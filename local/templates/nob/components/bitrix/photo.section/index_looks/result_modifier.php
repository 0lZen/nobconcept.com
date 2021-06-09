<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$preview_pc_exists = false;
$arResult['TOTAL'] = 0;

$pc_sizes = array(
	array('width' => 915, 'height' => 1377),
	array('width' => 525, 'height' => 698),
	array('width' => 525, 'height' => 698),
	array('width' => 720, 'height' => 1188),
);

$mobile_sizes = array(
	array('width' => 580, 'height' => 414),
	array('width' => 275, 'height' => 414),
	array('width' => 275, 'height' => 414),
	array('width' => 580, 'height' => 414),
);


if (isset($arResult['ITEMS'][0]) && isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE']) && is_array($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE']))
{
	$arResult['ITEMS'][0]['PREVIEW_PC'] = array();
	$arResult['ITEMS'][0]['PREVIEW_MOBILE'] = array();

	foreach ($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'] as $m => $image_pc)
	{
		if (isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][$m]))
		{
			$arResult['ITEMS'][0]['PREVIEW_PC'][$m] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][$m], $pc_sizes[$m]);
			$preview_pc_exists = true;
		}
		else
		{
			$arResult['ITEMS'][0]['PREVIEW_PC'][$m] = false;
		}

		if (isset($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_MOBILE']['VALUE'][$m]))
		{
		  $arResult['ITEMS'][0]['PREVIEW_MOBILE'][$m] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_MOBILE']['VALUE'][$m], $mobile_sizes[$m]);
		}
		elseif ($preview_pc_exists)
		{
		  $arResult['ITEMS'][0]['PREVIEW_MOBILE'][$m] = ImageBx::ResizeImageGet($arResult['ITEMS'][0]['PROPERTIES']['IMAGE_PC']['VALUE'][$m], $mobile_sizes[$m]);
		}
		else
		{
		  $arResult['ITEMS'][0]['PREVIEW_MOBILE'][$m] = false;
		}
	}

	$arResult['TOTAL'] = 1;
}
?>