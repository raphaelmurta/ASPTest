<?php

namespace ASPTest\Commands;

use ASPTest\Http\Controllers\UserController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserPassCreateCommand extends Command
{
  protected static $defaultName = 'USER:CREATE-PWD';

  public function __construct()
  {
    parent::__construct();
  }

  protected function configure(): void
  {
    $this
      ->addArgument('id', InputArgument::REQUIRED)
      ->addArgument('password', InputArgument::REQUIRED)
      ->addArgument('confirm_password', InputArgument::REQUIRED);
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $args = $input->getArguments();
    $pwd = (object) UserController::setPassword($args);

    if ($pwd->status) {
      $output->writeln("Success:");
      $output->writeln(" - {$pwd->message}");
    }

    if (!$pwd->status) {
      $output->writeln("Error:");
      foreach ($pwd->message as $i => $msg) {
        $output->writeln($msg);
      }
    }

    return Command::SUCCESS;
  }
}
