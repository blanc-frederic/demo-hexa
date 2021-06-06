<?php

declare(strict_types=1);

namespace Tests\Domain\Repository;

use Domain\Contract\DeckFinder;
use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use RuntimeException;

class MemoryDeckRepository implements DeckRepository, DeckFinder
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

    /** @return Deck[] */
    public function findAll(): array
    {
        return $this->decks;
    }
}
