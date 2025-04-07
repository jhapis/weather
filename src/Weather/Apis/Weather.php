<?php

namespace Weather\Apis;

use Weather\AbstractWeather;

class Weather extends AbstractWeather
{
    protected $apiConfig = [
        'juhe' => [
            'authField' => 'key',
            'authType' => 'query',
            'cityWeather' => [
                'url' => 'http://apis.juhe.cn/simpleWeather/query',
                'method' => 'GET',
            ],
            'weatherIndex' => [
                'url' => 'http://apis.juhe.cn/simpleWeather/life',
                'method' => 'GET',
            ],
            'weatherType' => [
                'url' => 'http://apis.juhe.cn/simpleWeather/wids',
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
