<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Traits;

use Ds\Sequence;

trait ValueParsersAware
{
    private Sequence $valueParsers;

    public function setValueParsers(Sequence $valueParsers): void
    {
        $this->valueParsers = $valueParsers;
    }

    protected function getValueParsers(): Sequence
    {
        return $this->valueParsers;
    }
}