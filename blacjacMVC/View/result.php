<?php
if (!isset($game)) {
    die("Game not initialized");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack - Result</title>
    <link rel="stylesheet" href="../View/stylesheet.css">
</head>
<body>
    <div class="result-container">
        <h2>Game Over!</h2>
        <p><?php echo htmlspecialchars($game->getWinner()); ?></p>
        
        <div class="final-hands">
            <div class="player-final">
                <h3>Player's Final Hand (Score: <?php echo $game->getPlayerScore(); ?>)</h3>
                <div class="card-area">
                    <?php foreach ($game->getPlayerHand() as $card): ?>
                        <?php
                            $suit = strtolower($card->getSuit());
                            $value = $card->getValue();
                            $displayValue = $value;
                            if ($value === '1') $displayValue = 'A';
                            if ($value === '11') $displayValue = 'J';
                            if ($value === '12') $displayValue = 'Q';
                            if ($value === '13') $displayValue = 'K';
                        ?>
                        <div class="card <?php echo $suit; ?> dealt">
                            <span class="card-value top"><?php echo $displayValue; ?></span>
                            <span class="card-suit"></span>
                            <span class="card-value bottom"><?php echo $displayValue; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="dealer-final">
                <h3>Dealer's Final Hand (Score: <?php echo $game->getDealerScore(); ?>)</h3>
                <div class="card-area">
                    <?php foreach ($game->getDealerHand() as $card): ?>
                        <?php
                            $suit = strtolower($card->getSuit());
                            $value = $card->getValue();
                            $displayValue = $value;
                            if ($value === '1') $displayValue = 'A';
                            if ($value === '11') $displayValue = 'J';
                            if ($value === '12') $displayValue = 'Q';
                            if ($value === '13') $displayValue = 'K';
                        ?>
                        <div class="card <?php echo $suit; ?> dealt">
                            <span class="card-value top"><?php echo $displayValue; ?></span>
                            <span class="card-suit"></span>
                            <span class="card-value bottom"><?php echo $displayValue; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <a href="blackjack.php?action=start" class="new-game-btn">Play Again</a>
    </div>
</body>
</html>
