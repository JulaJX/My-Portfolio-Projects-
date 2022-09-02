import { Link } from "react-router-dom";

const NotFound = () => {
    return ( 
            <div className="container center-align">
                    <h2>Page not Found</h2>
                    <Link to="/">Click to return to Home page</Link> 
            </div>


     );
}
 
export default NotFound
