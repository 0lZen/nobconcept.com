<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0];
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
  <img alt="<?=strip_tags($arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["VALUE"]["TEXT"])?>" class="block-discounts__background i-lazy" data-src="<?=$arItem["PREVIEW_PC"]["src"]?>" data-src-mobile="<?=$arItem["PREVIEW_MOBILE"]["src"]?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
<?}?>