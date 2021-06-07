<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deck\NewDeck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateDeck extends AbstractController
{
    private NewDeck $creator;

    public function __construct(NewDeck $creator)
    {
        $this->creator = $creator;
    }

    public function create(Request $request): Response
    {
        $name = $request->request->get('name');

        $this->creator->create($name);

        return $this->redirectToRoute('decks');
    }
}
