<?php

namespace Thisisboris\Psr7\Message\Headers\Factory;

use Ds\Sequence;
use Thisisboris\Psr7\Message\Headers\Exceptions\IllegalHeaderException;
use Thisisboris\Psr7\Message\Headers\Header;
use Thisisboris\Psr7\Message\Headers\HeaderInterface;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\Headers\Parsers;
use Thisisboris\Psr7\Message\HttpProtocol;

class DelegationHeaderFactoryInterface implements HeaderFactoryInterface
{
    private function __construct(
        private readonly HttpProtocol $httpProtocol
    ){}

    public function create(string $name, string $values): HeaderInterface
    {
        return new Header(HttpHeader::from($name), $name, [$values]);
    }
}