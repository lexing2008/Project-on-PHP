# Project-on-PHP

Просмотреть проект можно тут: http://project-on-php.zzz.com.ua/

Шаги установки:
1. Используем db_test.sql для создания базы данных
2. В конфиге config\config.php изменяем на свои

Хост базы данных:
$config->set('DB_HOST', 'localhost');

Название базы данных:
$config->set('DB_NAME', 'db_test');

Имя пользователя базы данных:
$config->set('DB_USER', 'root');

Пароль пользователя базы данных:
$config->set('DB_PASSWORD', '');

Имя домена:
$config->set('DOMAIN', '1500.my');


Просмотреть работающее веб-приложение можно тут: http://project-on-php.zzz.com.ua/
Я разместил его на бесплатном хостинге, поэтому хостер будет добавлять рекламу. Относитесь к этому снисходительно. =)

========== Локализация проекта ==========

Для этого создан контроллер Localization ( controllers/localization.php ) , который используя парсер LocalizationParser ( core/localization/LocalizationParser.php ) сканирует все файлы проекта и парсит все php-файлы на предмет функций __().
Таким образом парсер извлекает все фразы и добавляет в базу данных.
