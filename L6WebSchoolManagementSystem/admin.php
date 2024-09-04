<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$subjectsFile = 'data/subjects.txt';
$teachersFile = 'data/teachers.txt';
$studentsFile = 'data/students.txt';
$gradesFile = 'data/grades.txt';

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
            $subjects = array_values($subjects);
            file_put_contents($subjectsFile, serialize($subjects));
            display_message("Subject '$subject_name' removed successfully.");
        }
    } elseif (isset($_POST['remove_teacher'])) {
        $username = trim($_POST['username']);
        if (isset($teachers[$username])) {
            unset($teachers[$username]);
            file_put_contents($teachersFile, serialize($teachers));
            display_message("Teacher '$username' removed successfully.");
        }
    } elseif (isset($_POST['remove_student'])) {
        $username = trim($_POST['username']);
        if (isset($students[$username])) {
            unset($students[$username]);
            file_put_contents($studentsFile, serialize($students));
            display_message("Student '$username' removed successfully.");
        }
    } elseif (isset($_POST['logout'])) {
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
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/svg/arrows-fullscreen.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">
<?php include 'navbar-web.html'; ?>

<header class="navbar navbar-dark bg-primary p-3">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
</header>

<main class="container my-4">
    <h2>Subjects</h2>
    <?php if (!empty($subjects)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Subject Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?php echo htmlspecialchars($subject); ?></td>
                    <td>
                        <form method="post" action="admin.php" style="display:inline;">
                            <input type="hidden" name="subject_name" value="<?php echo htmlspecialchars($subject); ?>">
                            <button type="submit" name="remove_subject" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No subjects available.</p>
    <?php endif; ?>

    <h2>Teachers</h2>
    <?php if (!empty($teachers)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Assigned Subjects</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($teachers as $username => $teacher): ?>
                <tr>
                    <td><?php echo htmlspecialchars($username); ?></td>
                    <td><?php echo htmlspecialchars($teacher['name']); ?></td>
                    <td><?php echo htmlspecialchars(implode(', ', $teacher['subjects'])); ?></td>
                    <td>
                        <form method="post" action="admin.php" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                            <button type="submit" name="remove_teacher" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No teachers available.</p>
    <?php endif; ?>

    <h2>Students</h2>
    <?php if (!empty($students)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Assigned Subjects</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $username => $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($username); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars(implode(', ', $student['subjects'])); ?></td>
                    <td>
                        <form method="post" action="admin.php" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                            <button type="submit" name="remove_student" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No students available.</p>
    <?php endif; ?>

    <h2>Create Subject</h2>
    <form method="post" action="admin.php">
        <div class="mb-3">
            <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject Name"
                   required>
        </div>
        <button type="submit" name="create_subject" class="btn btn-primary">Create Subject</button>
    </form>

    <h2 class="mt-4">Create Teacher</h2>
    <form method="post" action="admin.php">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Teacher Username"
                   required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="assigned_subjects" name="assigned_subjects"
                   placeholder="Assigned Subjects (comma-separated)" required>
        </div>
        <button type="submit" name="create_teacher" class="btn btn-primary">Create Teacher</button>
    </form>

    <h2 class="mt-4">Create Student</h2>
    <form method="post" action="admin.php">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Student Username"
                   required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="assigned_subjects" name="assigned_subjects"
                   placeholder="Assigned Subjects (comma-separated)" required>
        </div>
        <button type="submit" name="create_student" class="btn btn-primary">Create Student</button>
    </form>

    <form method="post" action="admin.php">
        <button type="submit" name="logout" class="btn btn-secondary mt-3">Log Out</button>
    </form>
</main>
<?php include 'footer-web.html'; ?>
</body>
</html>