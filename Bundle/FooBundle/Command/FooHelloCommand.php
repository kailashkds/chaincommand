<?php

namespace FooBundle\Command;

use ChainCommandBundle\Service\ChainCommandManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FooHelloCommand extends Command
{
    protected static $defaultName = 'foo:hello';

    public function __construct(private LoggerInterface $chainCommandLogger)
    {
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Hello from Foo!')
            ->setHelp('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello from Foo!');
        $this->chainCommandLogger->notice('Hello from Foo!');
        return Command::SUCCESS;
    }
}
