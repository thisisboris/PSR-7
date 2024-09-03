<?php

namespace Thisisboris\Psr7;

use Ds\Map;
use Ds\Vector;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\UriInterface;
use Thisisboris\Assertions\AssertContains;
use Thisisboris\Assertions\AssertEquals;
use Thisisboris\Assertions\AssertInstanceOf;
use Thisisboris\Psr7\Request\Method;

class ServerRequest extends Request implements ServerRequestInterface
{
    protected Map $serverParams;

    protected Map $queryParams;

    protected Map $cookieParams;

    protected Map $uploadedFiles;

    protected Map $attributes;

    protected null|array|object $parsedBody = null;

    public function __construct(
        string $protocolVersion,
        array $headers,
        StreamInterface $body,
        UriInterface $uri,
        string $method,
        array $serverParams = [],
        array $queryParams = [],
        array $cookieParams = [],
        array $uploadedFiles = [],
        array $attributes = [],
        null|array|object $parsedBody = null
    ){
        parent::__construct($protocolVersion, $headers, $body, $uri, $method);

        (new AssertContains(new AssertInstanceOf(new Vector([UploadedFileInterface::class]))))->assert($uploadedFiles);

        $this->serverParams = new Map($serverParams);
        $this->queryParams = new Map($queryParams);
        $this->cookieParams = new Map($cookieParams);
        $this->uploadedFiles = new Map($uploadedFiles);
        $this->attributes = new Map($attributes);
        $this->parsedBody = $parsedBody;
    }

    public function getServerParams(): array
    {
        return $this->serverParams->toArray();
    }

    public function getCookieParams(): array
    {
        return $this->serverParams->toArray();
    }

    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        $clone = clone $this;
        $clone->cookieParams = new Map($cookies);
        return $clone;
    }

    public function getQueryParams(): array
    {
        return $this->cookieParams->toArray();
    }

    public function withQueryParams(array $query): ServerRequestInterface
    {
        $clone = clone $this;
        $clone->queryParams = new Map($query);
        return $clone;
    }

    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles->toArray();
    }

    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        (new AssertContains(new AssertInstanceOf(new Vector([UploadedFileInterface::class]))))->assert($uploadedFiles);

        $clone = clone $this;
        $clone->uploadedFiles = new Map($uploadedFiles);

        return $clone;
    }

    public function getParsedBody()
    {
        /**
         * If the request Content-Type is either application/x-www-form-urlencoded
         * or multipart/form-data, and the request method is POST, this method MUST
         * return the contents of $_POST.
         */
        if ($this->method === Method::POST && $this->hasHeader('Content-Type')) {
            $contentType = $this->getHeader('Content-Type');
            if (! empty(array_intersect($contentType, ['application/x-www-form-urlencoded', 'multipart/form-data']))) {
                return $_POST;
            }
        }

        /**
         * A null value indicates the absence of body content.
         */
        if (! isset($this->body) || $this->getBody()->getSize() == 0) {
            return null;
        }

        return $this->parsedBody;
    }

    public function withParsedBody($data): ServerRequestInterface
    {
        /**
         * The data IS NOT REQUIRED to come from $_POST, but MUST be the results of
         * deserializing the request body content. Deserialization/parsing returns
         * structured data, and, as such, this method ONLY accepts arrays or objects,
         * or a null value if nothing was available to parse.
         */
        if (!is_array($data) && !is_object($data) && $data !== null) {
            throw new InvalidArgumentException(sprintf( '`withParsedBody` expects data to be null, an array, or an object. Got %s', gettype($data)));
        }

        /**
         * If the request Content-Type is either application/x-www-form-urlencoded
         * or multipart/form-data, and the request method is POST, use this method
         * ONLY to inject the contents of $_POST.
         */
        if ($this->method === Method::POST && $this->hasHeader('Content-Type')) {
            $contentType = $this->getHeader('Content-Type');
            if (! empty(array_intersect($contentType, ['application/x-www-form-urlencoded', 'multipart/form-data']))) {
                (new AssertEquals($_POST))->assert($data);
            }
        }

        $clone = clone $this;
        $clone->parsedBody = $data;
        return $clone;
    }

    public function getAttributes(): array
    {
        return $this->attributes->toArray();
    }

    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes->get(...func_get_args());
    }

    public function withAttribute(string $name, $value): ServerRequestInterface
    {
        $clone = clone $this;
        $clone->attributes->put($name, $value);
        return $clone;
    }

    public function withoutAttribute(string $name): ServerRequestInterface
    {
        $clone = clone $this;
        if ($clone->attributes->hasKey($name)) {
            $clone->attributes->remove($name);
        }
        return $clone;
    }

    public function __clone()
    {
        parent::__clone();
        $this->serverParams = clone $this->serverParams;
        $this->queryParams = clone $this->queryParams;
        $this->cookieParams = clone $this->cookieParams;
        $this->uploadedFiles = clone $this->uploadedFiles;
        $this->attributes = clone $this->attributes;

        // Can only clone objects and parsedBody is null|array|object
        if (is_object($this->parsedBody)) {
            $this->parsedBody = clone $this->parsedBody;
        }
    }
}