<?php

declare(strict_types=1);

namespace Tests\Domain\Catalog;

use Domain\Catalog\ListCards;
use Domain\Contract\CardFinder;
use Domain\Entity\Card;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryCardRepository;

class ListCardsTest extends TestCase
{
    private CardFinder $finder;

    protected function setUp(): void
    {
        $standard = new Set('test', 'Standard test set');
        $nonStandard = new Set('test', 'Non standard test set', false);

        $this->finder = new MemoryCardRepository([
            new Card(1, 'First card', $standard),
            new Card(2, 'Second card', $nonStandard),
            new Card(3, 'Third card', $standard),
        ]);
    }

    public function testListAll(): void
    {
        $actor = new ListCards($this->finder);

        $list = $actor->list();

        $this->assertCount(3, $list);
    }

    public function testListStandard(): void
    {
        $actor = new ListCards($this->finder);

        $list = $actor->listStandard();
        
        $this->assertCount(2, $list);
    }
}
