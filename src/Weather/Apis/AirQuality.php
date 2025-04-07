<?php

namespace Weather\Apis;

use Weather\AbstractWeather;

class AirQuality extends AbstractWeather
{
    protected $apiConfig = [
        'juhe' => [
            'authField' => 'key',
            'authType' => 'query',
            'cityAirQuality' => [
                'url' => 'http://web.juhe.cn/environment/air/cityair',
                'method' => 'GET',
            ],
            'cityList' => [
                'url' => 'http://web.juhe.cn/environment/air/airCities',
                'method' => 'GET',
            ],
            'cityAirPM' => [
                'url' => 'http://web.juhe.cn/environment/air/pm',
                'method' => 'GET',
            ],
            'pmCityList' => [
                'url' => 'http://web.juhe.cn/environment/air/pmCities',
                'method' => 'GET',
            ],
        ],
    ];
    protected $support = 'juhe';

    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function apiGetway(string $action, array $params = [], array $headers = []): array
    {
        $result = [
            'code' => 400,
            'reason' => '数据类型不正确',
            'result' => [],
        ];

        if ($config = ($this->apiConfig[$this->support][$action] ?? [])) {
            $result = $this->request($config['url'], $params, $headers, $config['method']);
        }

        return $result;
    }
}
