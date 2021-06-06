<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Contract\DeckRepository;
use Domain\Contract\IdentifierGenerator;
use Domain\Entity\Deck;

class NewDeck
{
    private IdentifierGenerator $generator;
    private DeckRepository $repository;

    public function __construct(
        IdentifierGenerator $generator,
        DeckRepository $repository
    ) {
        $this->generator = $generator;
        $this->repository = $repository;
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
