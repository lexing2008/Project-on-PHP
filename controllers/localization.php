<?php

namespace Controllers;

use Config\Config;
use Core\Localization\LocalizationParser;

/**
 * Контроллер Localization
 *  Локализация и перевод сайта на другие языки
 * 
 * @author Алексей Согоян
 */
class Localization extends AbstractController {

    
    /**
     * Главная страница
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
            setcookie('LANG', $lang, time() + 3600 * 24 * 365, '/', $config->get('DOMAIN') );
        }
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        die();
    }

    
    
    
    
    public function pri( $a ){
        echo '<pre>';
        print_r($a);
        echo '</pre>';
    }
}
