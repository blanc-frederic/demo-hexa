<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Command;

use Infrastructure\Contract\FixturesLoaderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixturesLoadCommand extends Command
{
    /** @var FixturesLoaderInterface[] */
    private iterable $loaders;

    /** @param FixturesLoaderInterface[] $loaders */
    public function __construct(iterable $loaders)
    {
        $this->loaders = $loaders;
        parent::__construct('app:fixtures:load');
    }

    protected function configure(): void
    {
        $this->setDescription('Load fixtures for File Repositories');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Fixtures loader',
            '===============',
        ]);

        $loaded = 0;
        foreach ($this->loaders as $loader) {
            if (! $loader->isNeeded()) {
                continue;
            }

            $output->writeln('Loading ' . $loader->getName() . '...');
            $loader->load();
            $loaded++;
        }

        if ($loaded === 0) {
            $output->writeln('No fixtures load needed');
        } else {
            $output->writeln('Done !');
        }

        return Command::SUCCESS;
    }
}
