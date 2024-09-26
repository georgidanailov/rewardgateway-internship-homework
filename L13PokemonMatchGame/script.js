document.addEventListener("DOMContentLoaded", () => {
    const grid = document.getElementById('grid');
    const scoreElement = document.getElementById('score');
    const timerElement = document.getElementById('timer');
    const restartButton = document.getElementById('restart-button');
    const gridSizeSelect = document.getElementById('grid-size');

    let score = 0;
    let timer = 60;
    let intervalId;
    let firstCard = null;
    let secondCard = null;
    let lockBoard = false;
    let matchedPairs = 0;
    let numPairs = 8;
    let gameStarted = false;

    const gameStartSound = new Audio('sounds/game-start.mp3');
    const winningSound = new Audio('sounds/winning-sound.mp3');

    gameStartSound.loop = true;

    gridSizeSelect.addEventListener('change', () => {
        updateGridSize();
        startGame();
    });

    function updateGridSize() {
        const gridSize = gridSizeSelect.value;
        let cols, rows;

        switch (gridSize) {
            case '2x3':
                cols = 3;
                rows = 2;
                numPairs = 3;
                timer = 10;
                break;
            case '4x4':
                cols = 4;
                rows = 4;
                numPairs = 8;
                timer = 60;
                break;
            case '6x6':
                cols = 6;
                rows = 6;
                numPairs = 18;
                timer = 180;
                break;
            default:
                cols = 4;
                rows = 4;
                numPairs = 8;
                timer = 60;
        }

        grid.style.gridTemplateColumns = `repeat(${cols}, 100px)`;
        grid.style.gridTemplateRows = `repeat(${rows}, 100px)`;
        timerElement.textContent = timer;
    }

    function startGame() {
        resetGame();
        fetchPokemons(numPairs).then(pokemonPairs => {
            shuffleArray(pokemonPairs);
            buildGrid(pokemonPairs);
        });
    }

    function resetGame() {
        clearInterval(intervalId);
        gameStartSound.pause();
        gameStartSound.currentTime = 0;
        winningSound.pause();
        winningSound.currentTime = 0;
        score = 0;
        matchedPairs = 0;
        firstCard = null;
        secondCard = null;
        lockBoard = false;
        gameStarted = false;
        scoreElement.textContent = score;
        timerElement.textContent = timer;
    }

    async function fetchPokemons(numPairs) {
        const pokemons = [];
        while (pokemons.length < numPairs) {
            const id = Math.floor(Math.random() * 150) + 1;
            const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
            const data = await response.json();
            const imgUrl = data.sprites.other.dream_world.front_default;
            if (imgUrl && !pokemons.some(p => p.img === imgUrl)) {
                pokemons.push({id, img: imgUrl});
            }
        }
        return [...pokemons, ...pokemons];
    }

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function buildGrid(pokemonPairs) {
        grid.innerHTML = '';
        pokemonPairs.forEach(pokemon => {
            const card = document.createElement('div');
            card.classList.add('card');
            card.dataset.id = pokemon.id;

            const frontFace = document.createElement('img');
            frontFace.src = pokemon.img;
            frontFace.classList.add('front-face');

            card.appendChild(frontFace);
            grid.appendChild(card);

            card.addEventListener('click', handleCardClick);
        });
    }

    function handleCardClick(event) {
        if (lockBoard) return;
        const clickedCard = event.target.closest('.card');

        if (!gameStarted) {
            gameStartSound.play();
            startTimer();
            gameStarted = true;
        }

        if (clickedCard === firstCard) return;

        clickedCard.classList.add('flipped');

        if (!firstCard) {
            firstCard = clickedCard;
            return;
        }

        secondCard = clickedCard;
        checkForMatch();
    }

    function checkForMatch() {
        const isMatch = firstCard.dataset.id === secondCard.dataset.id;
        if (isMatch) {
            disableCards();
            matchedPairs++;
            score += 10;
            scoreElement.textContent = score;
            if (matchedPairs === numPairs) {
                clearInterval(intervalId);
                gameStartSound.pause();
                gameStartSound.currentTime = 0;
                winningSound.play();
                alert('You won! Congratulations!');
            }
        } else {
            unflipCards();
            score -= 2;
            scoreElement.textContent = score;
        }
    }

    function disableCards() {
        firstCard.removeEventListener('click', handleCardClick);
        secondCard.removeEventListener('click', handleCardClick);
        resetBoard();
    }

    function unflipCards() {
        lockBoard = true;
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            resetBoard();
        }, 1000);
    }

    function resetBoard() {
        [firstCard, secondCard, lockBoard] = [null, null, false];
    }

    function startTimer() {
        intervalId = setInterval(() => {
            timer--;
            timerElement.textContent = timer;
            if (timer === 0) {
                clearInterval(intervalId);
                gameStartSound.pause();
                gameStartSound.currentTime = 0;
                gameOver();
            }
        }, 1000);
    }

    function gameOver() {
        alert('Game Over! Time ran out.');
        lockBoard = true;
    }

    restartButton.addEventListener('click', () => {
        startGame();
    });

    updateGridSize();
    startGame();
});
