<?php

namespace Packages\Router;

trait Rest
{
    public function get($uri, $handler)
    {
        $this->request('GET', $uri, $handler);
    }

    public function put($uri, $handler)
    {
        $this->request('PUT', $uri, $handler);
    }

    public function patch($uri, $handler)
    {
        $this->request('PATCH', $uri, $handler);
    }

    public function post($uri, $handler)
    {
        $this->request('POST', $uri, $handler);
    }

    public function delete($uri, $handler)
    {
        $this->request('DELETE', $uri, $handler);
    }

    public function options($uri, $handler)
    {
        $this->request('OPTIONS', $uri, $handler);
    }
}