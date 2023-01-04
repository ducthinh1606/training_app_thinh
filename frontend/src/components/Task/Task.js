import React, {useEffect, useState} from "react";
import "./Task.scss"
import ReactModal from "react-modal";
import axios from "axios";
import dateFormat from "dateformat";

function Task({task}) {
    let [showEditModal, setShowEditModal] = useState(false)
    let [isEstimate, setIsEstimate] = useState(false)
    let [taskName, setTaskName] = useState(null)
    let [estimate, setEstimate] = useState(null)
    let [taskStatus, setTaskStatus] = useState(null)
    let [detailTask, setDetailTask] = useState("")
    const [listTaskStatus, setListTaskStatus] = useState([])

    useEffect(() => {
        const taskStatus = JSON.parse(localStorage.getItem('task_status'));
        if (taskStatus) {
            setListTaskStatus(taskStatus);
        }
    }, []);

    const statusOption = listTaskStatus.map((data) => <option key={data.id}
                                                              selected={detailTask.task_status_id === data.id}
                                                              defaultValue={null}
                                                              value={data.id}>{data.status_name}</option>)

    const editTask = (id) => {
        const data = {
            task_name: taskName,
            estimate: estimate ? dateFormat(estimate, "yyyy-mm-dd'T'HH:MM") : null,
            task_status_id: taskStatus
        }

        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }

        axios.put('tasks/' + id, data, config)
            .then(res => {
                alert(res.data.message)
                window.location.reload();
            })
            .catch(err => {
                alert(JSON.stringify(err.response.data.error.message))
            })
    }

    const showTask = (id) => {
        setShowEditModal(true)

        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }

        axios.get('tasks/' + id, config)
            .then(res => {
                setDetailTask(res.data.data)
                setTaskName(res.data.data.task_name)
                setEstimate(res.data.data.estimate)
                setTaskStatus(res.data.data.task_status_id)
            })
    }

    return (
        <div className="task">
            <div className="task-content">
                <span title={task.task_name} className="task-title">{task.task_name}</span>
                <span className="task-estimate">{task.estimate ?? "(not estimate)"}</span>
            </div>
            <div className="action">
                <span><button onClick={() => showTask(task.id)}><svg width="20px" height="20px"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 512 512"><path
                    d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg></button></span>
                <span><button><svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg"
                                   viewBox="0 0 448 512"><path
                    d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z"/></svg></button></span>

                <ReactModal
                    isOpen={showEditModal}
                    className="modal-edit-task"
                    ariaHideApp={false}
                >
                    <div className="form-edit-task">
                        <h1>Edit Task</h1>

                        <table className="table-edit-task">
                            <tbody>
                            <tr>
                                <td><label htmlFor="">Task title: </label></td>
                                <td><input type="text" className="task-name" placeholder="Task name"
                                           name="task_name" defaultValue={detailTask.task_name}
                                           value={taskName}
                                           onChange={e => setTaskName(e.target.value)}
                                />
                                </td>
                            </tr>
                            <tr>
                                <td><label htmlFor="">Estimate: </label></td>
                                <td>
                                    <input type="datetime-local" name="estimate" className="estimate"
                                           disabled={!isEstimate} defaultValue={detailTask.estimate}
                                           value={estimate}
                                           onChange={e => setEstimate(e.target.value)}/>
                                    <input type="checkbox" name="estimate"
                                           onChange={() => isEstimate ? setIsEstimate(false) : setIsEstimate(true)}/>
                                </td>
                            </tr>
                            <tr>
                                <td><label htmlFor="">Task status: </label></td>
                                <td><select defaultValue={null} onChange={e => setTaskStatus(e.target.value)}
                                            name="select-task-status">
                                    <option value={0}>All</option>
                                    {statusOption}
                                </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <button className="btn-add" onClick={() => editTask(task.id)}>Edit</button>
                        <button onClick={() => setShowEditModal(false)}>Close</button>
                    </div>
                </ReactModal>
            </div>
        </div>
    );
}

export default Task;