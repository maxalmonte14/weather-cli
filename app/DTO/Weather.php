<?php

namespace App\DTO;

class Weather
{
    public $stateName;
    public $minTemp;
    public $maxTemp;
    public $theTemp;

    public function __construct($stateName, $minTemp, $maxTemp, $theTemp)
    {
        $this->stateName = $stateName;
        $this->minTemp = $minTemp;
        $this->maxTemp = $maxTemp;
        $this->theTemp = $theTemp;
    }
}
