<?php


date_default_timezone_set('Europe/Moscow');


$sql_server = 'localhost';
$sql_dbname = '';
$sql_username = '';
$sql_password = '';
$pdo = new PDO("mysql:host=$sql_server;dbname=$sql_dbname", $sql_username, $sql_password, array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
