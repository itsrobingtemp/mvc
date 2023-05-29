<?php

namespace App\Card;

/**
 * Represents a graphic card for
 * virtual card games
 */
class CardGraphic extends Card
{
    /** @var mixed[] */
    private $cardGraphic;

    /**
     * @param string $suit    The suit of a card
     * @param int $value    The value of a card
     */
    public function __construct($suit, $value)
    {
        parent::__construct($suit, $value);
        $this->cardGraphic = $this->setCardGraphic($suit, $value);
    }

    /**
     * Makes a graphic representation of the card
     * 
     * @param int $value    The value of a card
     * @param string $suit    The suit of a card
     * 
     * @return mixed[]
     */
    public function setCardGraphic($suit, $value): array
    {
        $suitString = "";
        $valueString = "";
        $colorString = "";

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
                // Ints as string
                $valueString = (string)$value;
                break;
        }

        switch($suit) {
            case "hearts":
                $colorString = "red";
                break;
            case "diamonds":
                $colorString = "red";
                break;
            case "clubs":
                $colorString = "black";
                break;
            case "spades":
                $colorString = "black";
                break;
        }

        return array(
          "suitString" => $suitString,
          "valueString" => $valueString,
          "colorString" => $colorString,
          "suit" => $suit,
          "value" => $value
        );
    }

    /**
     * Returns the graphic card array
     * 
     * @return mixed[]
     */
    public function getCardGraphic(): array
    {
        return $this->cardGraphic;
    }
}
