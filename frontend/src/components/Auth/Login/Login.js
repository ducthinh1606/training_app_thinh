import React from "react";
import "./Login.scss"

function Login() {
    return (
        <div className="container">
            <form>
                <h1>Login</h1>

                <table className="login">
                    <tr>
                        <td><label htmlFor="">Username: </label></td>
                        <td><input type="text" className="form-control" placeholder="Username" name="username"/></td>
                    </tr>
                    <tr>
                        <td><label htmlFor="">Password: </label></td>
                        <td><input type="password" className="form-control" placeholder="Password" name="password"/>
                        </td>
                    </tr>
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