<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\ViewModel;

class Card
{
    public function __construct(
        public int $number,
        public string $name,
        public string $set
    ) {
    }
}
