<?php

declare(strict_types=1);

namespace Infrastructure\Contract;

interface FixturesGeneratorInterface
{
    /** @return string[] */
    public function getMissingFixtures(): array;
    public function generate(): void;
}
