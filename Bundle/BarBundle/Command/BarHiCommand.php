<?php

namespace BarBundle\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BarHiCommand.
 *
 * Represents a command that prints "Hi from Bar!" and logs the message using a custom logger channel.
 */
class BarHiCommand extends Command
{
    protected static $defaultName = 'bar:hi';

    /**
     * Injecting custom logger channel.
     */
    public function __construct(private readonly LoggerInterface $chainCommandLogger)
    {
        parent::__construct(self::$defaultName);
    }

    /**
     * Sets the description and help text for the command.
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Hi from Bar!')
            ->setHelp('...');
    }

    /**
     * Executes the Bar command.
     *
     * @param InputInterface  $input  the input interface
     * @param OutputInterface $output the output interface
     *
     * @return int the command exit status (0 for success)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hi from Bar!');
        $this->chainCommandLogger->notice('Hi from Bar!');

        return Command::SUCCESS;
    }
}
