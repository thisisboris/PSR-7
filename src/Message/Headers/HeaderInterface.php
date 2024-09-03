<?php

namespace Thisisboris\Psr7\Message\Headers;


interface HeaderInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    public function getValue(): array;

    public function withValue(array $value): HeaderInterface;

    public function withAddedValue(array $value): HeaderInterface;

    public function getValueAsString(): string;
}