<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeedingCommand extends Command
{
    protected static $defaultName = 'db:seed';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pdo = createPdo();
        emptyDb($pdo);
        populateData($pdo);

        return Command::SUCCESS;
    }
}