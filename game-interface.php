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