<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Value;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\ValueValidator;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

class AbsentValueValidator implements ValueValidator
{
    public function supports(HttpProtocol $httpProtocol, HttpHeader $header): bool
    {
        return true;
    }

    public function validate(string $value): bool
    {
        return true;
    }
}