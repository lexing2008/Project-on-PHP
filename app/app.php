<?php
namespace App;

use DB\DB;
use Config\Config;
use Core\Patterns\Singleton;
use Core\Localization\Localization;

/**
 * Класс приложения MVC
 * Обеспечивает выполнение приложения
 * Создавая сайт мы создаем объект приложения
 */
class App{

    /**
     * Делаем из класса Singleton
     */
    use Singleton;
    
    /**
     * Инициализация приложения
     */
    public function run(): void
    {
        $config = Config::get_instance();
        // запускаем сессию
        session_name( $config->get('SESSION_NAME') );
        session_set_cookie_params (1400 , '/' , '.' . $config->get('DOMAIN') );
        session_start();
        
        // подключаемся к БД
        $db = DB::get_instance();
        $db->connect();
        
        // установка локали
        if( !empty($_COOKIE['LANG']) && in_array($_COOKIE['LANG'], $config->get('LOCALES')) ){
            $lang = $_COOKIE['LANG'];
        } else {
            $lang = $config->get('DEFAULT_LOCALE');
        }

        $locale = Localization::get_instance();
        $locale->set_locale( $lang );
        $locale->load_words();
        

        if( empty($_GET) ){
            // устанавливаем конктроллер по умолчанию
            $controller_name    = 'site';
            $action             = 'index';
        } else {
            $controller_name    = $_GET['controller'];
            $action             = $_GET['action'];
        }
        
        $controller_name = 'Controllers\\' . $controller_name;
        if( class_exists($controller_name) ){
            (new $controller_name)->action($action);
        } else {
            echo 'Не удалось найти такой контроллер: ';
            echo $controller_name;
        }

        $db->close();   
    }
}
