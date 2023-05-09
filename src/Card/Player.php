<?php
namespace App\Card;

class Player 
{
  private $score;

  public function __construct($score) {
    $this->score = $score;
  }
  
  public function getScore() {
    return $this->score;
  }

  public function setScore($score) {
    $this->score = $score;
  }
}