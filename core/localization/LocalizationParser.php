<?php

namespace Core\Localization;

use DB\DB;

/**
 * Парсер всех файлов php в проекте для локализации и перевода сайта на другие языки
 *
 * @author Lexing
 */
class LocalizationParser {
    private $locale = 'ru_RU';
    public function __construct($locale) {
        $this->locale = $locale;
    }
    /**
    * Сканирует все php файлы директории и поддиректорий
    * 
    * @return void
    */
    public function scan_dir( $dir ){
        $ret = array();
        // получаем список файлов и каталогов в АЛФАВИТНОМ порядке
        if( is_dir($dir) )
            $arr = scandir($dir);
        else
            throw new Exception('Указанная директория не является таковой');
        
        // шаблон регулярного выражения
        $pattern = "/^(.*)\.php$/";
        $size = count($arr);
        for($i=0; $i<$size; ++$i){
            if ( is_file($dir . $arr[$i] ) ) {
                if( preg_match($pattern, $arr[$i])) {
                    echo $dir . $arr[$i] . '<br>';
                    $this->parse_file($dir . $arr[$i]);
                }
            } elseif( is_dir($dir . $arr[$i]) && $arr[$i]!= '..' && $arr[$i]!= '.' ){
                $this->scan_dir($dir . $arr[$i] . '/');
            }
        }
    }
    
    /**
     * Парсит файл и извлекает из него все языковые конструкции для перевода
     * @param string $file_name путь к файлу
     */
    public function parse_file( $file_name ){
        $content = file_get_contents($file_name);
        
        $pattern = '#__\(\'(.*)\'\)#i';
        $match = array();
        if (preg_match_all($pattern, $content, $match)) {
            $this->save_to_db($match[1]);
            echo '<pre>';
            print_r($match);
            echo '</pre>';
        }
    }
    
    /**
     * Сохранение в БД слов
     * @param string $words
     */
    public function save_to_db( $words ){
        $db = DB::getInstance();

        $size = count($words);
        for( $i=0; $i<$size; ++$i ){
            // проверяем наличие такой фразы в БД
            $statement = $db->prepare('SELECT word FROM langs WHERE word = :word AND locale= :locale LIMIT 1');
            $statement->execute(array(
                'word' => $words[$i],
                'locale' => $this->locale,
            ));
            
            if( $statement->rowCount() == 0 ){
                // добавляем в БД слово
                $statement = $db->prepare('INSERT INTO langs (word, locale)
                    VALUES(:word, :locale)');
                $statement->execute(array(
                    'word' => $words[$i],
                    'locale' => $this->locale,
                ));
            }
        }
    }
    
    /**
     * Очищает таблицу в БД от слов текущей локали
     */
    public function clear_locale(){
        $db = DB::getInstance();
        
        $statement = $db->prepare('DELETE FROM langs WHERE locale = :locale AND translate = \'\'');
        $statement->execute(array(
            'locale' => $this->locale
        ));
    }
}