<?php

namespace ChainCommandBundle\Service;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Argument\ServiceLocator;

class ChainCommandManager
{
    private $chains = [];

    public function setChainCommands(array $chainCommands): void
    {
        foreach ($chainCommands as $master => $chainCommand) {
            if(empty($this->chains[$master])) {
                $this->chains[$master] = new CommandChain();
            }

            foreach ($chainCommand as $chain) {
                foreach ($chain as $key => $value) {
                    $this->chains[$master]->addChildCommand($key);
                }
            }
        }
    }

    public function getChainCommands(): array
    {
        return $this->chains;
    }

    public function getParentCommand($command): ?CommandChain
    {
        return $this->chains[$command] ?? null;
    }

    public function isAChainCommand($command): bool
    {
        foreach ($this->chains as $chainCommands) {
            if(in_array($command, $chainCommands)) {
                return true;
            }
        }
        return false;
    }
}

