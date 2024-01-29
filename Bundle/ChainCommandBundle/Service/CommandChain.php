<?php

namespace ChainCommandBundle\Service;

class CommandChain
{
    private string $parentCommand;
    private array $childCommands = [];

    public function setParentCommand($commandName): void
    {
        $this->parentCommand = $commandName;
    }

    public function getParentCommand(): string
    {
        return $this->parentCommand;
    }

    public function addChildCommand($commandName): void
    {
        $this->childCommands[] = $commandName;
    }

    public function getChildCommands(): array
    {
        return $this->childCommands;
    }

    public function isChildExist($commandName): bool
    {
        return in_array($commandName, $this->childCommands);
    }
}
