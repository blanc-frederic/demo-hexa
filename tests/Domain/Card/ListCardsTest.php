<?php

declare(strict_types=1);

namespace Tests\Domain\Card;

use Domain\Card\ListCards;
use Domain\Contract\CardFinder;
use Domain\Entity\Card;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;

class ListCardsTest extends TestCase
{
    public function testListAll(): void
    {
        $set = new Set('test', 'Test set');
        $finder = $this->createMock(CardFinder::class);
        $finder->method('findAll')->willReturn([
            new Card(1, 'First card', $set),
            new Card(2, 'Second card', $set),
        ]);

        $actor = new ListCards($finder);
        $list = $actor->list();

        $this->assertCount(2, $list);
    }
}
