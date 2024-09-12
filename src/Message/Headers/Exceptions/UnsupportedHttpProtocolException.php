<?php

namespace Thisisboris\Psr7\Message\Headers\Exceptions;

use Thisisboris\Psr7\Message\HttpProtocol;

final class UnsupportedHttpProtocolException extends \InvalidArgumentException
{
    public static function from(HttpProtocol $httpProtocol): UnsupportedHttpProtocolException
    {
        return new self(sprintf("The HTTP Protocol HTTP-%s is not supported", $httpProtocol->value));
    }
}