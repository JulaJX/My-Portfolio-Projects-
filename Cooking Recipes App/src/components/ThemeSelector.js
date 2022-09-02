import { useState } from 'react'
import '../components/ThemeSelector.css'
import { useMode } from '../hooks/useMode'
import { useTheme } from '../hooks/useTheme'

const themeColors = ['#de870e','#249c6b','#b70233']

const ThemeSelector = () => {
    const { color ,changeColor } = useTheme()
    const { changeMode } = useMode()
    
    const [button, setButton] = useState(true);

    const changeButtonColor = () =>{
        if(button){setButton(false)}else{setButton(true)}
        changeMode()
    } 

    return ( 
        <div className='theme-selector'>
            <div className='theme-buttons'>
               { themeColors.map(color =>(
                <div 
                key={color}
                onClick={()=> changeColor(color)}
                style={{backgroundColor:color}}
                />
               ))}
            </div>
            <div 
                className='mode-button' 
                style=
                {{
                backgroundColor: button ? 'white' : 'black'
                ,color: button ? 'black' : 'white'
                }}
                onClick={()=>changeButtonColor()}>
                Mode
            </div>
        </div>
     );
}
 
export default ThemeSelector;