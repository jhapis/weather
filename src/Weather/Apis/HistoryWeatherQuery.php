<?php

namespace Weather\Apis;

use Weather\AbstractWeather;

class HistoryWeatherQuery extends AbstractWeather
{
    protected $apiConfig = [
        'juhe' => [
            'authField'=>'key',
            'authType'=>'query',
            'provinceList' => [
                'url' => 'http://v.juhe.cn/hisWeather/province',
                'method' => 'GET',
            ],
            'cityList' => [
                'url' => 'http://v.juhe.cn/hisWeather/citys',
                'method' => 'GET',
            ],
            'historyWeather' => [
                'url' => 'http://v.juhe.cn/hisWeather/weather',
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
