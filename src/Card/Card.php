<?php

namespace App\Card;

/**
 * Represents a Card for virtual card games
 */
class Card
{
    /** @var string */
    private $suit;

    /** @var int */
    private $value;

    /**
     * @param string $suit    The suit of a card
     * @param int $value    The value of a card
     */
    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * Returns the value of the card
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Returns the suit of the card
     */
    public function getSuit(): string
    {
        return $this->suit;
    }
}
