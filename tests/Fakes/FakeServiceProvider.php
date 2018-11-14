<?php

namespace Tests\Fakes;

use App\Http\HttpClientInterface;
use App\Providers\AppServiceProvider;

class FakeServiceProvider extends AppServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('App\Http\HttpClientInterface', function () {
            return new class implements HttpClientInterface
            {
                public function get(string $url): string
                {
                    if ($url == 'https://www.metaweather.com/api/location/search/?query=San+Diego') {
                        return $this->getCityInformationData();
                    }

                    if ($url == 'https://www.metaweather.com/api/location/2487889/') {
                        return $this->getWeatherData();
                    }
                }

                private function getCityInformationData()
                {
                    return '[{"title":"San Diego","location_type":"City","woeid":2487889,"latt_long":"32.715691,-117.161720"}]';
                }

                private function getWeatherData()
                {
                    return '{"consolidated_weather":[{"id":4866121622618112,"weather_state_name":"Thunderstorm","weather_state_abbr":"lc","wind_direction_compass":"NE","created":"2018-11-14T12:08:35.108768Z","applicable_date":"2018-11-14","min_temp":14.50000000,"max_temp":24.80000,"the_temp":19.075,"wind_speed":5.2266084718735915,"wind_direction":49.77025406533666,"air_pressure":1007.6800000000001,"humidity":21,"visibility":17.14238845144357,"predictability":70}]}';
                }
            };
        });
    }
}