<?php

function getTeachers()
{
    $teachers = readJsonFile();
    sendResponse(200, $teachers);
}

function getTeacher($id)
{
    $teachers = readJsonFile();
    if (isset($teachers[$id])) {
        sendResponse(200, $teachers[$id]);
    } else {
        sendResponse(404, ['error' => 'Teacher not found']);
    }
}

function createTeacher()
{
    $data = json_decode(file_get_contents('php://input'), true);
    $teachers = readJsonFile();
    $id = uniqid();
    $data['id'] = $id;
    $teachers[$id] = $data;
    writeJsonFile($teachers);
    sendResponse(201, $data);
}

function updateTeacher($id)
{
    $data = json_decode(file_get_contents('php://input'), true);
    $teachers = readJsonFile();
    if (isset($teachers[$id])) {
        $teachers[$id] = array_merge($teachers[$id], $data);
        writeJsonFile($teachers);
        sendResponse(200, $teachers[$id]);
    } else {
        sendResponse(404, ['error' => 'Teacher not found']);
    }
}

function patchTeacher($id)
{
    $data = json_decode(file_get_contents('php://input'), true);
    $teachers = readJsonFile();
    if (isset($teachers[$id])) {
        foreach ($data as $key => $value) {
            if (isset($teachers[$id][$key])) {
                $teachers[$id][$key] = $value;
            }
        }
        writeJsonFile($teachers);
        sendResponse(200, $teachers[$id]);
    } else {
        sendResponse(404, ['error' => 'Teacher not found']);
    }
}

function deleteTeacher($id)
{
    $teachers = readJsonFile();
    if (isset($teachers[$id])) {
        unset($teachers[$id]);
        writeJsonFile($teachers);
        sendResponse(204, []);
    } else {
        sendResponse(404, ['error' => 'Teacher not found']);
    }
}

function readJsonFile($filename = 'teachers.json')
{
    if (!file_exists($filename)) {
        file_put_contents($filename, json_encode([]));
    }
    $json = file_get_contents($filename);
    return json_decode($json, true);
}

function writeJsonFile($data, $filename = 'teachers.json')
{
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

function sendResponse($status, $data)
{
    header("Content-Type: application/json");
    http_response_code($status);
    echo json_encode($data);
    exit;
}
