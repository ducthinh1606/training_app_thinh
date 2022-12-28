import React from "react";
import "./ListTaskByStatus.scss"
import Task from "../Task/Task";

function ListTaskByStatus({taskStatus}) {
    const demoListTask = [
        {
            title: "1",
            estimate: "2022-27-12 00:00"
        },
        {
            title: "2",
            estimate: "2022-27-12 00:00"
        },
        {
            title: "3",
            estimate: "2022-27-12 00:00"
        },
        {
            title: "4",
            estimate: "2022-27-12 00:00"
        },
        {
            title: "5",
            estimate: "2022-27-12 00:00"
        },
    ]

    const listTask = demoListTask.map((data) => <Task key={data.title} task={data}/>)

    return (
        <div className="list-task-by-status">
            <div className="status">{taskStatus.name}</div>
            {listTask}
        </div>
    )
}

export default ListTaskByStatus;