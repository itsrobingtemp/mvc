<?php

namespace App\Card;

/**
 * The class of an "actual" player of 21
 */
class ActualPlayer extends Player
{
    /**
     * @param int $score    The score of the player
     */
    public function __construct($score)
    {
        parent::__construct($score);
    }

    /**
     * Returns a card array
     * 
     */
    public function draw(): array 
    {
        $deck = new DeckOfCards();
        $card = $deck->getRandomCard();

        $this->setScore($card["value"]);
        return $card;
    }
}
