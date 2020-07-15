<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerCommand extends Command
{
    protected static $defaultName = 'worker:run';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pdo = createPdo();

        do {
            $row = executeJob($pdo);
        } while (!empty($row));

        return Command::SUCCESS;
    }
}