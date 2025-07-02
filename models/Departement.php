<?php
class Departement {
    private $conn;
    private $table = "departements";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (nom) VALUES (:nom)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':nom' => $data['nom']]);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET nom = :nom WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':id' => $id
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
