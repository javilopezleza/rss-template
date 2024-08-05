<?php 
    $fichero = new DOMDocument();
	$fichero->load( "http://ep00.epimg.net/rss/tags/ultimas_noticias.xml");
	$salida = array(); 
	$noticias = $fichero->getElementsByTagName("item");
    foreach($noticias as $noticia) {
		$nuevo = new stdClass();
		$nuevo->titular = $noticia->getElementsByTagName("title")[0]->nodeValue;
		$nuevo->descripcion =  $noticia->getElementsByTagName("description")[0]->nodeValue;				
		$elemento  = $noticia->getElementsByTagName("enclosure")[0];				
		$nuevo->img = $elemento->getAttribute('url');
		
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
					echo "<p>";
					echo "<img style='clear:left;padding:.1em;float:left' width='100px' src='{$noticia->img}'alt='Imagen'/></li>";
					echo "<strong>{$noticia->titular}</strong><br>
							{$noticia->descripcion}";
					echo "</p>";
				}
			?>
		</ul>
	</body>
</html>