<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<div class="block-header__slides slides" data-slick-slidestoshow="1" data-slick-slidestoscroll="1" data-slick-infinite="true" data-slick-variable-width="false" data-slick-touch-threshold="20" data-slick-fade="true" data-slick-adaptive-height="true" data-slick-autoplay="<?=($arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] ? 'true' : 'false')?>" data-slick-autoplayspeed="<?=$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"]?>" data-slick-controls=".block-header__slides-controls">
  
  <?foreach($arResult["ITEMS"] as $k => $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="slides__item product-slide" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
      <?if ($arItem['PROPERTIES']['LINK_DETAIL']['VALUE']) {?><a href="<?=$arItem['PROPERTIES']['LINK_DETAIL']['VALUE']?>" <?=(mb_strpos($arItem['PROPERTIES']['LINK_DETAIL']['VALUE'], '/',0,'UTF-8') !== 0 || mb_strpos($arItem['PROPERTIES']['LINK_DETAIL']['VALUE'], '//',0,'UTF-8') === 0 ? 'target="_blank"' : '')?> title="<?=strip_tags($arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['VALUE'])?>"><?}?>
      <?if ($arItem['PREVIEW_PC']) { ?>
        <img <?=($k === 0 ? 'src="' . $arItem['PREVIEW_PC']['src'] . '"' : '')?> alt="<?=strip_tags($arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['VALUE'])?>" class="product-slide__image <?=($k === 0 ? 'i-pc' : 'i-lazy')?>" <?=($k !== 0 ? 'data-src="' . $arItem['PREVIEW_PC']['src'] . '" data-src-mobile="' . $arItem['PREVIEW_MOBILE']['src'] . '"' : '')?>>
        <?if ($k === 0 && $arItem['PREVIEW_MOBILE']) {?>
          <img src="<?=$arItem['PREVIEW_MOBILE']['src']?>" alt="<?=strip_tags($arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['VALUE'])?>" class="product-slide__image <?=($k === 0 ? 'i-mobile' : '')?>">
        <?}?>
      <?}?>
      <?if ($arItem['PROPERTIES']['LINK_DETAIL']['VALUE']) {?></a><?}?>
      <div class="product-slide__content">
        <h3 class="product-slide__title">
          <?=$arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT']?>
        </h3>
        <div class="product-slide__price">
          <?=$arItem['PROPERTIES']['SUBTITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT']?>
        </div>
      </div>
    </div>

  <?}?>

</div>

<?if ($arResult['TOTAL'] > 1) {?>
  <div class="block-header__slides-controls slides-controls i-noselect" data-slick=".block-header__slides">
    <div class="slides-controls__item slides-controls__item_left arrow" data-slick=".block-header__slides"></div>
    <div class="slides-controls__item slides-controls__item_right arrow" data-slick=".block-header__slides"></div>
  </div>
<?}?>