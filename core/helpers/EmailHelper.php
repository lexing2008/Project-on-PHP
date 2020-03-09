<?php

namespace Core\Helpers;

/**
 * Класс EmailHelper
 *
 * @author Lexing
 */
class EmailHelper {

    /**
     * Шаблон регулярного выражения для email
     */
    const REGEXP_PATTERN = '#^[-0-9a-z_\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$#i';
    
    /**
     * Проверяет, является ли email корректным
     * @param string $email email пользователя
     * @return bool является ли корректным email
     */
    public static function check_email(string $email): bool
    {
        return preg_match(self::REGEXP_PATTERN, $email);
    }
}