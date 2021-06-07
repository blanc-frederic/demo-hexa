<?php

declare(strict_types=1);

namespace Domain\Contract;

use Domain\Entity\Set;

interface SetRepository
{
    public function get(string $code): Set;
}
