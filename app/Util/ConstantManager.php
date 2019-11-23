<?php

namespace App\Util;

use ReflectionClass;

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
    const OTHER         = 4;
}

/**
 * アレンジタイプ
 * NOTICE: 運用開始後はデータ不整合の恐れがあるのでその他の下に追加していくこと
 */
class ArrangeType extends SimpleEnum {
    const NORMAL    = 0;
    const ACOSTIC   = 1;
    const ORIGINAL  = 2;
    const CHRISTMAS = 3;
    const R_AND_B   = 4;
    const OTHER     = 5;
    const ENGLISH   = 6;
    const CHINESE   = 7;
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
            case EventType::OTHER:
                return 'その他';
            default:
                return '';
        }
    }

    /**
     * ArrangeTypeからの文字列を取得
     */
    public static function getArrangeTypeString($type, $ignoreNormal = false)
    {
        switch ($type) {
            case ArrangeType::NORMAL:
                if ($ignoreNormal){
                    return '';
                }
                return '通常';
            case ArrangeType::ACOSTIC:
                return 'Acostic Ver';
            case ArrangeType::ORIGINAL:
                return 'Original Ver';
            case ArrangeType::CHRISTMAS:
                return 'Christmas Ver';
            case ArrangeType::R_AND_B:
                return 'R&B Ver';
            case ArrangeType::OTHER:
                return 'アレンジVer';
            case ArrangeType::ENGLISH:
                return '英語 Ver';
            case ArrangeType::CHINESE:
                return '中国語 Ver';
            default:
                return '';
        }
    }
    
    /**
     * EventType文字列のリストを配列で取得
     */
    public static function getEventTypeStringList()
    {
        $result = [];
        foreach(EventType::values() as $type) {
            $str = ConstantManager::getEventTypeString($type);
            if (!empty($str)) {
                $result[] = $str;
            }
        }
        return $result;
    }
    
    /**
     * ArrangeType文字列のリストを配列で取得
     */
    public static function getArrangeTypeStringList()
    {
        $result = [];
        foreach(ArrangeType::values() as $type) {
            $str = ConstantManager::getArrangeTypeString($type);
            if (!empty($str)) {
                $result[] = $str;
            }
        }
        return $result;
    }

    /**
     * ページネーションの固定件数
     */
    const PerPage = 15;
}