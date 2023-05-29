<?php

namespace App\Card;

/**
 * Represents a player of 21
 */
class Player
{
    /** @var int */
    private $score;

    /**
     * @param int $score    The current player score
     */
    public function __construct($score)
    {
        $this->score = $score;
    }

    /**
     * Returns the score
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Sets the score
     * 
     * @param int $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }
}
