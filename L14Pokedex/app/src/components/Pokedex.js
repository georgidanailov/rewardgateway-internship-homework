import React, {useEffect, useState} from "react";
import {Link, useSearchParams} from "react-router-dom";

const Pokedex = () => {
    const [pokemons, setPokemons] = useState([]);
    const [totalPages, setTotalPages] = useState(1);
    const [searchParams, setSearchParams] = useSearchParams();

    const currentPage = parseInt(searchParams.get("page") || 1);

    const fetchPokemons = async (page) => {
        const limit = 12;
        const offset = (page - 1) * limit;
        const response = await fetch(
            `https://pokeapi.co/api/v2/pokemon?limit=${limit}&offset=${offset}`
        );
        const data = await response.json();

        const pokemonDetails = await Promise.all(
            data.results.map(async (pokemon) => {
                const pokemonResponse = await fetch(pokemon.url);
                return await pokemonResponse.json();
            })
        );

        setPokemons(pokemonDetails);
        setTotalPages(Math.ceil(data.count / limit));
    };

    useEffect(() => {
        fetchPokemons(currentPage);
    }, [currentPage]);

    const handlePageChange = (newPage) => {
        setSearchParams({page: newPage});
    };

    return (
        <div className="pokedex">
            <h1>Pokedex</h1>
            <div className="pokemon-grid">
                {pokemons.map((pokemon) => (
                    <div key={pokemon.id} className="pokemon-card">
                        <Link to={`/pokemon/${pokemon.name}`}>
                            <img src={pokemon.sprites.front_default} alt={pokemon.name}/>
                            <h3>{pokemon.name}</h3>
                            <span>#{String(pokemon.id).padStart(4, "0")}</span>
                            <div className="pokemon-types">
                                {pokemon.types.map((typeInfo) => (
                                    <span
                                        key={typeInfo.slot}
                                        className={`pokemon-type ${typeInfo.type.name}`}
                                    >
                    {typeInfo.type.name}
                  </span>
                                ))}
                            </div>
                        </Link>
                    </div>
                ))}
            </div>
            <div className="pagination">
                <button
                    onClick={() => handlePageChange(Math.max(currentPage - 1, 1))}
                    disabled={currentPage === 1}
                >
                    Previous
                </button>
                <span>Page {currentPage} of {totalPages}</span>
                <button
                    onClick={() => handlePageChange(Math.min(currentPage + 1, totalPages))}
                    disabled={currentPage === totalPages}
                >
                    Next
                </button>
            </div>
        </div>
    );
};

export default Pokedex;
