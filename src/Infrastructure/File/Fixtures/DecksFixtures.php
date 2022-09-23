<?php

declare(strict_types=1);

namespace Infrastructure\File\Fixtures;

use Domain\Contract\DeckRepository;
use Domain\Entity\Deck;
use Infrastructure\Contract\FixturesLoaderInterface;
use OutOfBoundsException;

class DecksFixtures implements FixturesLoaderInterface
{
    public function __construct(
        private readonly DeckRepository $repository
    ) {
    }

    public function getName(): string
    {
        return 'Decks fixtures';
    }

    public function isNeeded(): bool
    {
        try {
            $this->repository->get('test');
            return false;
        } catch (OutOfBoundsException) {
            return true;
        }
    }

    public function load(): void
    {
        if (! $this->isNeeded()) {
            return;
        }

        $this->repository->save(new Deck('test', 'Test deck'));
    }
}
