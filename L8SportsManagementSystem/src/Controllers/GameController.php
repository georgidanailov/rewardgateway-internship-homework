<?php

require_once '../../config/Database.php';
require_once '../Models/Game.php';

$database = new Database();
$conn = $database->getConnection();

class GameController
{
    private $game;

    public function __construct($db)
    {
        $this->game = new Game($db);
    }

    public function createGame()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $team1_id = $_POST['team1_id'];
            $team2_id = $_POST['team2_id'];
            $team1_score = $_POST['team1_score'];
            $team2_score = $_POST['team2_score'];
            $match_date = $_POST['match_date'];
            $this->game->create($team1_id, $team2_id, $team1_score, $team2_score, $match_date);
            header('Location: view_games.php');
        }
    }

    public function updateGame($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $team1_id = $_POST['team1_id'];
            $team2_id = $_POST['team2_id'];
            $team1_score = $_POST['team1_score'];
            $team2_score = $_POST['team2_score'];
            $match_date = $_POST['match_date'];
            $this->game->update($id, $team1_id, $team2_id, $team1_score, $team2_score, $match_date);
            header('Location: view_games.php');
        }
    }

    public function deleteGame($id)
    {
        $this->game->delete($id);
        header('Location: view_games.php');
    }

    public function viewGames()
    {
        return $this->game->getAll();
    }

    public function viewGame($id)
    {
        return $this->game->getById($id);
    }
}