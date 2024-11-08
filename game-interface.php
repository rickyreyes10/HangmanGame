<?php
session_start();
error_reporting(0);



//get number of incorrect guesses from session (will be set up in game logic)
$incorrect_guesses = isset($_SESSION['incorrect_guesses']) ? $_SESSION['incorrect_guesses'] : 0;



//handle letter submission
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['letter'])){
    $guessed_letter = strtoupper($_POST['letter']);
    $current_word = strtoupper($_SESSION['words'][$_SESSION['round'] - 1]['word']);

    //add leter to guessed letters array
    if (!in_array($guessed_letter, $_SESSION['guessed_letters'])){
        $_SESSION['guessed_letters'][] = $guessed_letter;

        //check if letter is in word
        if (strpos($current_word, $guessed_letter) === false) {
            //letter not in word
            $_SESSION['incorrect_guesses']++;

            //check if round is lost (6 incorrect guesses)
            if ($_SESSION['incorrect_guesses'] >= 6){
                $_SESSION['round_losses']++;
                //start new round or end game if all rounds complete
                if ($_SESSION['round'] >= 6) {
                    showEndGameModal();
                } else {
                    startNewRound();
                }

            }
        } else {
            // check if word is complete
            $word_completed = true;
            foreach (str_split($current_word) as $letter) {
                if (!in_array($letter, $_SESSION['guessed_letters'])){
                    $word_completed = false;
                    break;
                }
            }

            if ($word_completed) {
                $_SESSION['round_wins']++;
                //start new round or end game if all rounds complete
                if ($_SESSION['round'] >= 6) {
                    showEndGameModal();
                } else {
                    startNewRound();
                }
            }
        }

    }

    //redirect to prevent form resubmission
    header("Location: game-interface.php");
    exit();
}

//function to start new round
function startNewRound() {
    $_SESSION['round']++;
    $_SESSION['incorrect_guesses'] = 0;
    $_SESSION['guessed_letters'] = array();
}

//function to show end game modal
function showEndGameModal() {
    //calculate final score 
    if ($_SESSION['round_wins'] <= 2) {
        $_SESSION['score'] = 0; //lose (0-2 rounds won only)
        $result_message = "Better luck next time!";
    } else if ($_SESSION['round_wins'] === 3) {
        $_SESSION['score'] = 1; //draw (3 rounds wons)
        $result_message = "You got a draw!";
    } else {
        $_SESSION['score'] = 3; //win (4-6 rounds won)
        $result_message = "Congratulations! You won this game!";
    }

    //update cumulative score
    $new_cumulative_score = isset($_COOKIE['cumulative_score']) ? 
        (int)$_COOKIE['cumulative_score'] + $_SESSION['score'] : 
        $_SESSION['score'];
    setcookie('cumulative_score', $new_cumulative_score, time() + (86400 * 30)); //30 days


    //set session variables for modal
    $_SESSION['show_end_modal'] = true;
    $_SESSION['end_game_data'] = [
        'message' => $result_message,
        'score' => $_SESSION['score'],
        'cumulative_score' => $new_cumulative_score,
        'round_won' => $_SESSION['round_wins']
    ];

    //clear game session variables except for cumulative score to ensure a new game session starts with a clean slate of variables
    $_SESSION['words'] = [];
    $_SESSION['difficulty'] = '';
    $_SESSION['round'] = 0;
    $_SESSION['round_wins'] = 0;
    $_SESSION['round_losses'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['incorrect_guesses'] = 0;
    $_SESSION['guessed_letters'] = [];
    
}


//define which image to show based on incorrect guesses
$hangman_image = 'pole.png'; //default image
if ($incorrect_guesses === 1) {
    $hangman_image = 'head.png';
} elseif ($incorrect_guesses === 2) {
    $hangman_image = 'torso.png';
} elseif ($incorrect_guesses === 3) {
    $hangman_image = 'arm.png';
} elseif ($incorrect_guesses === 4) {
    $hangman_image = 'arms.png';
} elseif ($incorrect_guesses === 5) {
    $hangman_image = 'leg.png';
} elseif ($incorrect_guesses === 6) {
    $hangman_image = 'full.png';
}



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Interface - Pirate Hangman</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header>
            <h1>Round <?php echo $_SESSION['round']; ?></h1>
            <nav>
                <div>Difficulty: <?php echo ucfirst($_SESSION['difficulty']); ?></div>
            </nav>
        </header>
        <main>
            <div class="game-container">
                <div class="hangman-container"> 
                    <img src="images/<?php echo htmlspecialchars($hangman_image); ?>" alt="Hangman" class="hangman-image">
                </div>
<!--other game elements will go here-->
                <div class="game-content"> 
                    <?php 
                    error_reporting(0);
                    //get current word data (based on round)
                    $current_round = $_SESSION['round'] - 1; //array is 0-based
                    $current_word_data = $_SESSION['words'][$current_round];

                    //initialize guessed letters array if not exists
                    if (!isset($_SESSION['guessed_letters'])){
                        $_SESSION['guessed_letters'] = array();
                    }
                    ?>

                    <!--add word display container-->
                    <div class="word-display"> 
                        <?php
                        $word = strtoupper($current_word_data['word']); //convert to uppercase to match keyboard
                        $letters = str_split($word); //split word into array of letters

                        foreach ($letters as $letter) {
                            $display_class = in_array($letter, $_SESSION['guessed_letters']) ? 'revealed' : 'hidden';
                            echo "<span class='letter $display_class'>";
                            echo in_array($letter, $_SESSION['guessed_letters']) ? $letter : '_';
                            echo "</span>";
                        }
                        ?>
                    </div>

                    <!--display hint-->
                    <div class="hint-container">
                        <p class="hint-text">Hint: <?php echo htmlspecialchars($current_word_data['hint']);?></p>
                    </div>

                    <!--display keyboard--> 
                    <div class="keyboard">
                        <?php 
                        error_reporting(0);
                        $letters = range('A', 'Z');
                        foreach ($letters as $letter) {
                            $is_guessed = in_array($letter, $_SESSION['guessed_letters']);
        echo "<form method='POST' action='game-interface.php' style='display: inline;'>";
        echo "<button type='submit' name='letter' value='$letter' 
              class='key-button" . ($is_guessed ? " guessed" : "") . "' 
              " . ($is_guessed ? "disabled" : "") . ">";
        echo $letter;
        echo "</button>";
        echo "</form>";
                        }
                        ?>

                    </div>
                </div>
                    
            </div>

        </main>

        <?php
        error_reporting(0);
         if (isset($_SESSION['show_end_modal']) && $_SESSION['show_end_modal']): ?>
    <input type="checkbox" id="modal-toggle" class="modal-toggle" checked>
    <div class="modal">
        <div class="modal-content">
            <h2><?php echo $_SESSION['end_game_data']['message']; ?></h2>
            <div class="game-stats">
                <p>Rounds Won: <?php echo $_SESSION['end_game_data']['round_won']; ?>/6</p>
                <p>Game Score: <?php echo $_SESSION['end_game_data']['score']; ?> points</p>
                <p>Total Score: <?php echo $_SESSION['end_game_data']['cumulative_score']; ?> points</p>
            </div>
            <img src="images/wink.webp" alt="pirate-wink" class="pirate-gif">
            <div class="modal-buttons"> 
                <a href="start-game.php" class="start-button">Play Again</a>
                <a href="home.php" class="home-button">Home</a>
            </div>
            
        </div>
    </div>
<?php endif; ?>

        
    </body>

</html>