<?php

declare(strict_types=1);

namespace Domain\Catalog;

use Domain\Contract\CardFinder;
use Domain\Entity\Card;

class ListCards
{
    private CardFinder $finder;

    public function __construct(CardFinder $finder)
    {
        $this->finder = $finder;
    }

    /** @return Card[] */
    public function list(): array
    {
        return $this->finder->findAll();
    }

    /** @return Card[] */
    public function listStandard(): array
    {
        return $this->finder->findStandard();
    }
}
