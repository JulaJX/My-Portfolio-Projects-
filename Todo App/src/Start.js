import { Link } from 'react-router-dom';
const Start = () => {
    return ( 
        <div className="start">
        <Link to="/todolist"><button className="btn">Start</button></Link>
        </div>
   
    );
}
 
export default Start;  