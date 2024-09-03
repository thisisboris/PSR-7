<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators;

use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

interface ValueValidator
{
    public function supports(HttpProtocol $httpProtocol, HttpHeader $header): bool;

    public function validate(string $value): bool;
}