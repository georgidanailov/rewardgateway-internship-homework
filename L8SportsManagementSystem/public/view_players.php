<?php

require_once '../config/Database.php';
require '../src/Controllers/PlayerController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new PlayerController($conn);
$players = $controller->viewPlayers();
?>

<table>
    <tr>
        <th>Player Name</th>
        <th>Age</th>
        <th>Position</th>
        <th>Team</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($players as $player) { ?>
        <tr>
            <td><?php echo $player['name']; ?></td>
            <td><?php echo $player['age']; ?></td>
            <td><?php echo $player['position']; ?></td>
            <td><?php echo $player['team_id']; ?></td>
            <td>
                <a href="update_player.php?id=<?php echo $player['id']; ?>">Edit</a>
                <a href="delete_player.php?id=<?php echo $player['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
