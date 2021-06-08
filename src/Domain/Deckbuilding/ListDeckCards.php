<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;

class ListDeckCards
{
    private DeckRepository $repository;

    public function __construct(DeckRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDeck(string $id): Deck
    {
        return $this->repository->get($id);
    }
}
