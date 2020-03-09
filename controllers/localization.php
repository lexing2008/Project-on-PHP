<?php

namespace Controllers;

use Config\Config;
use Core\Localization\LocalizationParser;
use Core\Helpers\DatetimeHelper;

/**
 * Контроллер Localization
 * Локализация и перевод сайта на другие языки
 * 
 * @author Алексей Согоян
 */
class Localization extends AbstractController {

    /**
     * Главная страница сайта
     */
    public function p_index(){
        $parser = new LocalizationParser('en_US');
        $parser->clear_locale();
        $parser->scan_dir( $_SERVER['DOCUMENT_ROOT'] . '/' );
    }

    /**
     * Страница смены локали
     */
    public function p_set_locale(){
        $config = Config::getInstance();

        $lang =  $_GET['lang'];
        if( in_array($lang, $config->get('LOCALES')) ){
            setcookie('LANG', $lang, time() + DatetimeHelper::YEAR_SECONDS, '/', $config->get('DOMAIN') );
        }
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        die();
    }
}
