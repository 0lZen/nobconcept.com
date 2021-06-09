<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
$arTemplate = array(
	"NAME" => Loc::getMessage("NOB_TEMPLATE_NAME"),
	"DESCRIPTION" => Loc::getMessage("NOB_TEMPLATE_DESC"),
	"SORT" => 1,
	"EDITOR_STYLES" => array(
		"/local/templates/nob/assets/css/editor.min.css",
	)
);?>