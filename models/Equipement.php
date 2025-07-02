<?php
require_once __DIR__ . '/../config/database.php';

class Equipement {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM equipement";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByLocal($localId) {
        $query = "SELECT * FROM equipement WHERE local_id = :local_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':local_id', $localId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function delete($id) {
    $query = "DELETE FROM equipement WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
public function update($id, $data) {
    $query = "UPDATE equipement SET nom = :nom, etat = :etat, est_mobile = :est_mobile, local_id = :local_id
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':etat', $data['etat']);
    $stmt->bindParam(':est_mobile', $data['est_mobile'], PDO::PARAM_BOOL);
    $stmt->bindParam(':local_id', $data['local_id']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}
public function getById($id) {
    $query = "SELECT * FROM equipement WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function create($data) {
    $query = "INSERT INTO equipement (nom, etat, est_mobile, local_id)
              VALUES (:nom, :etat, :est_mobile, :local_id)";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':etat', $data['etat']);
    $stmt->bindParam(':est_mobile', $data['est_mobile'], PDO::PARAM_BOOL);

    if (!empty($data['local_id'])) {
        $stmt->bindParam(':local_id', $data['local_id']);
    } else {
        $stmt->bindValue(':local_id', null, PDO::PARAM_NULL);
    }

    return $stmt->execute();
}


}
