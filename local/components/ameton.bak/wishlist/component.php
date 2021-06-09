<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFav=Favorites_getArr();
$arResult['ITEMS']=[];

if (!empty($arFav))
{
    if (in_array($_SESSION['CURRENCY_CURRENT'],['EUR','USD']))
    {
        $bNeedConvertCurrency=true;
    } else
    {
        $bNeedConvertCurrency=false;
    }

    $siteId=Bitrix\Main\Context::getCurrent()->getSite();



    $arParentIDs = [];
    $arSelect=["ID", "IBLOCK_ID", "CATALOG_QUANTITY", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL",
        "PROPERTY_TSVETT", "PROPERTY_TSVET_NA_ANGLIYSKOM", "PROPERTY_RAZMER", "PROPERTY_CML2_LINK"];
    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>SKU_IBLOCK_ID[$siteId], "ID" => $arFav, "ACTIVE" => "Y"], false, false, $arSelect);
    while($arFields = $res->GetNext())
    {
        if ($arFields['DETAIL_PICTURE'])
        {
            $img = CFile::GetPath($arFields['DETAIL_PICTURE']);
        } else
        if ($arFields['PREVIEW_PICTURE'])
        {
            $img = CFile::GetPath($arFields['PREVIEW_PICTURE']);
        } else
        {
            $img = false;
        }

        if ($siteId=='s1')
        {
            $color=$arFields["PROPERTY_TSVETT_VALUE"];
        } else
        {
            if ($arFields["PROPERTY_TSVET_NA_ANGLIYSKOM_VALUE"])
            {
                $color=$arFields["PROPERTY_TSVET_NA_ANGLIYSKOM_VALUE"];
            } else
            {
                $color=$arFields["PROPERTY_TSVETT_VALUE"];
            }
        }

        $productsArr[$arFields["ID"]]=array(
            "PARENT_ID" => $arFields["PROPERTY_CML2_LINK_VALUE"],
            'URL'       => $arFields["DETAIL_PAGE_URL"],
            'COLOR'     => $color,
            'SIZE'      => $arFields["PROPERTY_RAZMER_VALUE"],
            'MAX_CNT'   => $arFields["CATALOG_QUANTITY"],
            'IMG'       => $img
        );
        $arParentIDs[$arFields["PROPERTY_CML2_LINK_VALUE"]]=true;
    }

    $arSelect=["ID", "IBLOCK_ID", "CATALOG_QUANTITY", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_BREND", "PROPERTY_PREDZAKAZ"];
    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>CATALOG_IBLOCK_ID[$siteId], "ID" => array_merge($arFav,array_keys($arParentIDs)), "ACTIVE" => "Y"], false, false, $arSelect);
    while($arFields = $res->GetNext())
    {
        if ($arFields['DETAIL_PICTURE'])
        {
            $img = CFile::GetPath($arFields['DETAIL_PICTURE']);
        } else
        if ($arFields['PREVIEW_PICTURE'])
        {
            $img = CFile::GetPath($arFields['PREVIEW_PICTURE']);
        } else
        {
            $img = false;
        }

        $productsArr[$arFields["ID"]]=array(
            "PARENT_ID" => false,
            'NAME'      => $arFields["NAME"],
            'URL'       => $arFields["DETAIL_PAGE_URL"],
            'MAX_CNT'   => $arFields["CATALOG_QUANTITY"],
            "BRAND"     => $arFields["PROPERTY_BREND_VALUE"],
            "PREDZAKAZ" => $arFields["PROPERTY_PREDZAKAZ_VALUE"],
            'IMG'       => $img
        );
    }

    $needSave=false;
    foreach ($arFav as $key=>$skuID)
    {
        if (!isset($productsArr[$skuID]))
        {
            unset($arFav[$key]);
            $needSave=true;
        }
    }
    if ($needSave)
    {
        ?>
        <script>
        $.cookie("favorites_"+siteDir, "[<?=join(',',$arFav)?>]", { expires: 30000, path: "/"});
        </script>
        <?
    }

    if (!empty($arFav))
    {
        CModule::IncludeModule("sale");
        $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $basketStat = getBasketStat($basket);

        foreach ($arFav as $pId)
        {
            $parentId= $productsArr[$pId]['PARENT_ID'];

            $arPrice = CCatalogProduct::GetOptimalPrice($pId, 1, array(1), "N",[],SITE_ID,[]);

            $price          = $arPrice["DISCOUNT_PRICE"];
            $priceBase      = $arPrice["PRICE"]["PRICE"];

            if ($bNeedConvertCurrency)
            {
                $price          = round(CCurrencyRates::ConvertCurrency($price, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
                $priceBase      = round(CCurrencyRates::ConvertCurrency($priceBase, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
            }

            $arResult["ITEMS"][$pId]=array(
                "CAN_BUY"           => ($productsArr[$pId]["MAX_CNT"] > 0) ? true : false,
                "IN_CART"           => ($basketStat['ITEMS'][$pId]) ? true : false,
                "PRODUCT_ID"        => $pId,
                "NAME"              => $parentId ? $productsArr[$parentId]["NAME"] : $productsArr[$pId]["NAME"],

                "PRICE"             => $price,
                "PRICE_BASE"        => $priceBase,

                "PRICE_PRINT"       => CurrencyFormat($price, $_SESSION['CURRENCY_CURRENT']),
                "PRICE_BASE_PRINT"  => CurrencyFormat($priceBase, $_SESSION['CURRENCY_CURRENT']),

                "IMG"               => $productsArr[$pId]["IMG"] ? $productsArr[$pId]["IMG"] : $productsArr[$parentId]["IMG"],
                "URL"               => $parentId ? $productsArr[$parentId]["URL"] : $productsArr[$pId]["URL"],

                "MAX_CNT"           => $productsArr[$pId]["MAX_CNT"],
                "BRAND"             => $parentId ? $productsArr[$parentId]["BRAND"] : $productsArr[$pId]["BRAND"],
                "PREDZAKAZ"         => $parentId ? $productsArr[$parentId]["PREDZAKAZ"] : $productsArr[$pId]["PREDZAKAZ"],
                "COLOR"             => $productsArr[$pId]["COLOR"],
                "SIZE"              => $productsArr[$pId]["SIZE"]
            );
        }
    }
}

$this->IncludeComponentTemplate();