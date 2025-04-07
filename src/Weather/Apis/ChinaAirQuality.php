<?php

namespace Weather\Apis;

use Weather\AbstractWeather;

class ChinaAirQuality extends AbstractWeather
{
    protected $apiConfig = [
        'juhe' => [
            'authField'=>'key',
            'authType'=>'query',
            'provinceList' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/provinces',
                'method' => 'GET',
            ],
            'cityList' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/citys',
                'method' => 'GET',
            ],
            'cityAirQuality' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/live',
                'method' => 'GET',
            ],
            'siteAirQuality' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/stations',
                'method' => 'GET',
            ],
            'daysAirQuality' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/history',
                'method' => 'GET',
            ],
            'hoursAirQuality' => [
                'url' => 'http://apis.juhe.cn/fapigw/air/historyHours',
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
