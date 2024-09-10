<?php

require_once '../config/Database.php';
require '../src/Controllers/GameController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new GameController($conn);
$controller->createGame();
?>

<form method="POST" action="create_game.php">
    <select name="team1_id" required>
        <?php
        $result = $conn->query("SELECT id, name FROM teams");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>
    <select name="team2_id" required>
        <?php
        $result = $conn->query("SELECT id, name FROM teams");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>
    <input type="number" name="team1_score" placeholder="Team 1 Score" required>
    <input type="number" name="team2_score" placeholder="Team 2 Score" required>
    <input type="date" name="match_date" required>
    <button type="submit">Create Game</button>
</form>
