<?php declare(strict_types=1);

use ASPTest\Commands\UserPassCreateCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class CreateUserPWDTest extends TestCase
{

    public function testCanBeCreatedFromValidUserPwd(): void
    {
        $app = new Application();
        $app->add(new UserPassCreateCommand());

        $command = $app->find('USER:CREATE-PWD');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'id' => 3,
            'password' => 'Raphael1020*',
            'confirm_password' => 'Raphael1020*',
        ]);

        $this->addToAssertionCount(1);
        $output = $commandTester->getDisplay();
        print_r($output);
    }

    public function testCanBeCreatedFromInvalidUserPwd(): void
    {
        $app = new Application();
        $app->add(new UserPassCreateCommand());

        $command = $app->find('USER:CREATE-PWD');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'id' => 3,
            'password' => 'Raphael1020*',
            'confirm_password' => '2Raphael1020*',
        ]);

        $this->addToAssertionCount(1);
        $output = $commandTester->getDisplay();
        print_r($output);
    }

    public function testCanBeCreatedFromInvalidUserPwd2(): void
    {
        $app = new Application();
        $app->add(new UserPassCreateCommand());

        $command = $app->find('USER:CREATE-PWD');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'id' => 3,
            'password' => 'Raphael',
            'confirm_password' => 'Raphael',
        ]);

        $this->addToAssertionCount(1);
        $output = $commandTester->getDisplay();
        print_r($output);
    }

}