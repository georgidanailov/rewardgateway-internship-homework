<?php

session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('Location: index.php');
    exit();
}

$studentsFile = 'data/students.txt';
$subjectsFile = 'data/subjects.txt';
$gradesFile = 'data/grades.txt';
$teachersFile = 'data/teachers.txt';

$students = file_exists($studentsFile) ? unserialize(file_get_contents($studentsFile)) : [];
$subjects = file_exists($subjectsFile) ? unserialize(file_get_contents($subjectsFile)) : [];
$grades = file_exists($gradesFile) ? unserialize(file_get_contents($gradesFile)) : [];
$teachers = file_exists($teachersFile) ? unserialize(file_get_contents($teachersFile)) : [];

$teacher = $_SESSION['username'];
$currentTeacher = $teachers[$teacher] ?? ['subjects' => []];

$normalizedSubjects = array_map(function ($subject) {
    return ucwords(strtolower(trim($subject)));
}, $currentTeacher['subjects']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['grade_student'])) {
        $student_id = trim($_POST['student_id']);
        $subject_name = trim($_POST['subject_name']);
        $grade = trim($_POST['grade']);

        $subject_name = ucwords(strtolower($subject_name));

        if (!isset($students[$student_id])) {
            $error_message = "Student not found.";
        } elseif (!in_array($subject_name, $normalizedSubjects)) {
            $error_message = "Invalid subject.";
        } elseif (!is_numeric($grade) || $grade < 2 || $grade > 6) {
            $error_message = "Invalid grade. Must be between 2 and 6.";
        } else {
            $grades[$student_id][$subject_name][] = $grade;
            file_put_contents($gradesFile, serialize($grades));
            $success_message = "Grade for student $student_id in $subject_name set to $grade.";
        }
    } elseif (isset($_POST['logout'])) {
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
    <title>School Management System - Teacher Dashboard</title>
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
    <a class="navbar-brand" href="#">Teacher Dashboard</a>
</header>
<main class="container my-4">
    <form method="post" action="teacher.php">
        <h2>Grade Student</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID" required>
            <label for="student_id">Student ID</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject Name"
                   required>
            <label for="subject_name">Subject Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="grade" name="grade" placeholder="Grade (2-6)" min="2" max="6"
                   required>
            <label for="grade">Grade (2-6)</label>
        </div>
        <button type="submit" name="grade_student" class="btn btn-primary">Submit Grade</button>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger mt-3">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php elseif (isset($success_message)): ?>
        <div class="alert alert-success mt-3">
            <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="teacher.php" class="mt-4">
        <button type="submit" name="logout" class="btn btn-secondary">Log Out</button>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+VVfKpV1zBRv1y5h7/ZoX4hF20Ibt"
        crossorigin="anonymous"></script>
<?php include 'footer-web.html' ?>

</body>
</html>
