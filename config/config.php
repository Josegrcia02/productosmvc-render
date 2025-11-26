<?php
    $datos=  parse_ini_file('config.ini');
    if(isset($datos['base_url'])){
        define("BASE_URL", getenv('BASE_URL') ?: $datos['base_url']);
    }
?>