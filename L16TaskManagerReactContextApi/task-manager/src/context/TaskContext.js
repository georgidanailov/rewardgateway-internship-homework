import React, {createContext, useState, useEffect} from 'react';

const TaskContext = createContext();

const TaskProvider = ({children}) => {
    const [tasks, setTasks] = useState([]);
    const [editingTask, setEditingTask] = useState(null);

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

    return (
        <TaskContext.Provider value={{tasks, addTask, editTask, updateTask, deleteTask, editingTask}}>
            {children}
        </TaskContext.Provider>
    );
};

export {TaskProvider, TaskContext};
