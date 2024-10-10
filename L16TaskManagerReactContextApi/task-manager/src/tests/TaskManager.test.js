import React from 'react';
import {render, screen, fireEvent} from '@testing-library/react';
import {TaskContext} from '../context/TaskContext';
import TaskManager from '../components/TaskManager';

test('filters tasks by search term', () => {
    const mockTasks = [
        {id: 1, title: 'Task One'},
        {id: 2, title: 'Another Task'},
    ];

    render(
        <TaskContext.Provider value={{tasks: mockTasks}}>
            <TaskManager/>
        </TaskContext.Provider>
    );

    expect(screen.getByText(/Task One/i)).toBeInTheDocument();
    expect(screen.getByText(/Another Task/i)).toBeInTheDocument();

    fireEvent.change(screen.getByPlaceholderText(/Search tasks/i), {target: {value: 'Another'}});

    expect(screen.queryByText(/Task One/i)).not.toBeInTheDocument();
    expect(screen.getByText(/Another Task/i)).toBeInTheDocument();
});
