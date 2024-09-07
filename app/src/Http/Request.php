<?php

namespace App\Http;

class Request
{
    public function __construct(
        private readonly array $Params,
        private readonly array $POST,
        private readonly array $Cookies,
        private readonly array $Files,
        private readonly array $Server,
        private readonly string $RawData,
        private array $OptionsUrl,
    )
    {

    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER, file_get_contents('php://input'), []);
    }

    public function getParams(): array
    {
        return $this->Params;
    }

    public function getPOST(): array
    {
        return $this->POST;
    }

    public function getServer(): array
    {
        return $this->Server;
    }

    public function getCookies(): array
    {
        return $this->Cookies;
    }

    public function getFiles(): array
    {
        return $this->Files;
    }

    public function getRawData(): string
    {
        return $this->RawData;
    }

    public function getOptionsUrl(): array
    {
        return $this->OptionsUrl;
    }

    public function setOptionsUrl(array $data): array
    {
        $this->OptionsUrl = $data;
        return $data;
    }

}