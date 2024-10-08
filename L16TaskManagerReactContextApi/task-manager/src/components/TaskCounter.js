import React, {useContext} from 'react';
import {TaskContext} from '../context/TaskContext';

const TaskCounter = () => {
    const {tasks} = useContext(TaskContext);

    return (
        <div>
            <h2>Total Tasks: {tasks.length}</h2>
        </div>
    );
};

export default TaskCounter;
