# 常用天气接口
> 整理常用的天气接口，方便使用，整整合兼容多平台天气接口。目前仅支持聚合数据的天气接口。

## 简介
> 全国城市和站点空气质量查询，污染物浓度及空气质量分指数、空气质量指数、首要污染物及空气质量级别、健康指引及建议采取的措施等。
> 中国气象局权威数据，全国 3000 多个省市的实时天气预报，未来 7 天天气、温度、穿衣、运动、洗车、旅游、紫外线等指数查询接口，可按城市名或城市 ID 查询。

## 安装

```
composer requeire jhapis/weather
```

## 一、天气数据系列接口
> 数据源：[聚合数据](https://www.juhe.cn/docs?s=utm_id55)
> 接口请求 key,在个人中心->数据中心->我的 API 进行查看

### 【免费】全国城市空气质量

> [免费】全国城市空气质量](https://www.juhe.cn/docs/api/id/796?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【全国城市空气质量】官方文档](https://www.juhe.cn/docs/api/id/796?s=utm_id55)

- 示例

```php
use Weather\Apis\Weather;

require_once './vendor/autoload.php';
$wether = new ChinaAirQuality(['key' => '聚合接口申请Key']);

// 支持省份列表
$result = $wether->apiGetway('provinceList');
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 省份支持城市城市:省份列表ID
$params = ['pId' => 10];
$result = $wether->apiGetway('cityList', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

//城市实时空气质量
$params = ['cityId' => 1];
$result = $wether->apiGetway('cityAirQuality', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 城市站点实时空气质量
$params = ['cityId' => 1];
$result = $wether->apiGetway('siteAirQuality', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 城市，近14天空气质量
$params = ['cityId' => 1];
$result = $wether->apiGetway('daysAirQuality', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 城市，近24小时空气质量
$params = ['cityId' => 1];

$result = $wether->apiGetway('hoursAirQuality',$params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

```

- 返回

```json
// 城市实时空气质量
{
  "reason": "success",
  "result": {
    "Id": "73",
    "CityName": "苏州市",
    "CityCode": "320500",
    "CityJC": "SZS",
    "CO": "0.8",
    "NO2": "19",
    "O3": "106",
    "PM10": "37",
    "PM2_5": "26",
    "SO2": "6",
    "AQI": "38",
    "Quality": "优",
    "PrimaryPollutant": "—",
    "Measure": "各类人群可正常活动",
    "Unheathful": "空气质量令人满意，基本无空气污染",
    "Latitude": "31.3010181818182",
    "Longitude": "120.612236363636"
  },
  "error_code": 0
}
```

### 【免费】天气预报

> [【免费】天气预报](https://www.juhe.cn/docs/api/id/73?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【天气预报】官方文档查看](https://www.juhe.cn/docs/api/id/73?s=utm_id55)

- 示例：

```php
use Weather\Apis\Weather;

require_once './vendor/autoload.php';
$wether = new Weather(['key' => '聚合接口申请Key']);

$params = ['city' => '苏州'];
$result = $wether->apiGetway('cityWeather', $params);
var_dump($result);

$params = ['city' => '苏州'];
$result = $wether->apiGetway('eatherIndex', $params);
var_dump($result);

// 天气种类列表
$result = $wether->apiGetway('weatherType');
var_dump($result);

```

- 返回示例：

```json
// 城市天气
{
	"reason": "查询成功!",
	"result": {
		"city": "苏州",
		"realtime": {
			"temperature": "32",
			"humidity": "33",
			"info": "晴",
			"wid": "00",
			"direct": "南风",
			"power": "3级",
			"aqi": "114"
		},
		"future": [{
			"date": "2025-03-26",
			"temperature": "21\/32℃",
			"weather": "晴转中雨",
			"wid": {
				"day": "00",
				"night": "08"
			},
			"direct": "南风转西南风"
		},
        ....
        ]
	},
	"error_code": 0
}
```

### 【免费】历史天气查询

> [【【免费】历史天气查询](https://www.juhe.cn/docs/api/id/716?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【历史天气查询】官方文档](https://www.juhe.cn/docs/api/id/716?s=utm_id55)

- 示例

```php
use Weather\Apis\Weather;

require_once './vendor/autoload.php';
$wether = new HistoryWeatherQuery(['key' => '聚合接口申请Key']);

// 支持省份查询
$result = $wether->apiGetway('provinceList');
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 支持城市查询
$params = ['province_id' => 16];
$result = $wether->apiGetway('cityList', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 历史天气查询
$params = ['city_id' => 1145,'weather_date'=>'2011-01-01'];

$result = $wether->apiGetway('historyWeather',$params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";
```

- 返回示例

```json
// 历史天气查询结果:具体返回错误码，请查看官方文档
{
    "reason": "查询成功",
    "result": {
        "city_id": "123",
        "city_name": "南靖",
        "weather_date": "2022-01-01",
        "day_weather": "多云",
        "night_weather": "雾",
        "day_temp": "20℃",
        "night_temp": "10℃",
        "day_wind": "东风",
        "day_wind_comp": "3-4级",
        "night_wind": "东风",
        "night_wind_comp": "<3级",
        "day_weather_id": "01",
        "night_weather_id": "18"
    },
    "error_code": 0
}
```


### 【付费】空气质量

> [【付费】空气质量](https://www.juhe.cn/docs/api/id/33?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【空气质量】官方文档查看](https://www.juhe.cn/docs/api/id/33?s=utm_id55)

- 示例

```php

$wether = new AirQuality(['key' => '聚合接口申请Key']);

// 城市空气质量
$params = ['city' => '苏州'];
$result = $wether->apiGetway('cityAirQuality', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 支持城市列表
$result = $wether->apiGetway('cityList');
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 城市空气质量PM2。5
$params = ['city' => '苏州'];
$result = $wether->apiGetway('cityAirPM', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// pm支持城市
$result = $wether->apiGetway('pmCityList');
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

```

- 返回示例

```json
// 空气质量PM2.5
{
  "resultcode": "200",
  "reason": "SUCCESSED!",
  "result": [
    {
      "city": "苏州",
      "PM2.5": "50",
      "AQI": "114",
      "quality": "轻度污染",
      "PM10": "90",
      "CO": "0.0",
      "NO2": "23",
      "O3": "229",
      "SO2": "9",
      "time": "2025-03-26 16:51:13"
    }
  ],
  "error_code": 0
}
```

### 【付费】全国天气预报

> [【付费】全国天气预报](https://www.juhe.cn/docs/api/id/39?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【全国天气预报】官方文档查看](https://www.juhe.cn/docs/api/id/33?s=utm_id55)

- 示例
```php
use Weather\Apis\Weather;

require_once './vendor/autoload.php';
// 全国天气预报
$wether = new ChinaWeather(['key' => '聚合接口申请Key']);

// 支持城市列表
$citys = $wether->apiGetway('citys');
echo json_encode($citys, JSON_UNESCAPED_UNICODE)."\n\n";

// 天气种类及标识列表
$weatherTips = $wether->apiGetway('weatherTips');
echo json_encode($weatherTips, JSON_UNESCAPED_UNICODE)."\n\n";

// 根据城市名称或城市ID查询天气
$params = ['cityname' => '苏州'];
$params = ['cityname' => '1145'];
$result = $wether->apiGetway('cityWeather', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";
```
- 返回示例
```json
// 全国天气预报
{
    "resultcode": "200",
    "reason": "查询成功",
    "result": {
        "sk": {
            "temp": "14",
            "wind_direction": "东南风",
            "wind_strength": "2级",
            "humidity": "11%",
            "time": "11:05"
        },
        "today": {
            "temperature": "2℃~17℃",
            "weather": "多云转晴",
            "weather_id": {
                "fa": "01",
                "fb": "00"
            },
            "wind": "北风4-5级",
            "week": "星期一",
            "city": "永昌",
            "date_y": "2025年04月07日",
            "dressing_index": "冷",
            "dressing_advice": "天气冷，建议着棉服、羽绒服、皮夹克加羊毛衫等冬季服装。年老体弱者宜着厚棉衣、冬大衣或厚羽绒服。",
            "uv_index": "中等",
            "comfort_index": "",
            "wash_index": "较不宜",
            "travel_index": "较适宜",
            "exercise_index": "较适宜",
            "drying_index": ""
        },
        "future": {
            "day_20250407": {
                "temperature": "2℃~17℃",
                "weather": "多云转晴",
                "weather_id": {
                    "fa": "01",
                    "fb": "00"
                },
                "wind": "北风4-5级",
                "week": "星期一",
                "date": "20250407"
            },
            ....
            "day_20250413": {
                "temperature": "6℃~16℃",
                "weather": "晴转多云",
                "weather_id": {
                    "fa": "00",
                    "fb": "01"
                },
                "wind": "西北风3-5级",
                "week": "星期日",
                "date": "20250413"
            }
        }
    },
    "error_code": 0
}
```
### 【付费】历史天气

> [【付费】历史天气](https://www.juhe.cn/docs/api/id/277?s=utm_id55)
> 具体接口的请求参数、返回参数，请至[【历史天气】官方文档查看](https://www.juhe.cn/docs/api/id/33?s=utm_id55)

- 示例

```php
use Weather\Apis\Weather;

require_once './vendor/autoload.php';
$wether = new HistoryWeather(['key' => '聚合接口申请Key']);

// 支持省份查询
$result = $wether->apiGetway('provinceList');
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 支持城市查询
$params = ['province_id' => 16];
$result = $wether->apiGetway('cityList', $params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";

// 历史天气查询
$params = ['city_id' => 1145,'weather_date'=>'2011-01-01'];

$result = $wether->apiGetway('historyWeather',$params);
echo json_encode($result, JSON_UNESCAPED_UNICODE)."\n\n";
```

- 返回示例

```json
// 历史天气查询结果
{
  "reason": "查询成功",
  "result": {
    "city_id": "1145",
    "city_name": "南京",
    "weather_date": "2011-01-01",
    "day_weather": "晴",
    "night_weather": "晴",
    "day_temp": "4℃",
    "night_temp": "-4℃",
    "day_wind": "北风",
    "day_wind_comp": "3-4级",
    "night_wind": "东北风",
    "night_wind_comp": "4-5级",
    "day_weather_id": "00",
    "night_weather_id": "00"
  },
  "error_code": 0
}
```
