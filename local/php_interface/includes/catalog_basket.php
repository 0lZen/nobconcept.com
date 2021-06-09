<?
// total prods
function getBasket($basket,$isOrdered=false,$siteId,$fUserId)
{
    $siteIdreal=Bitrix\Main\Context::getCurrent()->getSite();

    if (in_array($_SESSION['CURRENCY_CURRENT'],['EUR','USD']))
    {
        $bNeedConvertCurrency=true;
    } else
    {
        $bNeedConvertCurrency=false;
    }

    $arResult=[];
    $arResult["ITEMS"]['AVAILABLE']=[];
    $arResult["ITEMS"]['NOT_AVAILABLE']=[];

    $arResult["TOTAL_BASKET_PRICE_PRINT"] = CurrencyFormat(0, $_SESSION['CURRENCY_CURRENT']);
    $arResult["COUNT_BY_Q"]=0;
    $arResult["COUNT"]=0;
    $arResult['COUPON_LIST']=[];

    $needSave=false;
    $productsIDs=[];
    foreach ($basket as $basketItem)
    {
        if ($basketItem->isDelay())
        {
            $basketItem->delete();
            $needSave=true;
        } else
        {
            $productsIDs[$basketItem->getProductId()]=true;
        }
    }
    if ($needSave)
    {
        $basket->save();
    }

    $productsArr=[];
    $productsParentArr=[];

    if (!empty($productsIDs))
    {

        $arParentIDs = [];
        $arSelect=["ID", "IBLOCK_ID", "CATALOG_QUANTITY", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL",
            "PROPERTY_TSVET", "PROPERTY_TSVET_NA_ANGLIYSKOM", "PROPERTY_RAZMER", "PROPERTY_CML2_LINK", "PROPERTY_ANGLIYSKOE_NAIMENOVANIE"];
        $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>SKU_IBLOCK_ID, "ID" => array_keys($productsIDs), "ACTIVE" => "Y"], false, false, $arSelect);
        while($arFields = $res->GetNext())
        {
            if ($arFields['DETAIL_PICTURE'])
            {
                $img = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=>400, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $img=$img['src'];
                #$img = CFile::GetPath($arFields['DETAIL_PICTURE']);
            } else
            if ($arFields['PREVIEW_PICTURE'])
            {
                $img = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>400, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $img=$img['src'];
                #$img = CFile::GetPath($arFields['PREVIEW_PICTURE']);
            } else
            {
                $img = false;
            }


            if ($siteIdreal=='s1')
            {
                $color=$arFields["PROPERTY_TSVET_VALUE"];
            } else
            {
                if ($arFields["PROPERTY_TSVET_NA_ANGLIYSKOM_VALUE"])
                {
                    $color=$arFields["PROPERTY_TSVET_NA_ANGLIYSKOM_VALUE"];
                } else
                {
                    $color=$arFields["PROPERTY_TSVET_VALUE"];
                }
            }

            $productsArr[$arFields["ID"]]=array(
                "PARENT_ID" => $arFields["PROPERTY_CML2_LINK_VALUE"],
                'NAME'      => $arFields["NAME"],
                'URL'       => $arFields["DETAIL_PAGE_URL"],
                'COLOR'     => $color,
                'SIZE'      => $arFields["PROPERTY_RAZMER_VALUE"],
                'MAX_CNT'   => $arFields["CATALOG_QUANTITY"],
                'IMG'       => $img
            );
            $arParentIDs[$arFields["PROPERTY_CML2_LINK_VALUE"]]=true;
        }

        $arSelect=["ID", "IBLOCK_ID", "CATALOG_QUANTITY", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_BREND", "PROPERTY_PREDZAKAZ", "PROPERTY_ANGLIYSKOE_NAIMENOVANIE"];
        $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ID" => array_merge(array_keys($productsIDs),array_keys($arParentIDs)), "ACTIVE" => "Y"], false, false, $arSelect);
        while($arFields = $res->GetNext())
        {
            if ($arFields['DETAIL_PICTURE'])
            {
                $img = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], array('width'=>400, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $img=$img['src'];
                #$img = CFile::GetPath($arFields['DETAIL_PICTURE']);
            } else
            if ($arFields['PREVIEW_PICTURE'])
            {
                $img = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array('width'=>400, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $img=$img['src'];
                #$img = CFile::GetPath($arFields['PREVIEW_PICTURE']);
            } else
            {
                $img = false;
            }

            if ($siteIdreal=='s2' && $arFields["PROPERTY_ANGLIYSKOE_NAIMENOVANIE_VALUE"])
            {
                $name=$arFields["PROPERTY_ANGLIYSKOE_NAIMENOVANIE_VALUE"];
            } else
            {
                $name=$arFields["NAME"];
            }

            $productsArr[$arFields["ID"]]=array(
                "PARENT_ID" => false,
                'NAME'      => $name,
                'URL'       => $arFields["DETAIL_PAGE_URL"],
                'MAX_CNT'   => $arFields["CATALOG_QUANTITY"],
                "BRAND"     => $arFields["PROPERTY_BREND_VALUE"],
                "PREDZAKAZ" => $arFields["PROPERTY_PREDZAKAZ_VALUE"],
                'IMG'       => $img
            );
        }

        if (!$isOrdered)
        {
            $needSave=false;
            foreach ($basket as $basketItem)
            {
                if (!isset($productsArr[$basketItem->getProductId()]))
                {
                    $basketItem->delete();
                    $needSave=true;
                }
            }
            if ($needSave)
            {
                $basket->save();
            }
        }

        $order=$basket->getOrder();

        if (!$order && !$isOrdered)
        {
            $order = Bitrix\Sale\Order::create($siteId, $fUserId);
            $order->setBasket($basket);
            $order->doFinalAction(true);
            $basket = $order->getBasket();
        }

        $deliveryPrice=0;
        $deliveryPriceBase=0;
        $shipmentCollection = $order->getShipmentCollection();
        foreach ($shipmentCollection as $shipment)
        {
            $deliveryPrice=$shipment->getField('PRICE_DELIVERY');
            $deliveryPriceBase=$shipment->getField('BASE_PRICE_DELIVERY');
        }

        $arResult["COUNT"]=count($basket->getOrderableItems());
        $arResult["COUNT_BY_Q"]=0;

        if (!$isOrdered)
        {
            $arResult["TOTAL_BASKET_PRICE"] = $arResult["SRC_TOTAL_BASKET_PRICE"] = round($basket->getOrderableItems()->getPrice(),2);
        } else
        {
            $arResult["TOTAL_BASKET_PRICE"] = $arResult["SRC_TOTAL_BASKET_PRICE"] = round($basket->getPrice(),2);
        }
        $arResult["TOTAL_PRICE"]        = $arResult["SRC_TOTAL_PRICE"]      = round($order->getPrice(),2);
        $arResult["TOTAL_PRICE_BASE"]   = $arResult["SRC_TOTAL_PRICE_BASE"] = round($basket->getOrderableItems()->getBasePrice()+$deliveryPriceBase,2);
        $arResult["TOTAL_DISCOUNT"]     = $arResult["SRC_TOTAL_DISCOUNT"]   = round($arResult["TOTAL_PRICE_BASE"]-$arResult["TOTAL_PRICE"],2);

        if ($bNeedConvertCurrency)
        {
            $arResult["TOTAL_BASKET_PRICE"] = round(CCurrencyRates::ConvertCurrency($arResult["TOTAL_BASKET_PRICE"], "RUB", $_SESSION['CURRENCY_CURRENT']),2);
            $arResult["TOTAL_PRICE"]        = round(CCurrencyRates::ConvertCurrency($arResult["TOTAL_PRICE"], "RUB", $_SESSION['CURRENCY_CURRENT']),2);
            $arResult["TOTAL_PRICE_BASE"]   = round(CCurrencyRates::ConvertCurrency($arResult["TOTAL_PRICE_BASE"], "RUB", $_SESSION['CURRENCY_CURRENT']),2);
            $arResult["TOTAL_DISCOUNT"]     = round(CCurrencyRates::ConvertCurrency($arResult["TOTAL_DISCOUNT"], "RUB", $_SESSION['CURRENCY_CURRENT']),2);
        }

        $arResult["TOTAL_BASKET_PRICE_PRINT"]   = CurrencyFormat($arResult["TOTAL_BASKET_PRICE"], $_SESSION['CURRENCY_CURRENT']);
        $arResult["TOTAL_PRICE_PRINT"]          = CurrencyFormat($arResult["TOTAL_PRICE"], $_SESSION['CURRENCY_CURRENT']);
        $arResult["TOTAL_PRICE_BASE_PRINT"]     = CurrencyFormat($arResult["TOTAL_PRICE_BASE"], $_SESSION['CURRENCY_CURRENT']);
        $arResult["TOTAL_DISCOUNT_PRINT"]       = CurrencyFormat($arResult["TOTAL_DISCOUNT"], $_SESSION['CURRENCY_CURRENT']);

        $arResult["SRC_TOTAL_BASKET_PRICE_PRINT"]   = CurrencyFormat($arResult["SRC_TOTAL_BASKET_PRICE"], 'RUB');
        $arResult["SRC_TOTAL_PRICE_PRINT"]          = CurrencyFormat($arResult["SRC_TOTAL_PRICE"], 'RUB');
        $arResult["SRC_TOTAL_PRICE_BASE_PRINT"]     = CurrencyFormat($arResult["SRC_TOTAL_PRICE_BASE"], 'RUB');
        $arResult["SRC_TOTAL_DISCOUNT_PRINT"]       = CurrencyFormat($arResult["SRC_TOTAL_DISCOUNT"], 'RUB');

        foreach ($basket as $basketItem)
        {
            $pId=$basketItem->getProductId();
            $parentId= $productsArr[$pId]['PARENT_ID'];

            if ($isOrdered || $basketItem->canBuy())
            {
                $CAN_BUY='AVAILABLE';
            } else
            {
                $CAN_BUY='NOT_AVAILABLE';
            }

            $basketPropertyCollection = $basketItem->getPropertyCollection();
            $arrProps=$basketPropertyCollection->getPropertyValues();

            $price          = $priceSrc             = $basketItem->getPrice();
            $priceBase      = $priceBaseSrc         = $basketItem->getBasePrice();
            $totalPrice     = $totalPriceSrc        = $price*$basketItem->getQuantity();
            $totalPriceBase = $totalPriceBaseSrc    = $basketItem->getBasePrice()*$basketItem->getQuantity();

            if ($bNeedConvertCurrency)
            {
                $price          = round(CCurrencyRates::ConvertCurrency($price, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
                $priceBase      = round(CCurrencyRates::ConvertCurrency($priceBase, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
                $totalPrice     = round(CCurrencyRates::ConvertCurrency($totalPrice, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
                $totalPriceBase = round(CCurrencyRates::ConvertCurrency($totalPriceBase, "RUB", $_SESSION['CURRENCY_CURRENT']),2);
            }

            $arResult["ITEMS"][$CAN_BUY][$basketItem->getId()]=array(
                "CAN_BUY"       => $basketItem->canBuy(),
                "CART_ID"       => $basketItem->getId(),
                "PRODUCT_ID"    => $basketItem->getProductId(),
                "NAME"          => $parentId ? $productsArr[$parentId]["NAME"] : $productsArr[$pId]["NAME"],
                "QUANTITY"      => $basketItem->getQuantity(),

                "PRICE"             => $price,
                "PRICE_BASE"        => $priceBase,
                "TOTAL_PRICE"       => $totalPrice,
                "TOTAL_PRICE_BASE"  => $totalPriceBase,

                "PRICE_PRINT"            => CurrencyFormat($price, $_SESSION['CURRENCY_CURRENT']),
                "PRICE_BASE_PRINT"       => CurrencyFormat($priceBase, $_SESSION['CURRENCY_CURRENT']),
                "TOTAL_PRICE_PRINT"      => CurrencyFormat($totalPrice, $_SESSION['CURRENCY_CURRENT']),
                "TOTAL_PRICE_BASE_PRINT" => CurrencyFormat($totalPriceBase, $_SESSION['CURRENCY_CURRENT']),

                "SRC_PRICE"             => $priceSrc,
                "SRC_PRICE_BASE"        => $priceBaseSrc,
                "SRC_TOTAL_PRICE"       => $totalPriceSrc,
                "SRC_TOTAL_PRICE_BASE"  => $totalPriceBaseSrc,

                "SRC_PRICE_PRINT"            => CurrencyFormat($priceSrc, 'RUB'),
                "SRC_PRICE_BASE_PRINT"       => CurrencyFormat($priceBaseSrc, 'RUB'),
                "SRC_TOTAL_PRICE_PRINT"      => CurrencyFormat($totalPriceSrc, 'RUB'),
                "SRC_TOTAL_PRICE_BASE_PRINT" => CurrencyFormat($totalPriceBaseSrc, 'RUB'),

                "IMG"         => $productsArr[$pId]["IMG"] ? $productsArr[$pId]["IMG"] : $productsArr[$parentId]["IMG"],
                "URL"         => $parentId ? $productsArr[$parentId]["URL"] : $productsArr[$pId]["URL"],

                "MAX_CNT"   => $productsArr[$basketItem->getProductId()]["MAX_CNT"],
                "BRAND"     => $parentId ? $productsArr[$parentId]["BRAND"] : $productsArr[$pId]["BRAND"],
                "PREDZAKAZ" => $parentId ? $productsArr[$parentId]["PREDZAKAZ"] : $productsArr[$pId]["PREDZAKAZ"],
                "COLOR"     => $productsArr[$pId]["COLOR"],
                "SIZE"      => $productsArr[$pId]["SIZE"]
            );

            $arResult["COUNT_BY_Q"]+=$basketItem->getQuantity();
        }

        $arResult["ITEMS"]['AVAILABLE']=array_reverse($arResult["ITEMS"]['AVAILABLE']);
        $arResult["ITEMS"]['NOT_AVAILABLE']=array_reverse($arResult["ITEMS"]['NOT_AVAILABLE']);

        $arCoupons = Bitrix\Sale\DiscountCouponsManager::get(true, [], true, true);
        if (!empty($arCoupons))
        {
            foreach ($arCoupons as &$oneCoupon)
            {
                if ($arResult['COUPON'] == '') $arResult['COUPON'] = $oneCoupon['COUPON'];

                if ($oneCoupon['STATUS'] == Bitrix\Sale\DiscountCouponsManager::STATUS_NOT_FOUND || $oneCoupon['STATUS'] == Bitrix\Sale\DiscountCouponsManager::STATUS_FREEZE)
                {
                    $oneCoupon['JS_STATUS'] = 'BAD';
                } else
                if ($oneCoupon['STATUS'] == Bitrix\Sale\DiscountCouponsManager::STATUS_NOT_APPLYED || $oneCoupon['STATUS'] == Bitrix\Sale\DiscountCouponsManager::STATUS_ENTERED)
                {
                    if($oneCoupon['STATUS'] == Bitrix\Sale\DiscountCouponsManager::STATUS_NOT_APPLYED)
                    {
                        $oneCoupon['STATUS_TEXT'] = Bitrix\Sale\DiscountCouponsManager::getCheckCodeMessage(Bitrix\Sale\DiscountCouponsManager::COUPON_CHECK_OK);
                    }
                }

                $arResult['COUPON_LIST'][] = $oneCoupon;
            }
            unset($oneCoupon);
            unset($arCoupons);
        }
    }

    $arResult["ITEMS"]=array_merge($arResult["ITEMS"]['AVAILABLE'],$arResult["ITEMS"]['NOT_AVAILABLE']);
    $arResult["IS_CURRENCY_CONVERTED"]=$bNeedConvertCurrency;

    return $arResult;
}

function Favorites_checkIn($prodID)
{
    $arFav=Favorites_getArr();
    return in_array($prodID,$arFav);
}

function Favorites_getArr()
{
    $arFav=json_decode($_COOKIE['favorites'],true);
    return $arFav;
}

function getBasketStat($basket)
{
    $arStat = ['CNT'=>0,'PRICE'=>0,'ITEMS'=>[]];

    foreach ($basket as $basketItem)
    {
        if ($basketItem->canBuy())
        {
            $arStat['CNT'] += $basketItem->getQuantity();
            $arStat['PRICE'] += $basketItem->getQuantity()*$basketItem->getPrice();
            $arStat['ITEMS'][$basketItem->getProductId()] = $basketItem->getQuantity();
        }
    }

    $arStat['PRICE']=round($arStat['PRICE'],2);

    return $arStat;
}