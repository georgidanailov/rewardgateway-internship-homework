<?php

require_once '../config/Database.php';
require '../src/Controllers/PlayerController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new PlayerController($conn);
$controller->createPlayer();
?>

<form method="POST" action="create_player.php">
    <input type="text" name="name" placeholder="Player Name" required>
    <input type="number" name="age" placeholder="Age" required>
    <select name="position" required>
        <option value="forward">Forward</option>
        <option value="midfielder">Midfielder</option>
        <option value="defender">Defender</option>
        <option value="goalkeeper">Goalkeeper</option>
    </select>
    <select name="team_id" required>
        <?php
        // Fetch teams to populate the dropdown
        $result = $conn->query("SELECT id, name FROM teams");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
    </select>
    <button type="submit">Create Player</button>
</form>
