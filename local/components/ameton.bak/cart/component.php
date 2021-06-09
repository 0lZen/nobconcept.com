<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("sale");

$basket = \Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

if ($_GET['view']=='Y')
{
    $basket->refreshData();
    $arResult=getBasket($basket, false, Bitrix\Main\Context::getCurrent()->getSite(), Bitrix\Sale\Fuser::getId());
    $this->IncludeComponentTemplate();
} else
{
    $arJsonResult=[];
    $arJsonResult['success']='N';
    $arJsonResult['error']=[];
    $arJsonResult['cnt']=[];
    $arJsonResult['skuID']=0;
    $arJsonResult['basketStat']=false;

    switch ($_POST['action'])
    {
        case "add_update":
            $skuID = (int)htmlspecialchars(trim($_POST["skuID"]));
            $rowID = (int)htmlspecialchars(trim($_POST["rowID"]));
            $q = (int)htmlspecialchars(trim($_POST["q"]));

            if ($skuID)
            {
                $rowID=false;
                $rowQ=false;
                foreach ($basket as $basketItem)
                {
                    if ($skuID==$basketItem->getProductId())
                    {
                        $rowID=$basketItem->GetID();
                        $rowQ=$basketItem->getQuantity()+1;
                        break;
                    }
                }

                if ($rowID)
                {
                    $res=$basket->getItemById($rowID)->setField('QUANTITY', $rowQ);
                    if ($res->IsSuccess())
                    {
                        $arJsonResult['success']='Y';
                        $basket->save();
                    } else
                    {
                        $arJsonResult["error"][]=join("\n",$res->getErrors());
                    }
                } else
                {
                    if (Add2BasketByProductID($skuID, 1))
                    {
                        $arJsonResult['success']='Y';
                        $basket = \Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
                    } else
                    {
                        global $APPLICATION;
                        if($ex = $APPLICATION->GetException())
                        {
                            $arJsonResult["error"][]=$ex->GetString();
                        }
                    }
                }
            } else
            if ($rowID)
            {
                $rowIDfound=false;
                foreach ($basket as $basketItem)
                {
                    if ($rowID==$basketItem->GetID())
                    {
                        $rowIDfound=true;
                        break;
                    }
                }

                if ($rowIDfound)
                {
                    if ($q)
                    {
                        $res=$basket->getItemById($rowID)->setField('QUANTITY', $q);
                        if ($res->IsSuccess())
                        {
                            $arJsonResult['success']='Y';
                            $basket->save();
                        } else
                        {
                            $arJsonResult["error"][]=join("\n",$res->getErrors());
                        }
                    } else
                    {
                        $res=$basket->getItemById($rowID)->delete();
                        if ($res->IsSuccess())
                        {
                            $arJsonResult['success']='Y';
                            $basket->save();
                        } else
                        {
                            $arJsonResult["error"][]=join("\n",$res->getErrors());
                        }
                    }
                } else
                {
                    if ($q)
                    {
                        if (Add2BasketByProductID($skuID, 1))
                        {
                            $arJsonResult['success']='Y';
                            $basket = \Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
                        } else
                        {
                            global $APPLICATION;
                            if($ex = $APPLICATION->GetException())
                            {
                                $arJsonResult["error"][]=$ex->GetString();
                            }
                        }
                    }
                }
            } else
            {
                $arJsonResult["error"][]='Ошибка, обновите страницу';
            }
            break;

        case "delete":
            $rowID = (int)htmlspecialchars(trim($_POST["id"]));

            if ($rowID)
            {
                $row=$basket->getItemById($rowID);
                $skuID=$row->GetProductID();
                $res=$row->delete();
                if ($res->IsSuccess())
                {
                    $arJsonResult['skuID']=$skuID;
                    $arJsonResult['success']='Y';
                    $basket->save();
                } else
                {
                    $arJsonResult["error"][]=join("\n",$res->getErrors());
                }
            } else
            {
                $arJsonResult["error"][]='Ошибка, обновите страницу';
            }
            break;

        case "coupon":
            $coupon=trim($_POST['coupon']);

            Bitrix\Sale\DiscountCouponsManager::init();
            Bitrix\Sale\DiscountCouponsManager::clear(true);
            if ($coupon)
            {
                Bitrix\Sale\DiscountCouponsManager::add($coupon);
            }
            $arJsonResult['success']='Y';
            break;

        case "clear":

            foreach ($basket as $item)
            {
                $item->delete();
            }
            $basket->save();

            $arJsonResult['success']='Y';
            break;
    }

    $arResult=getBasket($basket, false, Bitrix\Main\Context::getCurrent()->getSite(), Bitrix\Sale\Fuser::getId());
    $arJsonResult['cnt']=$arResult["COUNT_BY_Q"];
    $arJsonResult['basketStat']=getBasketStat($basket);

    $arResult['IS_REFRESH']=true;
    ob_start();
    $this->IncludeComponentTemplate();
    $arJsonResult['html'] = ob_get_contents();
    ob_end_clean();

    $arJsonResult['error']=join("\n", $arJsonResult['error']);
    echo json_encode($arJsonResult);
}