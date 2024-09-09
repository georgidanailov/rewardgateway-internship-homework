<?php

require_once '../../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

class Player
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $age, $position, $team_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO players (name, age, position, team_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sisi', $name, $age, $position, $team_id);
        return $stmt->execute();
    }

    public function update($id, $name, $age, $position, $team_id)
    {
        $stmt = $this->conn->prepare("UPDATE players SET name = ?, age = ?, position = ?, team_id = ? WHERE id = ?");
        $stmt->bind_param('sisii', $name, $age, $position, $team_id, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM players WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM players");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM players WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

