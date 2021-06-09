<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<div class="block-new__slides slides" data-slick-slidestoshow="3" data-slick-mobile-slidestoshow="1" data-slick-slidestoscroll="1" data-slick-infinite="true"data-slick-touch-threshold="20" data-slick-variable-width="true" data-slick-disable-on-mobile="false" data-slick-mobile-fade="false" data-slick-menu=".block-new__slides-menu" data-slick-autoplay="<?=($arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] ? 'true' : 'false')?>" data-slick-autoplayspeed="<?=$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"]?>" data-slick-controls=".block-new__slides-controls">

  <?foreach($arResult["ITEMS"] as $k => $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

  <div class="slides__item new-slide">
    <img alt="<?=strip_tags($arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT'])?>" class="new-slide__image i-lazy" data-src="<?=$arItem['PREVIEW_PC']['src']?>" data-src-mobile="<?=$arItem['PREVIEW_MOBILE']['src']?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
  </div>

  <?}?>

</div>

<?if ($arResult['TOTAL'] > 1) {?>
  <div class="block-new__slides-controls slides-controls i-noselect" data-slick=".block-new__slides">
    <div class="slides-controls__item slides-controls__item_left arrow" data-slick=".block-new__slides"></div>
    <div class="slides-controls__item slides-controls__item_right arrow" data-slick=".block-new__slides"></div>
  </div>

  <div class="block-new__slides-menu slides-menu i-noselect i-mobile" data-slick=".block-new__slides">
    <?for ($i = 1; $i <= $arResult['TOTAL']; $i++) {?>
      <div class="slides-menu__item <?=($i == 1 ? 'slides-menu__item_active' : '')?>" data-slick=".block-new__slides"></div>
    <?}?>
  </div>
<?}?>