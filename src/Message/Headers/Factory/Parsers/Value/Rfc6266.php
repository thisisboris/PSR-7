<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Value;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\ValueValidator;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\ValueParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc6266 Content-Disposition Header Field in the Hypertext Transfer Protocol (HTTP)
 *
 */
final class Rfc6266 implements ValueParser
{
    public function supports(HttpProtocol $httpProtocol, HttpHeader $httpHeader): bool
    {
        return in_array($httpProtocol, [HttpProtocol::OneDotOne, HttpProtocol::TwoDotZero]) && HttpHeader::CONTENT_DISPOSITION === $httpHeader;
    }

    public function parse(HttpProtocol $httpProtocol, HttpHeader $httpHeader, string $values): array
    {
        return explode(',', $values);
    }

}