<?php
require_once './controllers/LocalController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$db = (new Database())->getConnection();

switch ($uri) {
    case '/chepa_api/locaux':
        $controller = new LocalController($db);
        $controller->getLocaux();
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Route not found"]);
        break;
}
