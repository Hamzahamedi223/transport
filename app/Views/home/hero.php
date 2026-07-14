<section class="hero" id="top">
  <div class="container">
    <div class="hero-copy">
      <span class="hero-eyebrow"><?= icon('shield-check-bold-duotone') ?> <?= t('hero.eyebrow') ?></span>
      <h1><?= t('hero.title_line1') ?> <span class="accent"><?= t('hero.title_highlight') ?></span></h1>
      <p class="lead"><?= t('hero.subtitle') ?></p>

      <div class="hero-cta">
        <a href="#order" class="btn btn-primary btn-lg"><?= icon('delivery-bold-duotone') ?> <?= t('hero.cta_order') ?></a>
        <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank" rel="noopener" class="btn btn-whatsapp btn-lg"><?= icon('baseline-whatsapp') ?> <?= t('hero.cta_whatsapp') ?></a>
        <?php if (MESSENGER_USERNAME !== ''): ?>
        <a href="https://m.me/<?= MESSENGER_USERNAME ?>" target="_blank" rel="noopener" class="btn btn-messenger btn-lg"><?= icon('messenger') ?> <?= t('hero.cta_messenger') ?></a>
        <?php endif; ?>
      </div>

      <div class="hero-stats">
        <div class="stat"><b><?= t('hero.stat1_num') ?></b><span><?= t('hero.stat1_label') ?></span></div>
        <div class="stat"><b><?= t('hero.stat2_num') ?></b><span><?= t('hero.stat2_label') ?></span></div>
        <div class="stat"><b><?= t('hero.stat3_num') ?></b><span><?= t('hero.stat3_label') ?></span></div>
      </div>
    </div>

    <div class="hero-media">
      <div class="frame">
        <img src="<?= $baseUrl ?>/assets/images/gallery/van-hero.jpg" alt="Zaouali Transport — fourgon" width="605" height="653"/>
      </div>
      <div class="float-card">
        <span class="icon-badge solid"><?= icon('phone-calling-rounded-bold-duotone') ?></span>
        <div>
          <b><bdi><?= PHONE_DISPLAY ?></bdi></b>
          <span><?= t('hero.phone_label') ?></span>
        </div>
      </div>
    </div>
  </div>
</section>
