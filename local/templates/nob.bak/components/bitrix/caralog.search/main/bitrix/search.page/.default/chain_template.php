<?
//Navigation chain template
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arChainBody = array();
foreach($arCHAIN as $item)
{
	if (mb_strlen($item["LINK"],'UTF-8') < mb_strlen(SITE_DIR,'UTF-8'))
		continue;
	if($item["LINK"] <> "")
		$arChainBody[] = '<a href="'.$item["LINK"].'">'.htmlspecialcharsex($item["TITLE"]).'</a>';
	else
		$arChainBody[] = htmlspecialcharsex($item["TITLE"]);
}
return implode('&nbsp;/&nbsp;', $arChainBody);