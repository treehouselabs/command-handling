<?php

namespace TreeHouse\CommandHandling\Tests;

use PHPUnit_Framework_TestCase;
use TreeHouse\CommandHandling\CommandName;

class CommandNameTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_returns_expected_command_name()
    {
        $commandName = new CommandName(new DummyCommand());

        $this->assertEquals(
            'Dummy',
            (string) $commandName
        );
    }
}
