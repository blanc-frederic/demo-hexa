<?php

declare(strict_types=1);

namespace Tests\Domain\Deck;

use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use Domain\Deck\AddCard;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryCardRepository;
use Tests\Domain\Repository\MemoryDeckRepository;

class AddCardTest extends TestCase
{
    public function testAddCard(): void
    {
        $deckRepository = new MemoryDeckRepository([
            new Deck('1dd32', 'Test deck')
        ]);
        $cardRepository = new MemoryCardRepository([
            new Card(11, 'Sample', new Set('test', 'Test Set'))
        ]);

        $actor = new AddCard($deckRepository, $cardRepository);
        $actor->add('1dd32', 11);

        $deck = $deckRepository->get('1dd32');
        $this->assertSame('Test deck', $deck->getName());
        $this->assertCount(1, $deck->getCards());
        $this->assertSame('Sample', $deck->getCards()[0]->getName());
    }
}
