<?php
namespace vg;

use \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Loader,
    \Bitrix\Highloadblock as HL,
    \Bitrix\Main\Entity;

/**
 * Class Helper
 * Вспомогательный класс
 * @package vg
 */
class Helper {

    /**
     * Очистка телефона
     *@param $phone
     */
    public static function clearPhone($phone) {
        $phone = preg_replace("#[^\d]#", "", $phone);
        if (substr($phone, 0, 1) == '7'
            || substr($phone, 0, 1) == '8'
        ) {
            $phone = substr($phone, 1);
        }
        return $phone;
    }
}