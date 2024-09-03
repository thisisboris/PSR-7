<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Traits;

use Thisisboris\Psr7\Message\Headers\Factory\HeaderFactoryInterface;

class HeaderFactoryAware
{
    private HeaderFactoryInterface $headerFactory;

    public function setHeaderFactory(HeaderFactoryInterface $factory): void
    {
        $this->headerFactory = $factory;
    }

    protected function getHeaderFactory(): HeaderFactoryInterface
    {
        return $this->headerFactory;
    }
}