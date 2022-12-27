import React from "react";
import "./ListTask.scss"
import ListTaskByStatus from "../ListTaskByStatus/ListTaskByStatus";

function ListTask() {
    const demoTaskStatus = [
        {
            status: "1",
            name: "Status 1"
        },
        {
            status: "2",
            name: "Status 2"
        },
        {
            status: "3",
            name: "Status 3"
        }
    ]

    const listTaskStatus = demoTaskStatus.map((data) => <ListTaskByStatus taskStatus={data}/>)

    return (
        <div className="list-task">
            <div className="title">
                <a>List Tasks</a>
            </div>
            <div className="search">
                <form className="form-search">
                    <div className="input-task-name">
                        <label>Task name: </label>
                        <input type="text" placeholder="Task name"/>
                    </div>

                    <div className="select-task-status">
                        <label>Status: </label>
                        <select name="select-task-status">
                            <option defaultValue="">all</option>
                            <option value="1">status</option>
                            <option value="2">status</option>
                            <option value="3">status</option>
                            <option value="4">status</option>
                        </select>
                    </div>

                    <button className="search-button">
                        <svg width="15px" height="15px" fill="white" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/>
                        </svg>
                        Search
                    </button>
                </form>
            </div>
            <div className="list">
                {listTaskStatus}
            </div>

        </div>
    )
}

export default ListTask;