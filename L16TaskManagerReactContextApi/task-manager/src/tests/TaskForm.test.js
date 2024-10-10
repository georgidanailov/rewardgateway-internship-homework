import React from 'react';
import {render, screen, fireEvent} from '@testing-library/react';
import {TaskContext} from '../context/TaskContext';
import TaskForm from '../components/TaskForm';

test('adds a new task when the form is submitted', () => {
    const mockAddTask = jest.fn();

    render(
        <TaskContext.Provider value={{addTask: mockAddTask}}>
            <TaskForm/>
        </TaskContext.Provider>
    );

    fireEvent.change(screen.getByPlaceholderText(/Enter task title/i), {target: {value: 'New Task'}});
    fireEvent.click(screen.getByText(/Add Task/i));

    expect(mockAddTask).toHaveBeenCalledWith(expect.objectContaining({title: 'New Task'}));
});
