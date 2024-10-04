import React from 'react';

const TaskList = ({tasks, deleteTask, editTask}) => {
    return (
        <ul className="list-group">
            {tasks.map(task => (
                <li className="list-group-item d-flex justify-content-between align-items-center" key={task.id}>
                    {task.title}
                    <div>
                        <button className="btn btn-warning btn-sm me-2" onClick={() => editTask(task)}>Edit</button>
                        <button className="btn btn-danger btn-sm" onClick={() => deleteTask(task.id)}>Delete</button>
                    </div>
                </li>
            ))}
        </ul>
    );
};

export default TaskList;
