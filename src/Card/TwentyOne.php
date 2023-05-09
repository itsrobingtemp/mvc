<?php

namespace App\Card;

class TwentyOne
{
  private $game;

  public function __construct($currentGame)
  {
    if (empty($currentGame)) {
      $this->game = array(
        "playerScore" => 0,
        "computerScore" => 0,
        "currentCard" => array(),
        "finishedRound" => false,
        "resultString" => ""
      );
    } else {
      $this->game = $currentGame;
    }
  }

  public function playerDraw() {
    $player = new ActualPlayer($this->game["playerScore"]);
    $card = $player->draw();

    $this->game["playerScore"] += $player->getScore();
    $this->game["currentCard"] = $card;
    $this->verifyPlayerRound();
  }

  public function computerDraw() {
    $computer = new ComputerPlayer($this->game["computerScore"]);
    $computer->draw();

    $this->game["computerScore"] += $computer->getScore();
    $this->verifyComputerRound();
  }

  public function getCurrentGame() {
    return $this->game;
  }

  public function verifyPlayerRound() {
    if ($this->game["playerScore"] > 21) {
      $this->game["finishedRound"] = true;
      $this->game["resultString"] = "Du förlorade och gick över 21 med poängen " . $this->game["playerScore"];
    }
  }

  public function verifyComputerRound() {
    if ($this->game["computerScore"] > 21) {
      $this->game["finishedRound"] = true;
      $this->game["resultString"] = "Du vann med poängen " . $this->game["playerScore"] . " eftersom datorn gick över 21.";
    } else if ($this->game["playerScore"] > $this->game["computerScore"]) {
      $this->game["finishedRound"] = true;
      $this->game["resultString"] = "Du vann med poängen " . $this->game["playerScore"] . " mot datorns " . $this->game["computerScore"];
    } else if ($this->game["playerScore"] = $this->game["computerScore"]) {
      $this->game["finishedRound"] = true;
      $this->game["resultString"] = "Det blev oavgjort. Du fick " . $this->game["playerScore"] . " och datorn fick " . $this->game["computerScore"];
    }
    else {
      $this->game["finishedRound"] = true;
      $this->game["resultString"] = "Datorn vann med poängen " . $this->game["computerScore"] . " mot dina " . $this->game["playerScore"];
    }
  }
}