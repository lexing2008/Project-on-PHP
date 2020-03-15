<?php
namespace DB;

use Config\Config;
use Core\Patterns\Singleton;
use PDO;
use PDOStatement;
use PDOException;
/**
 * Класс работы с БД
 *
 * @author Lexing
 */
class DB {

    /**
     * Делаем из класса Singleton
     */
    use Singleton;
    
    /**
     * Объект PDO
     * @var PDO 
     */
    private $pdo = NULL;
    
    /** 
     * Соединение с базой данныз Mysql
     * @throws Exception
     */
    public function connect(): void
    {
        $config = Config::get_instance();

        $dsn = 'mysql:host=' . $config->get('DB_HOST') .';dbname=' . $config->get('DB_NAME') .';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $config->get('DB_USER'), $config->get('DB_PASSWORD'), $options);
    }
    
    /** 
     * Возврашает объект PDO
     * @return PDO объект PDO
     */
    public function pdo(): PDO 
    {
        return $this->pdo;
    }
    
    /** 
     * Выполняет SQL запрос к БД
     * @param string $sql
     * @return PDOStatement результат запроса
     */
    public function query(string $sql): PDOStatement
    {
        return $this->pdo->query($sql);
    }
    
    /**
     * Подготовленный SQL запрос
     * @param string $sql
     * @return PDOStatement результат запроса
     */
    public function prepare(string $sql): PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
    
    /**
     * Закрытие соединения с БД Mysql
     */
    public function close(): void
    {
        $this->pdo = NULL;
    }
}