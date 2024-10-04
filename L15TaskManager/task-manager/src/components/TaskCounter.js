import React from 'react';

const TaskCounter = ({taskCount}) => {
    return (
        <div>
            <h2>Total Tasks: {taskCount}</h2>
        </div>
    );
};

export default TaskCounter;
