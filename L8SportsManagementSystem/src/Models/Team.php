<?php

require_once '../../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

class Team
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $city)
    {
        $stmt = $this->conn->prepare("INSERT INTO teams (name, city) VALUES (?, ?)");
        $stmt->bind_param('ss', $name, $city);
        return $stmt->execute();
    }

    public function update($id, $name, $city)
    {
        $stmt = $this->conn->prepare("UPDATE teams SET name = ?, city = ? WHERE id = ?");
        $stmt->bind_param('ssi', $name, $city, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM teams WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM teams");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM teams WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
