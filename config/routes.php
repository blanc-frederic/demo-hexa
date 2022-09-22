<?php

declare(strict_types=1);

use Infrastructure\Symfony\Controller\CardsController;
use Infrastructure\Symfony\Controller\ChooseCardsController;
use Infrastructure\Symfony\Controller\CreateDeckController;
use Infrastructure\Symfony\Controller\DecksController;
use Infrastructure\Symfony\Controller\EditDeckController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->add('homepage', '/')
        ->controller([DecksController::class, 'index']);

    $routingConfigurator->add('decks', '/')
        ->controller([DecksController::class, 'index']);

    $routingConfigurator->add('create_deck', '/new')
        ->controller([CreateDeckController::class, 'create'])
        ->methods(['POST']);

    $routingConfigurator->add('edit_deck', '/deck/{id}')
        ->controller([EditDeckController::class, 'edit'])
        ->methods(['GET']);

    $routingConfigurator->add('choose_card', '/deck/{deckId}')
        ->controller([ChooseCardsController::class, 'choose'])
        ->methods(['POST']);

    $routingConfigurator->add('cards', '/cards')
        ->controller([CardsController::class, 'index']);
};
