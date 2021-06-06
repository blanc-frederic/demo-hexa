<?php

declare(strict_types=1);

namespace Domain\Entity;

class Deck
{
    private string $id;
    private string $name;
    private bool $isStandard;
    /** @var Card[] */
    private array $cards;
    
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isStandard = true;
        $this->cards = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isStandard(): bool
    {
        return $this->isStandard;
    }

    public function add(Card $card): void
    {
        if ($this->isStandard && ! $card->isStandard()) {
            $this->isStandard = false;
        }

        $this->cards[] = $card;
    }

    /** @return Card[] */
    public function getCards(): array
    {
        return $this->cards;
    }
}
