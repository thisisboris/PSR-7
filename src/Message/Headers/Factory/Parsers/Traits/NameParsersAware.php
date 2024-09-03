<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Traits;

use Ds\Sequence;

trait NameParsersAware
{
    private Sequence $nameParsers;

    public function setNameParsers(Sequence $nameParsers): void
    {
        $this->nameParsers = $nameParsers;
    }

    protected function getNameParsers(): Sequence
    {
        return $this->nameParsers;
    }
}