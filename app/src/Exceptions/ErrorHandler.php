<?php

namespace App\Exceptions;

class ErrorHandler
{
    public function register()
    {
        set_error_handler([$this, 'handleError']);
    }

    public function handleError(int $code, string $message, string $file, int $line, array $context = [])
    {
        return array($message, 0, $code, $file, $line, $context);
    }

}