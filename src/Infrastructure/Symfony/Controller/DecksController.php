<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deckbuilding\ListDecks;
use Infrastructure\Symfony\ViewModel\Deck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DecksController extends AbstractController
{
    private ListDecks $lister;

    public function __construct(ListDecks $lister)
    {
        $this->lister = $lister;
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
