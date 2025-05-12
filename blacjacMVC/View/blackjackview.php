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
    <title>Blackjack</title>
    <link rel="stylesheet" href="../View/stylesheet.css">
</head>
<body>
    <div class="game-container">
        <h1>Blackjack</h1>

        <div class="player-section">
            <h2>Player's Hand</h2>
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

            <p>Score: <?php echo $game->getPlayerScore(); ?></p>
        </div>

        <div class="dealer-section">
            <h2>Dealer's Hand</h2>
            <div class="card-area">
    <?php 
    $dealerHand = $game->getDealerHand();
    foreach ($dealerHand as $index => $card): 
        if ($index === 1 && !$game->isGameOver()): ?>
            <div class="card back dealt"></div>
        <?php else:
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
        <?php endif;
    endforeach; ?>
</div>

            <p>Score: <?php echo $game->getDealerScore(); ?></p>
        </div>

        <div class="button-row">
            <?php if (!$game->isGameOver()): ?>
                <form method="post" action="blackjack.php">
                    <button type="submit" name="hit">Hit</button>
                    <button type="submit" name="stand">Stand</button>
                </form>
            <?php else: ?>
                <form method="get" action="blackjack.php">
                    <button type="submit" name="action" value="start">New Game</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
