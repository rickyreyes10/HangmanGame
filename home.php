<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirate Hangman</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!--header section-->
    <header>
        <h1>Pirate Hangman</h1>
        <nav>
            <label for="leaderboard-modal" class="modal-button">Leaderboard</label>
            <a href="how-to-play.php">How to Play</a>
        </nav>
    </header>

    <!--main content section-->
    <main>
        <section class="intro">
            <p>Welcome to Pirate Hangman!</p>
            <img src="images/swing.webp" alt="pirate-swing" class="pirate-gif">
            <a href="start-game.php" class="start-button">Play Game</a>
        </section>
    </main>

    <!--footer section-->
    <footer>
        <label for="credits-modal" class="modal-button">Credits</label>
        <label for="contact-modal" class="modal-button">Contact Information</label>
        <label for="privacy-modal" class="modal-button">Privacy</label>
    </footer>

    <!--modal structure-->

    <!--leaderboard modal-->
    <input type="checkbox" id="leaderboard-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <label for="leaderboard-modal" class="close-button">&times;</label>
            <h2>Leaderboard</h2>
            <?php
            // Check if the cumulative_score cookie is set
            if (isset($_COOKIE['cumulative_score'])) {
                echo "<p>Your Cumulative Score: " . htmlspecialchars($_COOKIE['cumulative_score']) . " points</p>";
            } else {
                echo "<p>No scores available yet. Play the game to earn points!</p>";
            }
            ?>
        </div>
    </div>

    <!--credits modal-->
    <input type="checkbox" id="credits-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <label for="credits-modal" class="close-button">&times;</label>
            <h2>Credits</h2>
            <p>Developed by Team....</p>
        </div>
    </div>

    <!--privacy policy modal-->
    <input type="checkbox" id="privacy-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <label for="privacy-modal" class="close-button">&times;</label>
            <h2>Privacy Policy</h2>
            <p>Your privacy is important to us. No personal data is collected....</p>
        </div>
    </div>

    <!--contact info modal-->
    <input type="checkbox" id="contact-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <label for="contact-modal" class="close-button">&times;</label>
            <h2>Contact Info</h2>
            <p>Email: support@piratehangman.com</p>
        </div>
    </div>

</body>
</html>
