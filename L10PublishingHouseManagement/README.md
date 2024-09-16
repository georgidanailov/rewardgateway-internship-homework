# Publishing House Management System

This project is a Symfony-based web application that manages books, authors, editors, and genres for a publishing house.
The system allows for creating, editing, viewing, and listing entities related to books, authors, editors, and genres,
with relationships between them.

## Features

- **Books**:
    - Each book has a title, ISBN, publication year, genre(s), author, and editor(s).
    - Relationships:
        - A book is written by one author.
        - A book can belong to many genres.
        - A book can be edited by multiple editors.

- **Authors**:
    - Each author has a name, birth year, nationality, and a list of books they've written.

- **Editors**:
    - Each editor has a name, editorial number, specialty, and a list of books they've edited.

- **Genres**:
    - Each genre has a name and description, and a list of books in that genre.

## Requirements

- PHP 8.1 or higher
- Composer
- Symfony CLI
- MySQL or compatible database

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/publishing-house-management.git
    cd publishing-house-management
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Create and configure your `.env` file:

    ```bash
    cp .env .env.local
    ```

   Set your database credentials in `.env.local`:

    ```
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    ```

4. Create the database:

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. Load initial data (optional):

    ```bash
    php bin/console doctrine:fixtures:load
    ```

6. Start the server:

    ```bash
    symfony server:start
    ```

The application should now be accessible at `http://localhost:8000`.

## Running Tests

The project includes functional tests for the core controllers (`BookController`, `AuthorController`,
`EditorController`, `GenreController`).

To run the tests:

```bash
php bin/phpunit
```

## Key Routes

- **Books**: `/book`
- **Authors**: `/author`
- **Editors**: `/editor`
- **Genres**: `/genre`

Each of these routes provides options for:

- Viewing the list of entities
- Creating new entities
- Editing existing entities

## Project Structure

- **Entity**: Defines the structure and relationships for books, authors, editors, and genres.
- **Form**: Handles the forms for creating and editing entities.
- **Controller**: Manages the routing, processing, and rendering for each entity.
- **Tests**: Functional tests for the main application controllers.