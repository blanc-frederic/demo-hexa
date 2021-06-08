<?php

declare(strict_types=1);

namespace Tests\Domain\Deckbuilding;

use Domain\Deckbuilding\DeckComponent;
use Domain\Entity\Card;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;
use UnderflowException;

class DeckComponentTest extends TestCase
{
    public function testLessThan1Card(): void
    {
        $component = DeckComponent::createFor(
            new Card(1, 'Sample', new Set('test', 'Test set'))
        );

        $this->expectException(UnderflowException::class);
        $component->removeCopy();
    }
}
