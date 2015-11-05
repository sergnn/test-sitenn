<?php

include_once 'inc.db.php';

header("Location: /site-nn/?page=lk");
session_start();
if(intval($_SESSION['uid']) > 0){
	$fields = array('name', 'email', 'phone', 'city', 'street', 'building', 'flat', 'pass');

	$fail = 0;
	foreach ($fields as $row)
		if (!isset($_POST[$row]))
			$fail = 1;

	if (!$fail) {
		$sql = "UPDATE `sn_users` " .
			"SET `name`=:name, `email`=:email, `phone`=:phone, `city`=:city, `street`=:street, " .
			"`building`=:building, `flat`=:flat, `pass`=:pass, `status`=:status " .
			"WHERE `id`=:id;";

		$sth = $pdo->prepare($sql);
		$sth->bindParam(':id', $_SESSION['uid']);
		$sth->bindParam(':name', $_POST['name']);
		$sth->bindParam(':email', $_POST['email']);
		$sth->bindParam(':phone', $_POST['phone']);
		$sth->bindParam(':city', $_POST['city']);
		$sth->bindParam(':street', $_POST['street']);
		$sth->bindParam(':building', $_POST['building'], PDO::PARAM_INT);
		$sth->bindParam(':flat', $_POST['flat'], PDO::PARAM_INT);
		$pass_hash = sha1($_POST['pass']);
		$sth->bindParam(':pass', $pass_hash);
		$sth->bindParam(':status', $_POST['status'], PDO::PARAM_INT);
		$sth->execute();
		if ($sth->errorCode() != 0)
			$fail = 3;
		else
			$_SESSION["status"] = intval($_POST['status']);
	}
}