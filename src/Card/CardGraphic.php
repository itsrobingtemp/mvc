<?php

namespace App\Card;

class CardGraphic extends Card
{
  private $graphicArr;

  public function __construct($suit, $value) {
    parent::__construct($suit, $value);
    $this->graphicArr = $this->setGraphic($suit, $value);
  }

  public function setGraphic($value, $suit) {
    $suitString = "";
    $valueString = "";
    $color = "";

    switch ($suit) {
      case "hearts":
        $suitString = "♥";
        break;
      case "diamonds":
        $suitString = "♦";
        break;
      case "clubs":
        $suitString = "♣";
        break;
      case "spades":
        $suitString = "♠";
        break;
    }

    switch ($value) {
      case 1:
        $valueString = "A";
        break;
      case 11:
        $valueString = "J";
        break;
      case 12:
        $valueString = "Q";
        break;
      case 13:
        $valueString = "K";
        break;
      default:
        $valueString = (string)$value;
        break;
    }

    switch($suit) {
      case "hearts":
        $color = "red";
        break;
      case "diamonds":
        $color = "red";
        break;
      case "clubs":
        $color = "black";
        break;
      case "spades":
        $color = "black";
        break;
    }

    return array($valueString, $suitString, $color, $suit, $value);
  }

  public function getGraphic() {
    return $this->graphicArr; 
  }
}