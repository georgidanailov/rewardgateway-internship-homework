# Task Manager Application with React Context API

The application is now using the React Context API to manage the tasks globally, avoiding prop drilling compared to the
previous L15TaskManager! A simple Task Manager application built with React, allowing users to create, edit, delete, and
search tasks. The
application leverages Bootstrap for styling and utilizes localStorage to persist tasks.

## Features

- **Task List**: View a list of all tasks.
- **Add Task**: Create new tasks.
- **Edit Task**: Modify existing tasks.
- **Delete Task**: Remove tasks from the list.
- **Search**: Filter tasks by title.
- **Persistence**: Tasks are saved in localStorage, ensuring they persist across page reloads.

## Technologies Used

- **React**
- **Bootstrap**
- **localStorage**: Web storage API for saving tasks.

## Usage

```bash
   npm start
   ```

- **Use the input field to add a new task.**
- **Click "Edit" to modify a task.**
- **Click "Delete" to remove a task.**
- **Use the search bar to filter tasks by title.**

## Test

To run the tests with Jest use the following command:

```bash
   npm test
   ```

This will run the tests plus coverage:

```bash
   npm test -- --coverage
   ```