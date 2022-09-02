import {BrowserRouter as Router,Switch,Route} from 'react-router-dom';
import './App.css';
import  React, { Component } from 'react';
import Navbar from './components/layout/Navbar';
import Dashboard from './components/dashboard/Dashboard';
import ProjectDetails from './components/project/ProjectDetails';
import NotFound from './components/layout/NotFound';
import SignIn from './components/auth/SignIn';
import SignUp from './components/auth/SignUp';
import CreateProject from './components/project/ProjectCreate';

class App extends Component  {
  render(){
  return (
    <Router>
    <div className="App">
      <Navbar/>
      <Switch>
        <Route path='/' exact component = { Dashboard } />
        <Route path='/project/:id' component = { ProjectDetails } />
        <Route path='/signin' component = { SignIn }/>
        <Route path='/signup' component = { SignUp }/>
        <Route path='/createproject' component = { CreateProject } />
        <Route path='*' component = { NotFound } />
      </Switch>
    </div>
    </Router>
  );
  }
}
export default App;
