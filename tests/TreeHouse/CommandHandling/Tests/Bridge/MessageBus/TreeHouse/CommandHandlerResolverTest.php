<?php

namespace TreeHouse\CommandHandling\Tests\Bridge\MessageBus;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use TreeHouse\CommandHandling\Bridge\MessageBus\TreeHouse\CommandHandlerResolver;
use TreeHouse\CommandHandling\CommandHandlerInterface;
use TreeHouse\CommandHandling\Tests\DummyCommand;
use TreeHouse\MessageBus\MessageNameResolverInterface;

class CommandHandlerResolverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CommandHandlerResolver
     */
    private $commandHandlerResolver;

    /**
     * @var MessageNameResolverInterface
     */
    private $nameResolver;

    public function setUp()
    {
        $this->nameResolver = $this->prophesize(MessageNameResolverInterface::class);

        $this->commandHandlerResolver = new CommandHandlerResolver(
            $this->nameResolver->reveal()
        );
    }

    /**
     * @test
     */
    public function it_registers_handler()
    {
        $handler = $this->prophesize(CommandHandlerInterface::class)->reveal();

        $command = new DummyCommand();

        $this->nameResolver->resolve($command)->willReturn('Test');

        $this->commandHandlerResolver->registerCommandHandler('Test', $handler);

        $this->assertEquals(
            [
                [$handler, 'handle'],
            ],
            $this->commandHandlerResolver->resolve($command)
        );
    }

    /**
     * @test
     */
    public function it_appends_handlers_to_commands()
    {
        $handler = $this->prophesize(CommandHandlerInterface::class)->reveal();

        $command = new DummyCommand();

        $this->nameResolver->resolve($command)->willReturn('Test');

        $this->commandHandlerResolver->registerCommandHandler('Test', $handler);
        $this->commandHandlerResolver->registerCommandHandler('TestX', $handler);
        $this->commandHandlerResolver->registerCommandHandler('TestY', $handler);

        $this->assertEquals(
            [
                [$handler, 'handle'],
            ],
            $this->commandHandlerResolver->resolve($command)
        );
    }

    /**
     * @test
     *
     * @expectedException InvalidArgumentException
     */
    public function it_throws_when_command_is_not_registered()
    {
        $this->commandHandlerResolver->resolve(
            new DummyCommand()
        );
    }
}
