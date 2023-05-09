<?php
namespace App\Card;

class ActualPlayer extends Player
{
  public function __construct($score) {
    parent::__construct($score);
  }

  public function draw() {
    $deck = new DeckOfCards();
    $card = $deck->getRandomCard();

    $this->setScore($card["value"]);
    return $card;
  }
}