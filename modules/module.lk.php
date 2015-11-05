<?php
include_once 'inc.db.php';
$sql = "SELECT `city`, `street`, `building` FROM sn_users WHERE `id` = :id LIMIT 1;";
$sth = $pdo->prepare($sql);
$uid = intval($_SESSION["uid"]);
$sth->bindParam(':id', $uid, PDO::PARAM_INT);
$sth->execute();
$address = '';
foreach ($sth as $row)
	$address = $row['city'] . ', ' . $row['street'] . ', ' . $row['building'];

$sql = "SELECT * FROM sn_users WHERE `id` = :id LIMIT 1;";
$sth = $pdo->prepare($sql);
$uid = intval($_SESSION["uid"]);
$sth->bindParam(':id', $uid, PDO::PARAM_INT);
$sth->execute();
$user = array();
foreach ($sth as $row)
	$user = $row;

?>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
	ymaps.ready(init);
	function init() {
		var myMap = new ymaps.Map('map', {
			center: [55.753994, 37.622093],
			zoom: 9
		});
		ymaps.geocode('<?=$address?>', {
			results: 1
		}).then(function (res) {
			var firstGeoObject = res.geoObjects.get(0),
				coords = firstGeoObject.geometry.getCoordinates(),
				bounds = firstGeoObject.properties.get('boundedBy');
			myMap.geoObjects.add(firstGeoObject);
			myMap.setBounds(bounds, {
				checkZoomRange: true
			});
		});
	}
</script>

<div class="regform">
	<form role="form" id="regf" method="post" action="update.php">
		<div class="form-group">
			<label for="name">Ф. И. О. </label>
			<input class="form-control" id="name" name="name" type="text" required value="<?= $user['name'] ?>">
		</div>
		<div class="form-group">
			<label for="status">Статус:</label>
			<select class="form-control" name="status" id="status" <?= $user['status'] ?>>
				<option value="0"<?php if ($user['status'] == 0) echo ' selected'; ?>>юридическое лицо</option>
				<option value="1"<?php if ($user['status'] == 1) echo ' selected'; ?>>частное лицо</option>
			</select>
		</div>
		<div class="form-group">
			<label for="email">E-mail:</label>
			<input class="form-control" name="email" id="email" type="email" required value="<?= $user['email'] ?>">
		</div>
		<div class="form-group">
			<label for="phone">Телефон:</label>
			<input class="form-control" name="phone" id="phone" type="number" required value="<?= $user['phone'] ?>">
		</div>
		<div class="form-group">
			<label for="city">Город:</label>
			<input class="form-control" name="city" id="city" type="text" required value="<?= $user['city'] ?>">
		</div>
		<div class="form-group">
			<label for="street">Улица:</label>
			<input class="form-control" name="street" id="street" type="text" required value="<?= $user['street'] ?>">
		</div>
		<div class="form-group">
			<label for="building">Дом:</label>
			<input class="form-control" name="building" id="building" type="text" required
				   value="<?= $user['building'] ?>">
		</div>
		<div class="form-group">
			<label for="flat">Квартира:</label>
			<input class="form-control" name="flat" id="flat" type="text" required value="<?= $user['flat'] ?>">
		</div>
		<div class="form-group">
			<label for="login">Логин:</label>

			<p><?= $user['login'] ?></p>
		</div>
		<div class="form-group">
			<label for="pass">Пароль:</label>
			<input class="form-control" name="pass" id="pass" type="password" required value="">
		</div>
		<input class="btn btn-success" type="submit" value="Сохранить изменения">

	</form>
</div>
<br><br>
<div id="map"></div>