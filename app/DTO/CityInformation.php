<?php

namespace App\DTO;

class CityInformation
{
    public $title;
    public $locationType;
    public $woeid;
    public $lattLong;

    public function __construct($title, $locationType, $woeid, $lattLong)
    {
        $this->title = $title;
        $this->locationType = $locationType;
        $this->woeid = $woeid;
        $this->lattLong = $lattLong;
    }
}
