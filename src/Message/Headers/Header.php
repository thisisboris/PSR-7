<?php

namespace Thisisboris\Psr7\Message\Headers;

use Ds\Sequence;
use Ds\Vector;
use Thisisboris\Assertions\AssertContains;
use Thisisboris\Assertions\AssertType;
use Thisisboris\Basil\Attributes\Stringable;

class Header implements HeaderInterface, Stringable
{
    public Sequence $value;

    public function __construct(
        private readonly HttpHeader $httpHeader,
        private readonly string $name,
        array $value
    ){
        $this->setValue($value);
    }

    /**
     * @note While header names are not case-sensitive, getName() will preserve the exact case in which header
     *       was originally specified.
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getHttpHeader(): HttpHeader
    {
        return $this->httpHeader;
    }

    protected function setValue(array $value): void
    {
        (new AssertContains(new AssertType(new Vector(['string']))))->assert($value);
        $this->value = new Vector($value);
    }

    public function withAddedValue(array $value): HeaderInterface
    {
        $clone = clone $this;
        $clone->value->push(...$value);
        return $clone;
    }

    public function withValue(array $value): HeaderInterface
    {
        $clone = clone $this;
        $clone->setValue($value);
        return $clone;
    }

    public function getValue(): array
    {
        return $this->value->toArray();
    }

    public function getValueAsString(): string
    {
        return implode(',', $this->getValue());
    }

    public function __toString(): string
    {
        return sprintf('%s: %s', $this->getName(), $this->getValueAsString());
    }

    public function __clone(): void
    {
        $this->value = clone $this->value;
    }
}