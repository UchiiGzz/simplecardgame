<?php
require_once 'PlayingCard.php';

class Deck {
    private $cards = [];

    public function __construct() {
        $this->reset();
    }

    public function reset() {
        $this->cards = [];
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new PlayingCard($suit, $value);
            }
        }
    }

    public function shuffle() {
        shuffle($this->cards);
    }

    public function drawCard() {
        if (count($this->cards) > 0) {
            return array_pop($this->cards);
        }
        return null;
    }

    public function getRemainingCards() {
        return count($this->cards);
    }
}
?>
