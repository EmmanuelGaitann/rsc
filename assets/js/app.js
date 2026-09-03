// ===== Royal Sales Cameroon — Main Application JS =====

// ── Gestion de la langue (FR / EN) ────────────────────────────────────────────
// La traduction est faite CÔTÉ SERVEUR (hook Rsc_lang_hook + Rsc_translator) :
// tout le contenu, y compris les textes créés/modifiés dans l'admin, est
// traduit automatiquement. Ici on ne gère que le choix de langue (cookie).
function _getActiveLang() {
  var m = document.cookie.match(/(?:^|;\s*)rsc_lang=(en|fr)/);
  if (m) return m[1];
  try { return localStorage.getItem('rsc_lang') || 'fr'; } catch (e) { return 'fr'; }
}

let currentLang = _getActiveLang();

function setLang(lang) {
  if (lang !== 'en' && lang !== 'fr') lang = 'fr';
  var secure = (window.location.protocol === 'https:') ? ';Secure' : '';
  document.cookie = 'rsc_lang=' + lang + ';path=/;max-age=31536000;SameSite=Lax' + secure;
  try { localStorage.setItem('rsc_lang', lang); } catch (e) {}
  // Recharge la page sans paramètre ?lang= résiduel (le cookie fait foi)
  var url = window.location.href.replace(/([?&])lang=(en|fr)(&|$)/, function (_, p1, _v, p3) {
    return p3 ? p1 : '';
  }).replace(/[?&]$/, '');
  if (url === window.location.href) { window.location.reload(); }
  else { window.location.href = url; }
}

// Conservé pour compatibilité : la traduction du contenu est désormais rendue
// par le serveur — on ne remplace PLUS les textes [data-i18n] côté client
// (cela écrasait les textes personnalisés dans l'admin).
function applyTranslations() {
  document.documentElement.setAttribute('lang', currentLang);
}

// tr() reste utilisé pour les quelques textes générés en JavaScript.
function tr(key) {
  return (t[currentLang] && t[currentLang][key]) || (t['fr'] && t['fr'][key]) || key;
}

// ── SVG icons ─────────────────────────────────────────────────────────────────
const icons = {
  screw:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2zm0 18a8 8 0 110-16 8 8 0 010 16zm-1-5h2v2h-2v-2zm0-8h2v6h-2V7z"/></svg>`,
  wind:    `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.79 1.42-1.41zM4 10.5H1v2h3v-2zm9-9.95h-2V3.5h2V.55zm7.45 3.91l-1.41-1.41-1.79 1.79 1.41 1.41 1.79-1.79zm-3.21 13.7l1.79 1.8 1.41-1.41-1.8-1.79-1.4 1.4zM20 10.5v2h3v-2h-3zm-8-5c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm-1 16.95h2V19.5h-2v2.95zm-7.45-3.91l1.41 1.41 1.79-1.8-1.41-1.41-1.79 1.8z"/></svg>`,
  piston:  `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H7v-2h5v2zm5-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>`,
  filter:  `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 6h10l-5 7-5-7zm-2-2h14l-6 8.39V19l-2 1v-7.61L5 4z"/></svg>`,
  tank:    `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/></svg>`,
  control: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/></svg>`,
  all:     `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg>`,
  location:`<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>`,
  phone:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>`,
  email:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>`,
  chat:    `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>`,
  clock:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>`,
  arrow:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>`,
  check:   `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>`,
};

// ── Navigation & Footer now rendered by PHP (header.php / footer.php) ─────────

function toggleMobileMenu() {
  document.getElementById('mobile-nav')?.classList.toggle('open');
}


// ── WhatsApp button ───────────────────────────────────────────────────────────
function buildWhatsApp() {
  const el = document.createElement('a');
  el.href = 'https://wa.me/237691123112?text=Bonjour%20RSC%20Cameroon%2C%20je%20souhaite%20obtenir%20des%20informations.';
  el.target = '_blank';
  el.rel = 'noopener';
  el.className = 'whatsapp-btn';
  el.setAttribute('aria-label', 'Contactez-nous sur WhatsApp');
  el.title = 'Contactez-nous sur WhatsApp';
  el.innerHTML = `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" fill="white"/></svg>`;
  document.body.appendChild(el);
}

// ── Scroll effects ────────────────────────────────────────────────────────────
function initScrollEffects() {
  window.addEventListener('scroll', () => {
    const nav = document.getElementById('main-nav');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 20);
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.08 });

  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
}

// ── Contact form ──────────────────────────────────────────────────────────────
function initContactForm() {
  const form = document.getElementById('contact-form');
  if (!form) return;

  form.addEventListener('submit', function() {
    const btn = form.querySelector('[type=submit]');
    if (btn) {
      btn.disabled = true;
      btn.style.opacity = '0.7';
      btn.textContent = tr('sending');
    }
    // Soumission réelle au serveur PHP — pas de preventDefault
  });
}

// ── Product filter ────────────────────────────────────────────────────────────
let activeCat = 'all';
let activeBrand = 'all';

function applyProductFilters() {
  document.querySelectorAll('.product-card').forEach(card => {
    const catMatch = activeCat === 'all' || card.dataset.cat === activeCat;
    const brandMatch = activeBrand === 'all' || card.dataset.brand === activeBrand;
    card.style.display = (catMatch && brandMatch) ? '' : 'none';
  });
  const noResults = document.getElementById('no-results');
  if (noResults) {
    const visible = document.querySelectorAll('.product-card:not([style*="none"])');
    noResults.classList.toggle('hidden', visible.length > 0);
  }
}

function initProductFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  if (!filterBtns.length) return;

  const urlCat = new URLSearchParams(window.location.search).get('cat');
  if (urlCat) {
    activeCat = urlCat;
    filterBtns.forEach(btn => btn.classList.toggle('active', btn.dataset.filter === urlCat));
    applyProductFilters();
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      activeCat = this.dataset.filter;
      applyProductFilters();
    });
  });
}

function initBrandFilter() {
  const brandBtns = document.querySelectorAll('.brand-btn');
  if (!brandBtns.length) return;

  brandBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      brandBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      activeBrand = this.dataset.brand;
      applyProductFilters();
    });
  });
}

// ── Social floating bar ───────────────────────────────────────────────────────
function buildSocialBar() {
  const bar = document.createElement('div');
  bar.id = 'social-bar';
  bar.innerHTML = `
    <a href="https://www.facebook.com/profile.php?id=100093512901441" target="_blank" rel="noopener" class="sb-fb" aria-label="Facebook Royal Sales Cameroon">
      <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
    </a>
    <a href="https://www.linkedin.com/in/rsc-cameroon-sarl-215392364/" target="_blank" rel="noopener" class="sb-li" aria-label="LinkedIn Royal Sales Cameroon">
      <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
    </a>
    <a href="https://www.instagram.com/rscameroon/" target="_blank" rel="noopener" class="sb-ig" aria-label="Instagram Royal Sales Cameroon">
      <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
    </a>
    <a href="https://wa.me/237691123112" target="_blank" rel="noopener" class="sb-wa" aria-label="WhatsApp Royal Sales Cameroon">
      <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
  `;
  document.body.appendChild(bar);
}

// ── Search ────────────────────────────────────────────────────────────────────
function initSearch() {
  const searchInput = document.getElementById('product-search');
  if (!searchInput) return;

  searchInput.addEventListener('input', function() {
    const q = this.value.toLowerCase().trim();
    let count = 0;

    document.querySelectorAll('.product-card').forEach(card => {
      const matches = !q || card.textContent.toLowerCase().includes(q);
      card.style.display = matches ? '' : 'none';
      if (matches) count++;
    });

    const noResults = document.getElementById('no-results');
    if (noResults) noResults.classList.toggle('hidden', count > 0);
  });
}

// ── Hero Carousel ─────────────────────────────────────────────────────────────
function initHeroCarousel() {
  document.querySelectorAll('.hero-carousel').forEach(function(carousel) {
    var slides = Array.from(carousel.querySelectorAll('.hc-track .hc-slide'));
    var dots   = Array.from(carousel.querySelectorAll('.hc-dots .hc-dot'));
    var current = 0;
    var timer;

    if (slides.length < 2) return;

    function goTo(n) {
      slides[current].classList.remove('active');
      if (dots[current]) dots[current].classList.remove('active');
      current = ((n % slides.length) + slides.length) % slides.length;
      slides[current].classList.add('active');
      if (dots[current]) dots[current].classList.add('active');
    }

    function startTimer() { timer = setInterval(function() { goTo(current + 1); }, 3000); }
    function resetTimer() { clearInterval(timer); startTimer(); }

    var btnNext = carousel.querySelector('.hc-next');
    var btnPrev = carousel.querySelector('.hc-prev');
    if (btnNext) btnNext.addEventListener('click', function() { goTo(current + 1); resetTimer(); });
    if (btnPrev) btnPrev.addEventListener('click', function() { goTo(current - 1); resetTimer(); });

    dots.forEach(function(dot, i) {
      dot.addEventListener('click', function() { goTo(i); resetTimer(); });
    });

    carousel.addEventListener('mouseenter', function() { clearInterval(timer); });
    carousel.addEventListener('mouseleave', startTimer);
    startTimer();
  });
}

// ── Init ──────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  buildWhatsApp();
  buildSocialBar();
  initScrollEffects();
  initContactForm();
  initProductFilter();
  initBrandFilter();
  initSearch();
  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.lang === currentLang);
  });
  initHeroCarousel();
});

document.addEventListener('DOMContentLoaded', function() {
  applyTranslations();
});
