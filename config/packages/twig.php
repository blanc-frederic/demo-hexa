<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    if ($configurator->env() === 'test') {
        $configurator->extension('twig', ['strict_variables' => true]);
    }
};
