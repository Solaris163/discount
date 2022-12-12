<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Context;
use \Solaris\Discount\DiscountTable;
use \Bitrix\Main\Security\Random;

class SolarisDiscount extends CBitrixComponent
{
    public static function getPostRequest()
    {
        $request = Context::getCurrent()->getRequest();
        $arPostRequest = $request->getPostList()->toArray();
        return $arPostRequest;
    }

    private static function getDiscountFromDB($arFilter)
    {
        $row = DiscountTable::getRow(array(
            'filter' => $arFilter
        ));
        return $row;
    }

    // метод проверяет есть ли у пользователя уже скидка, и не истек ли период запрета получения новой скидки
    // метод возвращает текущую скидку или создает новую
    public static function getDiscount($userId, $arParams)
    {
        $arFilter = array('USER_ID' => $userId);
        $arDiscount = self::getDiscountFromDB($arFilter);
        if (is_array($arDiscount)) {
            $startTime = $arDiscount['DATE_START']->getTimestamp();
            // время которое прошло от начала действия скидки
            $discountAge = time() - $startTime;
        }
        
        // если скидка существует и не кончился период ожидания, то вернуть существующую скидку
        if ($arDiscount['ID'] && $discountAge <= $arParams['WAITING_PERIOD'] * 3600) {
            return $arDiscount;
        }

        // если кончился период ожидания
        if ($arDiscount['ID'] && $discountAge > $arParams['WAITING_PERIOD'] * 3600) {
            $arDiscount = self::discountUpdate($arDiscount['ID']);
            return $arDiscount;
        }

        // если скидка пока не существует
        if (!$arDiscount['ID']) {
            $arDiscount = self::discountAdd($userId);
            return $arDiscount;
        }
    }

    // метод обновляет скидку по ее id
    // метод возвращает массив с кодом скидки и ее значением
    private static function discountUpdate($discountId)
    {
        $arDiscount = array(
            'CODE' => uniqid(),
            'DISCOUNT_VALUE' => rand(1, 50),
            'DATE_START' => new \Bitrix\Main\Type\DateTime(),
        );
        $result = DiscountTable::update($discountId, $arDiscount);
        if ($result->isSuccess() && $result->getAffectedRowsCount()) {
            return $arDiscount;
        } else return false;
    }

    // метод создает скидку для пользователя с заданным id
    private static function discountAdd($userId)
    {
        $arDiscount = array(
            'USER_ID' => $userId,
            'CODE' => uniqid(),
            'DISCOUNT_VALUE' => rand(1, 50),
            'DATE_START' => new \Bitrix\Main\Type\DateTime(),
        );
        $result = DiscountTable::add($arDiscount);
        if ($result->isSuccess() && $result->getId()) {
            return $arDiscount;
        } else return false;
    }

    // checkDiscount($USER->GetID(), $arPostRequest['code'], $arParams)
    // метод 
    public static function checkDiscount($userId, $code, $arParams)
    {
        if ($code) {
            $arFilter = array('USER_ID' => $userId, 'CODE' => $code);
            $arDiscount = self::getDiscountFromDB($arFilter);
        }

        if (is_array($arDiscount)) {
            $startTime = $arDiscount['DATE_START']->getTimestamp();
            // время которое прошло от начала действия скидки
            $discountAge = time() - $startTime;
        }

        // если скидка существует и не кончился период ее действия, то вернуть значение скидки
        if ($arDiscount['ID'] && $discountAge <= $arParams['VALIDITY_PERIOD'] * 3600) {
            return $arDiscount['DISCOUNT_VALUE'];
        } else {
            return false;
        }
    }



}
