<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="block-menu__languages menu-languages">
<?foreach ($arResult["SITES"] as $key => $arSite) {?>
	<a class="js-lang-mobile menu-languages__item <?=($arSite["CURRENT"] == 'Y' ? 'menu-languages__item_active' : '')?>" href="javascript:void(0)" data-dir="<?=$arSite['DIR']?>"><?=$arSite["NAME"]?></a>
<?}?>
</div>