<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;

class ListDeckCards
{
    public function __construct(
        private DeckRepository $repository
    ) {
    }

    public function getDeck(string $id): Deck
    {
        return $this->repository->get($id);
    }
}
