<?php

declare(strict_types=1);

namespace Infrastructure\File\Fixtures;

use function Safe\file_put_contents;
use function Safe\json_encode;
use function Safe\mkdir;

class FileFixtures
{
    private string $path;

    public function __construct(string $path) {
        $this->path = $path;
    }

    /** @return string[] */
    public function getMissingFiles(): array
    {
        $missing = [];

        if (! $this->isSetsFileExists()) {
            $missing[] = 'Sets';
        }
        if (! $this->isCardsFileExists()) {
            $missing[] = 'Cards';
        }

        return $missing;
    }

    public function generate(): void
    {
        if (! is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }

        $this->generateSets();
        $this->generateCards();
    }

    private function isSetsFileExists(): bool
    {
        return is_file($this->path . '/sets.json');
    }

    private function isCardsFileExists(): bool
    {
        return is_file($this->path . '/cards.json');
    }

    private function generateSets(): void
    {
        if ($this->isSetsFileExists()) {
            return;
        }

        file_put_contents($this->path . '/sets.json', json_encode([
            ['code' => 'base', 'name' => 'Base set', 'standard' => true],
            ['code' => 'first', 'name' => 'First extension', 'standard' => false],
            ['code' => 'second', 'name' => 'Second extension', 'standard' => true],
            ['code' => 'third', 'name' => 'Third extension', 'standard' => true],
        ]));
    }

    private function generateCards(): void
    {
        if ($this->isCardsFileExists()) {
            return;
        }

        file_put_contents($this->path . '/cards.json', json_encode([
            ['number' => 1, 'name' => 'First', 'set' => 'base'],
            ['number' => 2, 'name' => 'Second', 'set' => 'base'],
            ['number' => 3, 'name' => 'Third', 'set' => 'base'],
            ['number' => 4, 'name' => 'Fourth', 'set' => 'base'],
            ['number' => 5, 'name' => 'Fifth', 'set' => 'base'],
            ['number' => 6, 'name' => 'Six', 'set' => 'base'],
            ['number' => 7, 'name' => 'Seven', 'set' => 'base'],
            ['number' => 8, 'name' => 'Height', 'set' => 'base'],

            ['number' => 9, 'name' => 'Second set #1', 'set' => 'first'],
            ['number' => 10, 'name' => 'Second set #2', 'set' => 'first'],
            ['number' => 11, 'name' => 'Second set #3', 'set' => 'first'],
            ['number' => 12, 'name' => 'Second set #4', 'set' => 'first'],

            ['number' => 13, 'name' => 'Card #13', 'set' => 'second'],
            ['number' => 14, 'name' => 'Card #14', 'set' => 'second'],
            ['number' => 15, 'name' => 'Card #15', 'set' => 'second'],
            ['number' => 16, 'name' => 'Card #16', 'set' => 'second'],

            ['number' => 17, 'name' => 'Card #17', 'set' => 'third'],
            ['number' => 18, 'name' => 'Card #18', 'set' => 'third'],
            ['number' => 19, 'name' => 'Card #19', 'set' => 'third'],
            ['number' => 20, 'name' => 'Card #20', 'set' => 'third'],
        ]));
    }
}
