<?php

namespace TreeHouse\CommandHandling;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command);
}
