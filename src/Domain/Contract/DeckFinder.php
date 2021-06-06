<?php

declare(strict_types=1);

namespace Domain\Contract;

use Domain\Entity\Deck;

interface DeckFinder
{
    /** @return Deck[] */
    public function findAll(): array;
}
