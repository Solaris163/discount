<?
namespace Solaris\Discount;

use Bitrix\Main\Entity;

class DiscountTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 's_discount';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\IntegerField('USER_ID'),
            new Entity\StringField('CODE'),
            new Entity\IntegerField('DISCOUNT_VALUE'),
            new Entity\DatetimeField('DATE_START'),
        );
    }
}