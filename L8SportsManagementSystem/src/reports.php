<?php
require 'Database.php';

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT t.name, COUNT(p.id) as total_players 
          FROM teams t 
          LEFT JOIN players p ON t.id = p.team_id 
          GROUP BY t.id";
$result = $conn->query($query);
$total_players = [];
while ($row = $result->fetch_assoc()) {
    $total_players[] = $row;
}
echo json_encode(['total_players' => $total_players]);

$query = "SELECT t.name, AVG(p.age) as avg_age 
          FROM teams t 
          LEFT JOIN players p ON t.id = p.team_id 
          GROUP BY t.id";
$result = $conn->query($query);
$avg_age = [];
while ($row = $result->fetch_assoc()) {
    $avg_age[] = $row;
}
echo json_encode(['avg_age' => $avg_age]);

$query = "SELECT t.name, COUNT(g.id) as total_matches 
          FROM teams t 
          LEFT JOIN games g ON t.id = g.team1_id OR t.id = g.team2_id 
          GROUP BY t.id";
$result = $conn->query($query);
$total_matches = [];
while ($row = $result->fetch_assoc()) {
    $total_matches[] = $row;
}
echo json_encode(['total_matches' => $total_matches]);

$query = "SELECT t.name, 
                 AVG(CASE WHEN t.id = g.team1_id THEN g.team1_score 
                          WHEN t.id = g.team2_id THEN g.team2_score END) as avg_goals 
          FROM teams t 
          JOIN games g ON t.id = g.team1_id OR t.id = g.team2_id 
          GROUP BY t.id";
$result = $conn->query($query);
$avg_goals = [];
while ($row = $result->fetch_assoc()) {
    $avg_goals[] = $row;
}
echo json_encode(['avg_goals' => $avg_goals]);

$query = "SELECT t.name, COUNT(*) as wins 
          FROM teams t 
          JOIN games g ON (t.id = g.team1_id AND g.team1_score > g.team2_score) 
                      OR (t.id = g.team2_id AND g.team2_score > g.team1_score) 
          GROUP BY t.id 
          ORDER BY wins DESC";
$result = $conn->query($query);
$rankings = [];
while ($row = $result->fetch_assoc()) {
    $rankings[] = $row;
}
echo json_encode(['rankings' => $rankings]);
