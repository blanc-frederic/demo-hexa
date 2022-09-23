<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\Deckbuilding\DeckComponent;
use OutOfBoundsException;

class Deck
{
    private bool $isStandard = true;
    private int $count = 0;

    /** @var DeckComponent[] */
    private array $components = [];

    public function __construct(
        private readonly string $id,
        private readonly string $name
    ) {
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
        $number = $card->getNumber();

        if (isset($this->components[$number])) {
            $this->components[$number]->addCopy();
            $this->count++;
            return;
        }

        if ($this->isStandard && ! $card->isStandard()) {
            $this->isStandard = false;
        }

        $this->components[$number] = DeckComponent::createFor($card);
        $this->count++;
    }

    public function remove(Card $card): void
    {
        $number = $card->getNumber();

        if (! isset($this->components[$number])) {
            throw new OutOfBoundsException('Card not found in this deck');
        }

        if ($this->components[$number]->getCount() === 1) {
            unset($this->components[$number]);
            $this->count--;
            return;
        }

        $this->components[$number]->removeCopy();
        $this->count--;
    }

    /** @return DeckComponent[] */
    public function getComponents(): array
    {
        return array_values($this->components);
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
                array_fill(0, $component->getCount(), $component->getCard())
            ),
            []
        );
    }
}
