import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import { ThemeProvider } from './context/ThemeContext';
import { ModeProvider } from './context/ModeContext';


const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <ModeProvider>
      <ThemeProvider>
        <App />
      </ThemeProvider>
    </ModeProvider>
  </React.StrictMode>
);
