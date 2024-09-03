<?php

namespace Thisisboris\Psr7\Request\Server;

class HttpCookie implements CookieInterface
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#attributes
    // A <cookie-name> can contain any US-ASCII characters except for:
    // control characters (ASCII characters 0 up to 31 and ASCII character 127) or separator characters (space, tab and the characters: ( ) < > @ , ; : \ " / [ ] ? = { })
    // A <cookie-value> can optionally be wrapped in double quotes and include any US-ASCII character excluding
    // control characters (ASCII characters 0 up to 31 and ASCII character 127), Whitespace, double quotes, commas, semicolons, and backslashes.
}