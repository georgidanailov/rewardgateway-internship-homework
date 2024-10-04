import React, {useState, useEffect} from 'react';

const TaskForm = ({addTask, editingTask, updateTask}) => {
    const [title, setTitle] = useState('');

    useEffect(() => {
        if (editingTask) {
            setTitle(editingTask.title);
        } else {
            setTitle('');
        }
    }, [editingTask]);

    const handleSubmit = (e) => {
        e.preventDefault();
        const task = {
            id: Date.now(),
            title,
        };

        if (editingTask) {
            updateTask({...editingTask, title});
        } else {
            addTask(task);
        }

        setTitle('');
    };

    return (
        <form onSubmit={handleSubmit} className="mb-3">
            <div className="input-group">
                <input
                    type="text"
                    className="form-control"
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                    placeholder="Enter task title"
                    required
                />
                <button type="submit" className="btn btn-primary">
                    {editingTask ? 'Update Task' : 'Add Task'}
                </button>
            </div>
        </form>
    );
};

export default TaskForm;
