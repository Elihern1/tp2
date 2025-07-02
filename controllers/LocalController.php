<?php
require_once __DIR__ . '/../models/Local.php';

class LocalController {
    public function getAllLocaux() {
        $model = new Local();
        $locaux = $model->getAll();
        echo json_encode($locaux);
    }

    public function getLocauxByDepartement($id) {
        $model = new Local();
        $locaux = $model->getByDepartement($id);
        echo json_encode($locaux);
    }

    public function createLocal() {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data['nom']) &&
        isset($data['type']) &&
        isset($data['capacite']) &&
        isset($data['etage']) &&
        isset($data['departement_id'])
    ) {
        $model = new Local();
        if ($model->create($data)) {
            http_response_code(201);
            echo json_encode(["message" => "Local créé avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la création du local."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Données manquantes."]);
    }
}
public function updateLocal($id) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data['nom']) &&
        isset($data['type']) &&
        isset($data['capacite']) &&
        isset($data['etage']) &&
        isset($data['departement_id'])
    ) {
        $model = new Local();
        if ($model->update($id, $data)) {
            http_response_code(200);
            echo json_encode(["message" => "Local mis à jour avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la mise à jour du local."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes."]);
    }
}

public function deleteLocal($id) {
    $model = new Local();
    if ($model->delete($id)) {
        http_response_code(200);
        echo json_encode(["message" => "Local supprimé avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erreur lors de la suppression du local."]);
    }
}



}
