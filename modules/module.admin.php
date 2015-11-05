<?php
session_start();

if ($_SESSION['admin'] == 1) {
	echo '<p>Админка</p>';


	?>

	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script type="text/javascript">
		ymaps.ready(init);
		function init() {
			var myMap = new ymaps.Map('map', {
				center: [55.753994, 37.622093],
				zoom: 3
			});

			<?php
	$sql = "SELECT * FROM sn_users;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	foreach ($sth as $row){
		$address = $row['city'] . ', ' . $row['street'] . ', ' . $row['building'];
		?>


			ymaps.geocode('<?=$address?>', {
				results: 1
			}).then(function (res) {
				var firstGeoObject = res.geoObjects.get(0),
					coords = firstGeoObject.geometry.getCoordinates(),
					bounds = firstGeoObject.properties.get('boundedBy');
				myMap.geoObjects.add(firstGeoObject);

			});

			<?php
			}
			?>
			myMap.setBounds(myMap.geoObjects.getBounds());
		}
	</script>
	<div id="map"></div>
	<?php
}

?>