<?php

declare(strict_types=1);

namespace Tests\Domain\Deckbuilding;

use Domain\Contract\IdentifierGenerator;
use Domain\Deckbuilding\CreateDeck;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryDeckRepository;

class CreateDeckTest extends TestCase
{
    public function testCreate(): void
    {
        $generator = $this->createMock(IdentifierGenerator::class);
        $generator->method('generate')->willReturn('223addf77c');
        $repository = new MemoryDeckRepository();

        $creator = new CreateDeck($generator, $repository);

        $creator->create('Test deck');

        $deck = $repository->get('223addf77c');
        $this->assertSame('Test deck', $deck->getName());
        $this->assertSame(0, $deck->getCardsCount());
    }
}
