<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*foreach($arResult["SITES"] as $key => $arSite) { 
	$arResult["SITES"][$key]['LINK'] = (is_array($arSite["DOMAINS"]) ? $arSite["DOMAINS"][0] : $arSite["DOMAINS"])
		. ($arSite['LANG'] == LANGUAGE_ID ? $_SERVER['REQUEST_URI'] : ($arSite['LANG'] != DEFAULT_LANG ? '/' . $arSite['LANG'] : '')
			. substr($_SERVER['REQUEST_URI'], (LANGUAGE_ID == DEFAULT_LANG || $arSite['LANG'] != DEFAULT_LANG ? 0 : 3)));
}
if ($arParams['IS_CATALOG']=='Y')
{
    $suffix='catalog/';
} else
{
    $suffix='';
}
foreach($arResult["SITES"] as $key => $arSite)
{
	$arResult["SITES"][$key]['LINK'] = ($arSite['LANG'] == 'ru' ? '/'.$suffix : '/' . $arSite['LANG'] . '/'.$suffix);
}*/