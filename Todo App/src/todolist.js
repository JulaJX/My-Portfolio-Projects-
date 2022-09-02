const todolist = ({todos, deleted }) => {
    
    if(todos.length){return ( 
        <div className="todolist">
        {
          todos.map(todo => {
        return(
                <div className="todos" key={todo.id}>
                    <li><p className="todo-p">{todo.content}</p><button className="btn2" onClick={()=>{deleted(todo.id)}}>Delete</button></li>
                </div>
              )
          })
        }
      </div>
     );
    }
     // this.setState({
    //   todos:newtodos
    // })
    else{
      return(
        <div className="todosinfo">
          <p>Ain't got todos fella</p>
        </div>

      );
    }
}
 
export default todolist;