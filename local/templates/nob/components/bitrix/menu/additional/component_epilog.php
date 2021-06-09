<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo preg_replace_callback("/#SEARCH#/is" . BX_UTF_PCRE_MODIFIER, 
	create_function('$matches', 'ob_start();
$GLOBALS["APPLICATION"]->IncludeComponent("bitrix:search.suggest.input","header",Array(
		"NAME" => "q",
		"VALUE" => $_GET["q"],
		"INPUT_SIZE" => "60",
		"DROPDOWN_SIZE" => "6"
	)
);
$strResult = @ob_get_contents();
ob_get_clean();
return $strResult;'), $arResult["CACHED_TPL"]);
?>