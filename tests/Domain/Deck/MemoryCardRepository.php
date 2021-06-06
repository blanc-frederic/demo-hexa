<?php

declare(strict_types=1);

namespace Tests\Domain\Deck;

use Domain\Contract\CardRepository;
use Domain\Entity\Card;
use RuntimeException;

class MemoryCardRepository implements CardRepository
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
            throw new RuntimeException('No card found for number #' . $number);
        }

        return $this->cards[$number];
    }
}
