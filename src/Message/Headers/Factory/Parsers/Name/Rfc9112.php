<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\NameParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc9112 HTTP/1.1
 */
final class Rfc9112  implements NameParser
{
    public function supports(HttpProtocol $httpProtocol): bool
    {
        return $httpProtocol === HttpProtocol::OneDotOne;
    }

    public function parse(HttpProtocol $httpProtocol, string $name): HttpHeader
    {
        // TODO: Implement parse() method.
    }

}