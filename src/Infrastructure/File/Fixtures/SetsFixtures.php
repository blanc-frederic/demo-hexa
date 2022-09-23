<?php

declare(strict_types=1);

namespace Infrastructure\File\Fixtures;

use Domain\Contract\SetRepository;
use Domain\Entity\Set;
use Infrastructure\Contract\FixturesLoaderInterface;
use OutOfBoundsException;

class SetsFixtures implements FixturesLoaderInterface
{
    public function __construct(
        private readonly SetRepository $repository
    ) {
    }

    public function getName(): string
    {
        return 'Sets fixtures';
    }

    public function isNeeded(): bool
    {
        try {
            $this->repository->get('CORE');
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

        array_map(
            fn(Set $set) => $this->repository->save($set),
            $this->getSets()
        );
    }

    /** @return Set[] */
    public function getSets(): array
    {
        return [
            new Set('CORE', 'Core set', true),
            new Set('EXPERT1', 'Classic set', true),
            new Set('NAXX', 'Curse of Naxxramas', false),
            new Set('GVG', 'Goblins vs Gnomes', false),
            new Set('BRM', 'Blacrock Mountain', false),
            new Set('TGT', 'The Grand Tournament', false),
            new Set('LOE', 'League of Explorers', false),
            new Set('OG', 'Whispers of the Old Gods', false),
            new Set('KARA', 'One Night in Karazhan', false),
            new Set('GANGS', 'Mean Streets of Gadgetzan', false),
        ];
    }
}
