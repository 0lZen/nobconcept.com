<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResultNew=[];
foreach ($arResult as $key => $arItem)
{
	$arItem["FROM_IBLOCK"] = intval($arItem["FROM_IBLOCK"]);
	$arItem["IS_PARENT"] = intval($arItem["IS_PARENT"]);
	$arItem["DEPTH_LEVEL"] = intval($arItem["DEPTH_LEVEL"]);
    $arResultNew[]=$arItem;
    if ($arItem["PARAMS"]["BRANDS"]==1)
    {
        global $arMenuBrands;
        foreach ($arMenuBrands as $brand)
        {
            $arResultNew[]=[
                "TEXT"              => $brand["NAME"],
                "LINK"              => SITE_DIR."catalog/filter/brend-is-".$brand["URL"]."/apply/",
                "SELECTED"          => false,
                "PERMISSION"        => "R",
                "ADDITIONAL_LINKS"  => [SITE_DIR."catalog/filter/brend-is-".$brand["URL"]."/apply/"],
                "ITEM_TYPE"         => "D",
                "PARAMS"            => [
                    "FROM_IBLOCK" => 1,
                    "IS_PARENT"   => 0,
                    "DEPTH_LEVEL" => 2
                ],
                "CHAIN"             => [$brand["NAME"]],
                "DEPTH_LEVEL"       => 2,
                "IS_PARENT"         => 0,
                "FROM_IBLOCK"       => 0
            ];
        }
    }
}
$arResult=$arResultNew;