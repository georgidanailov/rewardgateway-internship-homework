<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.css">
    <style>
        #sidebar {
            background: linear-gradient(145deg, #3a3a3a, #232323);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            height: 100vh;
            width: 250px;
        }

        #sidebar h4 {
            margin-bottom: 30px;
        }

        .nav-link {
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #505050;
            color: #fff;
        }

        body {
            background-color: #f4f4f9;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <nav id="sidebar" class="text-white p-3">
        <h4 class="text-center">Sports Management</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>"
                   href="/src/dashboard.php">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_teams.php') ? 'active' : ''; ?>"
                   href="/src/view_teams.php">
                    <i class="bi bi-people-fill"></i> Teams
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_players.php') ? 'active' : ''; ?>"
                   href="/src/view_players.php">
                    <i class="bi bi-person-fill"></i> Players
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'view_games.php') ? 'active' : ''; ?>"
                   href="/src/view_games.php">
                    <i class="bi bi-trophy-fill"></i> Games
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'create_game.php') ? 'active' : ''; ?>"
                   href="/src/create_game.php">
                    <i class="bi bi-plus-circle-fill"></i> Create Game
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'create_player.php') ? 'active' : ''; ?>"
                   href="/src/create_player.php">
                    <i class="bi bi-person-plus-fill"></i> Create Player
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == 'create_team.php') ? 'active' : ''; ?>"
                   href="/src/create_team.php">
                    <i class="bi bi-people-fill"></i> Create Team
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
