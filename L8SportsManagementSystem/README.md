SQL Script for Setting Up the Database
The following SQL script will create a database named sports_management, create the necessary tables, and set up
relationships between teams, players, and games.

-- 1. Create Database

CREATE DATABASE IF NOT EXISTS sports_management;

-- 2. Use the database

USE sports_management;

-- 3. Create Teams table

CREATE TABLE teams (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
city VARCHAR(255) NOT NULL
);

-- 4. Create Players table

CREATE TABLE players (

id INT AUTO_INCREMENT PRIMARY KEY,

name VARCHAR(255) NOT NULL,

age INT NOT NULL,

position ENUM('Forward', 'Midfielder', 'Defender', 'Goalkeeper') NOT NULL,

team_id INT,

FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

-- 5. Create Games table
CREATE TABLE games (

id INT AUTO_INCREMENT PRIMARY KEY,

team1_id INT,

team2_id INT,

team1_score INT NOT NULL,

team2_score INT NOT NULL,

game_date DATE NOT NULL,

FOREIGN KEY (team1_id) REFERENCES teams(id) ON DELETE CASCADE,

FOREIGN KEY (team2_id) REFERENCES teams(id) ON DELETE CASCADE
);

-- 6. Insert sample data into the Teams table

INSERT INTO teams (name, city) VALUES

('Team A', 'New York'),

('Team B', 'Los Angeles'),

('Team C', 'Chicago');

-- 7. Insert sample data into the Players table

INSERT INTO players (name, age, position, team_id) VALUES

('Player 1', 24, 'Forward', 1),

('Player 2', 28, 'Midfielder', 1),

('Player 3', 21, 'Defender', 2),

('Player 4', 30, 'Goalkeeper', 2),

('Player 5', 26, 'Forward', 3);

-- 8. Insert sample data into the Games table

INSERT INTO games (team1_id, team2_id, team1_score, team2_score, game_date) VALUES

(1, 2, 3, 2, '2024-01-15'),

(2, 3, 1, 0, '2024-02-10'),

(3, 1, 2, 2, '2024-03-05');
