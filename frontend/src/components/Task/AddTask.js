import React, {useState} from "react";
import "./AddTask.scss"
import ReactModal from "react-modal";

function AddTask() {
    let [showModal, setShowModal] = useState(false)
    let [notEstimate, setNotEstimate] = useState(true)
    let [taskName, setTaskName] = useState()
    let [estimateDate, setEstimateDate] = useState()
    let [estimateTime, setEstimateTime] = useState()

    const addTask = e => {
        const data = {
            task_name: taskName,
            estimate: !notEstimate ? estimateDate + " " + estimateTime : ""
        }
        alert(data.estimate)
    }

    return (
        <div className="add-task">
            <button className="add-task-btn" onClick={() => setShowModal(true)}>Add Task</button>
            <ReactModal
                isOpen={showModal}
                className="modal-add-task"
                ariaHideApp={false}
            >
                <form onSubmit={addTask}>
                    <h1>New Task</h1>

                    <table className="form-add-task">
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
                            <td><input type="date" name="estimate-date" className="estimate-date"
                                       onChange={e => setEstimateDate(e.target.value)} required={true}
                                       disabled={notEstimate}/>
                                <input type="time" name="estimate-time" className="estimate-time"
                                       onChange={e => setEstimateTime(e.target.value)} required={true}
                                       disabled={notEstimate}/>
                                <input type="checkbox" name="estimate"
                                       onChange={() => notEstimate ? setNotEstimate(false) : setNotEstimate(true)}/>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <button className="btn-add">Add</button>
                    <button onClick={() => setShowModal(false)}>Close</button>
                </form>
            </ReactModal>
        </div>
    )
}

export default AddTask;