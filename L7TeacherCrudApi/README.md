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

To test the API with Postman:

Start Your PHP Server:

In your project directory, run:
bash
Copy code
php -S localhost:8000
This starts a PHP development server on http://localhost:8000.
Log In:

Method: POST
URL: http://localhost:8000/login
Body: (Choose raw and JSON as the type)
json
Copy code
{
"username": "admin",
"password": "password"
}
Response: If successful, you should get a 200 OK with a message confirming the login.
Get All Teachers:

Method: GET
URL: http://localhost:8000/teachers
Response: You should get a 200 OK response with the list of teachers.
Get a Specific Teacher:

Method: GET
URL: http://localhost:8000/teachers/{id}
Replace {id} with the actual teacher ID.
Response: You should get a 200 OK response with the teacher’s data.
Create a New Teacher:

Method: POST
URL: http://localhost:8000/teachers
Body: (Choose raw and JSON)
json
Copy code
{
"name": "Jane Smith",
"subject": "History"
}
Response: You should get a 201 Created response with the newly created teacher’s data.
Update a Teacher:

Method: PUT
URL: http://localhost:8000/teachers/{id}
Replace {id} with the actual teacher ID.
Body: (Choose raw and JSON)
json
Copy code
{
"name": "Jane Doe",
"subject": "English"
}
Response: You should get a 200 OK response with the updated teacher’s data.
Patch a Teacher:

Method: PATCH
URL: http://localhost:8000/teachers/{id}
Replace {id} with the actual teacher ID.
Body: (Choose raw and JSON)
json
Copy code
{
"subject": "Science"
}
Response: You should get a 200 OK response with the patched teacher’s data.
Delete a Teacher:

Method: DELETE
URL: http://localhost:8000/teachers/{id}
Replace {id} with the actual teacher ID.
Response: You should get a 204 No Content response indicating the teacher was deleted.

Unit Tests:
Running the Tests:

./vendor/bin/phpunit