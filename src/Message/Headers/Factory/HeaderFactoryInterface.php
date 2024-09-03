<?php

namespace Thisisboris\Psr7\Message\Headers\Factory;

use Thisisboris\Psr7\Message\Headers\HeaderInterface;

interface HeaderFactoryInterface
{
    public function create(string $name, string $values): HeaderInterface;
}