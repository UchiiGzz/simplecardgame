<?php
// start.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game - Start</title>
    <link rel="stylesheet" href="../view/styles.css">
</head>
<body>
    <div class="start-container">
        <h1>Welcome to the Card Game</h1>
        <form method="post" action="">
            <button type="submit" name="start_game">Start Game</button>
            <button type="submit" name="boss_fight">Boss Fight</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['start_game'])) {
            header('Location: Game.php');
            exit;
        }

        if (isset($_POST['boss_fight'])) {
            header('Location: bossfightview.php');  // Updated to bossfightview.php
            exit;
        }
    }
    ?>
</body>
</html>