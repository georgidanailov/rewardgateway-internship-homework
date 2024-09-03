<?php

session_start();

$usersFile = 'data/users.txt';
$subjectsFile = 'data/subjects.txt';
$teachersFile = 'data/teachers.txt';
$studentsFile = 'data/students.txt';
$gradesFile = 'data/grades.txt';

function display_message($message, $type = 'danger')
{
    echo "<div class='alert alert-$type mt-3'>$message</div>";
}

$users = file_exists($usersFile) ? unserialize(file_get_contents($usersFile)) : [];

$adminExists = false;
foreach ($users as $user) {
    if ($user['role'] === 'admin') {
        $adminExists = true;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['initialize_system'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (strlen($username) < 3 || strlen($password) < 6) {
            $error_message = "Username must be at least 3 characters and password at least 6 characters.";
        } elseif ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $users[$username] = ['password' => $password, 'role' => 'admin'];
            file_put_contents($usersFile, serialize($users));

            if (!file_exists($subjectsFile)) {
                $subjects = [];
                file_put_contents($subjectsFile, serialize($subjects));
            }
            if (!file_exists($teachersFile)) {
                $teachers = [];
                file_put_contents($teachersFile, serialize($teachers));
            }
            if (!file_exists($studentsFile)) {
                $students = [];
                file_put_contents($studentsFile, serialize($students));
            }
            if (!file_exists($gradesFile)) {
                $grades = [];
                file_put_contents($gradesFile, serialize($grades));
            }

            $success_message = "System initialized successfully. You can now log in as admin.";
            $adminExists = true;
        }
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (isset($users[$username]) && $users[$username]['password'] === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $users[$username]['role'];

            switch ($users[$username]['role']) {
                case 'admin':
                    header('Location: admin.php');
                    break;
                case 'teacher':
                    header('Location: teacher.php');
                    break;
                case 'student':
                    header('Location: student.php');
                    break;
                default:
                    header('Location: index.php');
                    break;
            }
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - Login</title>
    <link rel="icon" type="image/x-icon" href="assets/svg/arrows-fullscreen.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<main class="form-signin w-100 m-auto">
    <?php if (!$adminExists): ?>
        <form method="post" action="index.php">
            <img class="mb-4" src="assets/svg/arrows-fullscreen.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Initialize System</h1>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php elseif (isset($success_message)): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Admin Username"
                       required>
                <label for="username">Admin Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                       required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                       placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit" name="initialize_system">Initialize</button>
        </form>
    <?php else: ?>
        <form method="post" action="index.php">
            <img class="mb-4" src="assets/svg/arrows-fullscreen.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username"
                       required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
                       required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
        </form>
    <?php endif; ?>
</main>
</body>
</html>
