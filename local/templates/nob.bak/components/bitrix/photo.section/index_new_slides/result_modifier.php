<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, $arSelect = array("UF_*"));

if ($arSection = $rsResult->GetNext())
{
	$arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] = $arSection["UF_AUTOPLAY"];
	$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"] = $arSection["UF_SLIDER_DELAY"];
}

$total = 0;
$preview_pc_exists = false;

foreach ($arResult['ITEMS'] as $k => $arItem)
{
	if (isset($arItem['PROPERTIES']['IMAGE_PC']['VALUE']) && is_array($arItem['PROPERTIES']['IMAGE_PC']['VALUE']) && isset($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][0]))
	{
	  $arResult['ITEMS'][$k]['PREVIEW_PC'] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][0], array('width' => 416, 'height' => 416));
	  $preview_pc_exists = true;
	}
	else
	{
	  $arResult['ITEMS'][$k]['PREVIEW_PC'] = false;
	}

	if (isset($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE']) && is_array($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE']) && isset($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE'][0]))
	{
	  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE'][0], array('width' => 580, 'height' => 580));
	}
	elseif ($preview_pc_exists)
	{
	  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][0], array('width' => 580, 'height' => 580));
	}
	else
	{
	  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = false;
	}

	$total++;
}

$arResult['TOTAL'] = $total;
?>