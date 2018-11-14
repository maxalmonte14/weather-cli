<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;

class WeatherCommandTest extends TestCase
{
    /** @test */
    public function it_can_get_the_weather()
    {
        // $mock = Mockery::mock(App\Http\HttpClientInterface::class);

        // $mock->shouldReceive('get')
        //     ->once()
        //     ->with('https://www.metaweather.com/api/location/search/?query=San+Diego')
        //     ->andReturn('[{"title":"San Diego","location_type":"City","woeid":2487889,"latt_long":"32.715691,-117.161720"}]');
        // $mock->shouldReceive('get')
        //     ->once()
        //     ->with('https://www.metaweather.com/api/location/2487889/')
        //     ->andReturn('{"consolidated_weather":[{"id":4866121622618112,"weather_state_name":"Thunderstorm","weather_state_abbr":"lc","wind_direction_compass":"NE","created":"2018-11-14T12:08:35.108768Z","applicable_date":"2018-11-14","min_temp":14.50000000,"max_temp":24.80000,"the_temp":19.075,"wind_speed":5.2266084718735915,"wind_direction":49.77025406533666,"air_pressure":1007.6800000000001,"humidity":21,"visibility":17.14238845144357,"predictability":70}]}');

        // $this->app->instance(App\Http\HttpClientInterface::class, new class implements \App\Http\HttpClientInterface
        //     {
        //         private $responses = [
        //             'https://www.metaweather.com/api/location/search/?query=San+Diego' => '[{"title":"San Diego","location_type":"City","woeid":2487889,"latt_long":"32.715691,-117.161720"}]',

        //             'https://www.metaweather.com/api/location/2487889/' => '{"consolidated_weather":[{"id":4866121622618112,"weather_state_name":"Thunderstorm","weather_state_abbr":"lc","wind_direction_compass":"NE","created":"2018-11-14T12:08:35.108768Z","applicable_date":"2018-11-14","min_temp":14.50000000,"max_temp":24.80000,"the_temp":19.075,"wind_speed":5.2266084718735915,"wind_direction":49.77025406533666,"air_pressure":1007.6800000000001,"humidity":21,"visibility":17.14238845144357,"predictability":70}]}'
        //         ];

        //         public function get(string $url): string
        //         {
        //             return $this->responses[$url];
        //         }
        // });

        $this->artisan('weather', ['city' => 'San Diego'])
             ->expectsOutput('Thunderstorm, Min temperature: 14.50, Max temperature: 24.80')
             ->assertExitCode(0);
    }
}
