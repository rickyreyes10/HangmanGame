<?php
session_start();

//check if the form was submitted
if($_SERVER["REQUEST_METHOD"] === "POST"){
    //defining word pools for each difficulty with associated hints
    $words = [
        'easy' => [
            'cat' => 'A small domesticated carnivorous mammal',
            'dog' => 'A loyal companion known as man\'s best friend',
            'sun' => 'The star at the center of our solar system',
            'hat' => 'An accessory worn on the head',
            'bat' => 'A flying mammal or a piece of sports equipment',
            'pan' => 'A flat metal container used for cooking',
            'cup' => 'A small container for drinking',
            'mop' => 'A tool for cleaning floors',
            'log' => 'A section of a tree trunk or large branch',
            'jar' => 'A cylindrical container typically made of glass or pottery'
        ],
        'medium' => [
            'apple' => 'A popular fruit that can be red, green, or yellow',
            'horse' => 'A large domesticated mammal known for its strength and speed',
            'train' => 'A form of rail transport consisting of a series of connected vehicles',
            'beach' => 'A sandy or pebbly shore by the ocean or sea',
            'river' => 'A large, natural stream of water flowing to the sea',
            'plane' => 'A vehicle with wings and an engine that flies in the sky',
            'cloud' => 'A visible mass of condensed water vapor floating in the atmosphere',
            'flame' => 'The visible part of a fire',
            'stone' => 'A hard, solid, nonmetallic mineral matter',
            'tower' => 'A tall structure that rises high above the ground'
        ],
        'hard' => [
            'elephant' => 'A large mammal with a trunk, found in Africa and Asia',
            'galaxy' => 'A vast system of stars, gas, and dust, bound together by gravity',
            'mountain' => 'A large natural elevation of the earth’s surface',
            'dinosaur' => 'A large extinct reptile from the Mesozoic era',
            'psychology' => 'The study of the human mind and behavior',
            'volcano' => 'A mountain or hill with a crater, where lava erupts',
            'syndrome' => 'A group of symptoms that consistently occur together',
            'abduction' => 'The action of forcibly taking someone away',
            'mystery' => 'Something that is difficult or impossible to understand or explain',
            'equation' => 'A statement showing the equality of two mathematical expressions'
        ]
    ];

    //retrieve the selected difficulty
    //if difficulty is not valid, kill the script and print message with die function.
    $difficulty = $_POST['difficulty'];
    if (!in_array($difficulty, ['easy', 'medium', 'hard'])){
        die("Invalid difficulty selection.");
    }

    //pick 6 random words with hints from the chosen difficulty level
    $selectedWords = array_rand(array_flip(array_keys($words[$difficulty])), 6);
    $gameWords = [];
    foreach ($selectedWords as $word) {
        $gameWords[] = ['word' => $word, 'hint' => $words[$difficulty][$word]];
    }

    //initialize game session variables
    $_SESSION['words'] = $gameWords; //words and hints for the game
    $_SESSION['difficulty'] = $difficulty;
    $_SESSION['round'] = 1; //start with round 1
    $_SESSION['round_wins'] = 0; 
    $_SESSION['round_losses'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['incorrect_guesses'] = 0;

    //reset modal-related session variables ensures modal doesn't show on a new game session
    unset($_SESSION['show_end_modal']);
    unset($_SESSION['end_game_data']);

    //set a unique user #D cookie if it doesn't already exist
    if (!isset($_COOKIE['user_id'])) {
        $user_id = uniqid('user_', true);
        setcookie('user_id', $user_id, time() + (86400 * 30)); //expires in 30 days
    } else{
        $user_id = $_COOKIE['user_id'];
    }

    //initialize or retrieve cumulative score from a cookie
    $cumulative_score = isset($_COOKIE['cumulative_score']) ? (int)$_COOKIE['cumulative_score'] : 0;
    setcookie('cumulative_score', $cumulative_score, time() + (86400 * 30)); //ensures the score persists for 30 days

    //redirect to the game interface
    header("Location: game-interface.php");
    exit();

}

?>

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
            <a href="home.php" class="home-button" style="margin-top: 40px;">Home</a>
        </section>
        
    </main>
</body>
</html>