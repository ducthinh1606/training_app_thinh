import React from "react";
import "./ListTaskByStatus.scss"
import Task from "../Task/Task";

function ListTaskByStatus({taskData}) {
    const showListTask = taskData.list.map((data) => {
        return taskData.status.id === data.task_status_id ? <Task key={data.id} task={data}/> : ""
    })

    return (
        <div className="list-task-by-status">
            <div className="status">{taskData.status.status_name}</div>
            {showListTask}
        </div>
    )
}

export default ListTaskByStatus;