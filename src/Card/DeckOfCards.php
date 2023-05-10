<?php

namespace App\Card;

class DeckOfCards
{
    private $cards;
    private $drawnCards;
    private $suits;
    private $values;

    public function __construct($drawnCards = [])
    {
        $this->suits = array("spades", "hearts", "clubs", "diamonds");
        $this->values = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
        $this->drawnCards = $drawnCards;
        $this->cards = array();

        // Either create full deck or exclude drawn cards
        if (empty($this->drawnCards)) {
            $this->createFullDeck();
        } else {
            $this->createDeckWithDrawnCards();
        }
    }

    public function createFullDeck() : void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $card = new CardGraphic($value, $suit);
                $this->cards[] = $card->getCardGraphic();
            }
        }
    }

    public function createDeckWithDrawnCards() : void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $newCard = new CardGraphic($value, $suit);
                $cardExists = false;

                foreach ($this->drawnCards as $drawnCard) {
                    if ($drawnCard["value"] == $value && $drawnCard["suit"] == $suit) {
                        $cardExists = true;
                        break;
                    }
                }

                if (!$cardExists) {
                    $this->cards[] = $newCard->getCardGraphic();
                }
            }
        }
    }

    public function getNumberCards($num) : array
    {
        $cards = array();

        for ($i = 0; $i < $num; $i++) {
            $cards[] = $this->getRandomCard();
        }

        return $cards;
    }

    public function getCards() : array
    {
        return $this->cards;
    }

    public function shuffleDeck() : void
    {
        shuffle($this->cards);
    }

    public function getRandomCard() : array
    {
        $index = rand(0, count($this->cards) - 1);
        $randomCard = $this->cards[$index];

        return $randomCard;
    }

    public function removeCardAndReturnDeck($cardToBeRemoved) : array
    {
        foreach ($this->cards as $index => $card) {
            if ($card->getSuit() === $cardToBeRemoved->getSuit() && $card->getValue() === $cardToBeRemoved->getValue()) {
                unset($this->cards[$index]);
                break;
            }
        }

        return $this->cards;
    }
}
