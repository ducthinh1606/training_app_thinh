import React, {useState} from "react";
import "./Register.scss"
import axios from "axios";

function Register({setShowRegisterModal}) {
    let [username, setUsername] = useState("")
    let [password, setPassword] = useState("")
    let [confirmPassword, setConfirmPassword] = useState("")

    const checkPassword = e => {
        if (password !== confirmPassword) {
            e.target.setCustomValidity("Passwords Don't Match")
        } else {
            e.target.setCustomValidity("")
        }
    }

    const register = (e) => {
        e.preventDefault();

        const data = {
            username: username,
            password: password,
            password_confirmation: confirmPassword
        }

        axios.post('register', data)
            .then(res => {
                alert("Register successful!")
                setShowRegisterModal(false)
            })
            .catch(err => {
                console.log(err)
            })
    }

    return (
        <div className="form-register-modal">
            <form className="form-register-inner" onSubmit={register}>
                <h1>Register</h1>

                <table className="login">
                    <tbody>
                    <tr>
                        <td><label htmlFor="">Username: </label></td>
                        <td><input type="text" className="form-control" placeholder="Username" name="username"
                                   onChange={e => setUsername(e.target.value)} required={true}
                                   minLength={5} maxLength={30}/>
                        </td>
                    </tr>
                    <tr>
                        <td><label htmlFor="">Password: </label></td>
                        <td><input type="password" className="form-control" placeholder="Password" name="password"
                                   onChange={e => setPassword(e.target.value)} required={true}
                                   minLength={3} maxLength={255}/>
                        </td>
                    </tr>
                    <tr>
                        <td><label htmlFor="">Confirm password: </label></td>
                        <td><input type="password" className="form-control" placeholder="Password"
                                   name="confirm-password"
                                   onChange={e => setConfirmPassword(e.target.value)}
                                   onKeyUp={e => checkPassword(e)} required={true}
                                   minLength={3} maxLength={255}/>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <button className="btn-register">Register</button>
                <button onClick={() => setShowRegisterModal(false)}>Close</button>
            </form>
        </div>
    );
}

export default Register;
