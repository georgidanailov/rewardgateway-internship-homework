###Who Wants to Be a Millionaire CLI Game - Documentation
##Overview
#This PHP CLI (Command Line Interface) application is a simplified version of the popular game show "Who Wants to Be a
Millionaire." Players answer a series of questions to win money, and the game supports multiple players, displaying a
scoreboard after each correct answer and at the end of the session.

The script prompts the player for their name.
A series of 15 random questions are asked.
The player answers by typing the letter corresponding to their choice.
Answering Questions:

If the player answers correctly, they win the prize associated with that question.
If the player answers incorrectly, they lose, and the game moves on to the next player.
Scoreboard:

After each correct answer, the current scoreboard is displayed, showing the accumulated winnings of all players.
The final scoreboard is displayed at the end of the session.
Switching Players:

After one player finishes, the script asks if another player would like to play.
If yes is entered, the game restarts for the new player.
If no is entered, the game ends and displays the final scoreboard.

#Example Command to Run in the Terminal

php millionaire.php

Example Session

Enter your name: Alice
What is the capital of France?
A: Berlin
B: Madrid
C: Paris
D: Rome
Your answer: C
Correct! You've won $100.
Scoreboard:
Alice: $100

Would another player like to play? (yes/no): yes

Enter your name: Bob
What is the smallest prime number?
A: 0
B: 1
C: 2
D: 3
Your answer: A
Incorrect answer. You lost.
Would another player like to play? (yes/no): no

#Dependencies
PHP 7.4 or later







