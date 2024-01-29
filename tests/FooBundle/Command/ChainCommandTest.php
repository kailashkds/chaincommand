<?php

namespace App\Tests\FooBundle\Command;

use BarBundle\Command\BarHiCommand;
use ChainCommandBundle\EventListener\ConsoleCommandListener;
use FooBundle\Command\FooHelloCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class ChainCommandTest.
 *
 * This class is used to test the execution of chain commands. It extends the KernelTestCase class.
 * The ChainCommandTest class contains two test methods: testChainExecute and testChainMemberExecute.
 *
 * @category  Testing
 */
class ChainCommandTest extends WebTestCase
{
    /**
     * Executes the test case for the `testChinExecute` method.
     *
     * This method boots the kernel, retrieves the container, retrieves the instance
     * of `FooHelloCommand` from the container and executes the command with an
     * empty input. It then asserts that the expected output is contained within
     * the display of the command tester.
     *
     * @return void
     */
    public function testChinExecute()
    {
        self::bootKernel();
        $container = static::getContainer();

        // Retrieve the FooHelloCommand from the container
        $fooHelloCommand = $container->get(FooHelloCommand::class);

        // Expect an exception when executing FooHelloCommand directly
        $commandTester = new CommandTester($fooHelloCommand);
        $commandTester->execute([]);

        $this->assertEquals('Hello from Foo!', trim($commandTester->getDisplay()));
    }

    /**
     * Execute the test case for the chain member.
     *
     * This method boots the kernel, retrieves the HiCommand object from the container,
     * creates a CommandTester instance for the HiCommand, and executes it with an empty array of options.
     * It then expects an exception of \Exception class to be thrown, with the message 'Error: bar:hi command is a member of'.
     *
     * @return void
     */
    public function testChainMemberExecute()
    {
        self::bootKernel();
        $container = static::getContainer();
        try {
            // Retrieve the BarHiCommand from the container
            $barHiCommand = $container->get(BarHiCommand::class);
            $commandTester = new CommandTester($barHiCommand);

            // Manually call onConsoleCommand method of ConsoleCommandListener
            $consoleCommandListener = $container->get(ConsoleCommandListener::class);
            $event = new ConsoleCommandEvent($barHiCommand, new StringInput('bar:hi'), new NullOutput());
            $consoleCommandListener->onConsoleCommand($event);

            $commandTester->execute([]);

            // Expect an exception when executing BarHiCommand directly
            $this->expectExceptionMessage('Error: bar:hi command is a member of foo:hello command chain and cannot be executed on its own.');
        } catch (RuntimeException $exception) {
            $this->assertSame('Error: bar:hi command is a member of foo:hello command chain and cannot be executed on its own.', $exception->getMessage());
        }
    }
}
