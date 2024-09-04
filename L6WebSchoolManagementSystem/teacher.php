<?php
session_start();
if ($_SESSION['role'] !== 'teacher') {
    header('Location: index.php');
    exit();
}

$studentsFile = 'data/students.txt';
$gradesFile = 'data/grades.txt';

$students = file_exists($studentsFile) ? unserialize(file_get_contents($studentsFile)) : [];
$grades = file_exists($gradesFile) ? unserialize(file_get_contents($gradesFile)) : [];

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['student_username']) && isset($_POST['subject_name']) && isset($_POST['grade'])) {
        $student_username = trim($_POST['student_username']);
        $subject_name = trim($_POST['subject_name']);
        $grade = trim($_POST['grade']);

        if (!isset($students[$student_username])) {
            $error_message = "Student does not exist.";
        } else {
            if (!isset($grades[$student_username])) {
                $grades[$student_username] = [];
            }

            $grades[$student_username][$subject_name] = $grade;
            file_put_contents($gradesFile, serialize($grades));
            $success_message = "Grade added/updated successfully.";
        }
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/svg/arrows-fullscreen.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
<?php include 'navbar-web.html'; ?>

<header class="navbar navbar-dark bg-primary p-3">
    <a class="navbar-brand" href="#">Teacher Dashboard</a>
</header>

<main class="container my-4">
    <h2>Student Grades</h2>

    <form method="post" action="teacher.php">
        <div class="mb-3">
            <input type="text" class="form-control" id="student_username" name="student_username"
                   placeholder="Student Username" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject Name"
                   required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Grade</button>
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

    <h2 class="mt-4">View Grades</h2>
    <?php if (!empty($grades)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Student Username</th>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($grades as $student_username => $subjects): ?>
                <?php foreach ($subjects as $subject_name => $grade): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student_username); ?></td>
                        <td><?php echo htmlspecialchars($subject_name); ?></td>
                        <td><?php echo htmlspecialchars($grade); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No grades available.</p>
    <?php endif; ?>
</main>

<form method="post" action="admin.php">
    <button type="submit" name="logout" class="btn btn-secondary mt-3">Log Out</button>
</form>
<?php include 'footer-web.html'; ?>
</body>
</html>