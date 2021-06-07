<?php

declare(strict_types=1);

namespace Infrastructure\File\Repository;

use Domain\Contract\CardFinder;
use Domain\Contract\CardRepository;
use Domain\Contract\SetRepository;
use Domain\Entity\Card;
use OutOfBoundsException;

use function Safe\file_get_contents;
use function Safe\json_decode;

class FileCardRepository implements CardRepository, CardFinder
{
    private string $filename;
    private SetRepository $setRepository;

    /** @var Card[] */
    private array $cards;

    public function __construct(string $path, SetRepository $setRepository)
    {
        $this->filename = $path . '/cards.json';
        $this->setRepository = $setRepository;
        $this->cards = [];
    }

    public function get(int $number): Card
    {
        $this->loadCards();

        if (! isset($this->cards[$number])) {
            throw new OutOfBoundsException('No card found for this number');
        }

        return $this->cards[$number];
    }

    /** @return Card[] */
    public function findAll(): array
    {
        $this->loadCards();

        return $this->cards;
    }

    /** @return Card[] */
    public function findStandard(): array
    {
        $this->loadCards();

        return array_filter($this->cards, fn ($card) => $card->isStandard());
    }

    private function loadCards(): void
    {
        if ((empty($this->cards)) && (is_file($this->filename))) {
            $raw = json_decode(file_get_contents($this->filename), true);
            foreach ($raw as $rawCard) {
                $this->cards[$rawCard['number']] = new Card(
                    $rawCard['number'],
                    $rawCard['name'],
                    $this->setRepository->get($rawCard['set'])
                );
            }
        }
    }
}
