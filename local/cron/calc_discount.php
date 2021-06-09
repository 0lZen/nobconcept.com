<?
define("IS_CRON", true);
define("STOP_STATISTICS", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("DisableEventsCheck", true);
define("NOT_CHECK_PERMISSIONS",true);

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../..");

if (is_file($_SERVER["DOCUMENT_ROOT"]."/local/cron/calc_discount_run"))
{
    $runTime=(int)file_get_contents($_SERVER["DOCUMENT_ROOT"]."/local/cron/calc_discount_run");
    $deltaRunTime=(time()-$runTime)/60;
    if ($deltaRunTime>60)
    {
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/cron/calc_discount_run",time());
    } else
    {
        die();
    }
} else
{
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/local/cron/calc_discount_run",time());
}

set_time_limit (0);
ini_set("max_execution_time",0);
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
set_time_limit (0);
ini_set("max_execution_time",0);
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$iblockID=[
    12 => [
        'offersIB' => 13,
        'SITE_ID' => 's1'
    ]
];


foreach ($iblockID as $ibid=>$ibInfo)
{
    $cnt=0;
    $allCnt=0;

    $arOffers=[];
    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>$ibInfo["offersIB"], "ACTIVE"=>"Y"], false, false, ["ID","PROPERTY_CML2_LINK","PROPERTY_DISCOUNT_PRICE"]);
    while ($arFields = $res->Fetch())
    {
        $arOffers[$arFields["PROPERTY_CML2_LINK_VALUE"]][]=[
            'ID'            => $arFields["ID"],
            'DISC_PRICE'    => $arFields['PROPERTY_DISCOUNT_PRICE_VALUE']
        ];
    }

    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>$ibid, "ACTIVE"=>"Y"], false, false, ["ID","IBLOCK_ID","PROPERTY_HAS_DISCOUNT","CATALOG_TYPE","PROPERTY_DISCOUNT_PRICE","PROPERTY_BASE_PRICE"]);
    while ($arFields = $res->Fetch())
    {

        $IS_SKIDKA='N';

        if ($arFields["CATALOG_TYPE"]==1)
        {
            $cnt++;
            $arPrice = CCatalogProduct::GetOptimalPrice($arFields["ID"], 1, array(1), "N",[],$ibInfo["SITE_ID"],[]);
            if ($arPrice["DISCOUNT_PRICE"]>0 && $arPrice["DISCOUNT_PRICE"]<$arPrice["PRICE"]["PRICE"])
            {
                $IS_SKIDKA="Y";
            }
            if ($arPrice["DISCOUNT_PRICE"]!=$arFields['PROPERTY_DISCOUNT_PRICE_VALUE'])
            {
                CIBlockElement::SetPropertyValueCode($arFields["ID"], "DISCOUNT_PRICE", (float)$arPrice["DISCOUNT_PRICE"]);
            }
            if ($arPrice["PRICE"]["PRICE"]!=$arFields['PROPERTY_BASE_PRICE_VALUE'])
            {
                CIBlockElement::SetPropertyValueCode($arFields["ID"], "BASE_PRICE", (float)$arPrice["PRICE"]["PRICE"]);
            }
        } else
        if ($arFields["CATALOG_TYPE"]==3)
        {
            $minPrice=0;
            $minBasePrice=0;
            foreach ($arOffers[$arFields["ID"]] as $offer)
            {
                $cnt++;
                $arPrice = CCatalogProduct::GetOptimalPrice($offer['ID'], 1, array(1), "N",[],$ibInfo["SITE_ID"],[]);
                if ($arPrice["DISCOUNT_PRICE"]!=$offer['DISC_PRICE'])
                {
                    CIBlockElement::SetPropertyValueCode($offer['ID'], "DISCOUNT_PRICE", $arPrice["DISCOUNT_PRICE"]);
                }

                if ($arPrice["DISCOUNT_PRICE"]>0 && $arPrice["DISCOUNT_PRICE"]<$arPrice["PRICE"]["PRICE"])
                {
                    $IS_SKIDKA="Y";
                }

                if ($arPrice["DISCOUNT_PRICE"]<$minPrice || !$minPrice)
                {
                    $minPrice=$arPrice["DISCOUNT_PRICE"];
                    $minBasePrice=$arPrice["PRICE"]["PRICE"];
                }
            }

            if ($minPrice!=$arFields['PROPERTY_DISCOUNT_PRICE_VALUE'])
            {
                CIBlockElement::SetPropertyValueCode($arFields["ID"], "DISCOUNT_PRICE", (float)$minPrice);
            }
            if ($minBasePrice!=$arFields['PROPERTY_BASE_PRICE_VALUE'])
            {
                CIBlockElement::SetPropertyValueCode($arFields["ID"], "BASE_PRICE", (float)$minBasePrice);
            }
        }

        if ($arFields["PROPERTY_HAS_DISCOUNT_VALUE"]!=$IS_SKIDKA)
        {
            CIBlockElement::SetPropertyValueCode($arFields["ID"], "HAS_DISCOUNT", $IS_SKIDKA);
        }

        if ($cnt>10)
        {
            $cnt=0;
            CCatalogDiscount::ClearDiscountCache(array(
                'PRODUCT' => true,
                'SECTIONS' => true,
                'PROPERTIES' => true
            ));
        }
    }
}
BXClearCache(true, "/s1/bitrix/catalog.section/");
BXClearCache(true, "/s1/bitrix/catalog.element/");
BXClearCache(true, "/s2/bitrix/catalog.section/");
BXClearCache(true, "/s2/bitrix/catalog.element/");

unlink($_SERVER["DOCUMENT_ROOT"]."/local/cron/calc_discount_run");