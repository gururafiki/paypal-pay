<?php
require "libs/rb.php";
$host = 'localhost'; // адрес сервера
$database = 'dbname'; // имя базы данных
$user = 'name'; // имя пользователя
$password = 'password'; // пароль
R::setup( 'mysql:host=localhost;dbname='.$dbname,$name, $password );
?>