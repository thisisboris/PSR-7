<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers;

use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

interface ValueParser
{
    public function supports(HttpProtocol $httpProtocol, HttpHeader $httpHeader): bool;

    public function parse(HttpProtocol $httpProtocol, HttpHeader $httpHeader, string $values): array;
}