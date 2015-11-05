<?php

include_once 'inc.db.php';

header("Location: /site-nn/?page=lk");

session_start();
unset($_SESSION["uid"]);
unset($_SESSION["status"]);
session_destroy();

$fields = array('name', 'email', 'phone', 'city', 'street', 'building', 'flat', 'login', 'pass');

$fail = 0;
foreach ($fields as $row)
	if (!isset($_POST[$row]))
		$fail = 1;

$sql = "SELECT count(*) FROM sn_users WHERE `login` = :login;";
$sth = $pdo->prepare($sql);
$sth->bindParam(':login', $_POST['login']);

$sth->execute();
if ($sth->fetchColumn() != 0)
	$fail = 2;

if (!$fail) {
	$sql = "INSERT INTO `sn_users` " .
		"(`id`, `name`, `email`, `phone`, `city`, `street`, `building`, `flat`, `login`, `pass`, `status`) " .
		"VALUES (NULL , :name, :email, :phone, :city, :street, :building, :flat, :login, :pass, :status);";

	$sth = $pdo->prepare($sql);
	$sth->bindParam(':name', $_POST['name']);
	$sth->bindParam(':email', $_POST['email']);
	$sth->bindParam(':phone', $_POST['phone']);
	$sth->bindParam(':city', $_POST['city']);
	$sth->bindParam(':street', $_POST['street']);
	$sth->bindParam(':building', $_POST['building'], PDO::PARAM_INT);
	$sth->bindParam(':flat', $_POST['flat'], PDO::PARAM_INT);
	$sth->bindParam(':login', $_POST['login']);
	$pass_hash = sha1($_POST['pass']);
	$sth->bindParam(':pass', $pass_hash);
	$sth->bindParam(':status', $_POST['status'], PDO::PARAM_INT);
	$sth->execute();
	if ($sth->errorCode() != 0)
		$fail = 3;
	else{
		session_start();
		$_SESSION["uid"] = $pdo->lastInsertId();
		$_SESSION["status"] = intval($_POST['status']);

		$sql = "SELECT * FROM sn_users WHERE `id` = :id LIMIT 1;";
		$sth = $pdo->prepare($sql);
		$sth->bindParam(':id', $_SESSION['uid']);
		$sth->execute();
		foreach ($sth as $row)
			$user = $row;

		$to  = "moocher@moocher.ru";
		$subject = "New user";

		$message = '
        <p>Имя: ' . $user['name'] . '</p>
        <p>Телефон: ' . $user['phone'] . '</p>
        <p>Почта: ' . $user['email'] . '</p>
        <p>Город: ' . $user['city'] . '</p>
        <p>Улица: ' . $user['street'] . '</p>
        <p>Дом: ' . $user['building'] . '</p>
        <p>Квартира: ' . $user['flat'] . '</p>
        <p>Логин: ' . $user['login'] . '</p>
        <p>Статус: ' . $user['status'] . '</p>
        <p>ID: ' . $user['id'] . '</p>';

		$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		$headers .= "From: moocher@moocher.ru\r\n";

		mail($to, $subject, $message, $headers);
	}
}

