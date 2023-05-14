<?php

namespace App\Card;

/**
 * Represents a deck of cards
 */
class DeckOfCards
{
    private $cards;
    private $drawnCards;
    private $suits;
    private $values;

    /**
     * @param array $drawnCards    An array of already drawn cards
     */
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

    /**
     * Creates a new full deck of cards
     */
    public function createFullDeck(): void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $card = new CardGraphic($value, $suit);
                $this->cards[] = $card->getCardGraphic();
            }
        }
    }

    /**
     * Creates a new deck of cards excluding drawn cards
     */
    public function createDeckWithDrawnCards(): void
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

    /**
     * Returns a number of cards
     */
    public function getNumberCards($num): array
    {
        $cards = array();

        for ($i = 0; $i < $num; $i++) {
            $cards[] = $this->getRandomCard();
        }

        return $cards;
    }

    /**
     * Retuurns all cards
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Shuffles the cards
     */
    public function shuffleDeck(): void
    {
        shuffle($this->cards);
    }

    /**
     * Draws a random card
     */
    public function getRandomCard(): array
    {
        $index = rand(0, count($this->cards) - 1);
        $randomCard = $this->cards[$index];

        return $randomCard;
    }

    /**
     * Removes cards from deck
     */
    public function removeCardAndReturnDeck($cardToBeRemoved): array
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
