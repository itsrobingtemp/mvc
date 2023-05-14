<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class ActualPlayerTest extends TestCase
{
    public function testCreateActualPlayer()
    {
        $player = new ActualPlayer(5);
        $this->assertInstanceOf("\App\Card\ActualPlayer", $player);

        $res = $player->draw();
        $this->assertIsArray($res);
    }
}
