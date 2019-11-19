<?php

namespace Models;

use Core\Image\Image;
use Core\Helpers\Helper;

/**
 * Форма регистрации
 *
 * @author Lexing
 */
class RegistrationForm extends AbstractForm {

    /**
     * Конструктор формы регистрации
     */
    public function __construct() {
        $this->add_field_img();
    }

    
    /**
     * Валидация полей формы
     * @return bool валидна ли форма
     */
    public function validation(){
        

        // удаление фотографии
        if( !empty($this->fields_values['photo_delete']) ){
            $path = 'public/image/' . $this->fields_values['file_name'];
            unlink($path);
            $path = 'public/image/thumbs/' . $this->fields_values['file_name'];
            unlink($path);
            unset($this->fields_values['file_name']);
        }
        
        if( $this->is_form_submit() ){
            
            if( !$this->check_anti_csrf_token() ){
                $this->add_field_error( __('Анти CSRF токен поддельный') );
            }
            if( empty($this->fields_values['surname']) ){
                $this->add_field_error( __('Поле "Фамилия" не заполнено') );
            }
            if( empty($this->fields_values['name']) ){
                $this->add_field_error( __('Поле "Имя" не заполнено') );
            }
            if( empty($this->fields_values['phone']) ){
                $this->add_field_error( __('Поле "Телефон" не заполнено') ) ;
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
                if( strlen($this->fields_values['password']) < 8 )
                    $$this->add_field_error( __('"Пароль" должен быть длиной 8 и более символов ') );
            }
            if( empty($this->fields_values['password2']) ){
                $this->add_field_error( __('Поле "Подтверждение пароля" не заполнено') );
            } else {
                if( strlen($this->fields_values['password2']) < 8 )
                    $this->add_field_error( __('"Подтверждение пароля" должно быть длиной 8 и более символов ') );
                
            }
            if( !empty($this->fields_values['password']) && !empty($this->fields_values['password2']) && $this->fields_values['password'] != $this->fields_values['password2'] ){
                $this->add_field_error( __('Поля "Пароль" и "Подтверждение пароля" не совпадают') );
            }
            
            if( !empty($_FILES['file_photo']['tmp_name']) ){
                if( $_FILES['file_photo']['size'] > 2*1024*1024 )
                    $this->add_field_error( __('Фото должно быть размером до 2МБ') );
                
                $this->upload_file_photo();
            }

        }
        return $this->is_valid();
    }
    
    /**
     * Загрузка файла фотографии на сервер
     */
    private function upload_file_photo(){
        $arr_ext = array('jpeg', 'jpg', 'gif', 'png');
        $path_parts = pathinfo($_FILES['file_photo']['name']);
        // устраняем проблему с регистром букв расширения файла
        $ext = strtolower($path_parts['extension']);
        if( !in_array($ext, $arr_ext) ){
            $this->add_field_error( __('Вы загрузили файл неподдерживаемого формата. Допустимые форматы файлов: JPEG, JPG, GIF, PNG') );
        } else {
            // проверяем разрешение изображения
            $info = getimagesize( $_FILES['file_photo']['tmp_name'] );
            if( $info[0]*$info[1] > 10000000 ){
                $this->add_field_error( __('Прикрепленное изображение имеет слишком большое разрешение. Наш сервер не может его обработать. Пожалуйста, прикрепите другое изображение.') );
            } else {
                $this->fields_values['file_name'] = time() . '.' . $ext;
                $path = 'public/image/' . $this->fields_values['file_name'];
                // копируем фотографию, если есть, на сервер
                copy($_FILES['file_photo']['tmp_name'], $path);

                $path_thumbs = 'public/image/thumbs/' . $this->fields_values['file_name'];
                // делаем превьюшку фотки
                Image::scale($path_thumbs, $path, 250, 250, 80);
            }
        }        
    }
    
    /**
     * Добавление поля изображения в fields_values
     */
    public function add_field_img(){
        $this->fields_values['file_name'] = '';
    }
}