<?php

declare(strict_types=1);

namespace Tests\Domain\Deck;

use Domain\Contract\IdentifierGenerator;
use Domain\Deck\NewDeck;
use PHPUnit\Framework\TestCase;

class NewDeckTest extends TestCase
{
    public function testCreate(): void
    {
        $generator = $this->createMock(IdentifierGenerator::class);
        $generator->method('generate')->willReturn('223addf77c');

        $creator = new NewDeck($generator);

        $deck = $creator->create('test');
        
        $this->assertSame('223addf77c', $deck->getId());
        $this->assertSame('test', $deck->getName());
        $this->assertCount(0, $deck->getCards());
    }
}
