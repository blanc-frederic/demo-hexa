<?php

declare(strict_types=1);

namespace Tests\Domain\Repository;

use Domain\Contract\CardFinder;
use Domain\Contract\CardRepository;
use Domain\Entity\Card;
use OutOfBoundsException;

class MemoryCardRepository implements CardRepository, CardFinder
{
    /** @var Card[] */
    private array $cards;

    /** @param Card[] $cards */
    public function __construct(array $cards = [])
    {
        foreach ($cards as $card) {
            $this->cards[$card->getNumber()] = $card;
        }
    }

    public function get(int $number): Card
    {
        if (! isset($this->cards[$number])) {
            throw new OutOfBoundsException('No card found for number #' . $number);
        }

        return $this->cards[$number];
    }

    public function save(Card $card): void
    {
        $this->cards[$card->getNumber()] = $card;
    }

    /** @return Card[] */
    public function findAll(): array
    {
        return $this->cards;
    }

    /** @return Card[] */
    public function findStandard(): array
    {
        return array_filter($this->cards, fn ($card) => $card->isStandard());
    }
}
