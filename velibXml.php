<?php


    $url = "https://abo-paris.cyclocity.fr/service/carto";
    $path = "js/velibCarto.xml";

    $content = file_get_contents($url);

    if(file_exists($path)){
        unlink($path);
    }


    file_put_contents($path,$content);

?>
