<?php

namespace Thisisboris\Psr7;

use Thisisboris\Psr7\Request\Method;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    protected ?string $requestTarget = null;

    protected Method $method;

    protected UriInterface $uri;

    public function __construct(
        string $protocolVersion,
        array $headers,
        StreamInterface $body,
        UriInterface $uri,
        string $method
    ){
        parent::__construct($protocolVersion, $headers, $body);

        $this->uri = $uri;
        $this->method = Method::from($method);
    }

    public function getRequestTarget(): string
    {
        if (! is_null($this->requestTarget)) {
            return $this->requestTarget;
        }

        /**
         * If no URI is available, and no request-target has been specifically
         * provided, this method MUST return the string "/".
         */
        if (! isset($this->uri)){
            return '/';
        }

        $target = $this->uri->getPath();
        if ($target === '') {
            $target = '/';
        }
        if ($this->uri->getQuery() != '') {
            $target .= '?'.$this->uri->getQuery();
        }

        return $target;
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $clone = clone $this;
        $clone->requestTarget = $requestTarget;
        return $clone;
    }

    public function getMethod(): string
    {
        return $this->method->value;
    }

    public function withMethod(string $method): RequestInterface
    {
        $clone = clone $this;
        $clone->method = Method::from($method);
        return $clone;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        if (! $preserveHost && !empty(trim($uri->getHost()))) {
            $clone = $this->withHeader('host', trim($uri->getHost()));
        } else {
            $clone = clone $this;
        }

        $clone->uri = $uri;
        return $clone;
    }

    public function __clone()
    {
        parent::__clone();
        $this->uri = clone $this->uri;
    }
}