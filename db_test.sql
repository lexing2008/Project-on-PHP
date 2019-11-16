-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 16 2019 г., 12:25
-- Версия сервера: 5.5.62
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `langs`
--

CREATE TABLE `langs` (
  `word` varchar(255) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `translate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `langs`
--

INSERT INTO `langs` (`word`, `locale`, `translate`) VALUES
(' и получить личный профайл на нашем сайте.', 'en_US', 'and get a personal profile on our website.'),
(' недоступно', 'en_US', 'not available'),
('\"Пароль\" должен быть длиной 8 и более символов ', 'en_US', 'Password must be 8 or more characters\n'),
('\"Пароль\" должен иметь длину 8 и более символов', 'en_US', 'Password must be 8 or more characters long\n'),
('\"Подтверждение пароля\" должно быть длиной 8 и более символов ', 'en_US', '\"Password confirmation\" must be 8 or more characters long'),
('Email', 'en_US', 'Email'),
('Анти CSRF токен поддельный', 'en_US', 'Anti CSRF Token Fake'),
('В случае, если Вы являетесь счастливым обладателем аккаунта на нашем сайте, Вы можете просто', 'en_US', 'In case you are a happy owner of an account on our website, you can simply'),
('Введите корректный Email', 'en_US', 'Enter a valid Email'),
('Вид ', 'en_US', 'View'),
('Войти', 'en_US', 'To come in'),
('войти на сайт', 'en_US', 'enter the site'),
('Вход', 'en_US', 'Login'),
('Вы загрузили файл неподдерживаемого формата. Допустимые форматы файлов: JPEG, JPG, GIF, PNG', 'en_US', 'You have downloaded an unsupported file format. Allowed file formats: JPEG, JPG, GIF, PNG'),
('Выход', 'en_US', 'Logout'),
('Главная', 'en_US', 'Home'),
('длина должна быть от 8 символов', 'en_US', 'length must be from 8 characters'),
('Добро пожаловать на главную страницу сайта', 'en_US', 'Welcome to the home page'),
('Допустимые форматы: JPEG, JPG, GIF, PNG. Размер файла до 2 МБ', 'en_US', 'Allowed formats: JPEG, JPG, GIF, PNG. File size up to 2 MB'),
('Зарегистрировать', 'en_US', 'Register'),
('Имя', 'en_US', 'Name'),
('Некорректные \"Email\" или \"Пароль\"', 'en_US', 'Invalid Email or Password'),
('О себе', 'en_US', 'About'),
('Ошибка! Такого action не существует', 'en_US', 'Error! There is no such action'),
('Пароль', 'en_US', 'Password'),
('Подтверждение пароля', 'en_US', 'Password confirmation'),
('Поле \"Email\" не заполнено', 'en_US', 'Email field is blank'),
('Поле \"Имя\" не заполнено', 'en_US', 'Name field is empty'),
('Поле \"Пароль\" не заполнено', 'en_US', 'Password field is empty'),
('Поле \"Подтверждение пароля\" не заполнено', 'en_US', 'Password confirmation field is empty\n'),
('Поле \"Телефон\" не заполнено', 'en_US', 'Phone field is empty'),
('Поле \"Фамилия\" не заполнено', 'en_US', 'Surname field is empty'),
('Поля \"Пароль\" и \"Подтверждение пароля\" не совпадают', 'en_US', 'The fields \"Password\" and \"Confirm Password\" do not match'),
('Прикрепленное изображение имеет слишком большое разрешение. Наш сервер не может его обработать. Пожалуйста, прикрепите другое изображение.', 'en_US', 'Attached image has too high resolution. Our server cannot process it. Please attach another image.'),
('Пример', 'en_US', 'Example'),
('Пример: Иванов', 'en_US', 'Example: Ivanov'),
('Пример: Сергей', 'en_US', 'Example: Sergey'),
('пройти регистрацию', 'en_US', 'get registered'),
('Профайл', 'en_US', 'Profile'),
('Расскажите о себе: чем занимаетесь, чем увлекаетесь ', 'en_US', 'Tell us about yourself: what do you do, what do you like'),
('Регистрация', 'en_US', 'Registration'),
('Регистрация пользователя', 'en_US', 'User registration'),
('Телефон', 'en_US', 'Phone'),
('Тестовое задание | Страница профайла', 'en_US', 'Test task | Profile Page'),
('У Вас есть возможность', 'en_US', 'You have a chance'),
('Фамилия', 'en_US', 'Surname'),
('Фото', 'en_US', 'Photo'),
('Фото должно быть размером до 2МБ', 'en_US', 'Photo must be up to 2MB in size'),
('Этот шикарный проект был разработан для демонстрации способностей разработчика.', 'en_US', 'This chic project was designed to demonstrate the abilities of the developer.'),
('Язык', 'en_US', 'Language');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `file_photo` varchar(20) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `phone`, `email`, `password`, `file_photo`, `about`) VALUES
(1, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(2, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(3, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(4, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(5, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(6, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(7, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(8, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(9, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(10, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(11, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(12, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(13, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(14, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '', ''),
(15, 'Согоян', 'Алексей', '80298087022', 'lexing2008@yandex.ru', 'd9b1d7db4cd6e70935368a1efb10e377', '1573759817.jpg', ''),
(16, 'Согоян', 'Алексей', '(+375 29) 808-70-22', 'lexing2008@yandex.ru', '550e1bafe077ff0b0b67f4e32f29d751', '1573761595.jpg', 'aasdsa'),
(17, 'Согоян', 'Алексей', '(+375 29) 808-70-22', 'lexing2008@yandex.ru', '550e1bafe077ff0b0b67f4e32f29d751', '1573761595.jpg', 'aasdsa'),
(18, 'Согоян', 'Алексей', '(+375 29) 808-70-22', 'lexing2008@yandex.ru', '550e1bafe077ff0b0b67f4e32f29d751', '1573761595.jpg', 'aasdsa'),
(19, 'Согоян', 'Алексей', '(+375 29) 808-70-22', 'lexing2008@yandex.ru', '550e1bafe077ff0b0b67f4e32f29d751', '1573761595.jpg', 'aasdsa'),
(20, 'Согоян', 'Алексей', '(+375 29) 808-70-22', 'lexing2008@yandex.ru', '550e1bafe077ff0b0b67f4e32f29d751', '1573761595.jpg', 'aasdsa'),
(21, 'Иванов', 'Сергей', '(+375 29) 808-70-22', 'info@tof.by', '550e1bafe077ff0b0b67f4e32f29d751', '1573811307.jpg', 'Я хороший');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `langs`
--
ALTER TABLE `langs`
  ADD UNIQUE KEY `locale` (`locale`,`word`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
