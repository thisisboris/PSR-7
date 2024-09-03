<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers;

use Ds\Sequence;

interface ValueParsersAware
{
    public function setValueParsers(Sequence $valueParsers): void;
}