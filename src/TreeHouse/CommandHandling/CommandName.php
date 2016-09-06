<?php

namespace TreeHouse\CommandHandling;

class CommandName
{
    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @var string
     */
    private $name;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if (null === $this->name) {
            $this->name = $this->parseName($this->command);
        }

        return $this->name;
    }

    /**
     * @param object $command
     *
     * @return string
     */
    private function parseName($command)
    {
        $class = get_class($command);

        if (substr($class, -7) === 'Command') {
            $class = substr($class, 0, -7);
        }

        $parts = explode('\\', $class);

        return end($parts);
    }
}
