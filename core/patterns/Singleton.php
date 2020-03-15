<?php

namespace Core\Patterns;

/**
 * Трейт делает из класса Singleton 
 */
trait Singleton {
    private static $instance = null;

    /**
     * Защищаем от создания через new Singleton
     */
    private function __construct() { } 
    
    /**
     * Защищаем от создания через клонирование
     */
    private function __clone() { }
    
    /**
     * Защищаем от создания через unserialize
     */
    private function __wakeup() { }

    /**
     * Возвращает Singleton объект класса
     * @return object Singleton объект класса
     */
    public static function get_instance() : object
    {
        return self::$instance===null
                ? self::$instance = new static() // Если $instance равен 'null', то создаем объект new self()
                : self::$instance; // Иначе возвращаем существующий объект 
    }
}