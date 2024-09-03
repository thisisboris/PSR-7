<?php

namespace Thisisboris\Psr7\Message\Headers\Exceptions;

class IllegalHeaderException extends \InvalidArgumentException
{
    public static function from(string $name, string $values = ''): static
    {
        if (empty(trim($values))) {
            return new static(sprintf("The header-name (%s) could not be parsed into a valid header.", $name));
        }

        return new static(sprintf("The header (%s) does not contain valid value(s)", $name));
    }
}