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

        <div class="dealer-section <?php echo $game->isGameOver() ? 'game-over' : ''; ?>">
    <h2>Dealer's Hand</h2>
    <div class="card-area">
        <?php 
        $dealerHand = $game->getDealerHand();
        foreach ($dealerHand as $index => $card): 
            $suit = strtolower($card->getSuit());
            $value = $card->getValue();
            $displayValue = $value;
            if ($value === '1') $displayValue = 'A';
            if ($value === '11') $displayValue = 'J';
            if ($value === '12') $displayValue = 'Q';
            if ($value === '13') $displayValue = 'K';
            
            if ($game->isGameOver()): ?>
                <!-- Toon alle kaarten wanneer spel afgelopen is -->
                <div class="card <?php echo $suit; ?>">
                    <span class="card-value top"><?php echo $displayValue; ?></span>
                    <span class="card-suit">
                        <?php 
                        if ($suit === 'hearts') echo '♥';
                        elseif ($suit === 'diamonds') echo '♦';
                        elseif ($suit === 'clubs') echo '♣';
                        elseif ($suit === 'spades') echo '♠';
                        ?>
                    </span>
                    <span class="card-value bottom"><?php echo $displayValue; ?></span>
                </div>
            <?php else: ?>
                <!-- Tijdens het spel: eerste kaart open, andere dicht -->
                <?php if ($index === 0): ?>
                    <div class="card <?php echo $suit; ?>">
                        <span class="card-value top"><?php echo $displayValue; ?></span>
                        <span class="card-suit">
                            <?php 
                            if ($suit === 'hearts') echo '♥';
                            elseif ($suit === 'diamonds') echo '♦';
                            elseif ($suit === 'clubs') echo '♣';
                            elseif ($suit === 'spades') echo '♠';
                            ?>
                        </span>
                        <span class="card-value bottom"><?php echo $displayValue; ?></span>
                    </div>
                <?php else: ?>
                    <div class="card back"></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <p>Score: <?php echo $game->isGameOver() ? $game->getDealerScore() : $game->getDealerHand()[0]->getNumericValue(); ?></p>
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