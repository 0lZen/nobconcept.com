<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>

<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0]; 
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
	<div class="block-city__image block-city__image_1 i-lazy i-pc" data-bg="url('<?=$arItem["PREVIEW_PC"][0]["src"]?>')"></div>
	<div class="block-city__image block-city__image_2 i-lazy i-pc" data-bg="url('<?=$arItem["PREVIEW_PC"][1]["src"]?>')"></div>

	<?if (count($arItem["PREVIEW_MOBILE"])) {?>
		<div class="block-city__slides slides i-mobile" data-slick-slidestoshow="1" data-slick-slidestoscroll="1" data-slick-infinite="true" data-slick-touch-threshold="20" data-slick-variable-width="true" data-slick-disable-on-mobile="false" data-slick-mobile-fade="false" data-slick-menu=".block-city__slides-menu" data-slick-autoplay="<?=($arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] ? 'true' : 'false')?>" data-slick-autoplayspeed="<?=$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"]?>">
			<?foreach($arItem["PREVIEW_MOBILE"] as $preview) {?>

				<div class="block-city__slide slides__item i-lazy" data-bg="url('<?=$preview["src"]?>')"></div>

			<?}?>
		</div>

	  <div class="block-city__slides-menu slides-menu i-noselect i-mobile" data-slick=".block-city__slides">
	    <?for ($i = 1; $i <= count($arItem["PREVIEW_MOBILE"]); $i++) {?>
	      <div class="slides-menu__item <?=($i == 1 ? 'slides-menu__item_active' : '')?>" data-slick=".block-city__slides"></div>
	    <?}?>
	  </div>
	<?}?>
<?}?>