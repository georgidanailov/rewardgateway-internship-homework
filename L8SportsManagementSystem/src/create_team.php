<?php

require_once '../vendor/autoload.php';
require_once 'header.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

require_once 'Database.php';
require 'TeamController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new TeamController($conn);
$controller->createTeam();
?>

<div class="page container mt-4">
    <form method="POST" action="create_team.php">
        <div class="form-group">
            <label for="name">Team Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Team Name" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Team</button>
    </form>
</div>

