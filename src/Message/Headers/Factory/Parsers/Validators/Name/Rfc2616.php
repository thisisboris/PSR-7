<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\NameValidator;
use Thisisboris\Psr7\Message\HttpProtocol;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc2616 Hypertext Transfer Protocol -- HTTP/1.1
 * HEADER_NAME must be `TOKEN` as defined in https://datatracker.ietf.org/doc/html/rfc2616#section-2.2
 * TOKEN is ANY CHAR except CTLs or SEPARATORS (which include SP and HT defined below)
 * CTLs: US-ASCII control character and DEL
 * SEPARATORS: ( ) < > @ , ; : \ " / [ ] ? = { } SP HT
 * SP: US-ASCII SP, space (32)
 * HT: US-ASCII HT, horizontal-tab (9)
 *
 * @note This implementation does not allow the first 32 ASCII characters (\x00-\x20).
 *        I consider Header names containing those highly questionable in nature.
 */
final class Rfc2616 implements NameValidator
{
    private const string NAME_REGEX = '/^[^\x00-\x20\x22\x28\x29\x2C\x2F\x3A\x3B\x3C\x3D\x3E\x3F\x40\x5B\x5C\x5D\x7B\x7D\x7F]+$/';

    public function supports(HttpProtocol $httpProtocol): bool
    {
        return $httpProtocol === HttpProtocol::OneDotOne;
    }

    public function validate(string $name): bool
    {
        return preg_match(Rfc2616::NAME_REGEX, $name) === 1;
    }
}