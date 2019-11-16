<?php
use Models\User;
?>
    <div>
        <a href="index.php"><?=__('Главная')?></a> | 
        <?php
        if( User::is_auth() ):?>
        <a href="index.php?controller=site&action=profile"><?=__('Профайл')?></a> | 
        <a href="index.php?controller=site&action=exit"><?=__('Выход')?></a>
        <?php
        else:?>
        <a href="index.php?controller=site&action=registration"><?=__('Регистрация')?></a> | 
        <a href="index.php?controller=site&action=entrance"><?=__('Вход')?></a>
        <?php
        endif;?>
        
        <div id="h-lang">
            <?=__('Язык')?>:
            <a href="index.php?controller=localization&action=set_locale&lang=ru_RU">ru</a> | 
            <a href="index.php?controller=localization&action=set_locale&lang=en_US">eng</a> 
        </div>
    </div>
    