<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$total = 0;
$preview_pc_exists = false;

foreach ($arResult['ITEMS'] as $k => $arItem)
{
	if ($arItem['PREVIEW_PICTURE']['ID'])
	{
	  $arResult['ITEMS'][$k]['PREVIEW_PC'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 720, 'height' => 9999));

		if (isset($arResult['ITEMS'][$k]['PROPERTIES']['IMAGE_MOBILE']['VALUE']) && $arResult['ITEMS'][$k]['PROPERTIES']['IMAGE_MOBILE']['VALUE'])
		{
		  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = CFile::ResizeImageGet($arResult['ITEMS'][$k]['PROPERTIES']['IMAGE_MOBILE']['VALUE'], array('width' => 580, 'height' => 560));
		}
		else
		{
		  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 580, 'height' => 560));
		}
	}

	$total++;
}

$arResult['TOTAL'] = $total;