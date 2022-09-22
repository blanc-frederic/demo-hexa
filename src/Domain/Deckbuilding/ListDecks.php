<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\DeckFinder;
use Domain\Entity\Deck;

class ListDecks
{
    public function __construct(
        private DeckFinder $finder
    ) {
    }

    /** @return Deck[] */
    public function list(): array
    {
        return $this->finder->findAll();
    }
}
