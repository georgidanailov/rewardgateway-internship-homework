<?php

require_once '../../config/Database.php';
require_once '../Models/Team.php';

$database = new Database();
$conn = $database->getConnection();

class TeamController
{
    private $team;

    public function __construct($db)
    {
        $this->team = new Team($db);
    }

    public function createTeam()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $city = $_POST['city'];
            $this->team->create($name, $city);
            header('Location: view_teams.php');
        }
    }

    public function updateTeam($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $city = $_POST['city'];
            $this->team->update($id, $name, $city);
            header('Location: view_teams.php');
        }
    }

    public function deleteTeam($id)
    {
        $this->team->delete($id);
        header('Location: view_teams.php');
    }

    public function viewTeams()
    {
        return $this->team->getAll();
    }

    public function viewTeam($id)
    {
        return $this->team->getById($id);
    }
}
