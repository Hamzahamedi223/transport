<section class="section" id="trajet">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow"><?= t('trajet.eyebrow') ?></span>
      <h2><?= t('trajet.title') ?></h2>
      <p class="subtitle"><?= t('trajet.subtitle') ?></p>
    </div>

    <div class="trajet-grid">
      <div class="card trajet-card reveal">
        <span class="icon-badge solid"><?= icon('point-on-map-bold-duotone') ?></span>
        <h3><?= t('trajet.simple.title') ?></h3>
        <p><?= t('trajet.simple.desc') ?></p>
        <div class="path-illustration">
          <span class="dot end"></span>
          <span class="line single"></span>
          <span class="icon-badge" style="width:30px;height:30px;border-radius:8px;"><?= icon('home-2-bold-duotone') ?></span>
        </div>
      </div>
      <div class="card trajet-card reveal">
        <span class="icon-badge solid"><?= icon('routing-2-bold-duotone') ?></span>
        <h3><?= t('trajet.double.title') ?></h3>
        <p><?= t('trajet.double.desc') ?></p>
        <div class="path-illustration">
          <span class="dot"></span>
          <span class="line"></span>
          <span class="dot end"></span>
        </div>
      </div>
    </div>
  </div>
</section>
