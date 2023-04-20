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

  public function getCardString() {
    return $this->value . " of " . $this->suit;
  }

  public function getRank() {
    return $this->value;
  }

  public function getSuit() {
      return $this->suit;
  }
}