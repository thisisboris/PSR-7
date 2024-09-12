<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Value;

use Ds\Sequence;
use Ds\Vector;
use Thisisboris\Psr7\Message\Headers\Exceptions\UnsupportedHttpHeaderException;
use Thisisboris\Psr7\Message\Headers\Exceptions\UnsupportedHttpProtocolException;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Value\Rfc6266;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Value\SimpleValueParser;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\ValueParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

class DelegationValueParser implements ValueParser
{
    public function __construct(
        private ?Sequence $parsers = null
    ) {
        $this->parsers ??= $this->getDefaultParsers();
    }

    public function supports(HttpProtocol $httpProtocol, HttpHeader $httpHeader): bool
    {
        foreach ($this->parsers as $parser) {
            if ($parser->supports($httpProtocol, $httpHeader)) {
                return true;
            }
        }

        return false;
    }

    public function parse(HttpProtocol $httpProtocol, HttpHeader $httpHeader, string $values): array
    {
        /** @var ValueParser $parser */
        foreach ($this->getSupportedParsers($httpProtocol, $httpHeader) as $parser) {
            if ($parser->supports($httpProtocol, $httpHeader)) {
                $parsed = $parser->parse($httpProtocol, $httpHeader, $values);
                if (! is_null($parsed)) {
                    return $parsed;
                }
            }
        }

        throw UnsupportedHttpHeaderException::from($httpHeader->value, $values);
    }

    protected function getSupportedParsers(HttpProtocol $httpProtocol, HttpHeader $httpHeader): Sequence
    {
        $supported = $this->parsers
            ->filter(fn(ValueParser $parser) => $parser->supports($httpProtocol, $httpHeader));

        if ($supported->isEmpty()) {
            throw UnsupportedHttpProtocolException::from($httpProtocol);
        }

        return $supported;
    }

    protected function getDefaultParsers(): Sequence
    {
        return new Vector([
            new Rfc6266(),
            new SimpleValueParser(),
        ]);
    }

}