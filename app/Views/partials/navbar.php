<header class="navbar" id="navbar">
  <div class="container">
    <a href="<?= $baseUrl ?>/#top" class="navbar-brand">
      <span class="mark"><?= icon('delivery-bold-duotone') ?></span>
      <span>
        <?= htmlspecialchars(t('nav.brand')) ?>
        <small><?= ['fr' => 'Tunisie', 'ar' => 'تونس'][App\Core\Lang::code()] ?></small>
      </span>
    </a>

    <nav>
      <ul class="navbar-links" id="navLinks">
        <li><a href="#services"><?= t('nav.services') ?></a></li>
        <li><a href="#how"><?= t('nav.how') ?></a></li>
        <li><a href="#gallery"><?= t('nav.gallery') ?></a></li>
        <li><a href="#about"><?= t('nav.about') ?></a></li>
        <li><a href="#faq"><?= t('nav.faq') ?></a></li>
        <li><a href="#order"><?= t('nav.order_cta') ?></a></li>
      </ul>
    </nav>

    <div class="navbar-actions">
      <div class="lang-switch">
        <a href="<?= $baseUrl ?>/lang?code=ar&amp;back=<?= urlencode($_SERVER['REQUEST_URI'] ?? '/') ?>" class="<?= App\Core\Lang::code() === 'ar' ? 'active' : '' ?>">AR</a>
        <a href="<?= $baseUrl ?>/lang?code=fr&amp;back=<?= urlencode($_SERVER['REQUEST_URI'] ?? '/') ?>" class="<?= App\Core\Lang::code() === 'fr' ? 'active' : '' ?>">FR</a>
      </div>
      <a href="#order" class="btn btn-primary btn-lg-only"><?= t('nav.order_cta') ?></a>
      <button class="navbar-toggle" id="navToggle" aria-label="menu">
        <?= icon('hamburger-menu-broken') ?>
      </button>
    </div>
  </div>
</header>
