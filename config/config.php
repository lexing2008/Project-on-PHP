<?php
namespace Config;

use Core\Patterns\Singleton;
use Core\Patterns\PropertyContainer;
use Core\Localization\Localization;

/**
 * Конфигурационный Singleton
 * Содержит все настройки и параметры сайта
 */
class Config {

    /**
     * Делаем из класса Singleton
     */
    use Singleton;
    
    /**
     * Делаем из класса Контейнер Свойств
     */
    use PropertyContainer;
}

$config = Config::get_instance();
$config->set('DB_HOST',         'localhost');
$config->set('DB_NAME',         'db_test');
$config->set('DB_USER',         'root');
$config->set('DB_PASSWORD',     '');
$config->set('DOMAIN',          '1500.my');
$config->set('SESSION_NAME',    '1500_MY');
$config->set('CSRF_SECRETKEY',  '54as5da4s5d4as5d4wq5d45a4sd5ad'); // ключ для формирования токена, служащего защитой от CSRF атаки
// допустимые локали
$config->set('LOCALES',         [Localization::LOCALE_RU_RU, Localization::LOCALE_EN_US]);
// локаль по умолчанию
$config->set('DEFAULT_LOCALE',  Localization::LOCALE_RU_RU);