-- 1. Create Database
CREATE DATABASE IF NOT EXISTS sports_management;

-- 2. Use the Database
USE sports_management;

-- 3. Create Teams Table
CREATE TABLE teams
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL
);

-- 4. Create Players Table
CREATE TABLE players
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(255)                                             NOT NULL,
    age      INT                                                      NOT NULL,
    position ENUM ('Forward', 'Midfielder', 'Defender', 'Goalkeeper') NOT NULL,
    team_id  INT,
    FOREIGN KEY (team_id) REFERENCES teams (id) ON DELETE SET NULL
);

-- 5. Create Games Table
CREATE TABLE games
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    team1_id    INT,
    team2_id    INT,
    team1_score INT  NOT NULL,
    team2_score INT  NOT NULL,
    game_date   DATE NOT NULL,
    FOREIGN KEY (team1_id) REFERENCES teams (id) ON DELETE CASCADE,
    FOREIGN KEY (team2_id) REFERENCES teams (id) ON DELETE CASCADE
);

-- 6. Insert Sample Data into the Teams Table
INSERT INTO teams (name, city)
VALUES ('Team A', 'New York'),
       ('Team B', 'Los Angeles'),
       ('Team C', 'Chicago');

-- 7. Insert Sample Data into the Players Table
INSERT INTO players (name, age, position, team_id)
VALUES ('Player 1', 24, 'Forward', 1),
       ('Player 2', 28, 'Midfielder', 1),
       ('Player 3', 21, 'Defender', 2),
       ('Player 4', 30, 'Goalkeeper', 2),
       ('Player 5', 26, 'Forward', 3);

-- 8. Insert Sample Data into the Games Table
INSERT INTO games (team1_id, team2_id, team1_score, team2_score, game_date)
VALUES (1, 2, 3, 2, '2024-01-15'),
       (2, 3, 1, 0, '2024-02-10'),
       (3, 1, 2, 2, '2024-03-05');

-- 9. Queries for Reports (optional)
-- Total Players per Team
SELECT t.name, COUNT(p.id) as total_players
FROM teams t
         LEFT JOIN players p ON t.id = p.team_id
GROUP BY t.id;

-- Average Player Age per Team
SELECT t.name, AVG(p.age) as avg_age
FROM teams t
         LEFT JOIN players p ON t.id = p.team_id
GROUP BY t.id;

-- Total Matches Played by Each Team
SELECT t.name, COUNT(g.id) as total_matches
FROM teams t
         LEFT JOIN games g ON t.id = g.team1_id OR t.id = g.team2_id
GROUP BY t.id;

-- Team Rankings by Wins
SELECT t.name, COUNT(*) as wins
FROM teams t
         JOIN games g ON (t.id = g.team1_id AND g.team1_score > g.team2_score)
    OR (t.id = g.team2_id AND g.team2_score > g.team1_score)
GROUP BY t.id
ORDER BY wins DESC;
