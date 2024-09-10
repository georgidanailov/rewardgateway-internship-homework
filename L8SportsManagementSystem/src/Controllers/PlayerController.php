<?php

require_once '../../config/Database.php';
require_once '../Models/Player.php';

$database = new Database();
$conn = $database->getConnection();

class PlayerController
{
    private $player;

    public function __construct($db)
    {
        $this->player = new Player($db);
    }

    public function createPlayer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $position = $_POST['position'];
            $team_id = $_POST['team_id'];
            $this->player->create($name, $age, $position, $team_id);
            header('Location: view_players.php');
        }
    }

    public function updatePlayer($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $position = $_POST['position'];
            $team_id = $_POST['team_id'];
            $this->player->update($id, $name, $age, $position, $team_id);
            header('Location: view_players.php');
        }
    }

    public function deletePlayer($id)
    {
        $this->player->delete($id);
        header('Location: view_players.php');
    }

    public function viewPlayers()
    {
        return $this->player->getAll();
    }

    public function viewPlayer($id)
    {
        return $this->player->getById($id);
    }
}

