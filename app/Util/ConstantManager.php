<?php

namespace App\Util;

class SimpleEnum {
    public static function values()
    {
        $className = get_called_class();

        $refClass = new ReflectionClass($className);
        $values = $refClass->getConstants();

        return $values;
    }

    public static function valueOf($value, $notfound = null)
    {
        $values = self::values();
        if (!array_key_exists($value, $values)) return $notfound;
        return $values[$value];
    }
}

/**
 * イベントタイプ
 */
class EventType extends SimpleEnum {
    const ONE_MAN_LIVE  = 0;
    const FC_EVENT      = 1;
    const FES_EVENT     = 2;
    const MINI_LIVE     = 3;
    const GUEST         = 4;
    const OTHER         = 5;
}

/**
 * アレンジタイプ
 */
class ArrangeType extends SimpleEnum {
    const NONE      = 0;
    const ACOSTIC   = 1;
    const ORIGINAL  = 2;
    const CHRISTMAS = 3;
}

/**
 * 定数マネージャー
 */
class ConstantManager
{
    /**
     * EventTypeからの文字列を取得
     */
    public static function getEventTypeString($type)
    {
        switch ($type) {
            case EventType::ONE_MAN_LIVE:
                return 'ワンマン';
            case EventType::FC_EVENT:
                return 'FCイベント';
            case EventType::FES_EVENT:
                return 'フェス';
            case EventType::MINI_LIVE:
                return 'ミニライブ';
            case EventType::GUEST:
                return 'ゲスト';
            case EventType::OTHER:
                return 'その他';
            default:
                return '';
        }
    }

    /**
     * ArrangeTypeからの文字列を取得
     */
    public static function getArrangeTypeString($type)
    {
        switch ($type) {
            case ArrangeType::ACOSTIC:
                return 'Acostic';
            case ArrangeType::ORIGINAL:
                return 'Original';
            case ArrangeType::CHRISTMAS:
                return 'Christmas';
            default:
                return '';
        }
    }
}