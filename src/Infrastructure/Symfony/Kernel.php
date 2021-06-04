<?php

namespace Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__, 3);
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $configDir = $this->getProjectDir() . '/config/';

        $container->import($configDir . '{packages}/*.yaml');
        $container->import($configDir . '{packages}/' . $this->environment . '/*.yaml');

        if (is_file($configDir . 'services.yaml')) {
            $container->import($configDir . 'services.yaml');
            $container->import($configDir . '{services}_' . $this->environment . '.yaml');
        } else {
            $container->import($configDir . '{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $configDir = $this->getProjectDir() . '/config/';

        $routes->import($configDir . '{routes}/' . $this->environment . '/*.yaml');
        $routes->import($configDir . '{routes}/*.yaml');

        if (is_file($configDir . 'routes.yaml')) {
            $routes->import($configDir . 'routes.yaml');
        } else {
            $routes->import($configDir . '{routes}.php');
        }
    }
}
