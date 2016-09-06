<?php

namespace TreeHouse\CommandHandling\Bridge\MessageBus\TreeHouse;

use InvalidArgumentException;
use TreeHouse\CommandHandling\CommandHandlerInterface;
use TreeHouse\MessageBus\MessageNameResolverInterface;
use TreeHouse\MessageBus\Middleware\Subscribers\SubscriberResolverInterface;

class CommandHandlerResolver implements SubscriberResolverInterface
{
    /**
     * @var CommandHandlerInterface[]
     */
    protected $mapping = [];

    /**
     * @var MessageNameResolverInterface
     */
    private $commandNameResolver;

    /**
     * @param MessageNameResolverInterface $commandNameResolver
     */
    public function __construct(MessageNameResolverInterface $commandNameResolver)
    {
        $this->commandNameResolver = $commandNameResolver;
    }

    /**
     * @param $commandName
     * @param CommandHandlerInterface $commandHandler
     */
    public function registerCommandHandler($commandName, CommandHandlerInterface $commandHandler)
    {
        $this->mapping[$commandName] = $commandHandler;
    }

    /**
     * @inheritdoc
     *
     * @return CommandHandlerInterface
     */
    public function resolve($command)
    {
        $commandName = $this->commandNameResolver->resolve($command);

        if (!isset($this->mapping[$commandName])) {
            throw new InvalidArgumentException(sprintf('No command handler registered to handle the command %s', $commandName));
        }

        return [
            [$this->mapping[$commandName], 'handle'],
        ];
    }
}
