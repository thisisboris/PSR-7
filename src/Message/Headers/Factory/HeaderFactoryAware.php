<?php

namespace Thisisboris\Psr7\Message\Headers\Factory;

interface HeaderFactoryAware
{
    public function setHeaderFactory(HeaderFactoryInterface $factory): void;
}