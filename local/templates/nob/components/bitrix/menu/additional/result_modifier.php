<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('sale');
/* Possible statuses: "has" or "empty" */

global $basketStat;

foreach ($arResult as $key => $arItem)
{
    if ($arItem["PARAMS"]["ACTION"] === "FAVORITE")
    {
        /* Logic for Favorites */
        $arResult[$key]["PARAMS"]["STATUS"] = "has";
    }
    elseif ($arItem["PARAMS"]["ACTION"] === "SEARCH")
    {
        /* Logic for Search */
        $arResult[$key]["PARAMS"]["STATUS"] = "empty";
    }
    elseif ($arItem["PARAMS"]["ACTION"] === "CART")
    {
        /* Logic for Cart */
        $arResult[$key]["PARAMS"]["STATUS"] = "has";

        $arResult[$key]["PARAMS"]["CART_NUM"] = $basketStat['CNT'];
    }

    if ($arItem["PARAMS"]["ICON"])
    {
        $arResult[$key]["PARAMS"]["ICON"] = str_replace(array("#SITE_TEMPLATE_PATH#"), SITE_TEMPLATE_PATH, $arItem["PARAMS"]["ICON"]);
    }
}

$this->__component->SetResultCacheKeys(array("CACHED_TPL"));