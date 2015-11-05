<?php
include_once 'inc.db.php';
session_start();

if($_SESSION['uid'] > 0 ) {
	$sql = "SELECT * FROM sn_users WHERE `id` = :id LIMIT 1;";
	$sth = $pdo->prepare($sql);
	$sth->bindParam(':id', $_SESSION['uid']);

	$sth->execute();
	foreach ($sth as $row)
		$user = $row;
	$_SESSION['status'] = $user['status'];
	$_SESSION['admin'] = $user['admin'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Тестовое задание Сайт-НН</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU&load=SuggestView&onload=onLoad"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.kladr.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.kladr.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
</head>
<body>
<?php

if (intval($_SESSION["uid"]) > 0) {
	echo '<p><a href="/site-nn/?page=lk">Личный кабинет</a>' .
	' | <a href="/site-nn/?page=price">Товары</a>';

	if($_SESSION['admin'] == 1)
		echo ' | <a href="?page=admin">Админка</a>';

	echo ' | <a href="/site-nn/reg.php">Выйти</a></p>';

	if ($_GET['page'] == 'admin')
		include 'modules/module.admin.php';
	if ($_GET['page'] == 'lk')
		include 'modules/module.lk.php';
	if ($_GET['page'] == 'price')
		include 'modules/module.price.php';
} else {
	if ($_GET['page'] == 'reg')
		include 'modules/module.reg.php';
	else
		include 'modules/module.login.php';
}
?>
</body>
</html>