<?php

namespace App\Http;

class Responce
{
    public function __construct(
        private mixed $content,
        private int $status = 200,
        private array $headers = [],
    )
    {

    }

    public function render()
    {
        foreach ($this->headers as $key => $value) {
            header(sprintf('%s: %s', $key, $value));
        }
        http_response_code($this->status);
        echo $this->content;
    }
}