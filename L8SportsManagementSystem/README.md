# Sports Team and Match Management System

---

## Overview

The **Sports Team and Match Management System** is a web-based application that allows users to manage teams, players,
and games. It includes features such as creating teams, adding players to teams, scheduling matches between teams, and
generating statistics related to team performance. The system is built with a RESTful API to support these operations
and a front-end with HTML forms for manual data input.

---

## Technologies Used

- **PHP**: Back-end logic and API implementation.
- **MySQL**: Relational database for storing teams, players, and games.
- **HTML/CSS**: Front-end interface for users to interact with the system.
- **JavaScript**: Optional, for dynamic actions on the front-end (e.g., form validation).
- **PHPUnit**: Used for unit testing API endpoints.

---

## Project Setup

### Prerequisites

1. **PHP 7.4 or higher**
2. **MySQL 5.7 or higher**
3. **Apache or Nginx Web Server**
4. **Composer** (Optional if advanced PHP packages are used)

### Steps to Set Up

1. **Clone the Repository**:
   ```bash
   git clone <repository-url>
   cd sports_management_system

Database Setup:

Create a .env file to store the database configuration:

Import the provided SQL script (sports_management.sql) to set up the MySQL database:

mysql -u username -p sports_management < sports_management.sql

Run the Project

# API Documentation

The system provides RESTful API endpoints to manage teams, players, and games. All requests and responses use JSON
format.

---

## Teams API

GET /teams`
Description**: Retrieve a list of all teams.

- **Response Example**:
  `

  {
  "id": 1,
  "name": "Team A",
  "city": "New York"
  },
  {
  "id": 2,
  "name": "Team B",
  "city": "Los Angeles"
  }

GET /teams/{id}
Description: Retrieve details of a specific team by ID.
Response Example:
json
Copy code
{
"id": 1,
"name": "Team A",
"city": "New York"
}

POST /teams
Description: Create a new team.
Request Body:
json
Copy code
{
"name": "Team C",
"city": "Chicago"
}

Response Example:
json
Copy code
{
"success": true,
"message": "Team created successfully"
}

PUT /teams/{id}
Description: Update an existing team.
Request Body:
json
Copy code
{
"name": "Team C Updated",
"city": "Chicago"
}

Response Example:
json
Copy code
{
"success": true,
"message": "Team updated successfully"
}

DELETE /teams/{id}
Description: Delete a team by ID.
Response Example:
json
Copy code
{
"success": true,
"message": "Team deleted successfully"
}

Players API
GET /players
Description: Retrieve a list of all players.
Response Example:
json
Copy code

{
"id": 1,
"name": "Player 1",
"age": 24,
"position": "Forward",
"team_id": 1
},

{
"id": 2,
"name": "Player 2",
"age": 28,
"position": "Midfielder",
"team_id": 1
}

GET /players/{id}
Description: Retrieve details of a specific player by ID.
Response Example:
json
Copy code
{
"id": 1,
"name": "Player 1",
"age": 24,
"position": "Forward",
"team_id": 1
}

POST /players
Description: Add a new player to a team.
Request Body:
json
Copy code
{
"name": "Player 3",
"age": 26,
"position": "Defender",
"team_id": 2
}

Response Example:
json
Copy code
{
"success": true,
"message": "Player added successfully"
}

PUT /players/{id}
Description: Update a player’s details.
Request Body:
json
Copy code
{
"name": "Player 3 Updated",
"age": 27,
"position": "Defender",
"team_id": 2
}

Response Example:
json
Copy code
{
"success": true,
"message": "Player updated successfully"
}

DELETE /players/{id}
Description: Remove a player by ID.
Response Example:
json
Copy code
{
"success": true,
"message": "Player deleted successfully"
}

Games API
GET /games
Description: Retrieve a list of all games.
Response Example:
json
Copy code

{
"id": 1,
"team1_id": 1,
"team2_id": 2,
"team1_score": 3,
"team2_score": 2,
"game_date": "2024-01-15"
},
{
"id": 2,
"team1_id": 2,
"team2_id": 3,
"team1_score": 1,
"team2_score": 0,
"game_date": "2024-02-10"
}

GET /games/{id}
Description: Retrieve details of a specific game by ID.
Response Example:
json
Copy code

{
"id": 1,
"team1_id": 1,
"team2_id": 2,
"team1_score": 3,
"team2_score": 2,
"game_date": "2024-01-15"
}

POST /games
Description: Create a new game between two teams.
Request Body:
json
Copy code
{
"team1_id": 1,
"team2_id": 2,
"team1_score": 3,
"team2_score": 2,
"game_date": "2024-01-15"
}

Response Example:
json
Copy code
{
"success": true,
"message": "Game created successfully"
}

PUT /games/{id}
Description: Update a game’s result.
Request Body:
json
Copy code
{
"team1_score": 2,
"team2_score": 2,
"game_date": "2024-01-20"
}

Response Example:
json
Copy code
{
"success": true,
"message": "Game updated successfully"
}

DELETE /games/{id}
Description: Delete a game by ID.
Response Example:
json
Copy code
{
"success": true,
"message": "Game deleted successfully"
}

Common HTTP Responses
200 OK: The request was successful.
201 Created: The resource was successfully created.
400 Bad Request: The request could not be understood or was missing required parameters.
404 Not Found: The resource could not be found.
500 Internal Server Error: An error occurred on the server.

