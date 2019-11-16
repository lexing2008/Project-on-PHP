<?php

namespace Core\Helpers;

/**
 * Класс Helper
 *
 * @author Lexing
 */
class Helper {

    /**
     * Проверяет, является ли email корректным
     * @param string $email email пользователя
     * @return bool является ли корректным email
     */
    public static function check_email($email){
        $pattern = '#^[-0-9a-z_\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$#i';
        return preg_match($pattern, $email);
    }
}