<?php

namespace App\Parsers;

class JsonParser
{
    public static function parse(string $JSONString): array
    {
        return json_decode($JSONString, true);
    }
}
