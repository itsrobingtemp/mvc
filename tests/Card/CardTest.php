<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardTest extends TestCase
{
    public function testCreateCard(): void
    {
        $card = new Card("spades", 5);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getValue();
        $this->assertNotEmpty($res);

        $res2 = $card->getSuit();
        $this->assertNotEmpty($res2);
    }
}
