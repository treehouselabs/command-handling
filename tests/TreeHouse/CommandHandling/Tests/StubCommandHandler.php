<?php

namespace TreeHouse\CommandHandling\Tests;

use TreeHouse\CommandHandling\AbstractCommandHandler;

class StubCommandHandler extends AbstractCommandHandler
{
    private $tested = false;

    protected function handleDummy(DummyCommand $command)
    {
        $this->tested = true;
    }

    /**
     * @return bool
     */
    public function isTested()
    {
        return $this->tested;
    }
}
