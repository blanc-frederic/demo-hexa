<?php

declare(strict_types=1);

namespace Tests\Domain\Deck;

use Domain\Deck\ListDecks;
use Domain\Entity\Deck;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryDeckRepository;

class ListDecksTest extends TestCase
{
    public function testList(): void
    {
        $finder = new MemoryDeckRepository([
            new Deck('145df', 'Test deck'),
            new Deck('14478', 'Test deck #2'),
            new Deck('afdf', 'Test deck #3'),
        ]);

        $lister = new ListDecks($finder);
        $list = $lister->list();

        $this->assertCount(3, $list);
    }
}
