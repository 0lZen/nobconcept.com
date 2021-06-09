<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Context;
use Bitrix\Main\Type\DateTime;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

/*************************************************************************
	Processing of received parameters
*************************************************************************/

if($this->StartResultCache(false, array($arrFilter, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arNavigation, $bUSER_HAVE_ACCESS, $pagerParameters)))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	$arSelect = array();
	if(isset($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
	{
		foreach($arParams["SECTION_USER_FIELDS"] as $field)
			if(is_string($field) && preg_match("/^UF_/", $field))
				$arSelect[] = $field;
	}
	if(preg_match("/^UF_/", $arParams["META_KEYWORDS"]))
		$arSelect[] = $arParams["META_KEYWORDS"];
	if(preg_match("/^UF_/", $arParams["META_DESCRIPTION"]))
		$arSelect[] = $arParams["META_DESCRIPTION"];
	if(preg_match("/^UF_/", $arParams["BROWSER_TITLE"]))
		$arSelect[] = $arParams["BROWSER_TITLE"];

	$arFilter = array(
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_ACTIVE" => "Y",
	);

	if($arParams["SECTION_CODE"]!='')
		$arFilter["=CODE"]=$arParams["SECTION_CODE"];
	else
		$arFilter["ID"]=$arParams["SECTION_ID"];

	$rsSection = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
	$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
	$arResult = $rsSection->GetNext();

	//Check if have to show root elements
	if(!$arResult && !$arParams["SECTION_CODE"] && !$arParams["SECTION_ID"])
	{
		$arResult = array(
			"ID" => $arParams["SECTION_ID"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		);
	}

		$key = 0;
		$arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], 'ACTIVE'=>'Y', 'PROPERTY_NOVINKA_VALUE'=>'Да','=AVAILABLE'=>'Y');
	    $res = CIBlockElement::GetList(Array('CATALOG_AVAILABLE'=>'DESC,NULLS','PROPERTY_DATA_POYAVLENIYA_TOVARA'=>'DESC','ID'=>'DESC'), $arFilter,false,Array("nPageSize"=>20,"iNumPage"=>1),['ID','NAME','DETAIL_PAGE_URL','PREVIEW_PICTURE','DETAIL_PICTURE','PROPERTY_*']);
		while ($ob = $res->GetNextElement())
        {
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();

			$arResult['ITEMS'][$key]['FIELDS'] = $arFields;
			$arResult['ITEMS'][$key]['PROPERTIES'] = $arProps;
			$key++;
		}


		$this->SetResultCacheKeys(array(
			"ID",
			"IBLOCK_ID",
			"NAV_CACHED_DATA",
			$arParams["META_KEYWORDS"],
			$arParams["META_DESCRIPTION"],
			$arParams["BROWSER_TITLE"],
			"NAME",
			"PATH",
			"IPROPERTY_VALUES",
			"ITEMS_TIMESTAMP_X",
		));
		$this->IncludeComponentTemplate();

}

if(isset($arResult["ID"]))
{
	$arTitleOptions = null;
	if($USER->IsAuthorized())
	{
		if(
			$APPLICATION->GetShowIncludeAreas()
			|| $arParams["SET_TITLE"]=='Y'
			|| isset($arResult[$arParams["BROWSER_TITLE"]])
		)
		{
			if(CModule::IncludeModule("iblock"))
			{
				$url_template = CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "LIST_PAGE_URL");
				$arIBlock = CIBlock::GetArrayByID($arResult["IBLOCK_ID"]);
				$arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
				$UrlDeleteSectionButton = CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false);

				$arButtons = CIBlock::GetPanelButtons(
					$arResult["IBLOCK_ID"],
					0,
					$arResult["ID"],
					array("RETURN_URL" => array(
						"delete_section" => $UrlDeleteSectionButton,
					))
				);
				foreach($arButtons as $mode => $ar)
					unset($arButtons[$mode]["add_section"]);

				if($APPLICATION->GetShowIncludeAreas())
					$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

				if($arParams["SET_TITLE"]=='Y' || isset($arResult[$arParams["BROWSER_TITLE"]]))
				{
					$arTitleOptions = array(
						'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_section"]["ACTION"],
						'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_section"]["ACTION"],
						'COMPONENT_NAME' => $this->GetName(),
					);
				}
			}
		}
	}

	$this->SetTemplateCachedData($arResult["NAV_CACHED_DATA"]);

	if($arParams["SET_TITLE"]=='Y')
	{
		if ($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
			$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arTitleOptions);
		elseif(isset($arResult["NAME"]))
			$APPLICATION->SetTitle($arResult["NAME"], $arTitleOptions);
	}

	$browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["BROWSER_TITLE"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "SECTION_META_TITLE"
	);
	if (is_array($browserTitle))
		$APPLICATION->SetPageProperty("title", implode(" ", $browserTitle), $arTitleOptions);
	elseif ($browserTitle != "")
		$APPLICATION->SetPageProperty("title", $browserTitle, $arTitleOptions);

	$metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_KEYWORDS"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "SECTION_META_KEYWORDS"
	);
	if (is_array($metaKeywords))
		$APPLICATION->SetPageProperty("keywords", implode(" ", $metaKeywords), $arTitleOptions);
	elseif ($metaKeywords != "")
		$APPLICATION->SetPageProperty("keywords", $metaKeywords, $arTitleOptions);

	$metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_DESCRIPTION"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "SECTION_META_DESCRIPTION"
	);
	if (is_array($metaDescription))
		$APPLICATION->SetPageProperty("description", implode(" ", $metaDescription), $arTitleOptions);
	elseif ($metaDescription != "")
		$APPLICATION->SetPageProperty("description", $metaDescription, $arTitleOptions);

	if($arParams["ADD_SECTIONS_CHAIN"])
	{
		foreach($arResult["PATH"] as $arPath)
		{
			$APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
		}
	}

	if ($arParams["SET_LAST_MODIFIED"] && $arResult["ITEMS_TIMESTAMP_X"])
	{
		Context::getCurrent()->getResponse()->setLastModified($arResult["ITEMS_TIMESTAMP_X"]);
	}
}

?>
