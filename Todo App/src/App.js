import './App.css';
import {BrowserRouter as Router,Switch,Route} from 'react-router-dom';
import { Component } from 'react';
import Start from './Start';
import AddTodo from './addTodo';
import Todolist from './todolist';


class App extends Component {
  state = {
    todos: [
      
    ]
  }
  add = (todo) => {
    let todos = [...this.state.todos,todo];
    this.setState({
      todos: todos
    })
  }
  delete = (id) =>{
    console.log(id);
    let newtodos = this.state.todos.filter(todo =>{
      return todo.id !== id
    });
    this.setState({
      todos:newtodos
    })
  }
  render() {
    return (
      <Router>
      <h1>Todo App</h1>
      <div className="App">
          <Switch> 
            <Route path="/" exact component = { Start }/>
            <Route path="/todolist"><AddTodo addtodos={this.add}/><Todolist todos={this.state.todos} deleted={this.delete}/></Route>
            <Todolist/>
          </Switch>
      </div>
      </Router>
    );
  }
}

export default App;
