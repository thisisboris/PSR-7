<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\NameParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc9110 HTTP Semantics
 */
final class Rfc9110  implements NameParser
{
    public function supports(HttpProtocol $httpProtocol): bool
    {
        // TODO: Implement supports() method.
    }

    public function parse(HttpProtocol $httpProtocol, string $name): HttpHeader
    {
        // TODO: Implement parse() method.
    }
}