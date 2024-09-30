import React, {useEffect, useState} from "react";
import {useParams, useNavigate} from "react-router-dom";

const PokemonDetail = () => {
    const {name} = useParams();
    const [pokemon, setPokemon] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const fetchPokemonDetails = async () => {
            const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
            const data = await response.json();
            setPokemon(data);
        };

        fetchPokemonDetails();
    }, [name]);

    if (!pokemon) return <div>Loading...</div>;

    return (
        <div className="pokemon-detail">
            <button onClick={() => navigate(-1)} className="back-button">
                ⬅️ Back
            </button>
            <h1>{pokemon.name}</h1>
            <img
                src={pokemon.sprites.front_default}
                alt={pokemon.name}
                className="pokemon-image"
            />
            <table className="pokemon-stats">
                <thead>
                <tr>
                    <th>Stat</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                {pokemon.stats.map((stat) => (
                    <tr key={stat.stat.name}>
                        <td>{stat.stat.name}</td>
                        <td>{stat.base_stat}</td>
                    </tr>
                ))}
                </tbody>
            </table>
            <div className="pokemon-types">
                <h3>Types</h3>
                {pokemon.types.map((typeInfo) => (
                    <span key={typeInfo.slot} className={`pokemon-type ${typeInfo.type.name}`}>
            {typeInfo.type.name}
          </span>
                ))}
            </div>
        </div>
    );
};

export default PokemonDetail;
