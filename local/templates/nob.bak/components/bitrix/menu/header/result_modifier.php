<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult as $key => $arItem)
{
	$arResult[$key]["FROM_IBLOCK"] = intval($arItem["FROM_IBLOCK"]);
	$arResult[$key]["IS_PARENT"] = intval($arItem["IS_PARENT"]);
	$arResult[$key]["DEPTH_LEVEL"] = intval($arItem["DEPTH_LEVEL"]);
}
?>