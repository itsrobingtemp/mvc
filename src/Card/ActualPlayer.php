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
     * @return mixed[]
     */
    public function draw(): array
    {
        $val = 0;
        $deck = new DeckOfCards([]);
        $card = $deck->getRandomCard();

        if (is_int($card["value"])) {
            $val = $card["value"];
        }

        $this->setScore($val);
        return $card;
    }
}
