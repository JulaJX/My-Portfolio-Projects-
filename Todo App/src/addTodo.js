import { Component } from 'react';
class addTodo extends Component {
    state = {
        content: null,
        id: null
    }
    handleChange = (e) => {   
        this.setState({ [e.target.id] : e.target.value});
    }
    handleSubmit = (e) => {
      e.preventDefault();
      this.props.addtodos(this.state);
      this.setState({id : Math.random()});
    }
    render() {
      return (
        <div className="addTodo">
         <form onSubmit={this.handleSubmit}>
        <label htmlFor="content">Add todo</label>     
        <input type="text" placeholder="todo" id="content" onChange={this.handleChange}/>
        <button type="submit">Add</button>  
        </form>   
        </div>
      );
    }

  }
export default addTodo;