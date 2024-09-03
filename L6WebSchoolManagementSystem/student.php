<?php

namespace GeorgiSimeonov\L6WebSchoolManagementSystem;

session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: index.php');
    exit();
}

$studentsFile = 'src/data/students.txt';
$gradesFile = 'src/data/grades.txt';
$subjectsFile = 'src/data/subjects.txt';

$students = file_exists($studentsFile) ? unserialize(file_get_contents($studentsFile)) : [];
$grades = file_exists($gradesFile) ? unserialize(file_get_contents($gradesFile)) : [];
$subjects = file_exists($subjectsFile) ? unserialize(file_get_contents($subjectsFile)) : [];

$student_id = $_SESSION['username'];
$student = $students[$student_id] ?? ['subjects' => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>School Management System - Student Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/svg/arrows-fullscreen.svg">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        @media (min-width: 768px) {
            /* Additional styling if needed */
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
<?php include 'navbar-web.html' ?>

<header class="navbar navbar-dark bg-dark p-3">
    <a class="navbar-brand" href="#">Student Dashboard</a>
</header>
<main class="container my-4">
    <h2>Your Subjects</h2>
    <ul>
        <?php foreach ($student['subjects'] as $subject): ?>
            <li><?php echo htmlspecialchars($subject); ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Your Grades</h2>
    <ul>
        <?php foreach ($student['subjects'] as $subject): ?>
            <li>
                <?php echo htmlspecialchars($subject); ?>:
                <?php
                $gradesForSubject = $grades[$student_id][$subject] ?? [];
                if ($gradesForSubject) {
                    echo implode(', ', $gradesForSubject);
                } else {
                    echo 'No grades available';
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="post" action="student.php" class="mt-4">
        <button type="submit" name="logout" class="btn btn-secondary">Log Out</button>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+VVfKpV1zBRv1y5h7/ZoX4hF20Ibt"
        crossorigin="anonymous"></script>
<?php include 'footer-web.html' ?>

</body>
</html>
