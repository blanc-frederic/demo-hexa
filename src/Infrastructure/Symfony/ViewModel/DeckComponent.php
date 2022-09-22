<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class DeckComponent
{
    public function __construct(
        public readonly int $count,
        public readonly int $number,
        public readonly string $name
    ) {
    }
}
