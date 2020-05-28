<?php

use Ramsey\Uuid\Uuid;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * 数组转json字符串(非json串)
 * @param $array
 * @return mixed
 */
function arrayValuesToJsonString($array)
{
    foreach ($array as $key => $val) {
        $array[$key] = (string)$val;
    }
    return $array;
}

/**
 * 解析异常信息
 * @param Exception $e
 * @return array
 */
function getExceptionMainInfo(Exception $e)
{
    return [
        "Code"    => $e->getCode(),
        "Message" => $e->getMessage(),
        "File"    => $e->getFile(),
        "Line"    => $e->getLine(),
    ];
}

/**
 * 记录日志
 * @param $logName
 * @return \Monolog\Logger
 */
function customerLoggerHandle($logName)
{
    $logName = $logName . "-" . exec('whoami');
    $log = new Logger($logName);
    $logFilePath = storage_path('logs') . "/" . $logName . ".log";
    $log->pushHandler(new RotatingFileHandler($logFilePath, 0, Logger::DEBUG));

    return $log;
}


/**
 * 金额 分转元
 * @param $fen
 * @return string
 */
function exchangeToYuan($fen)
{
    if ($fen == 0) {
        return 0;
    }
    return number_format($fen / 100, 2, ".", "");
}

/**
 * 金额 元转分
 * @param $yuan
 * @return string
 */
function exchangeToFen($yuan)
{
    if ($yuan == 0) {
        return 0;
    }
    return number_format($yuan * 100, 0, '.', '');
}

/**
 * 通用签名方法
 * @param array $data 签名数据
 * @param string $signKey 签名KEY
 * @return mixed
 */
function signServiceRequestData(array $data, string $signKey)
{
    unset($data['sign']);
    ksort($data);
    $sign = md5(customBuildQuery($data) . $signKey);

    return $sign;
}

/**
 * 签名字符串拼接
 * @param array $data
 * @return string
 */
function customBuildQuery(array $data)
{
    unset($data['sign']);
    ksort($data);
    $list = [];
    foreach ($data as $key => $value) {
        if (!is_null($value)) {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            } elseif (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $list[] = $key . "=" . $value;
        }
    }

    customerLoggerHandle("sign")->debug("sign", [join("&", $list)]);

    return join("&", $list);
}

/**
 * @return string
 * @throws Exception
 */
function generateNewUuid()
{
    return Uuid::uuid4()->toString();
}


function getAppUserUuid()
{
    $userUuid = auth('api')->user()->getAuthIdentifier();
    return $userUuid;
}

function getPhotoUrl($photoName)
{
    if (!empty($photoName)) {
        return url($photoName);
    } else {
        return "";
    }
}

function getRaiseSaleIndex($nowPrice, $topPrice)
{
    return 1000 + (($nowPrice / $topPrice) * 1000);
}

/**
 * 数据数组设置层级.
 *
 * @param array $category 数据数组.
 * @param int $parent_id 父级id.
 * @param int $level 层级id.
 *
 * @return array.
 */
function categoryTree($category, $parent_id = 0, $level = 0)
{
    static $res = array();
    foreach ($category as $v) {
        if ($v['parent_id'] == $parent_id) {
            $v['level'] = $level;
            $res[] = $v;
            categoryTree($category, $v['id'], $level + 1);
        }
    }
    return $res;
}



