<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Content_model');
    }

    public function index()
    {
        $data['title']    = 'Contact';
        $data['meta_desc'] = 'Contactez Royal Sales Cameroon à Douala pour vos demandes de devis, support technique, maintenance ou informations sur nos compresseurs industriels.';
        $data['success']  = $this->session->flashdata('success');
        $data['error']    = $this->session->flashdata('error');
        $data['c']        = $this->Content_model->get_page('contact');
        $data['cms_page'] = 'contact';
        // Horodatage signé anti-spam (le formulaire doit avoir >= 3 s d'existence)
        $fts = (string)time();
        $data['antispam_ts']  = $fts;
        $data['antispam_sig'] = hash_hmac('sha256', $fts, $this->config->item('encryption_key'));
        $this->load->view('templates/header', $data);
        $this->load->view('contact/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function envoyer()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect('contact');
        }

        // ── Anti-spam ────────────────────────────────────────────────
        // 1. Pot de miel : champ invisible que seuls les robots remplissent.
        if (trim((string)$this->input->post('website')) !== '') {
            // On fait comme si tout s'était bien passé, sans rien enregistrer.
            $this->session->set_flashdata('success', 'Votre message a été envoyé. Nous vous répondrons sous 12h.');
            redirect('contact');
        }
        // 2. Horodatage signé : le formulaire doit avoir été affiché il y a
        //    au moins 3 secondes (les robots soumettent instantanément).
        $fts = (string)$this->input->post('fts');
        $sig = (string)$this->input->post('fsig');
        $expected = hash_hmac('sha256', $fts, $this->config->item('encryption_key'));
        if ($fts === '' || !hash_equals($expected, $sig)
            || (time() - (int)$fts) < 3 || (time() - (int)$fts) > 86400) {
            $this->session->set_flashdata('error', 'Vérification anti-spam échouée. Merci de réessayer.');
            redirect('contact');
        }

        $this->form_validation->set_rules('name',    'Nom',       'required|trim');
        $this->form_validation->set_rules('email',   'Email',     'required|trim|valid_email');
        $this->form_validation->set_rules('phone',   'Téléphone', 'required|trim');
        $this->form_validation->set_rules('subject', 'Sujet',     'required|trim');
        $this->form_validation->set_rules('message', 'Message',   'required|trim|min_length[10]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('contact');
        }

        $name    = $this->input->post('name',    TRUE);
        $company = $this->input->post('company', TRUE);
        $email   = $this->input->post('email',   TRUE);
        $phone   = $this->input->post('phone',   TRUE);
        $wa      = $this->input->post('whatsapp',TRUE);
        $subject = $this->input->post('subject', TRUE);
        $message = $this->input->post('message', TRUE);

        // ── Centralisation des demandes (leads B2B) ──────────────────
        // Chaque demande est enregistrée en base et visible dans
        // Admin → Demandes reçues, même si l'envoi d'e-mail échoue.
        $lead_id = $this->_store_lead($name, $company, $email, $phone, $wa, $subject, $message);

        // Email body
        $body  = "Nom : $name\n";
        if ($company) $body .= "Entreprise : $company\n";
        $body .= "Email : $email\n";
        $body .= "Téléphone : $phone\n";
        if ($wa) $body .= "WhatsApp : $wa\n";
        $body .= "Sujet : $subject\n\nMessage :\n$message";

        // Read settings from CMS
        $c         = $this->Content_model->get_page('contact');
        $mail_to   = !empty($c['mail_to'])   ? trim($c['mail_to'])   : 'info@rsc-cameroon.com';
        $mail_cc   = !empty($c['mail_cc'])   ? trim($c['mail_cc'])   : '';
        $mail_bcc  = !empty($c['mail_bcc'])  ? trim($c['mail_bcc'])  : '';
        $from_name = !empty($c['mail_from_name']) ? trim($c['mail_from_name']) : 'Royal Sales Cameroon';

        $smtp_host   = !empty($c['smtp_host'])   ? trim($c['smtp_host'])   : '';
        $smtp_port   = !empty($c['smtp_port'])   ? (int)$c['smtp_port']    : 587;
        $smtp_crypto = !empty($c['smtp_crypto']) ? trim($c['smtp_crypto']) : 'tls';
        $smtp_user   = !empty($c['smtp_user'])   ? trim($c['smtp_user'])   : '';
        $smtp_pass   = !empty($c['smtp_pass'])   ? trim($c['smtp_pass'])   : '';

        // Build email config
        $email_config = [
            'charset'  => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'text',
        ];

        if ($smtp_host !== '' && $smtp_user !== '') {
            // Use configured SMTP
            $email_config['protocol']   = 'smtp';
            $email_config['smtp_host']  = $smtp_host;
            $email_config['smtp_port']  = $smtp_port;
            $email_config['smtp_user']  = $smtp_user;
            $email_config['smtp_pass']  = $smtp_pass;
            if ($smtp_crypto !== '') {
                $email_config['smtp_crypto'] = $smtp_crypto;
            }
        }
        // If no SMTP configured, falls back to PHP mail() — works if server has sendmail

        $this->load->library('email', $email_config);

        // Expéditeur TOUJOURS une adresse du domaine (jamais celle du
        // visiteur, sinon SPF/DMARC échoue et le message part en spam).
        // Avec SMTP configuré : la boîte authentifiée. Sinon : info@rsc-cameroon.com.
        $from_email = $smtp_user ?: $mail_to;
        $this->email->from($from_email, $from_name);
        $this->email->reply_to($email, $name); // répondre = répondre au visiteur
        $this->email->to($mail_to);
        if ($mail_cc  !== '') $this->email->cc($mail_cc);
        if ($mail_bcc !== '') $this->email->bcc($mail_bcc);
        $this->email->subject('[RSC] ' . ucfirst($subject) . ' — ' . $name);
        $this->email->message($body);

        $sent = (bool)$this->email->send();
        if (!$sent) {
            $debug = $this->email->print_debugger(['headers', 'subject']);
            log_message('error', 'Contact form email failed: ' . $debug);
        }
        if ($lead_id) {
            $this->db->where('id', $lead_id)->update('rsc_leads', ['email_sent' => $sent ? 1 : 0]);
        }

        // La demande est enregistrée dans l'admin dans tous les cas :
        // on confirme au visiteur (exigence : confirmation après envoi).
        if ($sent || $lead_id) {
            $this->session->set_flashdata('success', 'Votre message a été envoyé. Nous vous répondrons sous 12h.');
        } else {
            $this->session->set_flashdata('error', 'Erreur lors de l\'envoi. Veuillez réessayer ou nous contacter directement par téléphone.');
        }

        redirect('contact');
    }

    /**
     * Enregistre la demande dans rsc_leads (table créée à la volée si absente).
     * Retourne l'id inséré, ou 0 en cas d'échec (l'e-mail reste tenté).
     */
    private function _store_lead($name, $company, $email, $phone, $wa, $subject, $message)
    {
        try {
            $this->db->simple_query(
                "CREATE TABLE IF NOT EXISTS rsc_leads (
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR(190) NOT NULL,
                    company VARCHAR(190) DEFAULT NULL,
                    email VARCHAR(190) NOT NULL,
                    phone VARCHAR(50) DEFAULT NULL,
                    whatsapp VARCHAR(50) DEFAULT NULL,
                    subject VARCHAR(150) DEFAULT NULL,
                    message TEXT,
                    lang VARCHAR(5) NOT NULL DEFAULT 'fr',
                    ip_address VARCHAR(45) DEFAULT NULL,
                    status ENUM('nouveau','traite') NOT NULL DEFAULT 'nouveau',
                    email_sent TINYINT(1) NOT NULL DEFAULT 0,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id),
                    KEY idx_status (status),
                    KEY idx_created (created_at)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
            );
            $this->db->insert('rsc_leads', [
                'name'       => mb_substr($name, 0, 190),
                'company'    => $company ? mb_substr($company, 0, 190) : null,
                'email'      => mb_substr($email, 0, 190),
                'phone'      => mb_substr($phone, 0, 50),
                'whatsapp'   => $wa ? mb_substr($wa, 0, 50) : null,
                'subject'    => mb_substr($subject, 0, 150),
                'message'    => $message,
                'lang'       => $this->config->item('rsc_lang') ?: 'fr',
                'ip_address' => $this->input->ip_address(),
            ]);
            return (int)$this->db->insert_id();
        } catch (Throwable $e) {
            log_message('error', 'Lead non enregistré : ' . $e->getMessage());
            return 0;
        }
    }
}
