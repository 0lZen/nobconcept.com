<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<form action="<?=SITE_DIR?>catalog/" method="GET" class="additional-search-form">
	<input type="text" autocomplete="off" class="additional-search-form__input additional-search-form__input_suggest"
           placeholder="<?=GetMessage("SEARCH_PLACEHOLDER")?>" name="<?=$arParams["NAME"]?>"
           id="<?=$arResult["ID"]?>" value="<?echo $arParams["VALUE"]?>">
</form>