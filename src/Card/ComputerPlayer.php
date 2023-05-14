<?php

namespace App\Card;

/**
 * Represents the computer player in 21
 */
class ComputerPlayer extends Player
{
    /**
     * @param int $score    The computer score
     */
    public function __construct($score)
    {
        parent::__construct($score);
    }

    /**
     * Draws a card and sets the score
     */
    public function draw(): void
    {
        $deck = new DeckOfCards();
        $loopScore = 0;

        while ($loopScore < 17) {
            $card = $deck->getRandomCard();
            $loopScore += $card["value"];
        }

        $this->setScore($loopScore);
    }
}
