<?php
session_start();
if ($_SESSION['role'] !== 'student') {
    header('Location: index.php');
    exit();
}

$studentsFile = 'data/students.txt';
$gradesFile = 'data/grades.txt';

$students = file_exists($studentsFile) ? unserialize(file_get_contents($studentsFile)) : [];
$grades = file_exists($gradesFile) ? unserialize(file_get_contents($gradesFile)) : [];

$username = $_SESSION['username'];

if (!isset($students[$username])) {
    header('Location: index.php');
    exit();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/svg/arrows-fullscreen.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
<?php include 'navbar-web.html'; ?>

<header class="navbar navbar-dark bg-primary p-3">
    <a class="navbar-brand" href="#">Student Dashboard</a>
</header>

<main class="container my-4">
    <h2>Your Subjects</h2>
    <?php if (!empty($students[$username]['subjects'])): ?>
        <ul class="list-group">
            <?php foreach ($students[$username]['subjects'] as $subject): ?>
                <li class="list-group-item"><?php echo htmlspecialchars($subject); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You are not assigned to any subjects.</p>
    <?php endif; ?>

    <h2 class="mt-4">Your Grades</h2>
    <?php if (isset($grades[$username])): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($grades[$username] as $subject => $grade): ?>
                <tr>
                    <td><?php echo htmlspecialchars($subject); ?></td>
                    <td><?php echo htmlspecialchars($grade); ?></td>
                </tr>
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