<?php

declare(strict_types=1);

namespace Domain\Deckbuilding;

use Domain\Entity\Card;
use OverflowException;
use UnderflowException;

class DeckComponent
{
    private const MIN_CARDS_COPIES = 1;
    public const MAX_CARDS_COPIES = 2;

    private int $count;
    private Card $card;

    public static function createFor(Card $card)
    {
        return new self($card);
    }

    private function __construct(Card $card)
    {
        $this->count = 1;
        $this->card = $card;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function addCopy(): void
    {
        if ($this->count === static::MAX_CARDS_COPIES) {
            throw new OverflowException('Deck can only contain ' . static::MAX_CARDS_COPIES . ' copies of the same card');
        }
        $this->count++;
    }

    public function removeCopy(): void
    {
        if ($this->count === static::MIN_CARDS_COPIES) {
            throw new UnderflowException('Cannot keep less than ' . static::MIN_CARDS_COPIES . ' copy of a card');
        }
        $this->count--;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getCardNumber(): int
    {
        return $this->card->getNumber();
    }

    public function getCardName(): string
    {
        return $this->card->getName();
    }
}
