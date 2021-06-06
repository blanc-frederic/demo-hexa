<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Contract\DeckRepository;
use Domain\Entity\Card;

class ListDeckCards
{
    private DeckRepository $repository;

    public function __construct(DeckRepository $repository)
    {
        $this->repository = $repository;
    }

    /** @return Card[] */
    public function listCards(string $deckId): array
    {
        $deck = $this->repository->get($deckId);

        return $deck->getCards();
    }
}
