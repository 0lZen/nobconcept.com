<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="block-navigation__menu navigation-menu i-noselect">
	<?foreach ($arResult as $arItem) {?>
		<?if ($arItem['DEPTH_LEVEL'] === 1) {?>
			<a href="<?=$arItem["LINK"]?>" class="navigation-menu__item <?=($arItem['IS_PARENT'] === 1 ? "has" : "")?>
			<?=($arItem["LINK"] == '/shop/' || !$arItem["LINK"] ? 'i-mobile' : '')?>" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?>
            </a>
		<?}?>
	<?}?>
</div>