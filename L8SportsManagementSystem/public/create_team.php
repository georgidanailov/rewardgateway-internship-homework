<?php

require_once '../config/Database.php';
require '../src/Controllers/TeamController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new TeamController($conn);
$controller->createTeam();
?>

<form method="POST" action="create_team.php">
    <input type="text" name="name" placeholder="Team Name" required>
    <input type="text" name="city" placeholder="City" required>
    <button type="submit">Create Team</button>
</form>
