<?php

namespace App\Card;

/**
 * Represents a deck of cards
 */
class DeckOfCards
{
    /** @var mixed[] */
    private $cards;

    /** @var mixed[] */
    private $drawnCards;

    /** @var string[] */
    private $suits;

    /** @var int[] */
    private $values;

    /**
     * @param mixed[] $drawnCards    An array of already drawn cards
     */
    public function __construct(array $drawnCards = [])
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
     *
     * @return void
     */
    public function createFullDeck(): void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $card = new CardGraphic($suit, $value);
                $this->cards[] = $card->getCardGraphic();
            }
        }
    }

    /**
     * Creates if drawn cards matches by value and suit
     * @param int $value
     * @param string $suit
     *
     * @return bool
     */
    public function getDrawnCardValueSuitMatch($value, $suit): bool
    {
        foreach ($this->drawnCards as $drawnCard) {
            if (is_array($drawnCard)) {
                if ($drawnCard["value"] == $value && $drawnCard["suit"] == $suit) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Creates a new deck of cards excluding drawn cards
     *
     * @return void
     */
    public function createDeckWithDrawnCards(): void
    {
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $newCard = new CardGraphic($suit, $value);

                if ($this->getDrawnCardValueSuitMatch($value, $suit)) {
                    $this->cards[] = $newCard->getCardGraphic();
                }
            }
        }
    }

    /**
     * Returns a number of cards
     *
     * @param int $num
     * @return mixed[]
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
     *
     * @return mixed[]
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
     *
     * @return mixed[]
     */
    public function getRandomCard(): array
    {
        $index = rand(0, count($this->cards) - 1);
        $randomCard = $this->cards[$index];


        return $randomCard;
    }

    /**
     * Checks if cards matches
     *
     * @return bool
     */
    public function checkCardSuitAndValueMatch($cardOne, $cardTwo): bool
    {
        if ($cardOne["suit"] === $cardTwo->getSuit() && $cardOne["value"] === $cardTwo->getValue()) {
            return true;
        }

        return false;
    }

    /**
     * Removes cards from deck
     *
     * @return mixed[]
     */
    public function removeCardAndReturnDeck(Card $cardToBeRemoved): array
    {
        foreach ($this->cards as $index => $card) {
            if ($this->checkCardSuitAndValueMatch($card, $cardToBeRemoved)) {
                unset($this->cards[$index]);
                break;
            }
        }

        return $this->cards;
    }
}
