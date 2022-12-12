<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="discount-page-container">

    <? if ($arResult['IS_AUTHORIZED']) : ?>

        <div style="text-align: center;">
            Для получения скидки необходима авторизация<br>
            Пожалуйста перейдите на страницу авторизации: <a href="<?=$arParams['PAGE_AUTH_URL']?>?backurl=/discount/">Авторизация</a><br>
            Тестовые пользователи test1 и test2 пароли 123123
        </div>

    <? else : ?>

        <div class="get-discount-section">
            <div id="get-discount" class="discount-page-interface-element discount-page-button"><?=GetMessage("GET_DISCOUNT")?></div>
            <div class="discount-page-message-block">
                <?=GetMessage("YOUR_DISCOUNT")?>
                <div id="get-discount-value" class="discount-page-interface-element discount-page-discount-value"></div>
            </div>
            <div class="discount-page-message-block">
                <?=GetMessage("YOUR_CODE")?>
                <div id="get-discount-code" class="discount-page-interface-element discount-page-code"></div>
            </div>
            <div class="discount-page-clearfix"></div>
            <div id="get-discount-error" class="discount-page-interface-element discount-page-error"></div>
        </div>
        
        <div class="check-discount-section">
            <?=GetMessage("CHECKING_DISCOUNT")?>
            <form class="check-discount-form" action="" method="get" target="_blank">
                <div class="discount-page-message-block">
                    <input id="check-discount-input" class="check-discount-input" type="text" name="price"  placeholder="<?=GetMessage("ENTER_CODE")?>">
                </div>
                <div id="check-discount" class="discount-page-message-block discount-page-interface-element discount-page-button">
                    <?=GetMessage("CHECK_DISCOUNT")?>
                </div>
            </form>
            <div class="discount-page-clearfix"></div>
            <div class="check-discount-value-block">
                <?=GetMessage("DISCOUNT")?>
                <div id="check-discount-value" class="discount-page-interface-element discount-page-discount-value"></div>
            </div>
            <div id="check-discount-error" class="discount-page-interface-element discount-page-error"></div>
        </div>

    <? endif; ?>

</div>

<!-- прелоадер -->
<div class="overlay-preloader" style="display: none;"></div>