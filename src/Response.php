<?php

namespace Thisisboris\Psr7;

use Thisisboris\Psr7\Response\Status;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{
    private Status $status;

    private ?string $reasonPhrase = null;

    public function __construct(
        string $protocolVersion,
        array $headers,
        StreamInterface $body,
        int $status,
        ?string $reasonPhrase = null
    ){
        parent::__construct($protocolVersion, $headers, $body);
        $this->status = Status::from($status);
        $this->reasonPhrase = $reasonPhrase;
    }

    public function getStatusCode(): int
    {
        return $this->status->value;
    }

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        $clone = clone $this;
        $clone->status = Status::from($code);
        $clone->reasonPhrase = strlen($reasonPhrase) > 0 ? $reasonPhrase : null;

        return $clone;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase ?? $this->status->toReasonPhrase();
    }
}