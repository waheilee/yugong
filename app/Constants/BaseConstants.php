<?php

namespace App\Constants;


class BaseConstants
{
    const DATA_TRUE = 1;
    const DATA_FALSE = 2;

    //默认分页数量
    const DEFAULT_PAGE_SIZE = 20;
    const DEFAULT_PAGE_NUM = 1;//默认页码
    const TIMEOUT = 50;

    const RETURN_SUCCESS = 10000;
    const RETURN_ERROR = 20000;
    const TOKEN_ERROR = 30000;

    const USER_STATUS_LOCK = 3;
    const USER_STATUS_NORMAL = 2;
    const USER_STATUS_INIT = 1;

    const USER_STATUS_MAP = [
        self::USER_STATUS_LOCK   => "锁定",
        self::USER_STATUS_NORMAL => "正常",
        self::USER_STATUS_INIT   => "待激活",
    ];


    const UP_PACKAGES = [
        ['packageName' => "A", 'level' => 0, 'title' => "普通用户(0元)", 'fruitCoin' => 0, 'seedCoin' => 0],
        ['packageName' => "B", 'level' => 1, 'title' => "一星套餐(1000元)", 'fruitCoin' => 500, 'seedCoin' => 500],
        ['packageName' => "C", 'level' => 2, 'title' => "二星套餐(2000元)", 'fruitCoin' => 1000, 'seedCoin' => 1000],
        ['packageName' => "D", 'level' => 3, 'title' => "三星套餐(5000元)", 'fruitCoin' => 2500, 'seedCoin' => 2500],
        ['packageName' => "E", 'level' => 4, 'title' => "四星套餐(10000元)", 'fruitCoin' => 5000, 'seedCoin' => 5000],
        ['packageName' => "F", 'level' => 5, 'title' => "五星套餐(20000元)", 'fruitCoin' => 10000, 'seedCoin' => 10000],
        ['packageName' => "G", 'level' => 6, 'title' => "六星套餐(50000元)", 'fruitCoin' => 25000, 'seedCoin' => 25000],
        ['packageName' => "H", 'level' => 7, 'title' => "七星套餐(100000元)", 'fruitCoin' => 50000, 'seedCoin' => 50000],
        ['packageName' => "I", 'level' => 8, 'title' => "八星套餐(200000元)", 'fruitCoin' => 100000, 'seedCoin' => 100000],
        ['packageName' => "J", 'level' => 9, 'title' => "九星套餐(400000元)", 'fruitCoin' => 200000, 'seedCoin' => 200000]
    ];

    const USER_LEVEL_0_STAR = 0;
    const USER_LEVEL_1_STAR = 1;
    const USER_LEVEL_2_STAR = 2;
    const USER_LEVEL_3_STAR = 3;
    const USER_LEVEL_4_STAR = 4;
    const USER_LEVEL_5_STAR = 5;
    const USER_LEVEL_6_STAR = 6;
    const USER_LEVEL_7_STAR = 7;
    const USER_LEVEL_8_STAR = 8;
    const USER_LEVEL_9_STAR = 9;


    const USER_LEVEL_MAP = [
        self::USER_LEVEL_0_STAR => "普通用户",
        self::USER_LEVEL_1_STAR => "一星",
        self::USER_LEVEL_2_STAR => "二星",
        self::USER_LEVEL_3_STAR => "三星",
        self::USER_LEVEL_4_STAR => "四星",
        self::USER_LEVEL_5_STAR => "五星",
        self::USER_LEVEL_6_STAR => "六星",
        self::USER_LEVEL_7_STAR => "七星",
        self::USER_LEVEL_8_STAR => "八星",
        self::USER_LEVEL_9_STAR => "九星",
    ];

    const USER_LEVEL_REWARD_MAP = [
        self::USER_LEVEL_0_STAR => 0,
        self::USER_LEVEL_1_STAR => 5,
        self::USER_LEVEL_2_STAR => 6,
        self::USER_LEVEL_3_STAR => 7,
        self::USER_LEVEL_4_STAR => 9,
        self::USER_LEVEL_5_STAR => 10,
        self::USER_LEVEL_6_STAR => 11,
        self::USER_LEVEL_7_STAR => 16,
        self::USER_LEVEL_8_STAR => 18,
        self::USER_LEVEL_9_STAR => 20,
    ];

    const USER_DUTY_LEVEL_XIAOFEISHANG = 0; //消费商

    const USER_DUTY_LEVEL_QUYUJINGLI = 1;//区域经理
    const USER_DUTY_LEVEL_QUYUZONGJIAN = 2;//区域总监
    const USER_DUTY_LEVEL_LONGYAODIANZHANG = 3;//龙耀店长

    const USER_DUTY_LEVEL_SHIJIDAILI = 4;//市级代理
    const USER_DUTY_LEVEL_SHENGJIDAILI = 5;//省级代理
    const USER_DUTY_LEVEL_QUYUZONGCAI = 6;//区域总裁

    const USER_DUTY_LEVEL_CELUEWEIYUAN = 7;//策略委员
    const USER_DUTY_LEVEL_ZHANLUEWEIYUAN = 8;//战略委员
    const USER_DUTY_LEVEL_ZHIXINGDONGSHI = 9;//执行董事

    const USER_DUTY_MAP = [//shop_level
                           self::USER_DUTY_LEVEL_XIAOFEISHANG     => "消费商",
                           self::USER_DUTY_LEVEL_QUYUJINGLI       => "区域经理",
                           self::USER_DUTY_LEVEL_QUYUZONGJIAN     => "区域总监",
                           self::USER_DUTY_LEVEL_LONGYAODIANZHANG => "龙耀店长",
                           self::USER_DUTY_LEVEL_SHIJIDAILI       => "市级代理",
                           self::USER_DUTY_LEVEL_SHENGJIDAILI     => "省级代理",
                           self::USER_DUTY_LEVEL_QUYUZONGCAI      => "区域总裁",
                           self::USER_DUTY_LEVEL_CELUEWEIYUAN     => "策略委员",
                           self::USER_DUTY_LEVEL_ZHANLUEWEIYUAN   => "战略委员",
                           self::USER_DUTY_LEVEL_ZHIXINGDONGSHI   => "执行董事"
    ];

    const USER_DUTY_REWARD_MAP = [
        self::USER_DUTY_LEVEL_XIAOFEISHANG     => 0,
        self::USER_DUTY_LEVEL_QUYUJINGLI       => 3,
        self::USER_DUTY_LEVEL_QUYUZONGJIAN     => 6,
        self::USER_DUTY_LEVEL_LONGYAODIANZHANG => 9,
        self::USER_DUTY_LEVEL_SHIJIDAILI       => 11,
        self::USER_DUTY_LEVEL_SHENGJIDAILI     => 13,
        self::USER_DUTY_LEVEL_QUYUZONGCAI      => 15,
        self::USER_DUTY_LEVEL_CELUEWEIYUAN     => 16,
        self::USER_DUTY_LEVEL_ZHANLUEWEIYUAN   => 17,
        self::USER_DUTY_LEVEL_ZHIXINGDONGSHI   => 18
    ];

    const SHOP_LEVEL_DEFAULT = 0;
    const SHOP_LEVEL_HEZUODIAN = 1;
    const SHOP_LEVEL_SHEQUDIAN = 2;
    const SHOP_LEVEL_ZHUANMAIDIAN = 3;
    const SHOP_LEVEL_TEYUESHANG = 4;

    const SHOP_LEVEL_MAP = [//store_level
                            self::SHOP_LEVEL_DEFAULT      => "未开通",
                            self::SHOP_LEVEL_HEZUODIAN    => "合作店",
                            self::SHOP_LEVEL_SHEQUDIAN    => "社区店",
                            self::SHOP_LEVEL_ZHUANMAIDIAN => "专卖店",
                            self::SHOP_LEVEL_TEYUESHANG   => "特约经销商"
    ];

    const SHOP_LEVEL_REWARD_MAP = [
        self::SHOP_LEVEL_DEFAULT      => 0,
        self::SHOP_LEVEL_HEZUODIAN    => 1,
        self::SHOP_LEVEL_SHEQUDIAN    => 3,
        self::SHOP_LEVEL_ZHUANMAIDIAN => 5,
        self::SHOP_LEVEL_TEYUESHANG   => 5
    ];

    const MARKET_TYPE_MEMBER = 1;
    const MARKET_TYPE_VIP = 2;

    const MARKET_TYPE_MAP = [
        self::MARKET_TYPE_MEMBER => "会员市场",
        self::MARKET_TYPE_VIP    => "专卖市场",

    ];

    const FRUIT_ORDER_STATUS_INIT = 0;
    const FRUIT_ORDER_STATUS_DONE = 1;
    const FRUIT_ORDER_STATUS_CANCEL = 2;

    const FRUIT_ORDER_STATUS_MAP = [
        self::FRUIT_ORDER_STATUS_INIT   => "挂售中",
        self::FRUIT_ORDER_STATUS_DONE   => "交易完成",
        self::FRUIT_ORDER_STATUS_CANCEL => "交易取消",

    ];

    const CASH_OUT_STATUS_INIT = 0;
    const CASH_OUT_STATUS_WAIT_PAY = 1;
    const CASH_OUT_STATUS_DONE = 2;
    const CASH_OUT_STATUS_CLOSE = 3;

    const CASH_OUT_STATUS_MAP = [
        self::CASH_OUT_STATUS_INIT     => "申请中",
        self::CASH_OUT_STATUS_WAIT_PAY => "待付款",
        self::CASH_OUT_STATUS_DONE     => "已完成",
        self::CASH_OUT_STATUS_CLOSE    => "已取消",

    ];


    const COIN_TYPE_MAP = [
        'fruit'       => "众筹果实",
        'seed'        => "激活种子",
        'mallPoint'   => "商城积分",
        'buyPoint'    => "购酒积分",
        'wealthPoint' => "财富基金",
    ];

    const COIN_TYPE_ID_FRUIT = 1;
    const COIN_TYPE_ID_SEED = 2;
    const COIN_TYPE_ID_MALL_POINT = 3;
    const COIN_TYPE_ID_BUY_POINT = 4;
    const COIN_TYPE_ID_WEALTH_POINT = 5;

    const COIN_TYPE_ID_MAP = [
        self::COIN_TYPE_ID_FRUIT        => "众筹果实",
        self::COIN_TYPE_ID_SEED         => "激活种子",
        self::COIN_TYPE_ID_MALL_POINT   => "商城积分",
        self::COIN_TYPE_ID_BUY_POINT    => "购酒积分",
        self::COIN_TYPE_ID_WEALTH_POINT => "财富基金",
    ];

    const COIN_TYPE_TO_ID_MAP = [
        'fruit'       => self::COIN_TYPE_ID_FRUIT,
        'seed'        => self::COIN_TYPE_ID_SEED,
        'mallPoint'   => self::COIN_TYPE_ID_MALL_POINT,
        'buyPoint'    => self::COIN_TYPE_ID_BUY_POINT,
        'wealthPoint' => self::COIN_TYPE_ID_WEALTH_POINT,
    ];

    const GOODS_STATUS_CLOSE = 0;
    const GOODS_STATUS_OPEN = 1;

    const GOODS_STATUS_MAP = [
        self::GOODS_STATUS_CLOSE => "已下架",
        self::GOODS_STATUS_OPEN  => "销售中"
    ];


    const RAISE_STATUS_OPEN = 1;
    const RAISE_STATUS_SHOP = 2;
    const RAISE_STATUS_CLOSE = 3;

    const RAISE_STATUS_MAP = [
        self::RAISE_STATUS_OPEN  => "开启中",
        self::RAISE_STATUS_SHOP  => "暂停中",
        self::RAISE_STATUS_CLOSE => "已结束",
    ];

    const RAISE_UN_JOIN_STATUS_WAIT = 1;
    const RAISE_UN_JOIN_STATUS_CLEAN = 2;

    const ORDER_STATUS_INIT = 0;
    const ORDER_STATUS_PAY = 1;
    const ORDER_STATUS_CLOSE = 2;
    const ORDER_STATUS_WAIT_FOR_DELIVERY = 3;
    const ORDER_STATUS_DELIVERY = 4;
    const ORDER_STATUS_DONE = 5;
    const ORDER_STATUS_REFUND = 6;
    const ORDER_STATUS_REFUND_DONE = 7;
    const ORDER_STATUS_RETURN_GOODS = 8;
    const ORDER_STATUS_RETURN_GOODS_DONE = 9;


    const ORDER_STATUS_MAP = [
        self::ORDER_STATUS_INIT              => "待支付",
        self::ORDER_STATUS_PAY               => "支付成功,未确认",
        self::ORDER_STATUS_CLOSE             => "已取消",
        self::ORDER_STATUS_WAIT_FOR_DELIVERY => "商家已确认,待发货",
        self::ORDER_STATUS_DELIVERY          => "已发货",
        self::ORDER_STATUS_DONE              => "订单已完成",
        self::ORDER_STATUS_REFUND            => "退款中",
        self::ORDER_STATUS_REFUND_DONE       => "已退款",
        self::ORDER_STATUS_RETURN_GOODS      => "换货中",
        self::ORDER_STATUS_RETURN_GOODS_DONE => "已完成换货",
    ];

    const BRANCH_MANAGE_OFFICE_NULL = '';
    const BRANCH_MANAGE_OFFICE_DONGBEI = 1;
    const BRANCH_MANAGE_OFFICE_HUABEI = 2;
    const BRANCH_MANAGE_OFFICE_HUAZHONG = 3;
    const BRANCH_MANAGE_OFFICE_HUADONG = 4;
    const BRANCH_MANAGE_OFFICE_HUANAN = 5;
    const BRANCH_MANAGE_OFFICE_XIBEI = 6;
    const BRANCH_MANAGE_OFFICE_XINAN = 7;

    const BRANCH_MANAGE_OFFICE_MAP = [
        self::BRANCH_MANAGE_OFFICE_NULL     => '',
        self::BRANCH_MANAGE_OFFICE_DONGBEI  => "东北地区",
        self::BRANCH_MANAGE_OFFICE_HUABEI   => "华北地区",
        self::BRANCH_MANAGE_OFFICE_HUAZHONG => "华中地区",
        self::BRANCH_MANAGE_OFFICE_HUADONG  => "华东地区",
        self::BRANCH_MANAGE_OFFICE_HUANAN   => "华南地区",
        self::BRANCH_MANAGE_OFFICE_XIBEI    => "西北地区",
        self::BRANCH_MANAGE_OFFICE_XINAN    => "西南地区",
    ];

    const AREA_OPERATE_NULL = '';
    const AREA_OPERATE_REGION = 1;
    const AREA_OPERATE_PROVINCE = 2;
    const AREA_OPERATE_CITY = 3;

    const AREA_OPERATE_MAP = [
        self::AREA_OPERATE_NULL     => '',
        self::AREA_OPERATE_REGION   => '大区运营',
        self::AREA_OPERATE_PROVINCE => '省分公司',
        self::AREA_OPERATE_CITY     => '市分公司',
    ];

    const AREA_OPERATE_REWARD_MAP = [
        self::AREA_OPERATE_NULL     => 0,
        self::AREA_OPERATE_REGION   => 2,
        self::AREA_OPERATE_PROVINCE => 3,
        self::AREA_OPERATE_CITY     => 5,
    ];

    const ADMINS_STATUS_NORMAL = 0;
    const ADMINS_STATUS_LOCK = 1;

    const ADMINS_STATUS_MAP = [
        self::ADMINS_STATUS_NORMAL => '正常',
        self::ADMINS_STATUS_LOCK   => '锁定',
    ];


    const COURIER_STATUS_FIRST = 0;
    const COURIER_STATUS_EXCHANGE = 1;

    const COURIER_STATUS_MAP = [
        self::COURIER_STATUS_FIRST    => '正常发货',
        self::COURIER_STATUS_EXCHANGE => '换货',
    ];


    const RECEIVE_LIQUOR_STATUS_INIT = 1;
    const RECEIVE_LIQUOR_STATUS_DONE = 2;

    const RECEIVE_LIQUOR_STATUS_MAP = [
        self::RECEIVE_LIQUOR_STATUS_INIT => "未领酒",
        self::RECEIVE_LIQUOR_STATUS_DONE => "已领酒",
    ];

    const SMS_SEND_STATUS_INIT = 1;
    const SMS_SEND_STATUS_DONE = 2;
    const SMS_SEND_STATUS_ERROR = 3;

    const SMS_SEND_STATUS_MAP = [
        self::SMS_SEND_STATUS_INIT  => '未确认',
        self::SMS_SEND_STATUS_DONE  => '发送成功',
        self::SMS_SEND_STATUS_ERROR => '发送失败',
    ];

    const SMS_SEND_TYPE_VC = 1;
    const SMS_SEND_TYPE_NOTIFY = 2;

}