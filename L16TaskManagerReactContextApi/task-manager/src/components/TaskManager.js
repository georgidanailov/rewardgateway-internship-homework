import React, {useContext, useState} from 'react';
import TaskList from './TaskList';
import TaskForm from './TaskForm';
import TaskCounter from './TaskCounter';
import {TaskContext} from '../context/TaskContext';
import '../App.css';

const TaskManager = () => {
    const {tasks} = useContext(TaskContext);
    const [searchTerm, setSearchTerm] = useState('');

    const filteredTasks = tasks.filter(task =>
        task.title.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <div className="container mt-5">
            <h1 className="text-center">Task Manager</h1>
            <input
                type="text"
                className="form-control mb-3"
                placeholder="Search tasks..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
            />
            <TaskForm/>
            <TaskList tasks={filteredTasks}/>
            <TaskCounter taskCount={filteredTasks.length}/>
        </div>
    );
};

export default TaskManager;
