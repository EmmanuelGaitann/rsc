<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function index()
    {
        $this->load->model('Pages_model');
        $custom = $this->Pages_model->get_all();

        $urls = [
            ['loc' => base_url(),                    'priority' => '1.0',  'changefreq' => 'weekly'],
            ['loc' => base_url('a-propos'),          'priority' => '0.8',  'changefreq' => 'monthly'],
            ['loc' => base_url('produits'),          'priority' => '0.9',  'changefreq' => 'weekly'],
            ['loc' => base_url('services'),          'priority' => '0.9',  'changefreq' => 'monthly'],
            ['loc' => base_url('expertise'),         'priority' => '0.7',  'changefreq' => 'monthly'],
            ['loc' => base_url('galerie'),           'priority' => '0.6',  'changefreq' => 'monthly'],
            ['loc' => base_url('contact'),           'priority' => '0.8',  'changefreq' => 'monthly'],
            ['loc' => base_url('partenaires/renner'),'priority' => '0.8',  'changefreq' => 'monthly'],
            ['loc' => base_url('partenaires/ingersoll-rand'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => base_url('partenaires/cas-lubrifiants'),'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => base_url('mentions-legales'),  'priority' => '0.3',  'changefreq' => 'yearly'],
        ];

        foreach ($custom as $p) {
            if ($p->visible) {
                $urls[] = ['loc' => base_url('p/' . $p->slug), 'priority' => '0.6', 'changefreq' => 'monthly'];
            }
        }

        $today = date('Y-m-d');
        $xml   = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml  .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($u['loc']) . "</loc>\n";
            $xml .= "    <lastmod>$today</lastmod>\n";
            $xml .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$u['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        $this->output
            ->set_content_type('application/xml')
            ->set_output($xml);
    }
}
