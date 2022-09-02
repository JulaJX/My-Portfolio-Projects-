import { useState, useRef, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useFetch } from '../../hooks/useFetch';
import { useTheme } from '../../hooks/useTheme';
//styles
import './Create.css'
const Create = () => {
    const [ title, setTitle ] = useState('');
    const [ method, setMethod ] = useState('');
    const [ cookingTime, setCookingTime ] = useState('');

    const [ newIngredient, setNewIngredient ] = useState('');
    const [ ingredients, setIngredients ] = useState([]);
    const ingredientInput = useRef(null);

    const { color } = useTheme()

    const navigate = useNavigate();

    const { postData, data, error } = useFetch('http://localhost:3000/recipes', 'POST')

    const handleSubmit = (e) => {
        e.preventDefault()
        console.log(title, method, cookingTime, ingredients)
        postData({title, ingredients, method, cookingTime: cookingTime + ' minutes'})
    }

    const handleClick = (e) => {
        e.preventDefault()
        const ing = newIngredient.trim()
        if(ingredients && !ingredients.includes(ing)){
            setIngredients(prevIngredients => [...prevIngredients, ing])
        }
        setNewIngredient('')
        ingredientInput.current.focus()
    }

    //redirect the user when we get data response
    useEffect(()=>{
        if(data){navigate('/')}
    },[data,navigate])


    return ( 
        <div className="create">
            <h2 className='page-title'>Add a new Recipe</h2>
            {/* FORM CREATE RECIPE */}
            <form onSubmit={handleSubmit}>

                <label>
                    <span>Recipe title:</span>
                    <input 
                    type="text" 
                    onChange={ (e) => setTitle(e.target.value)} 
                    value={title}
                    required
                    />
                </label>
                
                <label>
                    <span>Recipe method:</span>
                    <textarea
                    onChange={ (e) => setMethod(e.target.value)}
                    value={method}
                    required
                    />
                </label>

                <label>
                    <span>Cooking time (minutes):</span>
                    <input 
                    type="number"
                    onChange={ (e) => setCookingTime(e.target.value)}
                    value={cookingTime}
                    required
                    />
                </label>
                
                <label>
                    <div className="addIng">
                            <input 
                            type = "text" 
                            onChange = {(e) => setNewIngredient(e.target.value)}
                            value = {newIngredient}
                            ref = {ingredientInput}
                            placeholder="Add new ingeredient"
                            />
                            <button className='btn' onClick={handleClick} style={{backgroundColor:color}}>Add</button>
                    </div>

                     <div className="list">
                        <h3> Recipe ingredients:</h3>
                        <ul>
                            {
                            ingredients.map(ing =>(
                            <li key={ing}> {ing} </li>
                            ))
                            }
                        </ul>
                    </div>
                </label>
                <button className='button' type='submit' onClick={handleSubmit} style={{backgroundColor:color}}>Create recipe</button>
            </form>
        </div>
     );
}
 
export default Create;