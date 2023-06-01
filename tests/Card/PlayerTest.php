<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class PlayerTest extends TestCase
{
    public function testCreateActualPlayer(): void
    {
        $player = new Player(5);
        $this->assertInstanceOf("\App\Card\Player", $player);

        $res = $player->getScore();
        $this->assertEquals($res, 5);

        $player->setScore(10);
        $res = $player->getScore();
        $this->assertEquals($res, 10);
    }
}
