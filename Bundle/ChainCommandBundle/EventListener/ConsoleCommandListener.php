<?php

namespace ChainCommandBundle\EventListener;

use ChainCommandBundle\Service\ChainCommandManager;
use ChainCommandBundle\Service\CommandChain;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Class ConsoleCommandListener.
 *
 * A listener class that handles console commands.
 */
class ConsoleCommandListener
{
    public function __construct(private ChainCommandManager $chainCommandManager, private LoggerInterface $chainCommandLogger)
    {
    }

    /**
     * Executes console command.
     *
     * @param ConsoleCommandEvent $event the console command event object
     */
    public function onConsoleCommand(ConsoleCommandEvent $event): void
    {
        $command = $event->getCommand();
        if ($chain = $this->chainCommandManager->getParentCommand($command->getName())) {
            $this->executeAllChainCommands($event, $command, $chain);

            return;
        }

        if ($chain = $this->chainCommandManager->getChainCommand($command->getName())) {
            // Log information about the master command and registered member commands
            $this->chainCommandLogger->error(sprintf(
                '%s command is a member of %s command chain and cannot be executed on its own.',
                $command->getName(),
                $chain->getParentCommand()
            ));
            throw new RuntimeException(sprintf('%s command is a member of %s command chain and cannot be executed on its own.', $command->getName(), $chain->getParentCommand()));
            // Prevent the original command from being executed
            $event->disableCommand();
        }
    }

    /**
     * Executes all commands in the given chain.
     *
     * @param ConsoleCommandEvent $event         the console command event
     * @param Command             $parentCommand the master command in the chain
     * @param CommandChain        $chain         the chain of commands
     *
     * @return void
     *
     * @throws ExceptionInterface
     */
    private function executeAllChainCommands(ConsoleCommandEvent $event, Command $parentCommand, CommandChain $chain)
    {
        $this->chainCommandLogger->notice(sprintf('%s is a master command of a command chain that has registered member commands', $parentCommand->getName()));

        foreach ($chain->getChildCommands() as $command) {
            $this->chainCommandLogger->notice(sprintf('%s registered as a member of %s command chain', $command, $parentCommand->getName()));
        }

        $this->chainCommandLogger->notice(sprintf('Executing %s command itself first:', $parentCommand->getName()));

        $parentCommand->run($event->getInput(), $event->getOutput());

        $this->chainCommandLogger->notice(sprintf('Executing %s chain members:', $parentCommand->getName()));
        $container = $parentCommand->getApplication()->getKernel()->getContainer()->get('console.command_loader');
        foreach ($chain->getChildCommands() as $command) {
            if ($command = $container->get($command)) {
                $newInput = new ArrayInput([], $command->getDefinition());
                $output = $event->getOutput();
                $command->run($newInput, $output);
            }
        }

        $this->chainCommandLogger->notice(sprintf('Execution of %s chain completed.', $parentCommand->getName()));

        $event->disableCommand();

        return;
    }
}
