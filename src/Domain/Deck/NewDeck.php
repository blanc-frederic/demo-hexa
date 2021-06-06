<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Contract\IdentifierGenerator;
use Domain\Entity\Deck;

class NewDeck
{
    private IdentifierGenerator $generator;

    public function __construct(IdentifierGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function create(string $name): Deck
    {
        return new Deck(
            $this->generator->generate(),
            $name
        );
    }
}
