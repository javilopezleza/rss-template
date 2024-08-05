<?php
$fichero = new DOMDocument();
$fichero->load("https://e00-elmundo.uecdn.es/elmundo/rss/andalucia.xml");
$salida = array();
$noticias = $fichero->getElementsByTagName("item");

foreach ($noticias as $noticia) {
    $nuevo = new stdClass();
    $nuevo->titular = $noticia->getElementsByTagName("title")[0]->nodeValue;
    $descripcionCompleta = $noticia->getElementsByTagName("description")[0]->nodeValue;

    // Eliminar el texto final "Leer"
    $posicionLeer = strpos($descripcionCompleta, '<a href="');
    if ($posicionLeer !== false) {
        $descripcion = substr($descripcionCompleta, 0, $posicionLeer);
    } else {
        $descripcion = $descripcionCompleta;
    }

    // Obtener la URL y el texto del enlace "Leer"
    $link = $noticia->getElementsByTagName("link")[0]->nodeValue;

    // Obtener la imagen principal de la noticia
    $mediaContent = $noticia->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "content");
    if ($mediaContent->length > 0) {
        $imagenUrl = $mediaContent[0]->getAttribute('url');
    } else {
        // Si no hay 'media:content', intentar obtener 'media:thumbnail'
        $mediaThumbnail = $noticia->getElementsByTagNameNS("http://search.yahoo.com/mrss/", "thumbnail");
        if ($mediaThumbnail->length > 0) {
            $imagenUrl = $mediaThumbnail[0]->getAttribute('url');
        } else {
            $imagenUrl = ''; // Puedes asignar una URL de imagen por defecto si no hay imagen disponible
        }
    }

    $nuevo->descripcion = $descripcion;
    $nuevo->imagen = $imagenUrl;
    $nuevo->link = $link; // Guardar la URL en una propiedad link del objeto $nuevo

    $salida[] = $nuevo;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Últimas noticias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <?php
    include_once 'header.php';
    ?>

    <div class="container">
        <h2 class="fs-1">Ultimas noticias</h2>
        <ul class="list-group">
            <?php foreach ($salida as $noticia) : ?>
                <li class="list-group-item">
                    <div class="noticia">
                        <?php if (!empty($noticia->imagen)) : ?>
                            <img class="w-25 img-thumbnail" src="<?= $noticia->imagen ?>" alt="Imagen de la noticia">
                        <?php endif; ?>
                        <div class="contenido ms-3">
                            <h3 class="fs-3"><strong><?= $noticia->titular ?></strong></h3>
                            <p class="descripcion fs-5"><?= $noticia->descripcion ?></p>
                            <a href="<?= $noticia->link ?>" class="btn btn-outline-primary w-50 btn-sm mx-auto my-3" target="_blank">Leer</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>