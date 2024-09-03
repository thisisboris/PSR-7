<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers;

use Ds\Sequence;

interface NameParsersAware
{
    public function setNameParsers(Sequence $nameparsers): void;
}