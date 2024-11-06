<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Start Game - Pirate Hangman</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <main>
            <section class="intro">
                <h1>Choose Difficulty</h1>
                <form method="POST" action="start-game.php">
                    <label>
                        <input type="radio" name="difficulty" value="easy" required> Easy
                    </label>
                    <label>
                    <input type="radio" name="difficulty" value="medium"> Medium
                </label>
                    <label>
                    <input type="radio" name="difficulty" value="hard"> Hard
                    </label>
                    <button type="submit" class="start-button">Start Game</button>
                </form>
            </section>
        
        </main>
    </body>
</html>