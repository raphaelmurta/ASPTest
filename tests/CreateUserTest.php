<?php declare(strict_types=1);

use ASPTest\Commands\UserCreateCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class CreateUserTest extends TestCase
{

    public function testCanBeCreatedFromValidUser(): void
    {
        $app = new Application();
        $app->add(new UserCreateCommand());

        $command = $app->find('USER:CREATE');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'first_name' => "TestName",
            'last_name' => 'TestLastName',
            'email' => 'testsNameAge022@test.com',
            'age' => 42
        ]);

        $this->addToAssertionCount(1);
        $output = $commandTester->getDisplay();
        print_r($output);
    }

    public function testCanBeCreatedFromValidUserAgeEmpty(): void
    {
        $app = new Application();
        $app->add(new UserCreateCommand());

        $command = $app->find('USER:CREATE');

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'first_name' => "TestName",
            'last_name' => 'TestLastName',
            'email' => 'testsNameAge021@test.com'
        ]);

        $this->addToAssertionCount(1);
        $output = $commandTester->getDisplay();
        print_r($output);
    }

}