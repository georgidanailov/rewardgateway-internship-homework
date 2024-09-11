<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}

require_once 'Database.php';
require 'header.php';

$database = new Database();
$conn = $database->getConnection();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create_team':
        require 'create_team.php';
        break;
    case 'update_team':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'update_team.php';
        }
        break;
    case 'delete_team':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'delete_team.php';
        }
        break;
    case 'create_player':
        require 'create_player.php';
        break;
    case 'update_player':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'update_player.php';
        }
        break;
    case 'delete_player':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'delete_player.php';
        }
        break;
    case 'create_game':
        require 'create_game.php';
        break;
    case 'update_game':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'update_game.php';
        }
        break;
    case 'delete_game':
        $id = $_GET['id'] ?? null;
        if ($id) {
            require 'delete_game.php';
        }
        break;
    default:
        echo '<h1>Welcome to the Sports Management System</h1>';
        echo '<a href="/src/create_team">Create Team</a><br>';
        echo '<a href="/src/create_player">Create Player</a><br>';
        echo '<a href="/src/create_game">Create Game</a><br>';
        break;
}
