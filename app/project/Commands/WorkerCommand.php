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

            if (!empty($row)) {
                $output->writeln(sprintf('Job for site `%s` executed', $row['url']));
            }

        } while (!empty($row));

        return Command::SUCCESS;
    }
}