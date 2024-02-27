<?php

namespace Monir\AmsRouter\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class AmsServe extends Command
{
  protected static $defaultName = 'serve';


  protected function configure()
  {
    $this
      ->setDescription('Start the AMS server.')
      ->setHelp('This command starts the AMS server.');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $projectDir = __DIR__ . '/../../';

    $host = 'localhost';
    $port = 8000;

    $process = new Process(['php', '-S', "{$host}:{$port}", '-t', $projectDir]);
    $process->start();

    $output->writeln("Server is running on http://{$host}:{$port}");

    $process->setTimeout(null);

    $process->wait();

    return Command::SUCCESS;
  }
}
