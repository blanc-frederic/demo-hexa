<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Deck
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $cardsCount,
        public readonly bool $isStandard
    ) {
    }
}
