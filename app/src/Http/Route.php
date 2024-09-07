<?php

namespace App\Http;

use App\Controllers\NotFoundController;
use App\Http\Kernel;

class Route
{

    private static function handleRoute(string $uri, string $params)
    {
        $listURI = array_values(array_filter(explode("/", $uri)));
        $listParams = array_values(array_filter(explode("/", $params)));

        if (count($listURI) !== count($listParams)) return null;

        $options = [];
        foreach ($listURI as $key => $value) {
            if ($value == $listParams[$key]) continue;
            elseif (preg_match('/\{*\}/', $value)) {
                $value = preg_replace('/\{|\}/', '', $value);
                $options[$value] = $listParams[$key];
            } else return null;
        }
        return $options;
    }
    public static function get(string $uri, array $handler, $request): ?Responce
    {
        if ($request->getParams()) {
            $handleRoute = self::handleRoute($uri, $request->getParams()['url']);
            if ($handleRoute === null) return null;
            else $request->setOptionsUrl($handleRoute);
        }else if ($uri !== $_SERVER['REQUEST_URI']) return null;

        if ($_SERVER['REQUEST_METHOD'] !== 'GET')
            trigger_error("Method not allowed (GET method was expected)", E_USER_ERROR);

        $kernel = new Kernel();
        $response = $kernel->handle('GET', $uri, $handler, $request);

        return $response;
    }

    public static function post(string $uri, array $handler, $request): ?Responce
    {
        if ($request->getParams()) {
            $handleRoute = self::handleRoute($uri, $request->getParams()['url']);
            if ($handleRoute === null) return null;
            else $request->setOptionsUrl($handleRoute);
        }else if ($uri !== $_SERVER['REQUEST_URI']) return null;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            trigger_error("Method not allowed (POST method was expected)", E_USER_ERROR);

        $kernel = new Kernel();
        $response = $kernel->handle('POST', $uri, $handler, $request);

        return $response;
    }

    public static function not_found($uri, $request): Responce
    {
//        $response = new Responce('404 Not found', 404);
        $kernel = new Kernel();
        $response = $kernel->handle('GET', $uri, [NotFoundController::class, 'index'], $request);
        return $response;
    }
}