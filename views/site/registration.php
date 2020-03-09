<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=__('Регистрация пользователя')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>

<body>
    <div class="wr">
        <?php
        require 'header.php';?>
            <h1><?=__('Регистрация')?></h1>
            <div>
                <?php
                require 'form_messages.php';?>
                <form id="form_registration" name="form_registration" id="form_registration" enctype="multipart/form-data" method="post">
                    <table border="0">
                    <tr>
                        <td class="caption">
                            <?=__('Фамилия')?> <span>*</span>
                        </td>
                        <td class="field">
                            <input type="text" name="surname" value="<?=$site['form']['f']['surname']?>">
                        </td>
                        <td class="help">
                            <?=__('Пример: Иванов')?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('Имя')?> <span>*</span>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?=$site['form']['f']['name']?>">
                        </td>
                        <td class="help">
                            <?=__('Пример: Сергей')?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('Телефон')?> <span>*</span>
                        </td>
                        <td>
                            <input type="text" name="phone" value="<?=$site['form']['f']['phone']?>">
                        </td>
                        <td class="help">
                            <?=__('Пример')?>: +375 29 808-70-22
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email <span>*</span>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?=$site['form']['f']['email']?>">
                        </td>
                        <td class="help">
                            <?=__('Пример')?>: info@tof.by
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('О себе')?>
                        </td>
                        <td>
                            <textarea name="about"><?=$site['form']['f']['about']?></textarea>
                        </td>
                        <td class="help">
                            <?=__('Расскажите о себе: чем занимаетесь, чем увлекаетесь ')?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('Фото')?>
                        </td>
                        <td>
                            <?php
                            if( empty($site['form']['f']['file_name']) ):?>
                            <input type="file" name="file_photo">
                            <?php
                            else:?>
                            <input type="hidden" name="file_name" value="<?=$site['form']['f']['file_name']?>">
                            <img src="public/image/thumbs/<?=$site['form']['f']['file_name']?>" alt="фото">
                            <br><br>
                            <input type="submit" name="photo_delete" value="Удалить фото">
                            <?php
                            endif;?>
                        </td>
                        <td class="help">
                            <?php
                            if( empty($site['form']['f']['file_name']) ):?>
                            <?=__('Допустимые форматы: JPEG, JPG, GIF, PNG. Размер файла до 2 МБ')?>
                            <?php
                            endif;?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('Пароль')?> <span>*</span>
                        </td>
                        <td>
                            <input type="password" name="password" value="<?=$site['form']['f']['password']?>">
                        </td>
                        <td class="help">
                            <?=__('длина должна быть от 8 символов')?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?=__('Подтверждение пароля')?> <span>*</span>
                        </td>
                        <td>
                            <input type="password" name="password2" value="<?=$site['form']['f']['password2']?>">
                        </td>
                        <td class="help">
                            <?=__('длина должна быть от 8 символов')?>
                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="AntiCSRF_token" value="<?=$_SESSION['AntiCSRF_token']?>">
                            <input name="submit" type="submit" value="<?=__('Зарегистрировать')?>">
                        </td>
                        <td>

                        </td>
                    </tr>
                    </table>
                </form>
            </div>
    </div>
<script type="text/javascript" src="public/js/lib/jquery.min.js"></script>
<script type="text/javascript" src="public/js/lib/jquery.cookie.min.js"></script>
<script type="text/javascript" src="public/js/lib/jquery.maskedinput.js"></script>
<script type="text/javascript" src="public/js/site/lang.js"></script>
<script type="text/javascript" src="public/js/js.js"></script>
<script type="text/javascript" src="public/js/site/registration.js"></script>

</body>
</html>
