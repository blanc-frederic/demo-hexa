<?php

declare(strict_types=1);

namespace Tests\Domain\Deckbuilding;

use Domain\Contract\CardRepository;
use Domain\Contract\DeckRepository;
use Domain\Entity\Card;
use Domain\Entity\Deck;
use Domain\Entity\Set;
use Domain\Deckbuilding\ChooseCards;
use OverflowException;
use PHPUnit\Framework\TestCase;
use Tests\Domain\Repository\MemoryCardRepository;
use Tests\Domain\Repository\MemoryDeckRepository;

class ChooseCardsTest extends TestCase
{
    private DeckRepository $deckRepository;
    private CardRepository $cardRepository;

    protected function setUp(): void
    {
        $this->deckRepository = new MemoryDeckRepository([
            new Deck('1dd32', 'Test deck')
        ]);

        $set = new Set('test', 'Test Set');
        $this->cardRepository = new MemoryCardRepository(
            array_map(
                fn ($number) => new Card($number, 'Card #' . $number, $set),
                range(1, 30)
            )
        );
    }

    public function testAddCard(): void
    {
        $builder = new ChooseCards($this->deckRepository, $this->cardRepository);
        $builder->add('1dd32', 11);

        $deck = $this->deckRepository->get('1dd32');
        $this->assertSame('Test deck', $deck->getName());
        $this->assertSame(1, $deck->getCardsCount());
        $this->assertSame('Card #11', $deck->getCards()[0]->getName());
    }

    public function testRemoveCard(): void
    {
        $builder = new ChooseCards($this->deckRepository, $this->cardRepository);
        $builder->add('1dd32', 11);
        $builder->remove('1dd32', 11);

        $deck = $this->deckRepository->get('1dd32');
        $this->assertSame('Test deck', $deck->getName());
        $this->assertSame(0, $deck->getCardsCount());
    }

    public function testMaxCardsReached(): void
    {
        $builder = new ChooseCards($this->deckRepository, $this->cardRepository);
        for ($number = 1; $number <= ChooseCards::MAX_CARDS_PER_DECK; $number++) {
            $builder->add('1dd32', $number);
        }

        $this->expectException(OverflowException::class);
        $builder->add('1dd32', 3);
    }


}
