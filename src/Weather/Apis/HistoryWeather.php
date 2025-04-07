<?php

namespace Weather\Apis;

use Weather\AbstractWeather;

class HistoryWeather extends AbstractWeather
{
    protected $apiConfig = [
        'juhe' => [
            'authField'=>'key',
            'authType'=>'query',
            'provinceList' => [
                'url' => 'http://v.juhe.cn/historyWeather/province',
                'method' => 'GET',
            ],
            'cityList' => [
                'url' => 'http://v.juhe.cn/historyWeather/citys',
                'method' => 'GET',
            ],
            'historyWeather' => [
                'url' => 'http://v.juhe.cn/historyWeather/weather',
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
