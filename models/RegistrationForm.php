<?php

namespace Models;

use Core\Image\Image;
use Core\Helpers\EmailHelper;

/**
 * Форма регистрации пользователя на сайте
 *
 * @author Lexing
 */
class RegistrationForm extends AbstractForm {

    /**
     * Директория хранения изображений
     * @var string 
     */
    protected $dir_images           = 'public/image/';
    
    /**
     * Директория хранения миниатюр изображения
     * @var string
     */
    protected $dir_images_thumbs    = 'public/image/thumbs/';
    
    /**
     * Максимальный допустимый размер файла изображения
     * @var int
     */
    protected $max_file_size        = 2*1024*1024;
    
    /**
     * Минимальная допустимая длина пароля
     * @var int 
     */
    protected $min_length_password  = 8;
    
    /**
     * Качество изображения при сохранении
     * Значени от 1 до 100
     * @var int
     */
    protected $quality              = 80;
    
    /**
     * Ширина изображения
     * @var int
     */
    protected $thumbs_width          = 250;
    
    /**
     * Высота изображения
     * @var int
     */
    protected $thumbs_height         = 250;

    /**
     * Разрешенные расширения файлов
     * @var array
     */
    protected $allowed_extensions    = ['jpeg', 'jpg', 'gif', 'png'];
    
    /**
     * Разрешенные Mime типы изображения
     * @var array
     */
    protected $allowed_mime_types    = ['image/jpeg', 'image/png', 'image/gif'];

    /**
     * Максимальный размер перемноженных ширины на высоту изображения
     * @var int
     */
    protected $max_image_size        = 10000000; 



    /**
     * Конструктор формы регистрации
     */
    public function __construct() {
        parent::__construct();
        $this->add_field_img();
    }

    
    /**
     * Валидация полей формы
     * @return bool валидна ли форма
     */
    public function validation(): bool
    {
        // удаление фотографии
        if( !empty($this->fields_values['photo_delete']) ){
            $path = $this->dir_images . $this->fields_values['file_name'];
            unlink($path);
            $path = $this->dir_images_thumbs . $this->fields_values['file_name'];
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
                if( !EmailHelper::check_email( $this->fields_values['email'] ) ){
                   $this->add_field_error( __('Введите корректный Email') );
                }
            }            
            if( empty($this->fields_values['password']) ){
                $this->add_field_error( __('Поле "Пароль" не заполнено') );
            } else {
                if( strlen($this->fields_values['password']) < $this->min_length_password )
                    $$this->add_field_error( __('"Пароль" должен быть длиной 8 и более символов ') );
            }
            if( empty($this->fields_values['password2']) ){
                $this->add_field_error( __('Поле "Подтверждение пароля" не заполнено') );
            } else {
                if( strlen($this->fields_values['password2']) < $this->min_length_password )
                    $this->add_field_error( __('"Подтверждение пароля" должно быть длиной 8 и более символов ') );
                
            }
            if( !empty($this->fields_values['password']) && !empty($this->fields_values['password2']) && $this->fields_values['password'] != $this->fields_values['password2'] ){
                $this->add_field_error( __('Поля "Пароль" и "Подтверждение пароля" не совпадают') );
            }
            
            if( !empty($_FILES['file_photo']['tmp_name']) ){
                if( $_FILES['file_photo']['size'] > $this->max_file_size )
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

        $path_parts = pathinfo($_FILES['file_photo']['name']);
        // устраняем проблему с регистром букв расширения файла
        $ext = strtolower($path_parts['extension']);
        if( !in_array($ext, $this->allowed_extensions) || !$this->check_mime_image_file() ){
            $this->add_field_error( __('Вы загрузили файл неподдерживаемого формата. Допустимые форматы файлов: JPEG, JPG, GIF, PNG') );
        } else {
            // проверяем разрешение изображения
            $info = getimagesize( $_FILES['file_photo']['tmp_name'] );
            if( $info[0]*$info[1] > $this->max_image_size ){
                $this->add_field_error( __('Прикрепленное изображение имеет слишком большое разрешение. Наш сервер не может его обработать. Пожалуйста, прикрепите другое изображение.') );
            } else {
                $this->fields_values['file_name'] = time() . '.' . $ext;
                $path = $this->dir_images_thumbs . $this->fields_values['file_name'];
                // копируем фотографию, если есть, на сервер
                copy($_FILES['file_photo']['tmp_name'], $path);

                $path_thumbs = self::DIR_IMAGES_THUMBS . $this->fields_values['file_name'];
                // делаем превьюшку фотки
                Image::scale($path_thumbs, $path, $this->thumbs_width, $this->thumbs_height, $this->quality);
            }
        }        
    }
    
    /**
     * Проверка MIME TYPE файла
     * @return bool
     */
    public function check_mime_image_file(){
        // проверка заголовка файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file_photo']['tmp_name'] );
        finfo_close($finfo);
        // - - - проверка заголовка файла
        return in_array($mime, $this->allowed_mime_types);
    }


    /**
     * Добавление поля изображения в fields_values
     */
    public function add_field_img(){
        $this->fields_values['file_name'] = '';
    }
}