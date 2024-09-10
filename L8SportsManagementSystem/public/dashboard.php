<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
require require_once '../config/Database.php';
require '../src/Views/header.php';

$database = new Database();
$conn = $database->getConnection();

?>
<h1>Welcome to the Sports Management Dashboard</h1>
<p>Select a section from the left menu to manage teams, players, and games.</p>

<?php
require_once '../src/Controllers/TeamController.php';
require_once '../src/Controllers/PlayerController.php';
require_once '../src/Controllers/GameController.php';

$teamController = new TeamController($conn);
$teams = $teamController->viewTeams();
?>

<h2>Teams Overview</h2>
<table>
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
