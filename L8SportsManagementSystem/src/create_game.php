<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

require_once 'Database.php';
require 'GameController.php';
require_once 'header.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new GameController($conn);
$controller->createGame();
?>

<form method="POST" action="create_game.php" class="page container mt-4">
    <div class="form-group">
        <label for="team1_id">Team 1</label>
        <select class="form-control" name="team1_id" id="team1_id" required>
            <?php
            $result = $conn->query("SELECT id, name FROM teams");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="team2_id">Team 2</label>
        <select class="form-control" name="team2_id" id="team2_id" required>
            <?php
            $result = $conn->query("SELECT id, name FROM teams");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="team1_score">Team 1 Score</label>
        <input type="number" class="form-control" name="team1_score" id="team1_score" placeholder="Team 1 Score"
               required>
    </div>

    <div class="form-group">
        <label for="team2_score">Team 2 Score</label>
        <input type="number" class="form-control" name="team2_score" id="team2_score" placeholder="Team 2 Score"
               required>
    </div>

    <div class="form-group">
        <label for="game_date">Game Date</label>
        <input type="date" class="form-control" name="game_date" id="game_date" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Game</button>
</form>