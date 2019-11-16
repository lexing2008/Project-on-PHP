<?php
namespace DB;

Use Config\Config;
Use Core\Patterns\Singleton;
Use PDO;
use PDOException;
/**
 * Класс работы с БД
 *
 * @author Lexing
 */
class DB {
    use Singleton;
    
    private $pdo = NULL;
    
    /** Соединение с базой данныз Mysql
     * 
     * @throws Exception
     */
    public function connect(){
        $config = Config::getInstance();

        $dsn = 'mysql:host=' . $config->get('DB_HOST') .';dbname=' . $config->get('DB_NAME') .';charset=utf8';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $config->get('DB_USER'), $config->get('DB_PASSWORD'), $options);
    }
    
    /** Возврашает объект PDO
     * 
     * @return PDO объект PDO
     */
    public function pdo(){
        return $this->pdo;
    }
    

    /** Выполняет SQL запрос к БД
     * 
     * @param string $sql
     * @return type результат запроса
     */
    public function query( $sql ){
        return $this->pdo->query($sql);
    }
    
    public function prepare( $sql ){
        return $this->pdo->prepare($sql);
    }
    
    /**
     * Закрытие соединения с БД Mysql
     */
    public function close(){
        $this->pdo = NULL;
    }
    

   /** Вставка множества значений из массива в таблицу БД
   * 
   * @param string $table_name - имя таблицы в БД
   * @param type $array_data - массив массивов значений для вставки
   * @return string NULL | значение функции mysql_query();
   */
    public static function multiinsert($table_name, &$array_data) {

        $sql = '';
        $fields = '';
        $values = '';

        if( !empty($array_data) && is_array($array_data) ){
            // перебираем весь массив данных
            $data = $array_data[0];
            $count = count( $data );
            $index = 0;
            foreach($data as $key => $val){
                ++$index;
                $fields .= '`'.$key.'`';

                if( is_string($val) )
                    $val = mysql_escape_string($val);

                $values .= '\''.$val.'\'';
                if( $index != $count ){
                    $fields .= ', ';
                    $values .= ', ';
                }
            }
            
            $sql = 'INSERT INTO `' . $config->db['table_prefix'].$table_name. '`
                     ( '.$fields.' ) VALUES 
                     ( '.$values.' )';
            
            $size = count($array_data);
            for( $i=1;$i<$size;++$i ){
                $data = $array_data[$i];
                $values = '';
                $index = 0;
                foreach($data as $key => $val){
                    ++$index;
                    if(!empty($val) && is_string($val) )
                        $val = mysql_escape_string($val);

                    $values .= '\''.$val.'\'';
                    if( $index != $count ){
                        $values .= ', ';
                    }
                }                
                
                $sql .= ', ( '.$values.' ) ';
            }
            return mysql_query($sql);
        }
        return NULL;
    }
}
