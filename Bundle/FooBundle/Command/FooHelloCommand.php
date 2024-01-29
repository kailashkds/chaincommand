<?php

namespace FooBundle\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FooHelloCommand.
 *
 * Represents a command that displays a "Hello from Foo!" message and logs it.
 */
class FooHelloCommand extends Command
{
    /**
     * @var string - The default name value. The string should be in the format of "foo:hello".
     */
    protected static $defaultName = 'foo:hello';

    /**
     * Constructor for the class.
     *
     * @param LoggerInterface $chainCommandLogger the logger interface to be used for logging
     */
    public function __construct(private LoggerInterface $chainCommandLogger)
    {
        parent::__construct(self::$defaultName);
    }

    /**
     * Configure the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setDescription('Hello from Foo!')
            ->setHelp('...');
    }

    /**
     * Executes the command logic.
     *
     * @param InputInterface  $input  the input interface object
     * @param OutputInterface $output the output interface object
     *
     * @return int The status code indicating the success or failure of the command execution. Possible
     *             values are Command::SUCCESS or Command::FAILURE.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello from Foo!');
        $this->chainCommandLogger->notice('Hello from Foo!');

        return Command::SUCCESS;
    }
}
