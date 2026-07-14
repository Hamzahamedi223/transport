<section class="section section-alt" id="gallery">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow"><?= t('gallery.eyebrow') ?></span>
      <h2><?= t('gallery.title') ?></h2>
      <p class="subtitle"><?= t('gallery.subtitle') ?></p>
    </div>

    <div class="gallery-grid reveal">
      <div class="g-item g-main">
        <img src="<?= $baseUrl ?>/assets/images/gallery/van-side.jpg" alt="Zaouali Transport — vue latérale du fourgon"/>
        <span class="g-tag"><?= icon('verified-check-bold-duotone') ?> Peugeot Boxer</span>
      </div>
      <div class="g-item">
        <img src="<?= $baseUrl ?>/assets/images/gallery/van-rear.jpg" alt="Zaouali Transport — vue arrière du fourgon"/>
      </div>
      <div class="g-item">
        <img src="<?= $baseUrl ?>/assets/images/gallery/van-hero.jpg" alt="Zaouali Transport — fourgon en route" style="object-position: 30% center;"/>
      </div>
    </div>
  </div>
</section>
