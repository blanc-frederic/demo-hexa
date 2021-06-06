<?php

declare(strict_types=1);

namespace Tests\Domain\Deck;

use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use RuntimeException;

class MemoryDeckRepository implements DeckRepository
{
    /** @var Deck[] */
    private array $decks;

    /** @param Deck[] $decks */
    public function __construct(array $decks = [])
    {
        foreach ($decks as $deck) {
            $this->decks[$deck->getId()] = $deck;
        }
    }

    public function get(string $id): Deck
    {
        if (! isset($this->decks[$id])) {
            throw new RuntimeException('No deck found for this id : ' . $id);
        }

        return $this->decks[$id];
    }

    public function save(Deck $deck): void
    {
        $this->decks[$deck->getId()] = $deck;
    }
}
