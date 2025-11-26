<?php
    $baseUrl = getenv('BASE_URL');
    // if(empty($baseUrl)) {
    //     $baseUrl = 'http://localhost:8084'; // Tu puerto local del docker-compose
    // }
    // Elimina la barra final si existe para estandarizar
    define("BASE_URL", rtrim($baseUrl, '/'));
?>