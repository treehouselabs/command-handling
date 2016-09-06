<?php

namespace TreeHouse\CommandHandling\Tests;

use PHPUnit_Framework_TestCase;

class CommandHandlerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_handles()
    {
        $handler = new StubCommandHandler();
        $handler->handle(new DummyCommand());

        $this->assertEquals(
            true,
            $handler->isTested()
        );
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_throws_missing_handler()
    {
        $handler = new StubCommandHandler();
        $handler->handle(new DummyUnknownCommand());
    }
}
