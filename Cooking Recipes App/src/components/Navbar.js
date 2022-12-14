
import { Link } from 'react-router-dom';
import './Navbar.css';
import Searchbar from './Searchbar';
import { useTheme } from '../hooks/useTheme';


const Navbar = () => {
    const {color, changeColor} = useTheme()
    return ( 
        <div  className="navbar" style={{ background: color}}>
            <nav>
            <Link to="/" className='brand'>
                <h1>Julek's Kitchen</h1>
            </Link>
            <Searchbar></Searchbar>
            <Link to="/create">Create Recipe</Link>
            </nav>
        </div>
     );
}
 
export default Navbar;