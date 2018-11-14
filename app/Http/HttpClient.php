<?php

namespace App\Http;

class HttpClient implements HttpClientInterface
{
    public function get(string $url): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ]);

        return curl_exec($curl);
    }
}
