<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true); 
?>
<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0];
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
	<div class="block-new__image i-lazy i-pc" id="<?=$this->GetEditAreaId($arItem['ID'])?>" data-bg="url('<?=$arItem["PREVIEW_PC"]["src"]?>')"></div>
<?}?>