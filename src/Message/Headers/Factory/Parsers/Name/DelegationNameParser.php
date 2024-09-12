<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

use Ds\Sequence;
use Ds\Vector;
use Thisisboris\Psr7\Message\Headers\Exceptions\UnsupportedHttpHeaderException;
use Thisisboris\Psr7\Message\Headers\Exceptions\UnsupportedHttpProtocolException;
use Thisisboris\Psr7\Message\Headers\Factory\Parsers\NameParser;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;

class DelegationNameParser implements NameParser
{
    public function __construct(
        private ?Sequence $parsers = null
    ) {
        $this->parsers ??= $this->getDefaultParsers();
    }

    public function supports(HttpProtocol $httpProtocol): bool
    {
        foreach ($this->parsers as $parser) {
            if ($parser->supports($httpProtocol)) {
                return true;
            }
        }

        return false;
    }

    public function parse(HttpProtocol $httpProtocol, string $name): HttpHeader
    {
        /** @var NameParser $parser */
        foreach ($this->getSupportedParsers($httpProtocol) as $parser) {
            if ($parser->supports($httpProtocol)) {
                $parsed = $parser->parse($httpProtocol, $name);
                if (! is_null($parsed)) {
                    return $parsed;
                }
            }
        }

        throw UnsupportedHttpHeaderException::from($name);
    }

    protected function getSupportedParsers(HttpProtocol $httpProtocol): Sequence
    {
        $supported = $this->parsers
            ->filter(fn(NameParser $parser) => $parser->supports($httpProtocol));

        if ($supported->isEmpty()) {
            throw UnsupportedHttpProtocolException::from($httpProtocol);
        }

        return $supported;
    }

    protected function getDefaultParsers(): Sequence
    {
        return new Vector([
            new Rfc2616(),
            new Rfc7230(),
            new Rfc9110(),
            new Rfc9112(),
            new SimpleNameParser(),
        ]);
    }
}