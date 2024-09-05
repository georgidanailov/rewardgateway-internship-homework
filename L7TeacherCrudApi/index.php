<?php
session_start();

require 'api.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$resource = $uri[2] ?? null;
$id = $uri[3] ?? null;

switch ($method) {
    case 'GET':
        if ($resource === 'teachers' && $id) {
            getTeacher($id);
        } elseif ($resource === 'teachers') {
            getTeachers();
        } else {
            sendResponse(404, ['error' => 'Resource not found']);
        }
        break;

    case 'POST':
        if ($resource === 'login') {
            require 'login.php';
            exit;
        }
        if ($resource === 'teachers') {
            createTeacher();
        } else {
            sendResponse(404, ['error' => 'Resource not found']);
        }
        break;

    case 'PUT':
        if ($resource === 'teachers' && $id) {
            updateTeacher($id);
        } else {
            sendResponse(404, ['error' => 'Resource not found']);
        }
        break;

    case 'PATCH':
        if ($resource === 'teachers' && $id) {
            patchTeacher($id);
        } else {
            sendResponse(404, ['error' => 'Resource not found']);
        }
        break;

    case 'DELETE':
        if ($resource === 'teachers' && $id) {
            deleteTeacher($id);
            sendResponse(204, ['success' => '204']);
        } else {
            sendResponse(404, ['error' => 'Resource not found']);
        }
        break;

    default:
        sendResponse(405, ['error' => 'Method Not Allowed']);
        break;
}