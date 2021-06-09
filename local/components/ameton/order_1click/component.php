<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("sale");
use Bitrix\Sale\DiscountCouponsManager;



if ($_POST["order"]=='Y')
{
    require('order_make.php');
} else
{
    $siteIDreal=Bitrix\Main\Context::getCurrent()->getSite();
    $siteID='s1';

    $skuID=(int)trim($_GET['id']);

    if ($skuID)
    {
        DiscountCouponsManager::init();
        $basket = \Bitrix\Sale\Basket::create($siteID);

        $item = $basket->createItem('catalog', $skuID);
        $item->setFields(array(
            'QUANTITY' => 1,
            'PRODUCT_PROVIDER_CLASS' => \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
            'LID' => $siteID,

        ));

        $arResult=getBasket($basket,false, $siteID,Bitrix\Sale\Fuser::getId());
        $arResult['skuID']=$skuID;

        if (!empty($arResult['ITEMS']))
        {
            $arItems=[];
            foreach ($arResult["ITEMS"] as $item)
            {
                if ($item['CAN_BUY'])
                {
                    $arItems[]=$item;
                }
            }
            $arResult['ITEMS']=$arItems;
        }

        // доставки
        $arResult["DELIVERIES"]=[];

        if ($arResult["ITEMS"])
        {
            $arResult["DELIVERIES"]=DELIVERIES[$siteIDreal];
        } else
        {
            foreach (DELIVERIES[$siteIDreal] as $item)
            {
                if ($item['PRICE']>0)
                {
                    $arResult["DELIVERIES"][]=$item;
                }
            }
        }

        $arResult["ORDER_PRICE"] = $arResult["SRC_ORDER_PRICE"] = $arResult["SRC_TOTAL_BASKET_PRICE"]+$arResult["DELIVERIES"][0]['PRICE'];
        if ($arResult['IS_CURRENCY_CONVERTED'])
        {
            $arResult["ORDER_PRICE"] = round(CCurrencyRates::ConvertCurrency($arResult["ORDER_PRICE"], "RUB", $_SESSION['CURRENCY_CURRENT']),2);
        }
        $arResult["ORDER_PRICE_PRINT"]       = CurrencyFormat($arResult["ORDER_PRICE"], $_SESSION['CURRENCY_CURRENT']);
        $arResult["SRC_ORDER_PRICE_PRINT"]   = CurrencyFormat($arResult["SRC_ORDER_PRICE"], 'RUB');
    }
    $this->IncludeComponentTemplate();
}

