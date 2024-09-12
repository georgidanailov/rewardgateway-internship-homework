# Symfony CRUD API Documentation

## Project Overview

This project is a Symfony-based web application that provides CRUD operations through a RESTful API. It manages four key
entities: **Category**, **Product**, **Customer**, and **Order**. The application allows for creating, reading,
updating, and deleting these entities. Additionally, it includes, filtering, and handling of many-to-one
relationships.

---

## Entities

### Category

- `id` (integer, auto-increment, primary key)
- `name` (string, required)
- `description` (text, optional)

### Product

- `id` (integer, auto-increment, primary key)
- `name` (string, required)
- `price` (float, required)
- `quantity` (integer, required)
- `description` (text, optional)
- `category` (Many-to-One relation to Category, required)

### Customer

- `id` (integer, auto-increment, primary key)
- `name` (string, required)
- `email` (string, required, unique)
- `address` (string, required)
- `phone` (string, optional)

### Order

- `id` (integer, auto-increment, primary key)
- `order_date` (datetime, required, defaults to current time)
- `total` (float, required)
- `status` (enum, required; options: `Pending`, `Completed`, `Cancelled`)
- `customer` (Many-to-One relation to Customer, required)

---

## API Endpoints

### Category Endpoints

1. **POST** `/api/categories` - Create a new category.
    - **Body (JSON)**:
      ```json
      {
          "name": "Electronics",
          "description": "Category for electronic products"
      }
      ```
2. **GET** `/api/categories` - List all categories.
3. **GET** `/api/categories/{id}` - Get details of a specific category by ID.
4. **PUT** `/api/categories/{id}` - Update a category.
    - **Body (JSON)**:
      ```json
      {
          "name": "Updated Category Name",
          "description": "Updated description"
      }
      ```
5. **DELETE** `/api/categories/{id}` - Delete a category by ID.

### Product Endpoints

1. **POST** `/api/products` - Create a new product.
    - **Body (JSON)**:
      ```json
      {
          "name": "Laptop",
          "price": 1200.50,
          "quantity": 5,
          "description": "High-end gaming laptop",
          "category_id": 1
      }
      ```
2. **GET** `/api/products` - List all products.
3. **GET** `/api/products/{id}` - Get details of a specific product by ID.
4. **PUT** `/api/products/{id}` - Update a product.
    - **Body (JSON)**:
      ```json
      {
          "name": "Updated Laptop",
          "price": 1100.00,
          "quantity": 3,
          "description": "Updated description",
          "category_id": 1
      }
      ```
5. **DELETE** `/api/products/{id}` - Delete a product by ID.

### Customer Endpoints

1. **POST** `/api/customers` - Create a new customer.
    - **Body (JSON)**:
      ```json
      {
          "name": "John Doe",
          "email": "john.doe@example.com",
          "address": "123 Main Street",
          "phone": "555-1234"
      }
      ```
2. **GET** `/api/customers` - List all customers.
3. **GET** `/api/customers/{id}` - Get details of a specific customer by ID.
4. **PUT** `/api/customers/{id}` - Update customer details.
    - **Body (JSON)**:
      ```json
      {
          "name": "Jane Doe",
          "email": "jane.doe@example.com",
          "address": "456 New Street",
          "phone": "555-6789"
      }
      ```
5. **DELETE** `/api/customers/{id}` - Delete a customer by ID.

### Order Endpoints

1. **POST** `/api/orders` - Create a new order.
    - **Body (JSON)**:
      ```json
      {
          "total": 150.00,
          "status": "Pending",
          "customer_id": 1
      }
      ```
2. **GET** `/api/orders` - List all orders.
3. **GET** `/api/orders/{id}` - Get details of a specific order by ID.
4. **PUT** `/api/orders/{id}` - Update order status.
    - **Body (JSON)**:
      ```json
      {
          "status": "Completed"
      }
      ```
5. **DELETE** `/api/orders/{id}` - Cancel an order (soft delete).

---

## Usage Instructions

### Setting Up the Project

1. Clone the repository:
    ```bash
    git clone <repository-url>
    ```


2. Running Tests:
    ```bash
    php bin/phpunit
    ```

## Technologies Used

- **Symfony 7.1**: Web framework for PHP.
- **Doctrine ORM**: Database ORM to manage entities.
- **PHPUnit**: Testing framework.
- **PostgreSQL/MySQL/SQLite**: Supported databases.

