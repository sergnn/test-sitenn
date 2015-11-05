<?php

include_once 'inc.db.php';

header("Location: /site-nn/?page=lk");

session_start();
unset($_SESSION["uid"]);
unset($_SESSION["status"]);
unset($_SESSION["admin"]);
session_destroy();

$fields = array('login', 'pass');

$fail = 0;
foreach ($fields as $row)
	if (!isset($_POST[$row]))
		$fail = 1;

$sql = "SELECT count(*) FROM sn_users WHERE `login` = :login LIMIT 1;";
$sth = $pdo->prepare($sql);
$sth->bindParam(':login', $_POST['login']);

$sth->execute();
if ($sth->fetchColumn() == 1) {
	$sql = "SELECT * FROM sn_users WHERE `login` = :login LIMIT 1;";
	$sth = $pdo->prepare($sql);
	$sth->bindParam(':login', $_POST['login']);

	$sth->execute();
	foreach ($sth as $row)
		$user = $row;
	$pass_hash = sha1($_POST['pass']);
	if ($user['pass'] == $pass_hash) {
		session_start();
		$_SESSION["uid"] = $user['id'];
		$_SESSION["status"] = $user['status'];
	}
}