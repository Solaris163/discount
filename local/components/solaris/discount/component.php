<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
global $USER;

$arPostRequest = $this->getPostRequest();

if (!$USER->IsAuthorized()) {
    $arResult['IS_AUTHORIZED'] = true;
	
} else {
    $arResult['IS_AUTHORIZED'] = false;
}

// запрос скидки
if ($arPostRequest['action'] === 'get-discount') {

    $arDiscount = $this->getDiscount($USER->GetID(), $arParams);

    if ($arDiscount) {
        $result = array(
            'success' => true,
            'code' => $arDiscount['CODE'],
            'value' => $arDiscount['DISCOUNT_VALUE'],
        );
    } else {
        $result = array(
            'error' => true,
        );
    }

    $APPLICATION->RestartBuffer(); 
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($result);
    die;
}

// проверка скидки
if ($arPostRequest['action'] === 'check-discount') {
    $value = $this->checkDiscount($USER->GetID(), $arPostRequest['code'], $arParams);
    if ($value) {
        $result = array(
            'success' => true,
            'value' => $value,
        );
    } else {
        $result = array(
            'error' => true,
            'message' => GetMessage("DISCOUNT_NOT_AVAILABLE"),
        );
    }

    $APPLICATION->RestartBuffer(); 
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($result);
    die;
}

$this->IncludeComponentTemplate();
?>