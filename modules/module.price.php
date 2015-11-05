<?php
include_once 'inc.db.php'; ?>
<p>Прайс</p>
<?php
$sql = "SELECT * FROM sn_price LIMIT 10;";
$sth = $pdo->prepare($sql);
$sth->execute();

echo '<table>';
foreach ($sth as $row) {
	$price = $row['price'];
	if($_SESSION['status'] == 1)
		$price *= 1.13;

	echo '<tr><td>';
	echo '<img src="/site-nn/img/' . $row['img'] . '">';
	echo '<td width="200">' . $row['name'];
	echo '<td width="200"><b>' . $price . ' р.</b>';
}
echo '</table>' . PHP_EOL;
?>