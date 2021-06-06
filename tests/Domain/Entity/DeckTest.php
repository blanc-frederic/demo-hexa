<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    private array $sets;
    private array $cards;

    protected function setUp(): void
    {
        $this->sets = [
            'base'      => new Set('base', 'Base set', true),
            'obsolete'  => new Set('one', 'First set', false),
            'last'      => new Set('two', 'Last set', true),
        ];

        $this->cards = [
            new Card(1, 'first', $this->sets['base']),
            new Card(2, 'second', $this->sets['base']),
            new Card(3, 'thrid', $this->sets['base']),
            new Card(4, 'first', $this->sets['base']),
            new Card(5, 'first', $this->sets['obsolete']),
            new Card(6, 'first', $this->sets['obsolete']),
            new Card(7, 'first', $this->sets['last']),
            new Card(8, 'first', $this->sets['last']),
            new Card(9, 'first', $this->sets['last']),
            new Card(10, 'first', $this->sets['last']),
        ];
    }

    public function testCreation(): void
    {
        $deck = new Deck('fferdsdhgsds', 'My first deck');
        $deck->add($this->cards[0]);

        $this->assertCount(1, $deck->getCards());
    }
}
