<?php
session_start();

$username = 'admin';
$password = 'password';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['username']) && isset($data['password'])) {
        if ($data['username'] === $username && $data['password'] === $password) {
            $_SESSION['authenticated'] = true;
            sendResponse(200, ['message' => 'Logged in successfully']);
        } else {
            sendResponse(401, ['error' => 'Invalid credentials']);
        }
    } else {
        sendResponse(400, ['error' => 'Bad Request']);
    }
}

function sendResponse($status, $data)
{
    header("Content-Type: application/json");
    http_response_code($status);
    echo json_encode($data);
    exit;
}
