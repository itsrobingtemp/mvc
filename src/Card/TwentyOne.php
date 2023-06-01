<?php

namespace App\Card;

/**
 * Represents the game of 21
 */
class TwentyOne
{
    /** @var mixed[] */
    private $game;

    /**
     * @param mixed[] $currentGame    An array of current game data
     */
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

    /**
     * Draws a card for the player
     */
    public function playerDraw(): void
    {
        $player = null;
        $playerScore = $this->game["playerScore"];

        if (is_int($playerScore)) {
            $player = new ActualPlayer($playerScore);

            $card = $player->draw();
            $this->game["playerScore"] += $player->getScore();
            $this->game["currentCard"] = $card;
            $this->verifyPlayerRound();
        }
    }

    /**
     * Draws a full round for the computer
     */
    public function computerDraw(): void
    {
        $computer = null;
        $computerScore = $this->game["computerScore"];

        if (is_int($computerScore)) {
            $computer = new ComputerPlayer($computerScore);

            $computer->draw();
            $this->game["computerScore"] += $computer->getScore();
            $this->verifyComputerRound();
        }
    }

    /**
     * Returns the current game as an array
     *
     * @return mixed[]
     */
    public function getCurrentGame(): array
    {
        return $this->game;
    }

    /**
     * Checks if player goes over 21
     */
    public function verifyPlayerRound(): void
    {
        if ($this->game["playerScore"] > 21) {
            $this->game["finishedRound"] = true;
            $this->game["resultString"] = "Du förlorade och gick över 21 med poängen " . $this->game["playerScore"];
        }
    }

    /**
     * Checks who the winner is
     */
    public function verifyComputerRound(): void
    {
        $finished = false;
        $resultString = "";

        if ($this->game["computerScore"] > 21) {
            $finished = true;
            $resultString = "Du vann med poängen " . $this->game["playerScore"] . " eftersom datorn gick över 21.";
        } elseif ($this->game["playerScore"] > $this->game["computerScore"]) {
            $finished = true;
            $resultString = "Du vann med poängen " . $this->game["playerScore"] . " mot datorns " . $this->game["computerScore"];
        } elseif ($this->game["playerScore"] == $this->game["computerScore"]) {
            $finished = true;
            $resultString = "Det blev oavgjort. Du fick " . $this->game["playerScore"] . " och datorn fick " . $this->game["computerScore"];
        } else {
            $finished = true;
            $resultString = "Datorn vann med poängen " . $this->game["computerScore"] . " mot dina " . $this->game["playerScore"];
        }

        $this->game["finishedRound"] = $finished;
        $this->game["resultString"] = $resultString;
    }
}
