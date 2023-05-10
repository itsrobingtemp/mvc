<?php

namespace App\Card;

class ComputerPlayer extends Player
{
    public function __construct($score)
    {
        parent::__construct($score);
    }

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
