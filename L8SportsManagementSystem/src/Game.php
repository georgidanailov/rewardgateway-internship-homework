<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();
require_once 'Database.php';

$database = new Database();
$conn = $database->getConnection();

class Game
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($team1_id, $team2_id, $team1_score, $team2_score, $match_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO games (team1_id, team2_id, team1_score, team2_score, match_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiis', $team1_id, $team2_id, $team1_score, $team2_score, $match_date);
        return $stmt->execute();
    }

    public function update($id, $team1_id, $team2_id, $team1_score, $team2_score, $match_date)
    {
        $stmt = $this->conn->prepare("UPDATE games SET team1_id = ?, team2_id = ?, team1_score = ?, team2_score = ?, match_date = ? WHERE id = ?");
        $stmt->bind_param('iiiisi', $team1_id, $team2_id, $team1_score, $team2_score, $match_date, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM games WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM games");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
