<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    public function testStandardByDefault(): void
    {
        $deck = new Deck('aff12', 'Test deck');

        $this->assertTrue($deck->isStandard());
    }

    public function testStandard(): void
    {
        $deck = new Deck('aff12', 'Test deck');

        $deck->add($this->createStandardCard());
        $deck->add($this->createStandardCard());

        $this->assertTrue($deck->isStandard());
    }

    public function testNonStandard(): void
    {
        $deck = new Deck('aff12', 'Test deck');

        $deck->add($this->createStandardCard());
        $deck->add($this->createNonStandardCard());
        $deck->add($this->createStandardCard());

        $this->assertFalse($deck->isStandard());
    }

    private function createStandardCard(): Card
    {
        $set = new Set('standard', 'Standard set');
        return new Card(1, 'Standard card', $set);
    }

    private function createNonStandardCard(): Card
    {
        $set = new Set('wild', 'Non standard set', false);
        return new Card(2, 'Non standard card', $set);
    }
}
