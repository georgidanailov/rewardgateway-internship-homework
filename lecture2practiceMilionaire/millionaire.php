<?php

function askQuestion($question)
{
    echo $question['question'] . "\n";
    foreach ($question['options'] as $key => $value) {
        echo "$key: $value\n";
    }
    echo "Your answer: ";
    $answer = trim(fgets(STDIN));
    return strtoupper($answer) == $question['answer'];
}

function showScoreboard($scoreboard)
{
    echo "\nScoreboard:\n";
    foreach ($scoreboard as $player => $score) {
        echo "$player: $$score\n";
    }
    echo "\n";
}

function playGame(&$scoreboard)
{
    $questions = [
        [
            "question" => "What is the capital of France?",
            "options" => ["A" => "Berlin", "B" => "Madrid", "C" => "Paris", "D" => "Rome"],
            "answer" => "C",
            "prize" => 100
        ],
        [
            "question" => "What is the smallest prime number?",
            "options" => ["A" => "0", "B" => "1", "C" => "2", "D" => "3"],
            "answer" => "C",
            "prize" => 200
        ],
        [
            "question" => "What is the largest ocean on Earth?",
            "options" => ["A" => "Atlantic", "B" => "Indian", "C" => "Arctic", "D" => "Pacific"],
            "answer" => "D",
            "prize" => 300
        ],
        [
            "question" => "Which planet is known as the Red Planet?",
            "options" => ["A" => "Venus", "B" => "Mars", "C" => "Jupiter", "D" => "Saturn"],
            "answer" => "B",
            "prize" => 400
        ],
        [
            "question" => "Who is the author of 'Pride and Prejudice'?",
            "options" => ["A" => "Emily Brontë", "B" => "Jane Austen", "C" => "Charles Dickens", "D" => "Mark Twain"],
            "answer" => "B",
            "prize" => 500
        ],
        [
            "question" => "What is the chemical symbol for Gold?",
            "options" => ["A" => "Au", "B" => "Ag", "C" => "Pb", "D" => "Fe"],
            "answer" => "A",
            "prize" => 600
        ],
        [
            "question" => "What is the hardest natural substance on Earth?",
            "options" => ["A" => "Gold", "B" => "Iron", "C" => "Diamond", "D" => "Platinum"],
            "answer" => "C",
            "prize" => 700
        ],
        [
            "question" => "In which year did the Titanic sink?",
            "options" => ["A" => "1905", "B" => "1912", "C" => "1915", "D" => "1920"],
            "answer" => "B",
            "prize" => 800
        ],
        [
            "question" => "What is the smallest country in the world?",
            "options" => ["A" => "Monaco", "B" => "San Marino", "C" => "Vatican City", "D" => "Liechtenstein"],
            "answer" => "C",
            "prize" => 900
        ],
        [
            "question" => "Which element has the atomic number 1?",
            "options" => ["A" => "Helium", "B" => "Hydrogen", "C" => "Oxygen", "D" => "Carbon"],
            "answer" => "B",
            "prize" => 1000
        ],
        [
            "question" => "What is the name of the longest river in Africa?",
            "options" => ["A" => "Nile", "B" => "Amazon", "C" => "Yangtze", "D" => "Mississippi"],
            "answer" => "A",
            "prize" => 1100
        ],
        [
            "question" => "Who painted the Mona Lisa?",
            "options" => ["A" => "Vincent van Gogh", "B" => "Claude Monet", "C" => "Leonardo da Vinci", "D" => "Pablo Picasso"],
            "answer" => "C",
            "prize" => 1200
        ],
        [
            "question" => "Which planet is known as the 'Morning Star'?",
            "options" => ["A" => "Venus", "B" => "Mercury", "C" => "Mars", "D" => "Jupiter"],
            "answer" => "A",
            "prize" => 1300
        ],
        [
            "question" => "What is the primary language spoken in Brazil?",
            "options" => ["A" => "Spanish", "B" => "Portuguese", "C" => "English", "D" => "French"],
            "answer" => "B",
            "prize" => 1400
        ],
        [
            "question" => "Who is known as the 'Father of Computers'?",
            "options" => ["A" => "Alan Turing", "B" => "Charles Babbage", "C" => "Ada Lovelace", "D" => "John von Neumann"],
            "answer" => "B",
            "prize" => 1500
        ],
        [
            "question" => "Who wrote the novel '1984'?",
            "options" => ["A" => "Aldous Huxley", "B" => "George Orwell", "C" => "Ray Bradbury", "D" => "F. Scott Fitzgerald"],
            "answer" => "B",
            "prize" => 1600
        ],
    ];

    echo "Enter your name: ";
    $playerName = trim(fgets(STDIN));
    $currentPrize = 0;

    foreach ($questions as $question) {
        if (askQuestion($question)) {
            $currentPrize += $question['prize'];
            echo "Correct! You've won $$currentPrize.\n";
            showScoreboard($scoreboard);
        } else {
            echo "Incorrect answer. You lost.\n";
            break;
        }
    }

    $scoreboard[$playerName] = $currentPrize;
}

$scoreboard = [];

do {
    playGame($scoreboard);

    echo "Would another player like to play? (yes/no): ";
    $playAgain = trim(fgets(STDIN));
} while (strtolower($playAgain) === 'yes');

echo "Final scoreboard:\n";
showScoreboard($scoreboard);
echo "Thanks for playing!\n";