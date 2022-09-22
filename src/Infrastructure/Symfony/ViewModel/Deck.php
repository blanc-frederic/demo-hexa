<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Deck
{
    public function __construct(
        public string $id,
        public string $name,
        public int $cardsCount,
        public bool $isStandard
    ) {
    }
}
