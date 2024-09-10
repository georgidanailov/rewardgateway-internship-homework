<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}

require_once '../config/Database.php';
require '../src/Views/header.php';

$database = new Database();
$conn = $database->getConnection();

require_once '../src/Controllers/TeamController.php';
require_once '../src/Controllers/PlayerController.php';
require_once '../src/Controllers/GameController.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create_team':
        $controller = new TeamController($conn);
        $controller->createTeam();
        break;
    case 'update_team':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new TeamController($conn);
            $controller->updateTeam($id);
        }
        break;
    case 'delete_team':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new TeamController($conn);
            $controller->deleteTeam($id);
        }
        break;
    case 'create_player':
        $controller = new PlayerController($conn);
        $controller->createPlayer();
        break;
    case 'update_player':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new PlayerController($conn);
            $controller->updatePlayer($id);
        }
        break;
    case 'delete_player':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new PlayerController($conn);
            $controller->deletePlayer($id);
        }
        break;
    case 'create_game':
        $controller = new GameController($conn);
        $controller->createGame();
        break;
    case 'update_game':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new GameController($conn);
            $controller->updateGame($id);
        }
        break;
    case 'delete_game':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller = new GameController($conn);
            $controller->deleteGame($id);
        }
        break;
    default:
        echo '<h1>Welcome to the Sports Management System</h1>';
        echo '<a href="/L8SportsManagementSystem/public/index.php?action=create_team">Create Team</a><br>';
        echo '<a href="/L8SportsManagementSystem/public/index.php?action=create_player">Create Player</a><br>';
        echo '<a href="/L8SportsManagementSystem/public/index.php?action=create_game">Create Game</a><br>';
        break;
}

