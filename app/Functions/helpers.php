<?php

use Ramsey\Uuid\Uuid;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use App\Exceptions\ServiceException;
use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Models\ServiceUserModel;
use App\Models\Video;
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
    $userUuid = auth('api')->id();
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

/**
 * @return ServiceUserModel|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
 */
function getAppUserModel()
{
    $id = getAppUserUuid();
    $appUser = ServiceUserModel::whereId($id)->first();
    if (!$appUser) {
        throw new ServiceException(ErrorMsgConstants::TOKEN_ERROR,
            "获取用户信息失败!请重新登录!");
    }

//    if ($appUser->status != BaseConstants::USER_STATUS_NORMAL) {
//        throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR,
//            "用户状态异常,当前状态:" . BaseConstants::USER_STATUS_MAP[$appUser->status]);
//    }

    return $appUser;
}

/**
 * 获取题库信息  返回每种题型下的试题个数和每种题型中每道题的分数
 * @param $data
 * @return array
 */
function getDataInfo($data){
    $count = [];            //保存某种题型的题目数量
    $score = [];            //每道题的分值

    foreach ($data as $k=>$v) {
        if (!empty($v['data'])){
            $count[$k]=count($v['data']);
            $score[$k]=round($v['score']/$count[$k]);
        }
    }

    return [$count,$score];         //使用list()接收返回值：list($count,$score);顺序依次对应
}

function getSectionList($sections)
{
    $data = [];
    foreach ($sections as $section){
        $video = Video::whereSectionId($section->id)->get(['id','title','url']);
        $item = [];
        $item['section_title'] = $section->title;
        $item['videos'] = $video;
        $data[] = $item;
    }
    return $data;
}
