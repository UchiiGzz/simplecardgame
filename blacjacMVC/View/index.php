<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: loginview.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welkom bij Blackjack</title>
    <link rel="stylesheet" href="../View/stylesheet.css">
</head>
<body>
    <div class="container">
        <h1>Welkom bij Blackjack</h1>
        <form method="post" action="../Controller/blackjack.php">
            <button type="submit" name="start">Start nieuw spel</button>
        </form>
    </div>
</body>
</html>
