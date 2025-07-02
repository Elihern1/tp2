<?php
require_once __DIR__ . '/../models/Equipement.php';

class EquipementController {
    public function getAllEquipements() {
        $model = new Equipement();
        $equipements = $model->getAll();
        echo json_encode($equipements);
    }

    public function getEquipementsByLocal($id) {
        $model = new Equipement();
        $equipements = $model->getByLocal($id);
        echo json_encode($equipements);
    }

    public function deleteEquipement($id) {
    $model = new Equipement();
    
    if ($model->delete($id)) {
        http_response_code(200);
        echo json_encode(["message" => "Équipement supprimé avec succès."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erreur lors de la suppression de l'équipement."]);
    }
}
public function updateEquipement($id) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data['nom']) &&
        isset($data['etat']) &&
        isset($data['est_mobile']) &&
        isset($data['local_id'])
    ) {
        $model = new Equipement();
        if ($model->update($id, $data)) {
            http_response_code(200);
            echo json_encode(["message" => "Équipement mis à jour avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la mise à jour de l'équipement."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Données manquantes."]);
    }
}
public function getEquipementById($id) {
    $model = new Equipement();
    $equipement = $model->getById($id);

    if ($equipement) {
        echo json_encode($equipement);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Équipement non trouvé."]);
    }
}
public function createEquipement() {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data['nom']) &&
        isset($data['etat']) &&
        isset($data['est_mobile'])
    ) {
        $model = new Equipement();
        if ($model->create($data)) {
            http_response_code(201);
            echo json_encode(["message" => "Équipement créé avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erreur lors de la création de l’équipement."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Données manquantes."]);
    }
}




}
