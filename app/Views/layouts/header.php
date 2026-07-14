<!doctype html>
<html lang="<?= App\Core\Lang::code() ?>" dir="<?= App\Core\Lang::dir() ?>">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($title ?? t('meta.title')) ?></title>
  <meta name="description" content="<?= htmlspecialchars($description ?? t('meta.description')) ?>"/>
  <link rel="icon" href="<?= $baseUrl ?>/assets/images/favicon.svg"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Inter:wght@400;500;600;700&family=Cairo:wght@500;600;700;800;900&display=swap"/>
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/global.css?v=<?= filemtime(ROOT_PATH . '/public/assets/css/global.css') ?>"/>
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/navbar.css?v=<?= filemtime(ROOT_PATH . '/public/assets/css/navbar.css') ?>"/>
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/home.css?v=<?= filemtime(ROOT_PATH . '/public/assets/css/home.css') ?>"/>
  <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/admin.css?v=<?= filemtime(ROOT_PATH . '/public/assets/css/admin.css') ?>"/>
  <script>
    var BASE_URL = '<?= htmlspecialchars($baseUrl ?? '', ENT_QUOTES) ?>';
  </script>
</head>
<body class="<?= App\Core\Lang::isRtl() ? 'is-rtl' : '' ?>">
