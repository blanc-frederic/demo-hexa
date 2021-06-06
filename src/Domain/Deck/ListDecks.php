<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Contract\DeckFinder;
use Domain\Entity\Deck;

class ListDecks
{
    private DeckFinder $finder;

    public function __construct(DeckFinder $finder)
    {
        $this->finder = $finder;
    }

    /** @return Deck[] */
    public function list(): array
    {
        return $this->finder->findAll();
    }
}
