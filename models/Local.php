<?php
require_once __DIR__ . '/../config/database.php';

class Local {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM local";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDepartement($departementId) {
        $query = "SELECT * FROM local WHERE departement_id = :departement_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':departement_id', $departementId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
    $query = "INSERT INTO local (nom, type, capacite, etage, departement_id)
              VALUES (:nom, :type, :capacite, :etage, :departement_id)";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':type', $data['type']);
    $stmt->bindParam(':capacite', $data['capacite']);
    $stmt->bindParam(':etage', $data['etage']);
    $stmt->bindParam(':departement_id', $data['departement_id']);

    return $stmt->execute();
}
    public function update($id, $data) {
    $query = "UPDATE local 
              SET nom = :nom, type = :type, capacite = :capacite, etage = :etage, departement_id = :departement_id 
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':type', $data['type']);
    $stmt->bindParam(':capacite', $data['capacite']);
    $stmt->bindParam(':etage', $data['etage']);
    $stmt->bindParam(':departement_id', $data['departement_id']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

public function delete($id) {
    $query = "DELETE FROM local WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
}

