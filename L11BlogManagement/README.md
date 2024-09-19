# L11 Blog Management System

## Overview

The **L11 Blog Management System** is a web application built with Symfony 7.1.4 and PHP 8.3.11. It allows users to
manage blog posts, comments, and user roles within a flexible, secure framework. This project features role-based access
control (RBAC), allowing for differentiated user permissions (Admin, Author, User).

## Features

- **User Management**
    - User registration and authentication.
    - Role-based access control with three roles: Admin, Author, User.
    - Password hashing and credential management.
    - Profile management.

- **Post Management**
    - Create, edit, delete, and view blog posts.
    - Posts are associated with specific authors.
    - Date of creation is automatically recorded.

- **Comment Management**
    - Users can add, edit, and delete comments on posts.
    - Comments are associated with both users and posts.
    - Comments have a rating system (1-5 stars).

- **Security**
    - Role-based access control: Admins have full access, Authors can manage their own posts and comments, and Users can
      comment on posts.
    - CSRF protection on forms.
    - User roles are hierarchical, with Admin having the most permissions.

- **Responsive Design**
    - The application is designed using Bootstrap 5 to be fully responsive.
    - Easy navigation through a fixed-top navbar with links to Home, Posts, and (optionally) Authors.

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/L11BlogManagement.git
    cd L11BlogManagement
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Configure environment variables:**

   Copy the `.env` file to create the required `.env.local` for your local environment.

    ```bash
    cp .env .env.local
    ```

   Edit the `.env.local` file to set up your database and other environment-specific settings.

4. **Create and migrate the database:**

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. **Load fixtures (optional):**

   If you have fixtures to load sample data:

    ```bash
    php bin/console doctrine:fixtures:load
    ```

6. **Run the Symfony server:**

    ```bash
    symfony server:start
    ```

7. **Access the application:**

   Visit `http://127.0.0.1:8000` in your web browser.

## Running Tests

To run the unit tests:

```bash
php bin/phpunit
```

This will execute the tests for your entities, controllers, and other components.

## Folder Structure

- **src/Entity** - Contains all the entities, such as `User`, `Post`, and `Comment`.
- **src/Controller** - Contains the controllers that manage the application flow.
- **templates** - Contains all the Twig templates for the frontend views.
- **public** - The web root directory, contains `index.php`.
- **tests** - Contains the unit and functional tests for the application.

## Author

- **Georgi Danailov** - *Initial work* - [My Github](https://github.com/georgidanailov)

## Acknowledgments

- Symfony documentation for its comprehensive guides.
- Bootstrap for providing the responsive design framework.
