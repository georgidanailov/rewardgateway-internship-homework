<?php

require_once '../vendor/autoload.php';
require_once 'header.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Adjust path as necessary
$dotenv->load();

require_once 'Database.php';
require 'GameController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new GameController($conn);
$games = $controller->viewGames();
?>

<div class="page">
    <div class="table">
        <table class="table table-hover table-condensed">
            <tr>
                <th>Team 1</th>
                <th>Team 2</th>
                <th>Team 1 Score</th>
                <th>Team 2 Score</th>
                <th>Match Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($games as $game) { ?>
                <tr>
                    <td><?php echo $game['team1_id']; ?></td>
                    <td><?php echo $game['team2_id']; ?></td>
                    <td><?php echo $game['team1_score']; ?></td>
                    <td><?php echo $game['team2_score']; ?></td>
                    <td><?php echo $game['game_date']; ?></td>
                    <td>
                        <a href="update_game.php?id=<?php echo $game['id']; ?>">Edit</a>
                        <a href="delete_game.php?id=<?php echo $game['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
