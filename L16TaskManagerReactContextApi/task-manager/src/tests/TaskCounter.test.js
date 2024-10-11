import React from 'react';
import {render, screen} from '@testing-library/react';
import {TaskContext} from '../context/TaskContext';
import TaskCounter from '../components/TaskCounter';

test('displays the correct number of tasks', () => {
    const mockTasks = [{id: 1, title: 'Task 1'}, {id: 2, title: 'Task 2'}];

    render(
        <TaskContext.Provider value={{tasks: mockTasks}}>
            <TaskCounter/>
        </TaskContext.Provider>
    );

    expect(screen.getByText(/Total Tasks: 2/i)).toBeInTheDocument();
});
