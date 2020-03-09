<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=__('Тестовое задание | Главная страница')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>

<body>
    <div class="wr">
        <?php
        require 'header.php';?>

        <h1>
            <?=__('Добро пожаловать на главную страницу сайта')?>
        </h1>
        
        <p>
            <?=__('Этот шикарный проект был разработан для демонстрации способностей разработчика.')?>
        </p>
        
        <p>
            <?=__('У Вас есть возможность')?> 
            <a href="index.php?controller=site&action=registration"><?=__('пройти регистрацию')?></a>
        <?=__(' и получить личный профайл на нашем сайте.')?>
        </p>
        
        <p>
            <?=__('В случае, если Вы являетесь счастливым обладателем аккаунта на нашем сайте, Вы можете просто')?> 
            <a href="index.php?controller=site&action=entrance"><?=__('войти на сайт')?></a>.
        </p>
    </div>
</body>
</html>
