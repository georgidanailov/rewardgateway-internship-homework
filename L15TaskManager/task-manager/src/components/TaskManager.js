import React, {useState, useEffect} from 'react';
import TaskList from './TaskList';
import TaskForm from './TaskForm';
import TaskCounter from './TaskCounter';
import '../App.css';

const TaskManager = () => {
    const [tasks, setTasks] = useState([]);
    const [editingTask, setEditingTask] = useState(null);
    const [searchTerm, setSearchTerm] = useState('');

    useEffect(() => {
        const storedTasks = JSON.parse(localStorage.getItem('tasks')) || [];
        setTasks(storedTasks);
    }, []);

    useEffect(() => {
        if (tasks.length > 0) {
            localStorage.setItem('tasks', JSON.stringify(tasks));
        }
    }, [tasks]);

    const addTask = (task) => {
        setTasks([...tasks, task]);
    };

    const editTask = (task) => {
        setEditingTask(task);
    };

    const updateTask = (updatedTask) => {
        setTasks(tasks.map(task => (task.id === updatedTask.id ? updatedTask : task)));
        setEditingTask(null);
    };

    const deleteTask = (id) => {
        setTasks(tasks.filter(task => task.id !== id));
    };

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
            <TaskForm addTask={addTask} editingTask={editingTask} updateTask={updateTask}/>
            <TaskList tasks={filteredTasks} deleteTask={deleteTask} editTask={editTask}/>
            <TaskCounter taskCount={filteredTasks.length}/>
        </div>
    );
};

export default TaskManager;
