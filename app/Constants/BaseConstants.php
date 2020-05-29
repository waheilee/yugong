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

    const GOODS_STATUS_CLOSE = 0;
    const GOODS_STATUS_OPEN = 1;

    const GOODS_STATUS_MAP = [
        self::GOODS_STATUS_CLOSE => "已下架",
        self::GOODS_STATUS_OPEN  => "销售中"
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


    const POLICY_TYPE_AIR      =1;
    const POLICY_TYPE_EMPLOYER =2;
    const POLICY_TYPE_MAP = [
        self::POLICY_TYPE_AIR                    => "空气治理责任险",
        self::POLICY_TYPE_EMPLOYER               => "雇主责任险",
    ];
}