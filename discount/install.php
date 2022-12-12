<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;

global $USER;
global $APPLICATION;

$APPLICATION->SetTitle("Скидка (добавление таблицы и тестовых пользователей)");

$message = '';
$arExistUserLogins = [];
$arNewUserLogins = array('test1', 'test2');


if (!$USER->IsAdmin()) {?>
	<div style="text-align: center;">
		Запуск скрипта доступен только администраторам
	</div>
<?} else {
	// создание таблицы в базе данных
	if (!Application::getConnection()->isTableExists(Base::getInstance('\Solaris\Discount\DiscountTable')->getDBTableName())) {  
		Base::getInstance('\Solaris\Discount\DiscountTable')->createDBTable();
		$message .= 'Таблица создана<br>';
	} else {
		$message .= 'Таблица уже создана<br>';
	}

	// поиск уже существующих тестовых пользователей
	$filter = array(
		"LOGIN" => implode('|', $arNewUserLogins),
	);
	$rsUsers = CUser::GetList(array(), array(), $filter);
	while($arUser = $rsUsers->Fetch()){
		$arExistUserLogins[] = $arUser['LOGIN'];
	};
	// создание тестовых пользователей
	foreach ($arNewUserLogins as $userLogin) {
		if (in_array($userLogin, $arExistUserLogins)) {
			$message .= 'Пользователь ' . $userLogin . ' уже существует<br>';
		} else {
			$user = new CUser;
			$arFields = array(
				"LOGIN" => $userLogin,
				"EMAIL" => 'test@test.test',
				"PASSWORD" => '123123',
				"CONFIRM_PASSWORD" => '123123',
			);
			if ($new_user_ID = $user->Add($arFields)) {
				$message .= 'Добавлен пользователь ' . $userLogin . '<br>';
			} else {
				$message .= 'Ошибка добавления пользователя ' . $userLogin . ': ' . $user->LAST_ERROR;
			}
		}
	}
	echo $message;
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>