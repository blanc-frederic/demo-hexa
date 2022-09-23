<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine', [
        'dbal' => ['url' => '%env(resolve:DATABASE_URL)%'],
        'orm' => [
            'auto_mapping' => false,
            'auto_generate_proxy_classes' => true,
            'mappings' => [
                'Domain' => [
                    'type' => 'xml',
                    'dir' => '%kernel.project_dir%/config/orm',
                    'prefix' => 'Domain\Entity',
                    'alias' => 'Domain'
                ]
            ]
        ]
    ]);

    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('doctrine', [
            'dbal' => ['dbname_suffix' => '_test%env(default::TEST_TOKEN)%']
        ]);
    }

    if ($containerConfigurator->env() === 'prod') {
        $containerConfigurator->extension('doctrine', [
            'orm' => [
                'auto_generate_proxy_classes' => false,
                'query_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'doctrine.system_cache_pool'
                ],
                'result_cache_driver' => [
                    'type' => 'pool',
                    'pool' => 'doctrine.result_cache_pool'
                ]
            ]
        ]);
        $containerConfigurator->extension('framework', [
            'cache' => [
                'pools' => [
                    'doctrine.result_cache_pool' => [
                        'adapter' => 'cache.app'
                    ],
                    'doctrine.system_cache_pool' => [
                        'adapter' => 'cache.system'
                    ]
                ]
            ]
        ]);
    }
};
