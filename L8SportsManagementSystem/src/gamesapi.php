<?php
require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
$url = $_GET['url'];

if ($url == 'games') {
    if ($request_method == 'GET') {
        $query = "SELECT * FROM games";
        $result = $conn->query($query);
        $games = [];
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
        echo json_encode($games);
    } elseif ($request_method == 'POST') {
        $team1_id = $_POST['team1_id'];
        $team2_id = $_POST['team2_id'];
        $team1_score = $_POST['team1_score'];
        $team2_score = $_POST['team2_score'];
        $game_date = $_POST['game_date'];
        $stmt = $conn->prepare("INSERT INTO games (team1_id, team2_id, team1_score, team2_score, game_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiii", $team1_id, $team2_id, $team1_score, $team2_score, $game_date);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Game created successfully']);
    }
} elseif (preg_match('/^games\/(\d+)$/', $url, $matches)) {
    $game_id = $matches[1];

    if ($request_method == 'GET') {
        $stmt = $conn->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->bind_param("i", $game_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $game = $result->fetch_assoc();
        echo json_encode($game);
    } elseif ($request_method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $team1_score = $_PUT['team1_score'];
        $team2_score = $_PUT['team2_score'];
        $game_date = $_PUT['game_date'];
        $stmt = $conn->prepare("UPDATE games SET team1_score = ?, team2_score = ?, game_date = ? WHERE id = ?");
        $stmt->bind_param("iiii", $team1_score, $team2_score, $game_date, $game_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Game updated successfully']);
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM games WHERE id = ?");
        $stmt->bind_param("i", $game_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Game deleted successfully']);
    }
}