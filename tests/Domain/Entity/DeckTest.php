<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use OutOfBoundsException;
use OverflowException;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    private int $currentCard;
    private Set $standardSet;
    private Set $nonStandardSet;

    protected function setUp(): void
    {
        $this->currentCard = 0;
        $this->standardSet = new Set('standard', 'Standard set');
        $this->nonStandardSet = new Set('wild', 'Non standard set', false);
    }

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

    public function testMax30Cards(): void
    {
        $deck = new Deck('aff12', 'Test deck');

        for ($i = 0; $i < 15; $i++) {
            $card = $this->createStandardCard();
            $deck->add($card);
            $deck->add($card);
        }

        $this->assertCount(30, $deck->getCards());

        $this->expectException(OverflowException::class);
        $deck->add($this->createStandardCard());
    }

    public function testMax2Copies(): void
    {
        $deck = new Deck('aff12', 'Test deck');
        $card = $this->createStandardCard();

        for ($i = 0; $i < 2; $i++) {
            $deck->add($card);
        }

        $this->expectException(OverflowException::class);
        $deck->add($card);
    }

    public function testRemoveCard(): void
    {
        $deck = new Deck('aff12', 'Test deck');
        $card = $this->createStandardCard();

        $deck->add($card);
        $deck->remove($card);

        $this->assertSame(0, $deck->getCardsCount());

        $this->expectException(OutOfBoundsException::class);
        $deck->remove($card);
    }

    public function testRemoveCopies(): void
    {
        $deck = new Deck('aff12', 'Test deck');
        $card = $this->createStandardCard();

        $deck->add($card);
        $deck->add($card);
        $deck->remove($card);

        $this->assertSame(1, $deck->getCardsCount());
        $this->assertSame($card, $deck->getCards()[0]);
    }

    private function createStandardCard(): Card
    {
        $this->currentCard++;

        return new Card(
            $this->currentCard,
            'Standard card #' . $this->currentCard,
            $this->standardSet
        );
    }

    private function createNonStandardCard(): Card
    {
        $this->currentCard++;

        return new Card(
            $this->currentCard,
            'Non standard card #' . $this->currentCard,
            $this->nonStandardSet
        );
    }
}
