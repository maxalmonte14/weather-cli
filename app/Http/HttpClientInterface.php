<?php

namespace App\Http;

interface HttpClientInterface
{
    public function get(string $url): string;
}
