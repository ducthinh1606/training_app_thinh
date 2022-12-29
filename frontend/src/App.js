import "./App.scss"
import Header from "./components/Layout/Header"
import ListTask from "./components/ListTask/ListTask";
import AddTask from "./components/Task/AddTask";
import Login from "./components/Auth/Login/Login";
import {Routes, Route, useNavigate} from "react-router-dom";
import {useEffect} from "react";
import axios from "axios";

function App() {
    const navigate = useNavigate()
    useEffect(() => {
        axios.get('info-user')
            .then(res => {
                if (res.data.data) {
                    navigate('/')
                }
            })
            .catch(() => {
                navigate('/login')
            })
    }, [navigate])

    return (
        <div className="App">
            <Routes>
                <Route path="/login" element={<Login/>}/>
                <Route path="/" element={
                    [
                        <Header key={1}/>,
                        <AddTask key={2}/>,
                        <ListTask key={3}/>
                    ]
                }/>
            </Routes>
        </div>
    );
}

export default App;
