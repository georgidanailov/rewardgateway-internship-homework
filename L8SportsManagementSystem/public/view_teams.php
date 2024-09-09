<?php

require_once '../config/Database.php';
require '../src/Controllers/TeamController.php';

$database = new Database();
$conn = $database->getConnection();

$controller = new TeamController($conn);
$teams = $controller->viewTeams();
?>

<table>
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
