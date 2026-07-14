<?php include dirname(__DIR__) . '/partials/navbar.php'; ?>
<section class="section" style="padding-top:180px;text-align:center;">
  <div class="container">
    <span class="icon-badge solid" style="width:76px;height:76px;border-radius:22px;margin:0 auto 24px;"><?= icon('close-circle-bold') ?></span>
    <h1>404</h1>
    <p style="max-width:420px;margin:0 auto 28px;"><?= t('nav.notfound') ?></p>
    <a href="<?= $baseUrl ?>/#top" class="btn btn-primary"><?= t('nav.home') ?></a>
  </div>
</section>
<?php include dirname(__DIR__) . '/partials/footer.php'; ?>
