<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["ID"]), false, $arSelect = array("UF_*"));

if ($arSection = $rsResult->GetNext())
{
	$arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] = $arSection["UF_AUTOPLAY"];
	$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"] = $arSection["UF_SLIDER_DELAY"];
}

$total = 0;

$pc_sizes = array(
	array('width' => 525, 'height' => 739),
	array('width' => 525, 'height' => 739),
	array('width' => 1110, 'height' => 1646),
	array('width' => 637, 'height' => 637),
);

foreach ($arResult['ITEMS'] as $k => $arItem)
{
	if (isset($arItem['PROPERTIES']['IMAGE_PC']['VALUE']) && is_array($arItem['PROPERTIES']['IMAGE_PC']['VALUE']))
	{
		foreach ($arItem['PROPERTIES']['IMAGE_PC']['VALUE'] as $m => $image_pc)
		{
			$preview_pc_exists = false;

			if (isset($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][$m]))
			{
				$arResult['ITEMS'][$k]['PREVIEW_PC'][$m] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][$m], $pc_sizes[$m]);
				$preview_pc_exists = true;
			}
			else
			{
				$arResult['ITEMS'][$k]['PREVIEW_PC'][$m] = false;
			}

			// Only one image show on mobile
			if ($m === 0)
			{
				if (isset($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE'][$m]))
				{
				  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'][$m] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_MOBILE']['VALUE'][$m], array('width' => 580, 'height' => 800));
				}
				elseif ($preview_pc_exists)
				{
				  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'][$m] = ImageBx::ResizeImageGet($arItem['PROPERTIES']['IMAGE_PC']['VALUE'][$m], array('width' => 580, 'height' => 800));
				}
				else
				{
				  $arResult['ITEMS'][$k]['PREVIEW_MOBILE'][$m] = false;
				}
			}
		}
	}

	$total++;
}

$arResult['TOTAL'] = $total;
?>