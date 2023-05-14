<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class ComputerPlayerTest extends TestCase
{
    public function testCreateActualPlayer()
    {
        $player = new ComputerPlayer(5);
        $this->assertInstanceOf("\App\Card\ComputerPlayer", $player);

        $player->draw();
        $res = $player->getScore();
        $this->assertIsInt($res);
    }
}
