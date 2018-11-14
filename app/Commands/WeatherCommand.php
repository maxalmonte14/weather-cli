<?php

namespace App\Commands;

use App\Http\HttpClientInterface;
use App\DTO\CityInformation;
use App\DTO\Weather;
use App\Parsers\JsonParser;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class WeatherCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'weather {city}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Get the weather for a city';

    /**
     * The HTTP client instance.
     *
     * @var \App\Http\HttpClientInterface
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cityResponse = $this->client->get(
            "https://www.metaweather.com/api/location/search/?query=".urlencode($this->argument('city'))
        );
        $cityData = JsonParser::parse($cityResponse);
        $cityInformation = new CityInformation(
            $cityData[0]['title'],
            $cityData[0]['location_type'],
            $cityData[0]['woeid'],
            $cityData[0]['latt_long']
        );

        $weatherResponse = $this->client->get("https://www.metaweather.com/api/location/{$cityInformation->woeid}/");
        $weatherData = JsonParser::parse($weatherResponse);
        $weather = new Weather(
            $weatherData['consolidated_weather'][0]['weather_state_name'],
            number_format($weatherData['consolidated_weather'][0]['min_temp'], 2),
            number_format($weatherData['consolidated_weather'][0]['max_temp'], 2),
            number_format($weatherData['consolidated_weather'][0]['the_temp'], 2)
        );

        $this->line(sprintf(
            '%s, Min temperature: %s, Max temperature: %s',
            $weather->stateName,
            $weather->minTemp,
            $weather->maxTemp
        ));
    }
}
