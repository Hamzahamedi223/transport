<?php

// Auto-detect the public sub-path from the current script location.
$_base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

date_default_timezone_set('Africa/Tunis');

define('APP_NAME',         'Zaouali Transport');
define('BASE_URL',         $_base);
define('PUBLIC_ASSETS',    $_base . '/assets');
define('ROOT_PATH',        dirname(__DIR__));
define('WHATSAPP_NUMBER',    $_ENV['WHATSAPP_NUMBER'] ?? '21652292078');
define('PHONE_DISPLAY',      $_ENV['CONTACT_PHONE_DISPLAY'] ?? '52 292 078');
define('MESSENGER_USERNAME', $_ENV['MESSENGER_USERNAME'] ?? '');

unset($_base);
