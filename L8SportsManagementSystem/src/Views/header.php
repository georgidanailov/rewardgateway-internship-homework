<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/L8SportsManagementSystem/public/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.css">
</head>
<body>
<div class="d-flex">
    <nav class="bg-dark text-white p-3" id="sidebar">
        <h4 class="text-center">Sports Management</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>"
                   href="/L8SportsManagementSystem/public/dashboard.php">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_teams.php') ? 'active' : ''; ?>"
                   href="/L8SportsManagementSystem/public/view_teams.php">
                    <i class="bi bi-people-fill"></i> Teams
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_players.php') ? 'active' : ''; ?>"
                   href="/L8SportsManagementSystem/public/view_players.php">
                    <i class="bi bi-person-fill"></i> Players
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_games.php') ? 'active' : ''; ?>"
                   href="/L8SportsManagementSystem/public/view_games.php">
                    <i class="bi bi-trophy-fill"></i> Games
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/L8SportsManagementSystem/public/logout.php">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid p-4" id="main-content">
        <!-- Main content will go here -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
