<?php

namespace Thisisboris\Psr7\Message\Headers\Factory;


use Thisisboris\Psr7\Message\Headers\Factory\Parsers\NameParser;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name\DelegationNameParser;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Value\DelegationValueParser;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\ValueParser;
use Thisisboris\Psr7\Message\Headers\Header;
use Thisisboris\Psr7\Message\Headers\HeaderInterface;
use Thisisboris\Psr7\Message\HttpProtocol;

class DelegationHeaderFactory implements HeaderFactoryInterface
{
    private NameParser $nameParser;

    private ValueParser $valueParser;

    public function __construct(
        private readonly HttpProtocol $httpProtocol,
    ){
        $this->nameParser = new DelegationNameParser();
        $this->valueParser = new DelegationValueParser();

        if (! $this->nameParser->supports($this->httpProtocol)) {
            throw new \InvalidArgumentException(
                "The supplied NameParser does not support the supplied HttpProtocol"
            );
        }
    }

    public function create(string $name, string $values): HeaderInterface
    {
        $httpHeader = $this->getNameParser()->parse($this->httpProtocol, $name);
        $values = $this->getValueParser()->parse($this->httpProtocol, $httpHeader, $values);

        return new Header(
            $httpHeader,
            $name,
            $values
        );
    }

    protected function getNameParser(): NameParser
    {
        return $this->nameParser;
    }

    protected function getValueParser(): ValueParser
    {
        return $this->valueParser;
    }
}