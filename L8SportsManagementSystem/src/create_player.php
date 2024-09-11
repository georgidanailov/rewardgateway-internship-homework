<?php

require_once '../vendor/autoload.php';
require_once 'header.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

require_once 'Database.php';
require 'PlayerController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new PlayerController($conn);
$controller->createPlayer();
?>

<div class="page container mt-4">
    <form method="POST" action="create_player.php">
        <div class="form-group">
            <label for="name">Player Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Player Name" required>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" name="age" id="age" placeholder="Age" required>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select class="form-control" name="position" id="position" required>
                <option value="forward">Forward</option>
                <option value="midfielder">Midfielder</option>
                <option value="defender">Defender</option>
                <option value="goalkeeper">Goalkeeper</option>
            </select>
        </div>

        <div class="form-group">
            <label for="team_id">Team</label>
            <select class="form-control" name="team_id" id="team_id" required>
                <?php
                $result = $conn->query("SELECT id, name FROM teams");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Player</button>
    </form>
</div>

