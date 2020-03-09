<?php

namespace Core\Localization;

use DB\DB;
use Core\Localization\Localization;

/**
 * Парсер всех файлов php в проекте для локализации и перевода сайта на другие языки
 *
 * @author Lexing
 */
class LocalizationParser {

    /**
     * Шаблон регулярного выражения для поиска PHP файлов
     */
    const REGEXP_FILE_PATTERN = '/^(.*)\.php$/';
    
    /**
     * Текущая локаль
     * @var string
     */
    private $locale = Localization::LOCALE_RU_RU;

    /**
     * Конструктор
     * @param string $locale локаль
     */
    public function __construct(string $locale) {
        $this->locale = $locale;
    }
    
    /**
    * Сканирует все php файлы директории и поддиректорий
    * 
    * @return void
    */
    public function scan_dir(string $dir): void
    {
        $ret = array();
        // получаем список файлов и каталогов в АЛФАВИТНОМ порядке
        if( is_dir($dir) ){
            $arr = scandir($dir);
        } else {
            throw new Exception('Указанная директория не является таковой');
        }
        
        $size = count($arr);
        for($i=0; $i<$size; ++$i){
            if ( is_file($dir . $arr[$i] ) ) {
                if( preg_match(self::REGEXP_FILE_PATTERN, $arr[$i])) {
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
    public function parse_file(string $file_name): void
    {
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
    public function save_to_db(string $words): void
    {
        $db = DB::getInstance();

        $size = count($words);
        for( $i=0; $i<$size; ++$i ){
            // проверяем наличие такой фразы в БД
            $statement = $db->prepare('SELECT word FROM langs WHERE word = :word AND locale= :locale LIMIT 1');
            $statement->execute([
                'word'      => $words[$i],
                'locale'    => $this->locale,
            ]);
            
            if( $statement->rowCount() == 0 ){
                // добавляем в БД слово
                $statement = $db->prepare('INSERT INTO langs (word, locale)
                                            VALUES(:word, :locale)');
                $statement->execute([
                    'word'      => $words[$i],
                    'locale'    => $this->locale,
                ]);
            }
        }
    }
    
    /**
     * Очищает таблицу в БД от слов текущей локали
     */
    public function clear_locale(): void
    {
        $db = DB::getInstance();
        
        $statement = $db->prepare('DELETE FROM langs WHERE locale = :locale AND translate = \'\'');
        $statement->execute([
            'locale' => $this->locale
        ]);
    }
}