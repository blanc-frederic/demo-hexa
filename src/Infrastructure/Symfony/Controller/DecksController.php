<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deckbuilding\ListDecks;
use Infrastructure\Symfony\ViewModel\Deck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DecksController extends AbstractController
{
    public function __construct(
        private readonly ListDecks $lister
    ) {
    }

    public function index(): Response
    {
        $decks = array_map(
            fn ($deck) => new Deck(
                $deck->getId(),
                $deck->getName(),
                $deck->getCardsCount(),
                $deck->isStandard()
            ),
            $this->lister->list()
        );

        return $this->render('deckbuilding/decks.html.twig', ['decks' => $decks]);
    }
}
