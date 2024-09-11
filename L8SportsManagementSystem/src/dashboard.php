<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}

require_once 'Database.php';
include 'header.php';

?>
<div class="page"><h1>Welcome to the Sports Management Dashboard</h1>
    <p>Select a section from the left menu to manage teams, players, and games.</p>

    <?php
    require_once 'TeamController.php';
    require_once 'PlayerController.php';
    require_once 'GameController.php';

    $teamController = new TeamController($conn);
    $teams = $teamController->viewTeams();
    ?>

    <h2>Teams Overview</h2>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Team Name</th>
            <th>City</th>
        </tr>
        <?php foreach ($teams as $team) { ?>
            <tr>
                <td><?php echo $team['name']; ?></td>
                <td><?php echo $team['city']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
