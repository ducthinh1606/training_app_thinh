import "./App.scss"
import Header from "./components/Layout/Header"
import ListTask from "./components/ListTask/ListTask";
import AddTask from "./components/Task/AddTask";
import Login from "./components/Auth/Login/Login";

function App() {
  return (
    <div className="App">
        <Login />
        {/*<Header />*/}
        {/*<AddTask />*/}
        {/*<ListTask />*/}
    </div>
  );
}

export default App;
