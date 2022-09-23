<?php

declare(strict_types=1);

use Infrastructure\Contract\FixturesLoaderInterface;
use Infrastructure\Symfony\Command\FixturesLoadCommand;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('app.data_path', '%kernel.project_dir%/%env(DATA_PATH)%');

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure()
        ->bind('string $dataPath', '%app.data_path%');

    $services->load('Domain\\', '%kernel.project_dir%/src/Domain')
        ->exclude(['%kernel.project_dir%/src/Domain/Entity/']);

    $services->load('Infrastructure\\', '%kernel.project_dir%/src/Infrastructure')
        ->exclude(['%kernel.project_dir%/src/Infrastructure/Symfony/Kernel.php']);

    $services->load('Infrastructure\Symfony\Controller\\', '%kernel.project_dir%/src/Infrastructure/Symfony/Controller/')
        ->tag('controller.service_arguments');

    $services->instanceof(FixturesLoaderInterface::class)
        ->tag('app.fixtures.loader');
    $services->set(FixturesLoadCommand::class)
        ->arg('$loaders', tagged_iterator('app.fixtures.loader'));
};
