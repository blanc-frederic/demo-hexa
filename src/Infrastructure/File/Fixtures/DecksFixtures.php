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
        private DeckRepository $deckRepository
    ) {
    }

    public function getName(): string
    {
        return 'Decks fixtures';
    }

    public function isNeeded(): bool
    {
        try {
            $this->deckRepository->get('test');
        } catch (OutOfBoundsException $exception) {
            return true;
        }
        return false;
    }

    public function load(): void
    {
        if (! $this->isNeeded()) {
            return;
        }

        $this->deckRepository->save(new Deck('test', 'Test deck'));
    }
}
