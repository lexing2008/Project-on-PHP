<?php

namespace Core\Localization;

use Core\Patterns\Singleton;
use DB\DB;

/**
 * Класс локализации
 *
 * @author Lexing
 */
class Localization {
    use Singleton;
    /**
     * Текущая локаль
     * @var string 
     */
    private $locale = 'ru_RU';
    
    /**
     * Все фразы с переводом на текущий язык
     * @var array 
     */
    private $words = array();
    

    /**
     * Установка текущей локали
     * @param string $locale
     */
    public function set_locale($locale){
        $this->locale = $locale;
    }
    
    /**
     * Получение текущей локали
     * @return string
     */
    public function get_locale(){
        return $this->locale;
    }
    
    /**
     * Загрузка из БД переводов всех фраз на текущий язык
     */
    public function load_words(){
        $db = DB::getInstance();
        $statement = $db->prepare('SELECT word, translate
                                    FROM langs
                                    WHERE locale = :locale');
        
        $statement->execute(array(
            'locale' => $this->locale
        ));
        
        foreach ($statement as $row){
            $this->words[ $row['word'] ] = $row['translate'];
        }
    }

    /**
     * Возвращает перевод слова/фразы
     * @param type $word непереведенное слово
     * @return string переведенное слово
     */
    public function get_translate( $word ){
        return $this->words[$word];
    }
}
