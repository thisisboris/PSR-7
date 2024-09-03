<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators;

use Thisisboris\Psr7\Message\HttpProtocol;

interface NameValidator
{
    public function supports(HttpProtocol $httpProtocol): bool;

    public function validate(string $name): bool;
}