<?php 
    $fichero = new DOMDocument();
	$fichero->load( "http://ep00.epimg.net/rss/tags/ultimas_noticias.xml");
	$salida = array(); 
	$noticias = $fichero->getElementsByTagName("item");
    foreach($noticias as $noticia) {
		$nuevo = array();
		$nuevo["titular"] = $noticia->getElementsByTagName("title")[0]->nodeValue;
		$nuevo["url"] =  $noticia->getElementsByTagName("link")[0]->nodeValue;
		
		$elemento  = $noticia->getElementsByTagName("enclosure")[0];				
		$nuevo["img"] = $elemento->getAttribute('url');

		$salida[] = $nuevo;
    }
?>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Últimas noticias</title>
	</head>
	<body>
		<ul>
			<?php
				foreach($salida as $noticia) {
					$url = $noticia["url"];
					$titular = $noticia["titular"];
					echo "<li><a href = '$url'>$titular</a>";
					echo "<img width='100px' src='{$noticia["img"]}'alt='Imagen'/>";
				}
			?>
		</ul>
	</body>
</html>