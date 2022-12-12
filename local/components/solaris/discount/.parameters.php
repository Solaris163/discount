<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
 $arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "WAITING_PERIOD" => array(
            "PARENT" => "BASE",
            "NAME" => "Время запрета получения новой скидки (часы)",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "1",
        ),
        "VALIDITY_PERIOD" => array(
            "PARENT" => "BASE",
            "NAME" => "Период действия скидки (часы)",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "3",
        ),
        "PAGE_AUTH_URL" => array(
            "PARENT" => "BASE",
            "NAME" => "URL страницы авторизации",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => "/auth/",
        ),
    ),
);
?>