<?php

declare(strict_types=1);

namespace Infrastructure\File\Repository;

use Domain\Contract\SetRepository;
use Domain\Entity\Set;
use OutOfBoundsException;

use function Safe\file_get_contents;
use function Safe\json_decode;

class FileSetRepository implements SetRepository
{
    private string $filename;
    /** @var Set[] */
    private array $sets;

    public function __construct(string $path)
    {
        $this->filename = $path . '/sets.json';
        $this->sets = [];
    }

    public function get(string $code): Set
    {
        $this->loadSets();

        if (! isset($this->sets[$code])) {
            throw new OutOfBoundsException('No set found for this code : ' . $code);
        }

        return $this->sets[$code];
    }

    private function loadSets(): void
    {
        if ((empty($this->sets)) && (is_file($this->filename))) {
            $raw = json_decode(file_get_contents($this->filename), true);
            foreach ($raw as $rawSet) {
                $this->sets[$rawSet['code']] = new Set(
                    $rawSet['code'],
                    $rawSet['name'],
                    $rawSet['standard']
                );
            }
        }
    }
}
