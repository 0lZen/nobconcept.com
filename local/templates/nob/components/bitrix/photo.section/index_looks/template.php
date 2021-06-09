<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>

<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0]; 
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
  <img alt="<?=strip_tags($arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"])?>" class="block-looks__image block-looks__image_1 i-lazy" data-src="<?=$arItem["PREVIEW_PC"][0]["src"]?>" data-src-mobile="<?=$arItem["PREVIEW_MOBILE"][0]["src"]?>" >
  <img alt="<?=strip_tags($arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"])?>" class="block-looks__image block-looks__image_2 i-lazy" data-src="<?=$arItem["PREVIEW_PC"][1]["src"]?>" data-src-mobile="<?=$arItem["PREVIEW_MOBILE"][1]["src"]?>" >
  <img alt="<?=strip_tags($arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"])?>" class="block-looks__image block-looks__image_3 i-lazy" data-src="<?=$arItem["PREVIEW_PC"][2]["src"]?>" data-src-mobile="<?=$arItem["PREVIEW_MOBILE"][2]["src"]?>" >
  <img alt="<?=strip_tags($arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"])?>" class="block-looks__image block-looks__image_4 i-lazy" data-src="<?=$arItem["PREVIEW_PC"][3]["src"]?>" data-src-mobile="<?=$arItem["PREVIEW_MOBILE"][3]["src"]?>" >
<?}?>