<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$url = $_GET['url'] ?? '';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($url == 'gamesapi') {
    if ($request_method == 'GET') {
        $query = "SELECT * FROM games";
        $result = $conn->query($query);
        $games = [];
        while ($row = $result->fetch_assoc()) {
            $games[] = $row;
        }
        echo json_encode($games);
    } elseif ($request_method == 'POST') {
        $input_data = [];
        if (!empty($_POST)) {
            $input_data = $_POST;
        } else {
            $input_data = json_decode(file_get_contents("php://input"), true);
        }

        if (isset($input_data['team1_id']) && isset($input_data['team2_id']) && isset($input_data['team1_score']) && isset($input_data['team2_score']) && isset($input_data['game_date'])) {
            $team1_id = $input_data['team1_id'];
            $team2_id = $input_data['team2_id'];
            $team1_score = $input_data['team1_score'];
            $team2_score = $input_data['team2_score'];
            $game_date = $input_data['game_date'];

            $stmt = $conn->prepare("INSERT INTO games (team1_id, team2_id, team1_score, team2_score, game_date) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiss", $team1_id, $team2_id, $team1_score, $team2_score, $game_date);
            $stmt->execute();
            echo json_encode(['success' => true, 'message' => 'Game added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }
} elseif (is_string($url) && preg_match('/^gamesapi\/(\d+)$/', $url, $matches)) {
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

        if (isset($_PUT['team1_id']) && isset($_PUT['team2_id']) && isset($_PUT['team1_score']) && isset($_PUT['team2_score']) && isset($_PUT['game_date'])) {
            $team1_id = $_PUT['team1_id'];
            $team2_id = $_PUT['team2_id'];
            $team1_score = $_PUT['team1_score'];
            $team2_score = $_PUT['team2_score'];
            $game_date = $_PUT['game_date'];

            $stmt = $conn->prepare("UPDATE games SET team1_id = ?, team2_id = ?, team1_score = ?, team2_score = ?, game_date = ? WHERE id = ?");
            $stmt->bind_param("iiissi", $team1_id, $team2_id, $team1_score, $team2_score, $game_date, $game_id);
            $stmt->execute();
            echo json_encode(['success' => true, 'message' => 'Game updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input for update']);
        }
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM games WHERE id = ?");
        $stmt->bind_param("i", $game_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Game deleted successfully']);
    }
}

