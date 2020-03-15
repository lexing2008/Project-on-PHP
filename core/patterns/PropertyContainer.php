<?php

namespace Core\Patterns;

/**
 * Трейт делает из класса Контейнер Свойств
 */
trait PropertyContainer {
    
    /**
     * Массив свойств
     * @var array 
     */
    private $properties = [];

    /**
     * Устанавливает значение свойства
     * @param mixed $property ключ
     * @param mixed $value значение
     */
    public function set( $property, $value ){
        $this->properties[$property] = $value;
    }
    
    /**
     * Возвращает значение по ключу
     * @param mixed $property ключ
     * @return mixed значение
     */
    public function get( $property ){
        return $this->properties[$property];
    }
}