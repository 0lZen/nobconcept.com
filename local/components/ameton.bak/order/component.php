<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("sale");
use Bitrix\Sale\DiscountCouponsManager;

if ($_POST["order"]=='Y')
{
    require('order_make.php');
} else
{
    $siteID=Bitrix\Main\Context::getCurrent()->getSite();

    DiscountCouponsManager::init();
    $basket = \Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), $siteID);
    $basket->refreshData();
    $arResult=getBasket($basket,false, $siteID,Bitrix\Sale\Fuser::getId());

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
        $arResult["DELIVERIES"]=DELIVERIES[$siteID];
    } else
    {
        foreach (DELIVERIES[$siteID] as $item)
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

    $this->IncludeComponentTemplate();
}

