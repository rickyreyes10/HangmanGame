<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Play - Pirate Hangman</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .tutorial-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: block;
        }

        .tutorial-step {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: #333;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .tutorial-step img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 5px;
        }

        .tutorial-step img[src*="difficulty-select"],
        .tutorial-step img[src*="end-game"] {
            max-width: 70%;
            display: block;
            margin: 20px auto;
        }

        .tutorial-step h2,
        .tutorial-step p,
        .tutorial-step ul,
        .tutorial-step .demo-keyboard {
            grid-column: 1;
        }

        .demo-keyboard {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin: 10px 0;
            justify-content: center;
        }

        .demo-key {
            padding: 10px 15px;
            border: 2px solid #8b4513;
            border-radius: 5px;
            background: #d2691e;
            color: white;
            font-weight: bold;
        }

        .demo-key.correct {
            background: #4CAF50;
        }

        .demo-key.incorrect {
            background: #f44336;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background: #8b4513;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .tutorial-step ul {
            list-style-type: none;
            padding-left: 0;
        }

        .tutorial-step ul.game-interface-list {
            list-style-type: disc;
            padding-left: 20px;
            text-align: left;
            width: fit-content;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>How to Play Pirate Hangman</h1>
    </header>

    <main class="tutorial-section">
        <div class="tutorial-step">
            <h2>Step 1: Choose Your Difficulty</h2>
            <p>Start by selecting your preferred difficulty level:</p>
            <ul>
                <li><strong>Easy:</strong> Simple words with helpful hints</li>
                <li><strong>Medium:</strong> More challenging words with moderate hints</li>
                <li><strong>Hard:</strong> Complex words with minimal hints</li>
            </ul>
            <img src="images/tutorial/difficulty-select.png" alt="Difficulty Selection" />
        </div>

        <div class="tutorial-step">
            <h2>Step 2: Game Interface</h2>
            <p>The game consists of:</p>
            <ul class="game-interface-list">
                <li>A hangman image that updates with each incorrect guess</li>
                <li>The mystery word shown as underscores (_)</li>
                <li>A helpful hint about the word</li>
                <li>An interactive keyboard to guess letters</li>
            </ul>
            <img src="images/tutorial/game-interface.png" alt="Game Interface" />
        </div>

        <div class="tutorial-step">
            <h2>Step 3: Making Guesses</h2>
            <p>Click letters on the keyboard to make your guess:</p>
            <ul>
                <li><strong>Correct guess:</strong> The letter appears in the word</li>
                <li><strong>Incorrect guess:</strong> The hangman image progresses; used letters become disabled</li>
            </ul>
            <img src="images/tutorial/make-guess.png" alt="Make Guess" />
        </div>

        <div class="tutorial-step">
            <h2>Step 4: Winning and Losing</h2>
            <p>The game consists of 6 rounds:</p>
            <ul>
                <li>Complete the word before the hangman is fully drawn (6 incorrect guesses)</li>
                <li>Win rounds to increase your score</li>
                <li>Your cumulative score is saved for future games</li>
                <li>Scoring:
                    <ul>
                        <li>0-2 rounds won: 0 points</li>
                        <li>3 rounds won: 1 point</li>
                        <li>4-6 rounds won: 3 points</li>
                    </ul>
                </li>
            </ul>
            <img src="images/tutorial/end-game.png" alt="End Game Screen" />
        </div>

        <a href="home.php" class="back-button">Back to Home</a>
    </main>
</body>
</html> 