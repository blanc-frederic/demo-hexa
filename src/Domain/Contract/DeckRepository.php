<?php

declare(strict_types=1);

namespace Domain\Contract;

use Domain\Entity\Deck;

interface DeckRepository
{
    public function get(string $id): Deck;
    public function save(Deck $deck): void;
}
