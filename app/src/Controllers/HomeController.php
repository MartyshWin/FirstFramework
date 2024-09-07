<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Responce;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    public function index($method, Request $request)
    {
        $loader = new FilesystemLoader(APP_PATH.'/resources/views');
        $twig = new Environment($loader, ['debug' => true,]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $template = $twig->load('home.twig');

//        dd($request);

        $html = $template->render([
            'title' => 'Главная',
            'request' => $request
        ]);
        return new Responce($html, 200, ['Content-Type' => 'text/html']);
    }
}