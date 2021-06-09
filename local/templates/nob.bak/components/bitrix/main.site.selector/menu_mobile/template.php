<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="block-menu__languages menu-languages">
<?foreach ($arResult["SITES"] as $key => $arSite) {?>
	<a class="menu-languages__item <?=($arSite["CURRENT"] == 'Y' ? 'menu-languages__item_active' : '')?>" href="<?=$arSite['LINK']?>"><?=$arSite["NAME"]?></a>
<?}?>
</div>