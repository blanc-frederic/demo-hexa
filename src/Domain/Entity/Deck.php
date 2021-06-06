<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\Deck\DeckComponent;
use OutOfBoundsException;
use OverflowException;
use UnderflowException;

class Deck
{
    private string $id;
    private string $name;

    private bool $isStandard;
    private int $count = 0;

    /** @var DeckComponent[] */
    private array $components;
    
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isStandard = true;
        $this->components = [];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function add(Card $card): void
    {
        if ($this->count === 30) {
            throw new OverflowException('Deck can only contain 30 cards');
        }

        $number = $card->getNumber();

        if (isset($this->components[$number])) {
            if ($this->components[$number]->number === 2) {
                throw new OverflowException('Deck can only contain 2 copies of the same card');
            }

            $this->components[$number]->number++;
            $this->count++;
            return;
        }

        if ($this->isStandard && ! $card->isStandard()) {
            $this->isStandard = false;
        }

        $this->components[$number] = new DeckComponent($card);
        $this->count++;
    }

    public function remove(Card $card): void
    {
        $number = $card->getNumber();

        if (! isset($this->components[$number])) {
            throw new OutOfBoundsException('Card not found in this deck');
        }

        if ($this->components[$number]->number === 1) {
            unset($this->components[$number]);
            $this->count--;
            return;
        }

        $this->components[$number]->number--;
        $this->count--;
    }

    public function isStandard(): bool
    {
        return $this->isStandard;
    }

    public function getCardsCount(): int
    {
        return $this->count;
    }

    /** @return Card[] */
    public function getCards(): array
    {
        return array_reduce(
            $this->components,
            fn ($cardList, $component) => array_merge(
                $cardList,
                array_fill(0, $component->number, $component->getCard())
            ),
            []
        );
    }
}
