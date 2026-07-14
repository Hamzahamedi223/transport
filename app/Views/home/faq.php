<section class="section" id="faq">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow"><?= t('faq.eyebrow') ?></span>
      <h2><?= t('faq.title') ?></h2>
    </div>

    <div class="faq-list reveal">
      <?php foreach ([1,2,3,4] as $i): ?>
      <div class="faq-item">
        <div class="faq-q">
          <span><?= t("faq.q{$i}") ?></span>
          <?= icon('round-alt-arrow-down-bold') ?>
        </div>
        <div class="faq-a"><p><?= t("faq.a{$i}") ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="container">
  <div class="cta-band reveal">
    <div>
      <h2><?= t('cta.title') ?></h2>
      <p><?= t('cta.subtitle') ?></p>
    </div>
    <a href="#order" class="btn btn-outline btn-lg"><?= icon('delivery-bold-duotone') ?> <?= t('cta.button') ?></a>
  </div>
</div>
