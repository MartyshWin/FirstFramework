<?php

namespace App\Http;

class Kernel
{
    public function handle($method, $uri, $handler, Request $request): Responce
    {

        [$controller, $method] = $handler;
        $response = (new $controller())->$method($method, $request);

        return $response;

    }
}