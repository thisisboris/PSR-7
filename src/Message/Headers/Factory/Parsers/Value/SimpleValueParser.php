<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Value;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\ValueParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

final class SimpleValueParser implements ValueParser
{
    public function supports(HttpProtocol $httpProtocol, HttpHeader $httpHeader): bool
    {
        return true;
    }

    public function parse(HttpProtocol $httpProtocol, HttpHeader $httpHeader, string $values): array
    {
        return explode(',', $values);
    }
}