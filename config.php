<?php

//Włączenie trybu developer - pokazywanie wszystkich błądów PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Ścieżki globalne
define('ROOT_PATH', __DIR__);
define('CORE_PATH', ROOT_PATH . '/core/');
define('APP_PATH', ROOT_PATH . '/app/');
define('MODEL_PATH', ROOT_PATH . '/model/');
define('VIEW_PATH', ROOT_PATH . '/view/');
define('CONTROLLER_PATH', ROOT_PATH . '/controller/');

// echo ROOT_PATH;

define('SITE_PATH', 'http://moje-portfolio.pl/dawid_matras/blog/');

//Połączenie z bazą danych
define('DB_ADDRESS', "");
define('DB_PORT', "");
define('DB_USER', "");
define('DB_PASSWORD', "");
define('DB_NAME', "");

//Pozostałe
define('DATE_FORMAT', 'Y-m-d H:i:s');
define('THEME', SITE_PATH . 'themes/clean-blog/');
define('MY_CSS_PATH', SITE_PATH . 'themes/mycss/');
