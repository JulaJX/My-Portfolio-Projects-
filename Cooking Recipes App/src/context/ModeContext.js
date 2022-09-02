import { createContext, useState } from "react";

export const ModeContext = createContext()

export function ModeProvider({ children }) {

        const [mode , setMode] = useState('#dfdfdf')

        const changeMode = () => {
            if(mode == '#dfdfdf'){setMode('rgb(20, 20, 20)')}
            else{setMode('#dfdfdf')}
        }

       return (
        <ModeContext.Provider value={{mode, changeMode}}>
          { children }
        </ModeContext.Provider>
      )

}


