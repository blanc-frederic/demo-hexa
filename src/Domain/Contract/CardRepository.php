<?php

declare(strict_types=1);

namespace Domain\Contract;

use Domain\Entity\Card;

interface CardRepository
{
    public function get(int $number): Card;
}
