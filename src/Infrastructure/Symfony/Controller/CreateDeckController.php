<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Controller;

use Domain\Deckbuilding\CreateDeck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateDeckController extends AbstractController
{
    private CreateDeck $creator;

    public function __construct(CreateDeck $creator)
    {
        $this->creator = $creator;
    }

    public function create(Request $request): Response
    {
        $name = (string) $request->request->get('name');

        if ($name) {
            $this->creator->create($name);
        }

        return $this->redirectToRoute('decks');
    }
}
