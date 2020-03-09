<?php
use Models\User;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=__('Тестовое задание | Страница профайла')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>

<body>
    <div class="wr">
        <?php
        require 'header.php';?>

        <h1>
            <?=__('Профайл')?>
        </h1>

    <?php
    if( User::is_auth() ):?>
        <div>
            <table id="t-profile">
                <tr>
                    <td class="caption"><?=__('Фото')?>:</td>
                    <td>
                        <?php
                        if( empty($site['profile']['file_photo']) ):?>
                        нет фото
                        <?php
                        else:?>
                        <img src="public/image/thumbs/<?=$site['profile']['file_photo']?>" alt="<?=__('Фото')?>">
                        <?php
                        endif;?>
                    </td>
                </tr>

                <tr>
                    <td class="caption"><?=__('Фамилия')?>:</td>
                    <td>
                        <?=$site['profile']['surname']?>
                    </td>
                </tr>

                <tr>
                    <td class="caption"><?=__('Имя')?>:</td>
                    <td>
                        <?=$site['profile']['name']?>
                    </td>
                </tr>

                <tr>
                    <td class="caption"><?=__('Телефон')?>:</td>
                    <td>
                        <?=$site['profile']['phone']?>
                    </td>
                </tr>

                <tr>
                    <td class="caption"><?=__('Email')?>:</td>
                    <td>
                        <a href="mailto:<?=$site['profile']['email']?>"><?=$site['profile']['email']?></a>
                    </td>
                </tr>

                <tr>
                    <td class="caption"><?=__('О себе')?>:</td>
                    <td>
                        <?=$site['profile']['about']?>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    endif;?>
    </div>
</body>
</html>
