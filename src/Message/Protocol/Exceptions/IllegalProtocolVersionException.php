<?php

namespace Thisisboris\Psr7\Message\Protocol\Exceptions;

class IllegalProtocolVersionException extends \UnexpectedValueException
{
    public static function from(string $protocolVersion): static
    {
        return new static(sprintf("Protocol (%s) is not supported", $protocolVersion));
    }
}