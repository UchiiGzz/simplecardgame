<?php
require_once 'Card.php';

class PlayingCard extends Card {
    public function __construct($suit, $value) {
        parent::__construct($suit, $value);
    }

    public function __toString() {
        return $this->value . ' of ' . $this->suit;
    }

    public function getNumericValue() {
        if ($this->value == 'Ace') {
            return 11;
        }
        if (in_array($this->value, ['Jack', 'Queen', 'King'])) {
            return 10;
        }
        return (int)$this->value;
    }
}
?>
