import React, {useEffect, useState} from "react";
import "./ListTask.scss"
import ListTaskByStatus from "../ListTaskByStatus/ListTaskByStatus";
import axios from "axios";

function ListTask() {
    const [listTaskStatus, setListTaskStatus] = useState([])
    const [listTask, setListTask] = useState([])
    const [filterTaskStatus, setFilterTaskStatus] = useState("")
    const [filterTaskName, setFilterTaskName] = useState("")

    const config = {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        }
    }

    useEffect(() => {
        axios.get('task-statuses', config)
            .then(res => {
                setListTaskStatus(res.data.data)
                localStorage.setItem('task_status', JSON.stringify(res.data.data))
            })

        axios.get('tasks', config)
            .then(res => {
                setListTask(res.data.data)
            })
    }, [])

    const search = () => {
        const params = {
            params: {
                task_name: filterTaskName,
                task_status_id: filterTaskStatus
            },
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }
        axios.get('tasks', params)
            .then(res => {
                setListTask(res.data.data)
            })
    }

    const showListTaskStatus = listTaskStatus.map((data) => <ListTaskByStatus key={data.id} taskData={{
        status: data,
        list: listTask
    }}/>)
    const statusOption = listTaskStatus.map((data) => <option key={data.id} value={data.id}>{data.status_name}</option>)

    return (
        <div className="list-task">
            <div className="title">
                <span>List Tasks</span>
            </div>
            <div className="search">
                <div className="form-search">
                    <div className="input-task-name">
                        <label>Task name: </label>
                        <input type="text" onChange={e => setFilterTaskName(e.target.value)} placeholder="Task name"/>
                    </div>

                    <div className="select-task-status">
                        <label>Status: </label>
                        <select onChange={e => setFilterTaskStatus(e.target.value)} name="select-task-status">
                            <option defaultValue={null} value={0}>All</option>
                            {statusOption}
                        </select>
                    </div>

                    <button className="search-button" onClick={search}>
                        <svg width="15px" height="15px" fill="white" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/>
                        </svg>
                        Search
                    </button>
                </div>
            </div>
            <div className="list">
                {showListTaskStatus}
            </div>

        </div>
    )
}

export default ListTask;