import "./App.scss"
import Header from "./components/Layout/Header"
import ListTask from "./components/ListTask/ListTask";
import AddTask from "./components/Task/AddTask";

function App() {
  return (
    <div className="App">
        <Header />
        <AddTask />
        <ListTask />
    </div>
  );
}

export default App;
