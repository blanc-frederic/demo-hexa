<?php

declare(strict_types=1);

namespace Domain\Deck;

use Domain\Entity\Card;

class DeckComponent
{
    public int $number = 1;
    private Card $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function getCard(): Card
    {
        return $this->card;
    }
}
