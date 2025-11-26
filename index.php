<?php
// index.php
require_once("config/config.php");
require_once("controller/productController.php");

// Router básico para convertir URL (/producto/lista) en acciones del controlador
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$action = 'defaultProduct'; // Acción por defecto

// Mapeo de rutas amigables a funciones del controlador
// Puedes añadir más casos aquí según tus necesidades
switch ($requestUri) {
    case '/':
    case '/index.php':
        $action = 'listProduct';
        break;
    case '/producto/lista':
        $action = 'listProduct';
        break;
    case '/producto/nuevo':
        $action = 'addProduct';
        break;
    case '/producto/insertar':
        $action = 'insertProduct';
        break;
    default:
        // Si usas ?action=algo (fallback)
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        break;
}

$productController = new ProductController();

// Verificamos si el método existe para evitar errores fatales
if (method_exists($productController, $action)) {
    $productController->$action();
} else {
    // Si la acción no existe, mostramos error o inicio
    echo "Error 404: La acción '$action' no existe.";
}
?>