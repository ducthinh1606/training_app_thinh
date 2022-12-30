import React, {useState} from "react";
import "./AddTask.scss"
import ReactModal from "react-modal";
import axios from "axios";

function AddTask() {
    let [showModal, setShowModal] = useState(false)
    let [notEstimate, setNotEstimate] = useState(true)
    let [taskName, setTaskName] = useState("")
    let [estimate, setEstimate] = useState("")

    const addTask = () => {
        const data = {
            task_name: taskName,
            estimate: !notEstimate ? estimate : ""
        }

        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }

        axios.post('tasks', data, config)
            .then(res => {
                alert(res.data.message)
                setShowModal(false)
            })
            .catch(err => {
                alert(JSON.stringify(err.response.data.error.message))
            })
    }

    return (
        <div className="add-task">
            <button className="add-task-btn" onClick={() => setShowModal(true)}>Add Task</button>
            <ReactModal
                isOpen={showModal}
                className="modal-add-task"
                ariaHideApp={false}
            >
                <div className="form-add-task">
                    <h1>New Task</h1>

                    <table className="table-add-task">
                        <tbody>
                        <tr>
                            <td><label htmlFor="">Task title: </label></td>
                            <td><input type="text" className="task-name" placeholder="Task name"
                                       name="task_name"
                                       onChange={e => setTaskName(e.target.value)}/>
                            </td>
                        </tr>
                        <tr>
                            <td><label htmlFor="">Estimate: </label></td>
                            <td>
                                <input type="datetime-local" name="estimate" className="estimate" required={true}
                                       disabled={notEstimate}
                                       onChange={e => setEstimate(e.target.value)}/>
                                <input type="checkbox" name="estimate"
                                       onChange={() => notEstimate ? setNotEstimate(false) : setNotEstimate(true)}/>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <button className="btn-add" onClick={addTask}>Add</button>
                    <button onClick={() => setShowModal(false)}>Close</button>
                </div>
            </ReactModal>
        </div>
    )
}

export default AddTask;