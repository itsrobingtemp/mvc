<?php

namespace App\Card;

class Card
{
  private $suit;
  private $value;

  public function __construct($suit, $value) {
    $this->suit = $suit;
    $this->value = $value;
  }

  public function getValue() {
    return $this->value;
  }

  public function getSuit() {
      return $this->suit;
  }
}



