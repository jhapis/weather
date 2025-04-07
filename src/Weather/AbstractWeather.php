<?php

namespace Weather;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractWeather
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $config;

    protected $support = 'juhe';

    /**
     * AbstractWeather constructor.
     */
    public function __construct(array $config, $support = 'juhe')
    {
        $this->config = $config;
        $this->support = $support;
        if (!($this->apiConfig[$support] ?? null)) {
            return [
                'code' => 400,
                'reason' => '数据源不存在',
                'result' => [],
            ];
        }

        $this->httpClient = new Client([
            'timeout' => 5.0,
            'verify' => false,
        ]);
    }

    /**
     * 发送HTTP请求
     *
     * @throws GuzzleException
     */
    protected function request(string $url, array $params = [], array $headers = [], string $method = 'GET'): array
    {
        $key = $this->apiConfig[$this->support]['authField'] ?? 'key';
        $authType = $this->apiConfig[$this->support]['authType'] ?? 'query';
        if ('query' === $authType) {
            $params = array_merge([$key => $this->getConfig('key', '')], $params);
        } elseif ('header' === $authType) {
            $headers[$key] = $this->getConfig('key', '');
        } elseif ('bearer' === strtolower($authType)) {
            $headers['Authorization'] = $this->getConfig('key', '');
        }

        $options = ['query' => $params];

        if ('POST' === $method) {
            $options = ['form_params' => $params];
        }

        $options['headers'] = array_merge([], $headers);

        try {

            $response = $this->httpClient->request($method, $url, $options);
            $content = $response->getBody()->getContents();

            return $this->formatResponse($content);
        } catch (GuzzleException $e) {
            return $this->formatException($e);
        }
    }

    /**
     * 格式化响应数据.
     */
    protected function formatResponse(string $content): array
    {
        // 自定义处理请求响应数据格式
        if ($method = $this->getConfig('customFormatRespons')) {
            return $this->{$method}($content);
        }

        return json_decode($content, true);
    }

    /**
     * 获取配置项.
     */
    protected function getConfig(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    protected function formatException(GuzzleException $e): array
    {
        // 自定义处理异常信息
        if ($method = $this->getConfig('customFormatException')) {
            return $this->{$method}($e);
        }

        return [
            'code' => 500,
            'reason' => '请求异常',
            'result' => [
                'errcoed' => $e->getCode(),
                'errmsg' => $e->getMessage(),
            ],
        ];
    }

    abstract public function apiGetway(string $action, array $params): array;
}
