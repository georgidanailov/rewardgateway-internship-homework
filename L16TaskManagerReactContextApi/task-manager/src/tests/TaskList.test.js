import React from 'react';
import {render, screen, fireEvent} from '@testing-library/react';
import {TaskContext} from '../context/TaskContext';
import TaskList from '../components/TaskList';

test('displays tasks and deletes a task when delete button is clicked', () => {
    const mockTasks = [{id: 1, title: 'Task 1'}, {id: 2, title: 'Task 2'}];
    const mockDeleteTask = jest.fn();

    render(
        <TaskContext.Provider value={{tasks: mockTasks, deleteTask: mockDeleteTask}}>
            <TaskList tasks={mockTasks}/>
        </TaskContext.Provider>
    );

    expect(screen.getByText(/Task 1/i)).toBeInTheDocument();
    fireEvent.click(screen.getAllByText(/Delete/i)[0]);

    expect(mockDeleteTask).toHaveBeenCalledWith(1);
});
