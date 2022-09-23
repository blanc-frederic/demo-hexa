<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Contract\DeckRepository;
use Domain\Contract\IdentifierGenerator;
use Domain\Entity\Deck;

class CreateDeck
{
    public function __construct(
        private readonly IdentifierGenerator $generator,
        private readonly DeckRepository $repository
    ) {
    }

    public function create(string $name): void
    {
        $deck = new Deck(
            $this->generator->generate(),
            $name
        );

        $this->repository->save($deck);
    }
}
