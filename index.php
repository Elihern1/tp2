<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Local.php';
require_once __DIR__ . '/controllers/LocalController.php';
require_once __DIR__ . '/models/Equipement.php';
require_once __DIR__ . '/controllers/EquipementController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($request === '/chepa-api/locaux' && $method === 'POST') {
    $controller = new LocalController();
    $controller->createLocal();

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


} elseif (preg_match('#^/chepa-api/locaux/departement/(\d+)$#', $request, $matches)) {
    $controller = new LocalController();
    $controller->getLocauxByDepartement($matches[1]);

} elseif (preg_match('#^/chepa-api/equipements/local/(\d+)$#', $request, $matches)) {
    $controller = new EquipementController();
    $controller->getEquipementsByLocal($matches[1]);

} elseif ($request === '/chepa-api/locaux') {
    $controller = new LocalController();
    $controller->getAllLocaux();

} elseif (preg_match('#^/chepa-api/equipements/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new EquipementController();
    $controller->getEquipementById($matches[1]);


} elseif ($request === '/chepa-api/equipements') {
    $controller = new EquipementController();
    $controller->getAllEquipements();

} elseif ($request === '/chepa-api/locaux' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller = new LocalController();
    $controller->updateLocal();

} elseif (preg_match('#^/chepa-api/locaux/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller = new LocalController();
    $controller->updateLocal($matches[1]);

} elseif (preg_match('#^/chepa-api/locaux/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller = new LocalController();
    $controller->deleteLocal($matches[1]);
} elseif (preg_match('#^/chepa-api/equipements/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller = new EquipementController();
    $controller->deleteEquipement($matches[1]);

} elseif (preg_match('#^/chepa-api/equipements/(\d+)$#', $request, $matches) && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $controller = new EquipementController();
    $controller->updateEquipement($matches[1]);

} elseif ($request === '/chepa-api/equipements' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EquipementController();
    $controller->createEquipement();



} else {
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
