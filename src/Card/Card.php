<?php

namespace App\Card;

class Card
{
    private $suit;
    private $value;

    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getValue() : int
    {
        return $this->value;
    }

    public function getSuit() : string
    {
        return $this->suit;
    }
}
