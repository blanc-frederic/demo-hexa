<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Command;

use Infrastructure\File\Fixtures\FileFixtures;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixturesLoad extends Command
{
    private FileFixtures $generator;

    public function __construct(FileFixtures $generator)
    {
        $this->generator = $generator;
        parent::__construct('file:fixtures:load');
    }

    protected function configure(): void
    {
        $this->setDescription('Load fixtures for File Repositories');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Fixtures generator',
            '==================',
        ]);

        $missingFiles = $this->generator->getMissingFiles();

        if (empty($missingFiles)) {
            $output->writeln('No file generation needed');
            return Command::SUCCESS;
        }

        foreach ($missingFiles as $file) {
            $output->writeln('Generating ' . $file . '...');
        }

        $this->generator->generate();

        $output->writeln('Done ! ' . count($missingFiles) . ' files generated');

        return Command::SUCCESS;
    }
}
