Teacher Management API Documentation

Overview

The Teacher Management API is a simple PHP-based API that allows for CRUD (Create, Read, Update, Delete) operations on
teacher records. Data is stored in a JSON file, and the API includes authentication using sessions. The API supports the
following operations:

Create: Add a new teacher.

Read: Retrieve all teachers or a specific teacher by ID.

Update: Fully update a teacher's information.

Patch: Partially update a teacher's information.

Delete: Remove a teacher by ID.

Login: Authenticate users to access the API.

Project Structure:

index.php: The main entry point for routing requests.

api.php: Contains functions for handling API operations (CRUD).

login.php: Handles user authentication.

teachers.json: Stores teacher data in JSON format.

Start the PHP Server:
php -S localhost:8000

Unit Tests:
Running the Tests:

./vendor/bin/phpunit