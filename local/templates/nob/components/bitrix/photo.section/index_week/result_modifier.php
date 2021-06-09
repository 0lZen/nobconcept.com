<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$preview_pc_exists = false;
$arResult['TOTAL'] = 0;

if (isset($arResult['ITEMS'][0]) && isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE']) && is_array($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE']))
{
	if (isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][0]))
	{
		$arResult['ITEMS'][0]['PREVIEW_PC'] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][0], array('width' => 759, 'height' => 1063));
		$preview_pc_exists = true;
	}
	else
	{
		$arResult['ITEMS'][0]['PREVIEW_PC'] = false;
	}

	if (isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_MOBILE']['VALUE'][0]))
	{
	  $arResult['ITEMS'][0]['PREVIEW_MOBILE'] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_MOBILE']['VALUE'][0], array('width' => 580, 'height' => 812));
	}
	elseif ($preview_pc_exists)
	{
	  $arResult['ITEMS'][0]['PREVIEW_MOBILE'] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][0], array('width' => 580, 'height' => 812));
	}
	else
	{
	  $arResult['ITEMS'][0]['PREVIEW_MOBILE'] = false;
	}

	$arResult['TOTAL'] = 1;
}
?>