<?php

namespace Thisisboris\Psr7;

use Ds\Collection;
use Ds\Map;
use Ds\Vector;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;
use Thisisboris\Assertions\AssertType;
use Thisisboris\Psr7\Message\Headers\Header;
use Thisisboris\Psr7\Message\Headers\HttpHeader;
use Thisisboris\Psr7\Message\HttpProtocol;
use Thisisboris\Psr7\Message\Protocol\Exceptions\IllegalProtocolVersionException;

class Message implements MessageInterface
{

    protected HttpProtocol $protocolVersion = HttpProtocol::OneDotOne;

    /** @var Collection<string,Header> */
    protected Collection $headers;

    protected StreamInterface $body;

    public function __construct(string $protocolVersion, array $headers, StreamInterface $body)
    {
        $this->setProtocol($protocolVersion);
        $this->setHeaders($headers);
        $this->setBody($body);
    }

    protected function setProtocol(string $protocolVersion): void
    {
        try {
            $this->protocolVersion = HttpProtocol::from($protocolVersion);
        } catch (\ValueError) {
            throw new IllegalProtocolVersionException($protocolVersion);
        }
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion->value;
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        $clone = clone $this;
        $clone->protocolVersion = HttpProtocol::from($version);
        $clone->headers = clone $this->headers;

        return $clone;
    }

    protected function setHeaders(array $headers): void
    {
        $this->headers = new Map($headers);
    }

    public function getHeaders(): array
    {
        return array_reduce(
            $this->headers->toArray(),
            function ($carry, $header) {
                $carry[$header->getName()] = $header->getValue();
                return $carry;
            },
            []
        );
    }
    public function hasHeader(string $name): bool
    {
        return $this->headers->hasKey(strtolower($name));
    }

    public function getHeader(string $name): array
    {
        if (! $this->hasHeader($name)) {
            return [];
        }

        return $this->headers->get(strtolower($name))->getValue();
    }

    public function getHeaderLine(string $name): string
    {
        if (! $this->hasHeader($name)) {
            return '';
        }

        return $this->headers->get(strtolower($name))->getValueAsString();
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        (new AssertType(new Vector(['string', 'array'])))->assert($value);

        $clone = clone $this;
        $clone->headers->put(strtolower($name), new Header(HttpHeader::from($name), $name, $value));

        return $clone;
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        (new AssertType(new Vector(['string', 'array'])))->assert($value);
        $normalized = strtolower($name);

        $clone = clone $this;
        if (! $clone->headers->hasKey($normalized)) {
            $clone->headers->put($normalized, new Header(HttpHeader::from($name), $name, $value));

            return $clone;
        }

        $clone->headers->put(
            $normalized, $clone->headers->get($normalized)->withAddedValue($value)
        );
        return $clone;
    }

    public function withoutHeader(string $name): MessageInterface
    {
        $clone = clone $this;
        if (! $clone->headers->hasKey($name)) {
            return $clone;
        }

        $clone->headers->remove($name);

        return $clone;
    }

    protected function setBody(StreamInterface $body): void
    {
        $this->body = $body;
    }

    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        $clone = clone $this;
        $clone->body = $body;

        return $clone;
    }

    public function __clone()
    {
        $this->headers = clone $this->headers;
        $this->body = clone $this->body;
    }
}