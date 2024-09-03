<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers;

use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

interface NameParser
{
    public function supports(HttpProtocol $httpProtocol): bool;

    public function parse(string $name): HttpHeader;
}