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

   <!--leaderboard modal-->
<input type="checkbox" id="leaderboard-modal" class="modal-toggle">
<div class="modal">
    <div class="modal-content">
        <label for="leaderboard-modal" class="close-button">&times;</label>
        <h2>Leaderboard</h2>

        <?php
        // Check if user ID and cumulative score cookies are set
        if (isset($_COOKIE['user_id']) && isset($_COOKIE['cumulative_score'])) {
            $user_id = $_COOKIE['user_id'];
            $cumulative_score = (int)$_COOKIE['cumulative_score'];

            // Simulate leaderboard data with current user's cookie data
            $leaderboard = [
                ["rank" => 1, "id" => $user_id, "score" => $cumulative_score],
            ];

            // Display leaderboard in a table format
            echo "<table id='leaderboard-table'>";
            echo "<tr><th>Rank</th><th>Name</th><th>Score</th></tr>";

            foreach ($leaderboard as $entry) {
                echo "<tr>";
                echo "<td>" . $entry['rank'] . "</td>";
                echo "<td>" . htmlspecialchars($entry['id']) . "</td>";
                echo "<td>" . htmlspecialchars($entry['score']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No leaderboard data available. Start a game to record your score!</p>";
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
