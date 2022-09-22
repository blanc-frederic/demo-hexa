<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $configurator): void {
    $configurator->extension('framework', ['router' => ['utf8' => true]]);

    if ($configurator->env() === 'prod') {
        $configurator->extension('framework', ['router' => ['strict_requirements' => null]]);
    }
};
