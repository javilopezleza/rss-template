<?php
$fichero = new DOMDocument();
$fichero->load("http://www.ign.es/ign/RssTools/sismologia.xml");
$salida = array();
$terremotos = $fichero->getElementsByTagName("item");
foreach ($terremotos as $entry) {
	$nuevo = array();
	$nuevo["title"] = $entry->getElementsByTagName("title")[0]->nodeValue;
	$nuevo["link"] = $entry->getElementsByTagName("link")[0]->nodeValue;
	$nuevo["lat"] =  $entry->getElementsByTagName("lat")[0]->nodeValue;
	$nuevo["lng"] =  $entry->getElementsByTagName("long")[0]->nodeValue;
	$salida[] = $nuevo;
}
?>
<html>

<head><?php
		include_once '../../imports.php'
		?>
	<link rel="stylesheet" href="css/style.css">



	<meta charset="UTF-8">
	<title>Últimos terremotos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container-fluid">
	<?php
	include_once 'header.php';
	?>

	<h1>Tabla de terremotos recientes</h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<td scope="col">#</td>
				<td scope="col">Título</td>
				<td scope="col">Link</td>
				<td scope="col">Longitud</td>
				<td scope="col">Latitud</td>
			</tr>
		</thead>
		<tbody>

			<?php
			$counter = 1;
			foreach ($salida as $elemento) {
				$titulo = $elemento["title"];
				$link = $elemento["link"];
				$lat = $elemento["lat"];
				$lon = $elemento["lng"];
				echo "<tr>
					<th scope='row'>$counter</th>	
					<td>$titulo</td>
					<td><a href='$link' target='_blank'>Ver</a></td>
					<td>$lon</td>
					<td>$lat</td>
				</tr>";
				$counter++;
			}
			?>
		</tbody>
	</table>
</body>

</html>