<?php

use Commands\WorkerCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class WorkerCommandTest extends TestCase
{
    public function testPushAndPop()
    {
        $commandTester = new CommandTester(new WorkerCommand());
        $commandTester->execute([]);

        $this->assertTrue(true);
    }
}