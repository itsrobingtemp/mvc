<?php

namespace App\Card;

class DeckOfCards
{
  private $cards;
  private $drawnCards;

  public function __construct($drawnCards = []) {
    $this->cards = array();
    $this->drawnCards = $drawnCards;
    $this->createDeck();
  }

  public function createDeck() {
    $this->cards = array();
    $suits = array("spades", "hearts", "clubs", "diamonds");
    $values = array("Ace", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King");

    // No cards drawn
    if (empty($this->drawnCards)) {
      foreach ($suits as $suit) {
          foreach ($values as $value) {
              $card = new CardGraphic($value, $suit);
              $this->cards[] = $card->getGraphic();
          }
      }
    } else {
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $newCard = new CardGraphic($value, $suit);
                $cardExists = false;

                // If card exists
                foreach ($this->drawnCards as $drawnCard) {
                    if ($drawnCard[4] == $value && $drawnCard[3] == $suit) {
                        $cardExists = true;
                        break;
                    }
                }
    
                if (!$cardExists) {
                    $this->cards[] = $newCard->getGraphic();
                }
            }
        }
    }
  }

  public function getNumberCards($num) {
    $cards = array();

    for ($i = 0; $i < $num; $i++) {
      $cards[] = $this->getRandomCard();
    }

    return $cards;
  }

  public function getCards() {
    return $this->cards;
  }

  public function shuffleDeck() {
    $this->createDeck();
    shuffle($this->cards);
  }

  public function getRandomCard() {
    $i = rand(0, count($this->cards) - 1);
    $randomCard = $this->cards[$i];

    return $randomCard;
  }

  public function removeCardAndReturnDeck($cardToBeRemoved) {
    foreach ($this->cards as $index => $card) {
      if ($card->getSuit() === $cardToBeRemoved->getSuit() && $card->getValue() === $cardToBeRemoved->getValue()) {
        unset($cards[$index]);
        break;
      }
    }

    return $this->cards;
  }
}