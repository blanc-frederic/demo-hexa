<?php

declare(strict_types=1);

namespace Domain\Contract;

use Domain\Entity\Card;

interface CardFinder
{
    /** @return Card[] */
    public function findAll(): array;
}
