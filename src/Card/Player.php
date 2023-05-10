<?php

namespace App\Card;

class Player
{
    private $score;

    public function __construct($score)
    {
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore($score): void
    {
        $this->score = $score;
    }
}
