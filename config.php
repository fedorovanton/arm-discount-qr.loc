<?php
// настройки подключения
define('PATH', 'http://burgerjack.loc/'); // домен
define('HOST', '127.0.0.1'); // сервер
define('USER', 'root'); // пользователь
define('PASS', ''); // пароль
define('DB', 'burgerjack_db'); // БД

// соединение с БД
mysql_connect(HOST, USER, PASS) or die('Не удалось подключиться к серверу');
mysql_select_db(DB) or die('Не удалось открыть БД');
mysql_query("SET NAMES 'UTF8'") or die('Не удалось установить кодировку');

?>
