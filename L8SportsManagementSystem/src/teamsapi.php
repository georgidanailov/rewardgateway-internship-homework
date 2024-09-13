<?php
require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];
$url = $_GET['url'];

if ($url == 'teams') {
    if ($request_method == 'GET') {
        $query = "SELECT * FROM teams";
        $result = $conn->query($query);
        $teams = [];
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row;
        }
        echo json_encode($teams);
    } elseif ($request_method == 'POST') {
        $name = $_POST['name'];
        $city = $_POST['city'];
        $stmt = $conn->prepare("INSERT INTO teams (name, city) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $city);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Team created successfully']);
    }
} elseif (preg_match('/^teams\/(\d+)$/', $url, $matches)) {
    $team_id = $matches[1];

    if ($request_method == 'GET') {
        $stmt = $conn->prepare("SELECT * FROM teams WHERE id = ?");
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $team = $result->fetch_assoc();
        echo json_encode($team);
    } elseif ($request_method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $name = $_PUT['name'];
        $city = $_PUT['city'];
        $stmt = $conn->prepare("UPDATE teams SET name = ?, city = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $city, $team_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Team updated successfully']);
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM teams WHERE id = ?");
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Team deleted successfully']);
    }
}