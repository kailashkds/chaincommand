<?php

namespace ChainCommandBundle\EventListener;

use ChainCommandBundle\Service\ChainCommandManager;
use ChainCommandBundle\Service\CommandChain;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Input\ArrayInput;

class ConsoleCommandListener
{
    public function __construct(private  ChainCommandManager $chainCommandManager, private LoggerInterface $chainCommandLogger)
    {
    }

    public function onConsoleCommand(ConsoleCommandEvent $event): void
    {
        $command = $event->getCommand();
        if($chain = $this->chainCommandManager->getParentCommand($command->getName())) {
            $this->executeAllChainCommands($event, $command, $chain);
            return;
        }


        // Log information about the master command and registered member commands
        $this->chainCommandLogger->info(sprintf(
            '%s registered as a member of %s command chain',
            $command->getName(),
            $chainName
        ));

        // Prevent the original command from being executed
        $event->disableCommand();
    }

    private function executeAllChainCommands(ConsoleCommandEvent $event, Command $parentCommand, CommandChain $chain)
    {
        $this->chainCommandLogger->notice(sprintf('%s is a master command of a command chain that has registered member commands', $parentCommand->getName()));

        foreach ($chain->getChildCommands() as $command) {
            $this->chainCommandLogger->notice(sprintf('%s registered as a member of %s command chain',$command,$parentCommand->getName()));
        }

        $this->chainCommandLogger->notice(sprintf('Executing %s command itself first:',$parentCommand->getName()));

        $parentCommand->run($event->getInput(), $event->getOutput());

        $this->chainCommandLogger->notice(sprintf('Executing %s chain members:',$parentCommand->getName()));
        $container = $parentCommand->getApplication()->getKernel()->getContainer()->get('console.command_loader');
        foreach ($chain->getChildCommands() as $command) {
            if($command = $container->get($command)) {
                $newInput = new ArrayInput([], $command->getDefinition());
                $output = $event->getOutput();
                $command->run($newInput, $output);
            }
        }

        $this->chainCommandLogger->notice(sprintf('Execution of %s chain completed.',$parentCommand->getName()));

        $event->disableCommand();
        return;
    }
}
