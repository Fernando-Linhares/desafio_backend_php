<?php

namespace Packages\Router\Http;

abstract class Response
{
    protected static $content;

    protected static array $headers = [];

    protected static int $status = 0;

    public function getHeaders(): array
    {
        return self::$headers;
    }

    public function setHeaders(array $headers): void
    {
        self::$headers = $headers;
    }

    public function getStatus(): int
    {
        return self::$status;
    }

    public function setStatus(int $status): void
    {
        self::$status = $status;
    }

    public function getContent(): mixed
    {
        return self::$content;
    }

    public function setContent(mixed $content)
    {
        self::$content = $content;
    }

    public function headers(array $headers)
    {
        self::$headers = $headers;

        return $this;
    }

    public function addHeaders(array $headers)
    {
        self::$headers = array_merge(self::$headers, $headers);

        return $this;
    }

    public abstract function render();

    public function notHas(): bool
    {
        return empty(self::$content);
    }
}