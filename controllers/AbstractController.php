<?php

namespace Controllers;

/**
 * Абстрактный класс контроллера
 */
abstract class AbstractController{
    
    /**
     * Узел распределения запроса
     * @param string $action Название вызываемого action 
     */
    public function action(string $action): void
    {
        $method_name = 'p_' . $action;
        if( method_exists($this, $method_name) ) {
            $this->$method_name();
        } else {
            echo __('Ошибка! Такого action не существует');
        }
    }
    
    /** 
     * Подключает необходимый View
     * @param string $view_tpl_file имя файла View
     * @param array $site передаваемы во View данные
     */
    public function render(string $view_tpl_file, array $site): void
    {
        // подключаем необходимый вид 
        $view_tpl_file = 'views/site/' . $view_tpl_file;
        if(file_exists($view_tpl_file) ){
            include_once $view_tpl_file;
        } else {
            echo __('Вид ') . 
                    $view_tpl_file .
                    __(' недоступно');
        }
        // - - - подключаем необходимый вид
    }
    
    /**
     * Перемещает пользователя на главную страницу сайта
     */
    public function goto_home(): void
    {
        header('Location: /');
        die();
    }
}