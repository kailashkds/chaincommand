<?php

namespace ChainCommandBundle\Service;

/**
 * Represents a command chain that consists of a parent command and child commands.
 */
class CommandChain
{
    /**
     * @var string The parent command name
     */
    private string $parentCommand;

    /**
     * @var array An array containing the child command names
     */
    private array $childCommands = [];

    /**
     * Sets the parent command of the current command.
     *
     * @param string $commandName the name of the parent command
     */
    public function setParentCommand(string $commandName): void
    {
        $this->parentCommand = $commandName;
    }

    /**
     * Returns the parent command of the current command.
     *
     * @return string the name of the parent command
     */
    public function getParentCommand(): string
    {
        return $this->parentCommand;
    }

    /**
     * Adds a child command to the current command.
     *
     * @param mixed $commandName the name or instance of the child command
     */
    public function addChildCommand($commandName): void
    {
        $this->childCommands[] = $commandName;
    }

    /**
     * Retrieves the child commands.
     *
     * @return array the array of child commands
     */
    public function getChildCommands(): array
    {
        return $this->childCommands;
    }

    /**
     * Checks if a child command exists.
     *
     * @param string $commandName the command name to check
     *
     * @return bool true if the child command exists, false otherwise
     */
    public function isChildExist($commandName): bool
    {
        return in_array($commandName, $this->childCommands);
    }
}
