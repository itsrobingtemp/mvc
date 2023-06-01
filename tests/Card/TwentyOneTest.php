<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class TwentyOneTest extends TestCase
{
    public function testCreateTwentyOne(): void
    {
        $twentyone = new TwentyOne([]);
        $this->assertInstanceOf("\App\Card\TwentyOne", $twentyone);

        $res = $twentyone->getCurrentGame();
        $this->assertIsArray($res);

        $twentyone = new TwentyOne([
          "playerScore" => 1,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $res = $twentyone->getCurrentGame();
        $this->assertIsArray($res);
    }

    public function testPlayerDraw(): void
    {
        $twentyone = new TwentyOne([
          "playerScore" => 1,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->playerDraw();
        $res = $twentyone->getCurrentGame();
        $this->assertGreaterThan(1, $res["playerScore"]);
    }

    public function testComputerDraw(): void
    {
        $twentyone = new TwentyOne([
          "playerScore" => 1,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->computerDraw();
        $res = $twentyone->getCurrentGame();
        $this->assertGreaterThan(1, $res["computerScore"]);
    }

    public function testGetCurrentGame(): void
    {
        $twentyone = new TwentyOne([
          "playerScore" => 1,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $res = $twentyone->getCurrentGame();
        $this->assertIsArray($res);
    }

    public function testVerifyRound(): void
    {
        $twentyone = new TwentyOne([
          "playerScore" => 22,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->verifyPlayerRound();
        $res = $twentyone->getCurrentGame();
        $this->assertEquals($res["finishedRound"], true);
    }

    public function testVerifyComputerRound(): void
    {
        $twentyone = new TwentyOne([
          "playerScore" => 1,
          "computerScore" => 22,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->verifyComputerRound();
        $res = $twentyone->getCurrentGame();
        $this->assertEquals($res["finishedRound"], true);

        $twentyone = new TwentyOne([
          "playerScore" => 22,
          "computerScore" => 1,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->verifyComputerRound();
        $res = $twentyone->getCurrentGame();
        $this->assertEquals($res["finishedRound"], true);

        $twentyone = new TwentyOne([
          "playerScore" => 21,
          "computerScore" => 21,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->verifyComputerRound();
        $res = $twentyone->getCurrentGame();
        $this->assertEquals($res["finishedRound"], true);

        $twentyone = new TwentyOne([
          "playerScore" => 0,
          "computerScore" => 21,
          "currentCard" => array(),
          "finishedRound" => false,
          "resultString" => ""
        ]);

        $twentyone->verifyComputerRound();
        $res = $twentyone->getCurrentGame();
        $this->assertEquals($res["finishedRound"], true);
    }
}
