<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-brand">
          <span class="mark"><?= icon('delivery-bold-duotone') ?></span>
          <span><?= htmlspecialchars(t('nav.brand')) ?></span>
        </div>
        <p style="max-width:320px;color:rgba(255,255,255,0.6);"><?= t('footer.tagline') ?></p>
        <div class="footer-social">
          <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?= icon('baseline-whatsapp') ?></a>
          <?php if (MESSENGER_USERNAME !== ''): ?>
          <a href="https://m.me/<?= MESSENGER_USERNAME ?>" target="_blank" rel="noopener" aria-label="Messenger"><?= icon('messenger') ?></a>
          <a href="https://www.facebook.com/<?= MESSENGER_USERNAME ?>" target="_blank" rel="noopener" aria-label="Facebook"><?= icon('facebook') ?></a>
          <?php endif; ?>
          <a href="#" aria-label="Instagram"><?= icon('instagram') ?></a>
        </div>
      </div>

      <div>
        <h4><?= t('footer.nav') ?></h4>
        <ul class="footer-links">
          <li><a href="#services"><?= t('nav.services') ?></a></li>
          <li><a href="#how"><?= t('nav.how') ?></a></li>
          <li><a href="#gallery"><?= t('nav.gallery') ?></a></li>
          <li><a href="#about"><?= t('nav.about') ?></a></li>
          <li><a href="#order"><?= t('nav.order_cta') ?></a></li>
        </ul>
      </div>

      <div>
        <h4><?= t('footer.contact') ?></h4>
        <div class="footer-contact-item">
          <?= icon('phone-calling-rounded-bold-duotone') ?>
          <a href="tel:+<?= WHATSAPP_NUMBER ?>"><bdi><?= PHONE_DISPLAY ?></bdi></a>
        </div>
        <div class="footer-contact-item">
          <?= icon('baseline-whatsapp') ?>
          <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank" rel="noopener">WhatsApp</a>
        </div>
        <?php if (MESSENGER_USERNAME !== ''): ?>
        <div class="footer-contact-item">
          <?= icon('messenger') ?>
          <a href="https://m.me/<?= MESSENGER_USERNAME ?>" target="_blank" rel="noopener">Messenger</a>
        </div>
        <?php endif; ?>
        <div class="footer-contact-item">
          <?= icon('global-bold-duotone') ?>
          <span><?= t('about.point4') ?></span>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> <?= htmlspecialchars(t('nav.brand')) ?> — <?= t('footer.rights') ?></span>
      <span><?= t('footer.made') ?></span>
    </div>
  </div>
</footer>

<div class="float-stack">
  <?php if (MESSENGER_USERNAME !== ''): ?>
  <a href="https://m.me/<?= MESSENGER_USERNAME ?>" target="_blank" rel="noopener" class="messenger-float" aria-label="Messenger">
    <?= icon('messenger') ?>
  </a>
  <?php endif; ?>
  <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank" rel="noopener" class="wa-float" aria-label="<?= htmlspecialchars(t('whatsapp.float')) ?>">
    <?= icon('baseline-whatsapp') ?>
  </a>
</div>
