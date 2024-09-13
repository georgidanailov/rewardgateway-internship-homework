<?php

require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
$url = $_GET['url'];

if ($url == 'players') {
    if ($request_method == 'GET') {
        $query = "SELECT * FROM players";
        $result = $conn->query($query);
        $players = [];
        while ($row = $result->fetch_assoc()) {
            $players[] = $row;
        }
        echo json_encode($players);
    } elseif ($request_method == 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $position = $_POST['position'];
        $team_id = $_POST['team_id'];
        $stmt = $conn->prepare("INSERT INTO players (name, age, position, team_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $name, $age, $position, $team_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Player added successfully']);
    }
} elseif (preg_match('/^players\/(\d+)$/', $url, $matches)) {
    $player_id = $matches[1];

    if ($request_method == 'GET') {
        $stmt = $conn->prepare("SELECT * FROM players WHERE id = ?");
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $player = $result->fetch_assoc();
        echo json_encode($player);
    } elseif ($request_method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $name = $_PUT['name'];
        $age = $_PUT['age'];
        $position = $_PUT['position'];
        $team_id = $_PUT['team_id'];
        $stmt = $conn->prepare("UPDATE players SET name = ?, age = ?, position = ?, team_id = ? WHERE id = ?");
        $stmt->bind_param("sisi", $name, $age, $position, $team_id, $player_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Player updated successfully']);
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM players WHERE id = ?");
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Player deleted successfully']);
    }
}

