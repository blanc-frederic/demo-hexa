<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use Domain\Entity\Card;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testCreate(): void
    {
        $set = new Set('test', 'Test set');
        $card = new Card(1, 'First card', $set);

        $this->assertTrue($card->isStandard());
        $this->assertSame('Test set', $card->getSetName());
    }
}
