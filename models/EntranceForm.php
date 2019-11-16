<?php

namespace Models;

use Core\Helpers\Helper;

/**
 * Форма входа
 *
 * @author Lexing
 */
class EntranceForm extends AbstractForm {

    /**
     * Валидация полей формы
     * @return bool валидна ли форма
     */
    public function validation(){
        if( $this->is_form_submit() ){
            if( !$this->check_anti_csrf_token() ){
                $this->add_field_error( __('Анти CSRF токен поддельный') );
            }
            if( empty($this->fields_values['email']) ){
                $this->add_field_error( __('Поле "Email" не заполнено') );
            } else {
                // проверяем email на корректность
                if( !Helper::check_email( $this->fields_values['email'] ) ){
                   $this->add_field_error( __('Введите корректный Email') );
                }
            }
            if( empty($this->fields_values['password']) ){
                $this->add_field_error( __('Поле "Пароль" не заполнено') );
            } else {
                if( strlen($this->fields_values['password']) < 8 ){
                    $this->add_field_error( __('"Пароль" должен иметь длину 8 и более символов') );
                }
            }
        }
        return $this->is_valid();
    }
}