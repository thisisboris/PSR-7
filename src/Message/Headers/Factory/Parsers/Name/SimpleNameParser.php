<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Thisisboris\Psr7\Message\Headers\Exceptions\UnsupportedHttpHeaderException;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\NameParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

final class SimpleNameParser implements NameParser
{
    public function supports(HttpProtocol $httpProtocol): bool
    {
        return true;
    }

    public function parse(HttpProtocol $httpProtocol, string $name): HttpHeader
    {
        try {
            return HttpHeader::from($name);
        } catch (\ValueError) {
            return HttpHeader::CUSTOM;
        }
    }
}