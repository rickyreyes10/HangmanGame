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
        <div class="credits-list-wrapper">
            <ul class="credits-list">
                <li>Dio Briggs</li>
                <li>Ricky Reyes</li>
                <li>Peter Kim</li>
                <li>Group 2</li>
                <li>Louis Henry</li>
            </ul>
        </div>
    </div>
</div>


    <!--privacy policy modal-->
    <input type="checkbox" id="privacy-modal" class="modal-toggle">
        <div class="modal">
            <div class="modal-content">
                <label for="privacy-modal" class="close-button">&times;</label>
                <h2>Privacy Policy</h2>
                <div class="privacy-policy-wrapper">
                <p class="privacy-policy-text">
                We value your privacy. When you use Pirate Hangman,
                we collect minimal personal data which includes your user ID,
                cumulative score, and game progress. We do not share your data with third parties.
                We are committed to protecting your privacy and ensuring a safe and enjoyable
                gaming experience.
                </p>
            </div>
        </div>
    </div>


    <!--contact info modal-->
    <input type="checkbox" id="contact-modal" class="modal-toggle">
    <div class="modal">
        <div class="modal-content">
            <label for="contact-modal" class="close-button">&times;</label>
            <h2>Contact Info</h2>
            <div class="contact-list-wrapper">
                <ul class="contact-list">
                    <li>Email: support@piratehangman.com</li>
                    <li>Email: dbriggs6@student.gsu.edu</li>
                    <li>Email: rreyespena1@student.gsu.edu</li>
                    <li>Email: pkim35@student.gsu.edu</li>
                </ul>
            </div>
        </div>
    </div>


</body>
</html>
