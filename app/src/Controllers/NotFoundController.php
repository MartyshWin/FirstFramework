<?php

namespace App\Controllers;

use App\Http\Responce;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class NotFoundController
{
    public function index($method, $request)
    {
        $loader = new FilesystemLoader(APP_PATH.'/resources/views');
        $twig = new Environment($loader);
        $template = $twig->load('not_found.twig');

        $html = $template->render([
            'variable' => '404'
        ]);
        return new Responce($html, 404, ['Content-Type' => 'text/html']);
    }
}