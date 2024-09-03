<?php

session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$subjectsFile = 'src/data/subjects.txt';
$teachersFile = 'src/data/teachers.txt';
$studentsFile = 'src/data/students.txt';
$gradesFile = 'src/data/grades.txt';

$subjects = file_exists($subjectsFile) ? unserialize(file_get_contents($subjectsFile)) : [];
$teachers = file_exists($teachersFile) ? unserialize(file_get_contents($teachersFile)) : [];
$students = file_exists($studentsFile) ? unserialize(file_get_contents($studentsFile)) : [];
$grades = file_exists($gradesFile) ? unserialize(file_get_contents($gradesFile)) : [];

function display_message($message, $type = 'info')
{
    echo "<div class='alert alert-$type mt-3'>$message</div>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_subject'])) {
        $subject_name = trim($_POST['subject_name']);
        if (strlen($subject_name) < 2) {
            display_message("Invalid subject name. It must be at least 2 characters long.", 'danger');
        } else {
            $subjects[] = $subject_name;
            file_put_contents($subjectsFile, serialize($subjects));
            display_message("Subject '$subject_name' created successfully.");
        }
    } elseif (isset($_POST['create_teacher'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        $assigned_subjects = array_map('trim', explode(',', $_POST['assigned_subjects']));

        if (strlen($username) < 3 || strlen($password) < 6 || strlen($name) < 2) {
            display_message("Invalid teacher details. Please ensure all fields are filled correctly.", 'danger');
        } elseif (empty(array_intersect($assigned_subjects, $subjects))) {
            display_message("Invalid subjects selected.", 'danger');
        } else {
            $teachers[$username] = [
                'password' => $password,
                'name' => $name,
                'subjects' => $assigned_subjects
            ];
            file_put_contents($teachersFile, serialize($teachers));
            display_message("Teacher '$name' created successfully.");
        }
    } elseif (isset($_POST['create_student'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        $assigned_subjects = array_map('trim', explode(',', $_POST['assigned_subjects']));

        if (strlen($username) < 3 || strlen($password) < 6 || strlen($name) < 2) {
            display_message("Invalid student details. Please ensure all fields are filled correctly.", 'danger');
        } elseif (empty(array_intersect($assigned_subjects, $subjects))) {
            display_message("Invalid subjects selected.", 'danger');
        } else {
            $students[$username] = [
                'password' => $password,
                'name' => $name,
                'subjects' => $assigned_subjects
            ];
            file_put_contents($studentsFile, serialize($students));
            display_message("Student '$name' created successfully.");
        }
    } elseif (isset($_POST['remove_subject'])) {
        $subject_name = trim($_POST['subject_name']);
        if (($key = array_search($subject_name, $subjects)) !== false) {
            unset($subjects[$key]);
            file_put_contents($subjectsFile, serialize($subjects));
            // Remove subject from teachers and students
            foreach ($teachers as &$teacher) {
                $teacher['subjects'] = array_diff($teacher['subjects'], [$subject_name]);
            }
            foreach ($students as &$student) {
                $student['subjects'] = array_diff($student['subjects'], [$subject_name]);
            }
            file_put_contents($teachersFile, serialize($teachers));
            file_put_contents($studentsFile, serialize($students));
            display_message("Subject '$subject_name' removed successfully.");
        } else {
            display_message("Subject not found.", 'danger');
        }
    } elseif (isset($_POST['remove_teacher'])) {
        $username = trim($_POST['username']);
        if (isset($teachers[$username])) {
            unset($teachers[$username]);
            file_put_contents($teachersFile, serialize($teachers));
            display_message("Teacher '$username' removed successfully.");
        } else {
            display_message("Teacher not found.", 'danger');
        }
    } elseif (isset($_POST['remove_student'])) {
        $username = trim($_POST['username']);
        if (isset($students[$username])) {
            unset($students[$username]);
            file_put_contents($studentsFile, serialize($students));
            display_message("Student '$username' removed successfully.");
        } else {
            display_message("Student not found.", 'danger');
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
    <title>School Management System - Admin Dashboard</title>
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
    <a class="navbar-brand" href="#">Admin Dashboard</a>
</header>
<main class="container my-4">
    <form method="post" action="admin.php">
        <h2>Create Subject</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject Name"
                   required>
            <label for="subject_name">Subject Name</label>
        </div>
        <button type="submit" name="create_subject" class="btn btn-primary">Create Subject</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <h2>Create Teacher</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="assigned_subjects" name="assigned_subjects"
                   placeholder="Subjects (comma separated)" required>
            <label for="assigned_subjects">Subjects (comma separated)</label>
        </div>
        <button type="submit" name="create_teacher" class="btn btn-primary">Create Teacher</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <h2>Create Student</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="assigned_subjects" name="assigned_subjects"
                   placeholder="Subjects (comma separated)" required>
            <label for="assigned_subjects">Subjects (comma separated)</label>
        </div>
        <button type="submit" name="create_student" class="btn btn-primary">Create Student</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <h2>Remove Subject</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject Name"
                   required>
            <label for="subject_name">Subject Name</label>
        </div>
        <button type="submit" name="remove_subject" class="btn btn-danger">Remove Subject</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <h2>Remove Teacher</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username">Username</label>
        </div>
        <button type="submit" name="remove_teacher" class="btn btn-danger">Remove Teacher</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <h2>Remove Student</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username">Username</label>
        </div>
        <button type="submit" name="remove_student" class="btn btn-danger">Remove Student</button>
    </form>

    <form method="post" action="admin.php" class="mt-4">
        <button type="submit" name="logout" class="btn btn-secondary">Log Out</button>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+VVfKpV1zBRv1y5h7/ZoX4hF20Ibt"
        crossorigin="anonymous"></script>
<?php include 'footer-web.html' ?>
</body>
</html>
