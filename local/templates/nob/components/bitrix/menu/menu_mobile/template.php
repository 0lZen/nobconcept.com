<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="block-menu__menu menu-menu i-noselect">
	<?foreach ($arResult as $arItem) {?>
		<?if ($arItem['DEPTH_LEVEL'] === 1) {?>
			<div class="menu-menu__item-wrapper">
				<a href="<?=($arItem["LINK"] ? $arItem["LINK"] : '/shop/')?>" class="menu-menu__item <?=($arItem["PARAMS"]['BRANDS'] == "1" ? 'menu-menu__item_brands' : '')?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
			</div>
		<?}?>
	<?}?>
</div>