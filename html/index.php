<?php
if (!isset($_COOKIE['connection'])) {
    $page = $_GET['page'] ?? 'home';
} else {
    $page = $_GET['page'] ?? 'landpage';
}
// Sanitiza para seguridad
$page = trim($page, "/");
$page = str_replace("..", "", $page); // evitar acceso a archivos fuera del directorio

$filepath = $page . ".php";

if (file_exists($filepath)) {
    include $filepath;
} else {
    // require_once("../main.php");
    http_response_code(404);
    echo "<h1>404 - Página no encontrada</h1>";
}
// switch ($page) {
//     case 'contacto':
//         include 'contacto.php';
//         break;
//     case 'test':
//         include 'CrearTarea.php';
//         break;
//     case 'acerca':
//         include 'acerca.php';
//         break;
//     case 'home':
//         include 'home.php';
//         break;
//     default:
//         http_response_code(404);
//         echo "<h1>404 - Página no encontrada</h1>";
//         break;
// }