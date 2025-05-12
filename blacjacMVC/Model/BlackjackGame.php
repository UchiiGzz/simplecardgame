<?php
require_once 'Deck.php';

class BlackjackGame {
    private $deck;
    private $playerHand = [];
    private $dealerHand = [];
    private $playerScore = 0;
    private $dealerScore = 0;
    private $gameOver = false;

    public function __construct() {
        $this->deck = new Deck();
        $this->deck->shuffle();
    }

    public function startNewGame() {
        $this->deck->reset();
        $this->deck->shuffle();
        $this->playerHand = [];
        $this->dealerHand = [];
        $this->playerScore = 0;
        $this->dealerScore = 0;
        $this->gameOver = false;

        $this->playerHand[] = $this->deck->drawCard();
        $this->dealerHand[] = $this->deck->drawCard();
        $this->playerHand[] = $this->deck->drawCard();
        $this->dealerHand[] = $this->deck->drawCard();

        $this->updateScores();
    }

    public function playerHit() {
        if (!$this->gameOver) {
            $card = $this->deck->drawCard();
            if ($card) {
                $this->playerHand[] = $card;
                $this->updateScores();
                if ($this->playerScore > 21) {
                    $this->gameOver = true;
                }
            }
        }
    }

    public function playerStand() {
        if (!$this->gameOver) {
            while ($this->dealerScore < 17) {
                $card = $this->deck->drawCard();
                if ($card) {
                    $this->dealerHand[] = $card;
                    $this->updateScores();
                }
            }
            $this->gameOver = true;
        }
    }

    private function calculateScore($hand) {
        $score = 0;
        $aces = 0;

        foreach ($hand as $card) {
            if ($card->getValue() === 'Ace') {
                $aces++;
                $score += 11;
            } else {
                $score += $card->getNumericValue();
            }
        }

        while ($score > 21 && $aces > 0) {
            $score -= 10;
            $aces--;
        }

        return $score;
    }

    private function updateScores() {
        $this->playerScore = $this->calculateScore($this->playerHand);
        $this->dealerScore = $this->calculateScore($this->dealerHand);
    }

    public function getWinner() {
        if ($this->playerScore > 21) {
            return 'Dealer wins (Player busts)';
        }
        if ($this->dealerScore > 21) {
            return 'Player wins (Dealer busts)';
        }
        if ($this->playerScore > $this->dealerScore) {
            return 'Player wins';
        }
        if ($this->dealerScore > $this->playerScore) {
            return 'Dealer wins';
        }
        return "It's a tie";
    }

    public function isGameOver() {
        return $this->gameOver;
    }

    public function getPlayerHand() {
        return $this->playerHand;
    }

    public function getDealerHand() {
        return $this->dealerHand;
    }

    public function getPlayerScore() {
        return $this->playerScore;
    }

    public function getDealerScore() {
        return $this->dealerScore;
    }
}
?>
