<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\NameValidator;
use Thisisboris\Psr7\Message\HttpProtocol;

class AbsentNameValidator implements NameValidator
{
    public function supports(HttpProtocol $httpProtocol): bool
    {
        return true;
    }

    public function validate(string $name): bool
    {
        return true;
    }
}