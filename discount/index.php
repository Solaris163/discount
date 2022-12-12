<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Скидка");
CJSCore::Init(array("jquery"));


$APPLICATION->IncludeComponent(
	"solaris:discount",
	"",
	array(
		"WAITING_PERIOD" => 1, // время в течение которого нельзя получить новую скидку (в часах)
		"VALIDITY_PERIOD" => 3, // время действия скидки (в часах)
		"PAGE_AUTH_URL" => '/auth/', // страница для авторизации
	),
	false
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>