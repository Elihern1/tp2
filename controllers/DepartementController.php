<?php
require_once 'models/Departement.php';

class DepartementController {
    private $model;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->model = new Departement($db);
    }

    public function handleRequest($method, $id = null) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $departement = $this->model->getById($id);
                    $departement ? $this->sendJson($departement) : $this->notFound();
                } else {
                    $this->sendJson($this->model->getAll());
                }
                break;

            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                $this->model->create($data)
                    ? $this->respondCreated()
                    : $this->badRequest();
                break;

            case 'PUT':
                $data = json_decode(file_get_contents("php://input"), true);
                $this->model->update($id, $data)
                    ? $this->sendJson(['message' => 'Département mis à jour'])
                    : $this->badRequest();
                break;

            case 'DELETE':
                $this->model->delete($id)
                    ? http_response_code(204)
                    : $this->notFound();
                break;

            default:
                http_response_code(405);
                echo json_encode(['erreur' => 'Méthode non autorisée']);
        }
    }

    private function sendJson($data) {
        echo json_encode($data);
    }

    private function badRequest() {
        http_response_code(400);
        echo json_encode(['erreur' => 'Requête invalide']);
    }

    private function notFound() {
        http_response_code(404);
        echo json_encode(['erreur' => 'Ressource non trouvée']);
    }

    private function respondCreated() {
        http_response_code(201);
        echo json_encode(['message' => 'Département créé']);
    }
}
