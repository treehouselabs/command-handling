<?php

namespace TreeHouse\CommandHandling\Bridge\MessageBus\TreeHouse;

use TreeHouse\CommandHandling\CommandInterface;
use TreeHouse\CommandHandling\CommandName;
use TreeHouse\MessageBus\MessageNameResolverInterface;

class CommandNameResolver implements MessageNameResolverInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return string
     */
    public function resolve($command)
    {
        return (string) new CommandName($command);
    }
}
