<?php

namespace Core;

use Config\Config;

/**
 * Класс для работы с токенами защищающими от CSRF атаки
 */
class AntiCSRF {
    /** Генерирует токен
     * 
     * @return string токен
     */
    public static function generate_token(){
        $salt = rand(1000000,99999999);
        return self::get_token($salt); 
    }

    /**
     * Возвращает токен
     * @param string $salt соль
     * @return string токен формы
     */
    public static function get_token($salt){
        $config = Config::getInstance();
        return $salt . ':' . md5( $salt . $config->get('CSRF_SECRETKEY')  ); 
    }
    
    /**
     *  Проверяет CSRF токен формы на корректность
     * @param string $token Токен формы
     * @return bool Истина если верный токен
     */
    public static function check_token( $token ){
        $arr = split(':', $token);
        return self::get_token($arr[0]) == $token;
    }    
}
