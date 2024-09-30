import React from "react";
import {BrowserRouter as Router, Route, Routes} from "react-router-dom";
import Pokedex from "./components/Pokedex";
import PokemonDetail from "./components/PokemonDetail";
import './App.css';

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Pokedex/>}/>
                <Route path="/pokemon/:name" element={<PokemonDetail/>}/>
            </Routes>
        </Router>
    );
}

export default App;
