<?php

namespace ChainCommandBundle\Service;

/**
 * The ChainCommandManager class manages a collection of CommandChain objects.
 */
class ChainCommandManager
{
    /**
     * @var array
     */
    private $chains = [];

    /**
     * Set chain commands.
     *
     * This method sets the chain commands for the command chains.
     * It takes an array of chain commands as input and assigns them to the corresponding command chains.
     * Each chain command is an associative array where the key represents the command chain master
     * and the value represents the chain command.
     * For each chain command, a CommandChain object is created if it doesn't already exist for the master command.
     * The parent command is set for the CommandChain object and the child commands are added to the chain.
     *
     * @param array $chainCommands An array of chain commands.
     *                             Each element of the array is an associative array where the key represents
     *                             the command chain master and the value represents the chain command.
     *                             The chain command is an array of associative arrays where the key represents
     *                             the child command key and the value is not used.
     *                             Example: [
     *                             'master_command_1' => [
     *                             ['child_command1' => ''],
     *                             ['child_command2' => ''],
     *                             ],
     *                             'master_command_2' => [
     *                             ['child_command3' => ''],
     *                             ['child_command4' => ''],
     *                             ],
     *                             ]
     */
    public function setChainCommands(array $chainCommands): void
    {
        foreach ($chainCommands as $master => $chainCommand) {
            if (empty($this->chains[$master])) {
                $this->chains[$master] = new CommandChain();
            }
            $this->chains[$master]->setParentCommand($master);
            foreach ($chainCommand as $chain) {
                foreach ($chain as $key => $value) {
                    $this->chains[$master]->addChildCommand($key);
                }
            }
        }
    }

    /**
     * Get chain commands.
     *
     * This method returns the chain commands for the command chains.
     * It retrieves the array of chain commands that have been previously set and returns it.
     * Each element of the array represents a command chain, where the key represents the command chain master
     * and the value is a CommandChain object.
     *
     * @return array An array of chain commands.
     *               Each element of the array represents a command chain, where the key represents
     *               the command chain master and the value is a CommandChain object.
     */
    public function getChainCommands(): array
    {
        return $this->chains;
    }

    /**
     * Get parent command.
     *
     * This method retrieves the parent command of a given command.
     * It takes a command as input and returns the parent command, or null if the parent command does not exist.
     *
     * @param string $command the command for which to retrieve the parent command
     *
     * @return CommandChain|null the parent command of the given command, or null if the parent command does not exist
     */
    public function getParentCommand($command): ?CommandChain
    {
        return $this->chains[$command] ?? null;
    }

    /**
     * Retrieves the CommandChain object that contains the given command.
     *
     * @param mixed $command the command to search for within the CommandChain objects
     *
     * @return CommandChain|null the CommandChain object that contains the given command, or null if not found
     */
    public function getChainCommand($command): ?CommandChain
    {
        foreach ($this->chains as $chainCommands) {
            if (in_array($command, $chainCommands->getChildCommands())) {
                return $chainCommands;
            }
        }

        return null;
    }
}
