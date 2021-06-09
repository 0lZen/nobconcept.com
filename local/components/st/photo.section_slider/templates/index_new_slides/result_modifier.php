<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, $arSelect = array("UF_*"));
if ($arSection = $rsResult->Fetch())
{
	$arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] = $arSection["UF_AUTOPLAY"];
	$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"] = $arSection["UF_SLIDER_DELAY"];
}

$total = 0;

foreach ($arResult['ITEMS'] as $k => $arItem)
{
	if (isset($arItem['FIELDS']['PREVIEW_PICTURE']))
	{
	    $arResult['ITEMS'][$k]['PREVIEW_PC']['src'] = smart_resize_ameton($arItem['FIELDS']['PREVIEW_PICTURE'],150,150,JPEG_QUALITY,false,false,true);
	    $arResult['ITEMS'][$k]['PREVIEW_MOBILE']['src'] = smart_resize_ameton($arItem['FIELDS']['PREVIEW_PICTURE'],230,230,JPEG_QUALITY,false,false,true);
	    #$arResult['ITEMS'][$k]['PREVIEW_PC']['src'] = CFile::GetPath($arItem['FIELDS']['PREVIEW_PICTURE']);
	    #$arResult['ITEMS'][$k]['PREVIEW_MOBILE']['src'] = CFile::GetPath($arItem['FIELDS']['PREVIEW_PICTURE']);
	} else
	{
	    $arResult['ITEMS'][$k]['PREVIEW_PC'] = false;
	    $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = false;
	}

	$total++;
}

$arResult['TOTAL'] = $total;