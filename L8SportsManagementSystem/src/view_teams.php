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
$teams = $controller->viewTeams();
?>

<div class="page">
    <table class="table table-hover table-condensed">
        <tr>
            <th>Team Name</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($teams as $team) { ?>
            <tr>
                <td><?php echo $team['name']; ?></td>
                <td><?php echo $team['city']; ?></td>
                <td>
                    <a href="update_team.php?id=<?php echo $team['id']; ?>">Edit</a>
                    <a href="delete_team.php?id=<?php echo $team['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
