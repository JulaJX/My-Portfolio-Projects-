import { BrowserRouter,Routes, Route } from 'react-router-dom';
//Pages
import Home from './pages/home/Home';
import Recipe from './pages/recipe/Recipe';
import Search from './pages/search/Search';
import Create from './pages/create/Create';
//Seperated Components
import Navbar from './components/Navbar';
import ThemeSelector from './components/ThemeSelector';
//Styles
import './App.css';
import { useMode } from './hooks/useMode'

function App() {
   const { mode } = useMode()
  return (
    <div className="App" style={{backgroundColor:mode}}>
      <BrowserRouter>
            <Navbar/>
            <ThemeSelector/>
            <Routes>
              <Route path="/" element={<Home/>}></Route>
              <Route path="/create" element={<Create/>}></Route>   
              <Route path="/search" element={<Search/>}></Route>  
              <Route path="/recipes/:id" element={<Recipe/>}></Route> 
            </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
