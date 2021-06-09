<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<select class="languages selectbox" data-modifier="custom-select_languages">
<?foreach ($arResult["SITES"] as $key => $arSite) {?>
	<option class="languages__item" value="<?=$arSite['DIR']?>" <?=($arSite["CURRENT"] == 'Y' ? 'selected' : '')?>><?=$arSite["NAME"]?></option>
<?}?>
</select>