<?php

declare(strict_types=1);

namespace Tests\Domain\Deckbuilding;

use Domain\Deckbuilding\ListDeckCards;
use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryDeckRepository;

class ListDeckCardsTest extends TestCase
{
    public function testGetDeck(): void
    {
        $set = new Set('test', 'Test set');
        $card1 = new Card(1, 'First card', $set);
        $card2 = new Card(2, 'Second card', $set);

        $deck = new Deck('414d', 'Test deck');
        $deck->add($card1);
        $deck->add($card2);
        $deck->add($card1);

        $repository = new MemoryDeckRepository([$deck]);
        $lister = new ListDeckCards($repository);

        $listedDeck = $lister->getDeck('414d');

        $this->assertSame($deck, $listedDeck);
    }
}
