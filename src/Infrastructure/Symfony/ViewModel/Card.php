<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Card
{
    public function __construct(
        public readonly int $number,
        public readonly string $name,
        public readonly string $set
    ) {
    }
}
