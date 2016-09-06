<?php

namespace TreeHouse\CommandHandling;

use InvalidArgumentException;

class AbstractCommandHandler implements CommandHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(CommandInterface $command)
    {
        $commandName = new CommandName($command);
        $method = 'handle' . ucfirst((string) $commandName);

        if (!method_exists($this, $method)) {
            throw new InvalidArgumentException(
                sprintf('Missing method %s in class %s', $method, get_class($this))
            );
        }

        $this->$method($command);
    }
}
