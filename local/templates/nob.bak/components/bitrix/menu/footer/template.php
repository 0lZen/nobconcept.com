<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block-footer__menu footer-menu i-noselect">
	<?foreach ($arResult as $arItem) {?>
		<a href="<?=$arItem["LINK"]?>" class="footer-menu__item <?=(mb_strpos($arItem["LINK"], "/shop/",0,'UTF-8') === 0 ? "i-pc" : "")?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
	<?}?>
</div>