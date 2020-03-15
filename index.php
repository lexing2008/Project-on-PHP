<?php
// устраняем проблему с кодировкой
header('Content-type: text/html; charset=utf-8');

function __($str){
    $locale = Core\Localization\Localization::get_instance();
    $ret = $locale->get_translate( $str );
    return empty($ret)? $str : $ret ;
}

use App\App;

require_once 'vendor/autoload.php';

$app = App::getInstance();
$app->run();



