<?php
namespace Config;

use Core\Patterns\Singleton;
use Core\Patterns\PropertyContainer;

class Config {
    use Singleton;
    use PropertyContainer;
}

$config = Config::getInstance();
$config->set('DB_HOST', 'localhost');
$config->set('DB_NAME', 'db_test');
$config->set('DB_USER', 'root');
$config->set('DB_PASSWORD', '');
$config->set('DOMAIN', '1500.my');
$config->set('SESSION_NAME', '1500_MY');
$config->set('CSRF_SECRETKEY', '54as5da4s5d4as5d4wq5d45a4sd5ad'); // ключ для формирования токена, служащего защитой от CSRF атаки
// допустимые локали
$config->set('LOCALES', ['ru_RU', 'en_US']);
// локаль по умолчанию
$config->set('DEFAULT_LOCALE', 'ru_RU');