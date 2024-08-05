<!DOCTYPE html>
<html>

<head>

	<?php
	include_once '../../imports.php'
	?>

	<style>
		#map {
			height: 100%;
		}

		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>

	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<?php
	include_once 'header.php';
	?>

	<div id="map"></div>
	<script>
		function initMap() {
			var map;
			var results;
			map = new google.maps.Map(
				document.getElementById('map'), {
					zoom: 5.5,
					center: new google.maps.LatLng(40, -4),
					mapTypeId: 'terrain'
				});
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					results = JSON.parse(this.responseText);
					for (var i = 0; i < results.length; i++) {
						var title = results[i].title;
						var latLng = new google.maps.LatLng(
							results[i].lat, results[i].lng
						);
						var marker = new google.maps.Marker({
							position: latLng,
							title: title,
							map: map
						});
					}
				}
			}
			xhttp.open("GET", "terremotos_json.php", true);
			xhttp.send();
		}
	</script>
	<!--introducir API key -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
	</script>
</body>

</html>