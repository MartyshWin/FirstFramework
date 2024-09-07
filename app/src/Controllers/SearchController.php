<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Responce;

class SearchController
{
    public function getDate($method, Request $request): Responce
    {
        $data = $request->getRawData();

        if (!$data)
            $data = $request->getPOST();
        if (!$data)
            $data = $request->getParams();

        return new Responce(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }
}