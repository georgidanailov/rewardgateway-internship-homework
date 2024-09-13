<?php

// Load environment variables using Dotenv
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

// Ensure 'url' is defined to avoid undefined array key warnings
$url = $_GET['url'] ?? '';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($url == 'playersapi') {
    // Handle GET request - Retrieve all players
    if ($request_method == 'GET') {
        $query = "SELECT * FROM players";
        $result = $conn->query($query);
        $players = [];
        while ($row = $result->fetch_assoc()) {
            $players[] = $row;
        }
        echo json_encode($players);

        // Handle POST request - Create a new player
    } elseif ($request_method == 'POST') {
        // Handle both form-data and JSON input
        $input_data = [];

        // Check if data is sent via form-data (i.e., $_POST)
        if (!empty($_POST)) {
            $input_data = $_POST;
        } else {
            // Otherwise, assume the data is sent as JSON
            $input_data = json_decode(file_get_contents("php://input"), true);
        }

        // Validate input data
        if (isset($input_data['name']) && isset($input_data['age']) && isset($input_data['position']) && isset($input_data['team_id'])) {
            $name = $input_data['name'];
            $age = $input_data['age'];
            $position = $input_data['position'];
            $team_id = $input_data['team_id'];

            // Prepare and execute the query
            $stmt = $conn->prepare("INSERT INTO players (name, age, position, team_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sisi", $name, $age, $position, $team_id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Player added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }
} elseif (is_string($url) && preg_match('/^playersapi\/(\d+)$/', $url, $matches)) {
    $player_id = $matches[1];

    // Handle GET request - Retrieve a specific player by ID
    if ($request_method == 'GET') {
        $stmt = $conn->prepare("SELECT * FROM players WHERE id = ?");
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $player = $result->fetch_assoc();
        echo json_encode($player);

        // Handle PUT request - Update a player by ID
    } elseif ($request_method == 'PUT') {
        // Get the raw input data
        parse_str(file_get_contents("php://input"), $_PUT);

        // Validate input data
        if (isset($_PUT['name']) && isset($_PUT['age']) && isset($_PUT['position']) && isset($_PUT['team_id'])) {
            $name = $_PUT['name'];
            $age = $_PUT['age'];
            $position = $_PUT['position'];
            $team_id = $_PUT['team_id'];

            // Prepare and execute the update query
            $stmt = $conn->prepare("UPDATE players SET name = ?, age = ?, position = ?, team_id = ? WHERE id = ?");
            $stmt->bind_param("sisi", $name, $age, $position, $team_id, $player_id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Player updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input for update']);
        }

        // Handle DELETE request - Delete a player by ID
    } elseif ($request_method == 'DELETE') {
        $stmt = $conn->prepare("DELETE FROM players WHERE id = ?");
        $stmt->bind_param("i", $player_id);
        $stmt->execute();
        echo json_encode(['success' => true, 'message' => 'Player deleted successfully']);
    }
}

