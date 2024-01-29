<?php

namespace BarBundle\Command;

use ChainCommandBundle\Service\ChainCommandManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BarHiCommand extends Command
{
    protected static $defaultName = 'bar:hi';

    public function __construct(private readonly LoggerInterface $chainCommandLogger)
    {

        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Hi from Bar!')
            ->setHelp('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hi from Bar!');
        $this->chainCommandLogger->notice('Hi from Bar!');

        return Command::SUCCESS;
    }
}
