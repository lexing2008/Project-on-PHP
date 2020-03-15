<?php

namespace Models;

use DB\DB;

/**
 * Модель User
 *
 * @author Алексей Согоян
 */
class User {

    /** 
     * Осуществляет авторизацию пользователя
     * @param string $email Email пользователя
     * @param string $password пароль пользователя
     * @return bool получилось ли залогиниться
     */
    public static function login(string $email, string $password): bool
    {
        $password = self::get_password_hash($password);

        $db = DB::get_instance();
        $statement = $db->prepare('SELECT id, name, surname, email, password
                                    FROM users
                                    WHERE email = :email  AND password = :password LIMIT 1');
        $statement->execute([
            'email'     => $email,
            'password'  => $password,
        ]);
        
        if( $statement->rowCount() ){
            $_SESSION['user'] = $statement->fetch();
        }

        return !empty($_SESSION['user']);
    }
    
    /** 
     * Возвращает true если пользователь авторизован
     * @return bool 
     */
    public static function is_auth(): bool
    {
        return !empty( $_SESSION['user']);
    }
    
    /**
     * Возвращает ID пользователя
     * @return int ID пользователя
     */
    public static function user_id(): int
    {
        return (int)$_SESSION['user']['id'];
    }
    
    /**
     * Возвращает информацию о пользователе
     * @param int $user_id
     * @return array Массив информации о пользователе
     */
    public static function get_user(int $user_id): array
    {
        $db = DB::get_instance();
        $statement = $db->prepare('SELECT id, name, surname, email, phone, password, about, file_photo
                                    FROM users
                                    WHERE id = :id LIMIT 1');
        $statement->execute([
            'id' => $user_id
        ]);
        return $statement->fetch();
    }
    
    /** 
     * Добавляет пользователя с передаваемыми параметрами в базу данных
     * 
     * @param string $surname Фамилия
     * @param string $name Имя
     * @param string $phone Телефон
     * @param string $email Электронная почта
     * @param string $password Пароль
     * @param string $about О себе
     * @param string $file_name Имя файла изображения
     */
    public static function insert_into_database(string $surname, string $name, string $phone, string $email, string $password, string $about, string $file_name ): void
    {
        // создаем пользователя в БД
        $db = DB::get_instance();

        $statement = $db->prepare('INSERT INTO users (surname, name, phone, email, password, about, file_photo)
                                    VALUES(:surname, :name, :phone, :email, :password, :about, :file_photo)');
        $statement->execute([
            'surname'       => $surname,
            'name'          => $name,
            'phone'         => $phone,
            'email'         => $email,
            'password'      => self::get_password_hash($password),
            'about'         => $about,
            'file_photo'    => $file_name,
        ]);
    }

    /**
     * Возвращает хэш пароля
     * @param string $password пароль
     * @return string хэш пароля
     */
    public static function get_password_hash(string $password): string
    {
        return password_hash(md5($password), PASSWORD_DEFAULT);
    }
    
    /**
     * Выход пользователя
     */
    public static function logout(): void
    {
        unset( $_SESSION['user'] );
    }
}