<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0];
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>

  <div class="block-about__image block-about__image_<?=$arParams["SHOP_IMAGE"]?> i-lazy" data-bg="url('<?=$arItem['PREVIEW_PC']["src"]?>')" data-bg-mobile="url('<?=$arItem['PREVIEW_MOBILE']["src"]?>')" id="<?=$this->GetEditAreaId($arItem['ID'])?>"></div>
<?}?>