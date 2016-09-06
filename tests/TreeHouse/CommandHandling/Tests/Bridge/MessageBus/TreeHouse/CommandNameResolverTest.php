<?php

namespace TreeHouse\CommandHandling\Tests\Bridge\MessageBus;

use PHPUnit_Framework_TestCase;
use TreeHouse\CommandHandling\Bridge\MessageBus\TreeHouse\CommandNameResolver;
use TreeHouse\CommandHandling\Tests\DummyCommand;

class CommandNameResolverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_resolves_command_name()
    {
        $resolver = new CommandNameResolver();

        $this->assertEquals(
            'Dummy',
            $resolver->resolve(new DummyCommand())
        );
    }
}
