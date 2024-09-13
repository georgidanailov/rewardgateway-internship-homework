<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$url = $_GET['url'] ?? '';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($url == 'teamsapi') {
    if ($request_method == 'GET') {
        $query = "SELECT * FROM teams";
        $result = $conn->query($query);
        $teams = [];
        while ($row = $result->fetch_assoc()) {
            $teams[] = $row;
        }
        echo json_encode($teams);
    } elseif ($request_method == 'POST') {
        $input_data = [];
        if (!empty($_POST)) {
            $input_data = $_POST;
        } else {
            $input_data = json_decode(file_get_contents("php://input"), true);
        }

        if (isset($input_data['name']) && isset($input_data['city'])) {
            $name = $input_data['name'];
            $city = $input_data['city'];

            $stmt = $conn->prepare("INSERT INTO teams (name, city) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $name, $city);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Team added successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to add team']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Statement preparation failed']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }
} elseif (is_string($url) && preg_match('/^teamsapi\/(\d+)$/', $url, $matches)) {
    $team_id = $matches[1];

    if ($request_method == 'GET') {
        $stmt = $conn->prepare("SELECT * FROM teams WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $team_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $team = $result->fetch_assoc();
            echo json_encode($team);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
        }
    } elseif ($request_method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);

        if (isset($_PUT['name']) && isset($_PUT['city'])) {
            $name = $_PUT['name'];
            $city = $_PUT['city'];

            $stmt = $conn->prepare("UPDATE teams SET name = ?, city = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("ssi", $name, $city, $team_id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Team updated successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to update team']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Statement preparation failed']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input for update']);
        }
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM teams WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $team_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Team deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete team']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
        }
    }
}

