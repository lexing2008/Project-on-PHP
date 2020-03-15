<?php

namespace Core\Localization;

use Core\Patterns\Singleton;
use DB\DB;

/**
 * Класс локализации
 * Позволяет иметь сайт на разных языках
 * 
 * @author Lexing
 */
class Localization {
    use Singleton;
    
    /**
     * Локаль русского языка для России
     */
    const LOCALE_RU_RU = 'ru_RU';
    
    /**
     * Локаль английского языка для США
     */
    const LOCALE_EN_US = 'en_US';
    
    /**
     * Текущая локаль
     * @var string 
     */
    private $locale = self::LOCALE_RU_RU;
    
    /**
     * Все фразы с переводом на текущий язык
     * @var array 
     */
    private $words = [];

    /**
     * Установка текущей локали
     * @param string $locale
     */
    public function set_locale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * Получение текущей локали
     * @return string
     */
    public function get_locale(): string
    {
        return $this->locale;
    }

    /**
     * Загрузка из БД переводов всех фраз на текущий язык
     */
    public function load_words(): void
    {
        $db = DB::get_instance();
        $statement = $db->prepare('SELECT word, translate
                                    FROM langs
                                    WHERE locale = :locale');
        
        $statement->execute([
            'locale' => $this->locale
        ]);
        
        foreach ($statement as $row){
            $this->words[ $row['word'] ] = $row['translate'];
        }
    }

    /**
     * Возвращает перевод слова/фразы
     * @param string $word слово, которое нужно перевести
     * @return string переведенное слово
     */
    public function get_translate(string $word): string
    {
        return $this->words[$word];
    }
}