<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<div class="block-season__slides slides" data-slick-slidestoshow="1" data-slick-slidestoscroll="1" data-slick-infinite="true" data-slick-variable-width="false" data-slick-touch-threshold="20" data-slick-fade="true" data-slick-adaptive-height="true" data-slick-autoplay="<?=($arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] ? 'true' : 'false')?>" data-slick-autoplayspeed="<?=$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"]?>" data-slick-controls=".block-season__slides-controls" data-slick-menu=".block-season__slides-menu">

  <?foreach($arResult["ITEMS"] as $k => $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="slides__item season-page" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
      <?if (isset($arItem['PREVIEW_PC'][3]) && $arItem['PREVIEW_PC'][3]) {?>
        <div class="season-page__texture i-lazy i-pc" data-bg="url('<?=$arItem['PREVIEW_PC'][3]['src']?>')"></div>
      <?}?>
      <?if (isset($arItem['PREVIEW_PC'][0]) && $arItem['PREVIEW_PC'][0]) {?>
        <div class="season-page__image season-page__image_1 i-lazy" data-bg="url('<?=$arItem['PREVIEW_PC'][0]['src']?>')" data-bg-mobile="url('<?=$arItem['PREVIEW_MOBILE'][0]['src']?>')"></div>
      <?}?>
      <?if (isset($arItem['PREVIEW_PC'][1]) && $arItem['PREVIEW_PC'][1]) {?>
        <div class="season-page__image season-page__image_2 i-lazy i-pc" data-bg="url('<?=$arItem['PREVIEW_PC'][1]['src']?>')"></div>
      <?}?>
      <?if (isset($arItem['PREVIEW_PC'][2]) && $arItem['PREVIEW_PC'][2]) {?>
        <div class="season-page__image season-page__image_3 i-lazy i-pc" data-bg="url('<?=$arItem['PREVIEW_PC'][2]['src']?>')"></div>
      <?}?>
    </div>

  <?}?>

</div>
<?if ($arResult['TOTAL'] > 1) {?>
  <div class="block-season__slides-controls slides-controls i-noselect i-pc" data-slick=".block-season__slides">
    <div class="slides-controls__item slides-controls__item_left arrow" data-slick=".block-season__slides"></div>
    <div class="slides-controls__item slides-controls__item_right arrow" data-slick=".block-season__slides"></div>
  </div>

  <div class="block-season__slides-menu slides-menu i-noselect i-mobile" data-slick=".block-season__slides">
    <?for ($i = 1; $i <= $arResult['TOTAL']; $i++) {?>
      <div class="slides-menu__item <?=($i == 1 ? 'slides-menu__item_active' : '')?>" data-slick=".block-season__slides"></div>
    <?}?>
  </div>
<?}?>