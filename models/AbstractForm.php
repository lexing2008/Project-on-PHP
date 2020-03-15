<?php

namespace Models;

use Core\AntiCSRF;

/**
 * Класс абстрактной формы данных
 * 
 * @author Lexing <lexing2008@yandex.ru>
 */
abstract class AbstractForm {
    
    /**
     * Массив сообщений об ошибках
     * @var array 
     */
    private $field_errors = [];

    /**
     * Массив сообщений об успехе
     * @var array 
     */
    private $field_accept = [];
    
    /**
     * Массив значений полей формы
     * @var array 
     */
    protected $fields_values = [];

    /**
     * Конструктор класса
     */
    public function __construct() {
        $this->add_field_anti_csrf();
    }

    /**
     * Устанавливаем значения полей формы
     * @param array $values массив значений полей формы
     */
    public function set_fields_values(array $values): void
    {
        if( !empty($values) ){
            foreach($values as $key => $value){
                if( is_string($value) ){
                    $this->fields_values[$key] = htmlspecialchars(trim($value));
                }
            }
        }
    }

    /**
     * Добавляет анти CSRF токен
     */
    public function add_field_anti_csrf(): void
    {
        if( !$this->is_form_submit() ){
            // генерация токена формы
            if( empty($_SESSION['AntiCSRF_token']) ){
                $_SESSION['AntiCSRF_token'] = AntiCSRF::generate_token();
            }
            $this->set_fields_values( ['AntiCSRF_token' => $_SESSION['AntiCSRF_token'] ] );
        }
    }
    
    /**
     * Проверяет корректность анти CSRF токена
     * @return bool является ли токен верным
     */
    public function check_anti_csrf_token(): bool
    {
        return ($_SESSION['AntiCSRF_token'] == $this->fields_values['AntiCSRF_token'] 
                && AntiCSRF::check_token($this->fields_values['AntiCSRF_token']) ? true : false );
    }
    
    /**
     * Проверяет, является ли форма валидной.
     * Вызывать только после вызова validation()
     * @return bool является ли форма валидной
     */
    public function is_valid(): bool
    {
        return empty($this->field_errors);
    }
    
    /**
     * Возвращает массив сообщений об ошибке
     * @return array массив сообщений об ошибке
     */
    public function get_field_errors(): array
    {
        return $this->field_errors;
    }
    
    /**
     * Добавляет сообщение об ошибке в список сообщений об ошибке
     * @param string $message сообщение
     */
    public function add_field_error(string $message){
        $this->field_errors[] = $message;
    }
    
    /**
     * Добавляет успешное сообщение в массив успешных сообщений
     * @param string $message сообщение
     */
    public function add_field_accept(string $message){
        $this->field_accept[] = $message;
    }
    
    /**
     * Валидация формы
     */
    abstract function validation(): bool;

    /**
     * Проверяет была ли отправлена форма
     * @return bool была ли отправлена форма
     */
    public function is_form_submit(): bool
    {
        return !empty($this->fields_values['submit']);
    }
    
    /**
     * Возвращает значение поля формы
     * @param string $field название поля формы
     * @return string значение поля формы
     */
    public function get(string $field): string
    {
        return $this->fields_values[$field];
    }
    
    /**
     * Возвращает форму
     * @return array массив формы
     */
    public function get_form(): array
    {
        return  [
                    'accept' => $this->field_accept,
                    'errors' => $this->field_errors,
                    'f' => $this->fields_values,
                ];
    }
}