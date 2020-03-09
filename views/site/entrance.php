<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=__('Вход')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="public/css/style.css" type="text/css">
</head>

<body>
    <div class="wr">
        <?php
        require 'header.php';?>
            <h1><?=__('Вход')?></h1>
            <div>
                <?php
                require 'form_messages.php';?>
                <form id="form_entrance" name="form_entrance" enctype="multipart/form-data" method="post">
                    <table width="600">
                    <tr>
                        <td class="caption">
                            <?=__('Email')?>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?=$site['form']['f']['email']?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="caption">
                            <?=__('Пароль')?>
                        </td>
                        <td>
                            <input type="password" name="password" value="<?=$site['form']['f']['password']?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="AntiCSRF_token" value="<?=$_SESSION['AntiCSRF_token']?>">
                            <input name="submit" type="submit" value="<?=__('Войти')?>">
                        </td>
                    </tr>
                    </table>
                </form>
            </div>
    </div>
<script type="text/javascript" src="public/js/lib/jquery.min.js"></script>
<script type="text/javascript" src="public/js/lib/jquery.cookie.min.js"></script>
<script type="text/javascript" src="public/js/site/lang.js"></script>
<script type="text/javascript" src="public/js/js.js"></script>
<script type="text/javascript" src="public/js/site/entrance.js"></script>
</body>
</html>
