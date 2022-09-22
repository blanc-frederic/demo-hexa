<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class DeckComponent
{
    public function __construct(
        public int $count,
        public int $number,
        public string $name
    ) {
    }
}
