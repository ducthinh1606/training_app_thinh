import React, {useState} from "react";
import axios from "axios";
import "./Login.scss"
import {useNavigate} from "react-router-dom";

function Login() {
    const navigate = useNavigate()
    let [username, setUsername] = useState("")
    let [password, setPassword] = useState("")
    const login = e => {
        e.preventDefault();

        const data = {
            username: username,
            password: password
        }

        axios.post('login', data)
            .then(res => {
                localStorage.setItem('token', res.data.data.token)

                const config = {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }

                axios.get('info-user', config)
                    .then(res => {
                        localStorage.setItem('username', res.data.data.username)
                        navigate('/')
                    })
                    .catch(err => {
                        console.log(err)
                    })
            })
            .catch(err => {
                console.log(err)
            })
    }

    return (
        <div className="container">
            <form onSubmit={login}>
                <h1>Login</h1>

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
                    </tbody>
                </table>

                <button className="btn btn-primary btn-block">Login</button>

                <p className="message">
                    Not registered? <a href="#">Create an account</a> or <a href="#">Log in</a> with test account
                </p>
            </form>
        </div>
    )
}

export default Login;