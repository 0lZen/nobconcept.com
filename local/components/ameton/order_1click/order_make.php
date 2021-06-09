<?require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("sale");

global $USER;
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\DiscountCouponsManager,
    Bitrix\Sale\PaySystem;

$result=array();
$result["success"]='N';
$result["error_text"]=array();
$result["errors"]=array();
$result['ORDER_ID']=false;
$result['redirect_url']='';

if (check_bitrix_sessid())
{
    $dir=$_SERVER["DOCUMENT_ROOT"].'/upload/logs/orders/';
    if (!is_dir($dir)) mkdir($dir,0777,true);

    $arLog=[];

    $siteIDreal=Bitrix\Main\Context::getCurrent()->getSite();
    $siteID='s1';

    $arLog[]='site_id='.$siteID;
    $arLog[]='real_site_id='.$siteIDreal;
    $arLog[]='post='.print_r($_POST,true);

    $order_fields=array();
    foreach ($_POST as $key=>$val)
    {
        $order_fields[$key]=trim(htmlspecialchars($val));
    }

    $arLog[]='order_fields='.print_r($order_fields,true);

    $DELIVERY_ID=1;
    $PAYMENT_ID=3;

    $deliveryPrice=0;
    $needAddress='Y';
    $dadataType='';
    foreach (DELIVERIES[$siteIDreal] as $item)
    {
        if ($item['NAME']==$order_fields["delivery"])
        {
            $deliveryPrice=$item['PRICE'];
            $needAddress=$item['NEED_ADDRESS'];
            $dadataType=$item['DADATA_TYPE'];
            break;
        }
    }

    if (!$order_fields['skuID'])
    {
        $result["error_text"][]='Ошибка, обновите страницу';
    }
    if ($order_fields["NAME"]=="")
    {
        $result["errors"]["NAME"]=($siteIDreal=='s1')?'Заполните данное поле!':'Fill in this field!';
    }

    $phone=preg_replace("/[^\d]/","",$order_fields["PHONE"]);
    if (strlen($phone)<6)
    {
        $result["errors"]['PHONE']=($siteIDreal=='s1')?'Заполните данное поле!':'Fill in this field!';
    }

    $email=$order_fields["EMAIL"];
    if ($email=="")
    {
        $result["errors"]['EMAIL']=($siteIDreal=='s1')?'Заполните данное поле!':'Fill in this field!';
    } else
    {
        $res=preg_match("/^([a-z0-9_\-+.]+\.)*[a-z0-9_\-+.]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,10}$/i", $email, $found);
        if (!$res)
        {
            $result["errors"]['EMAIL']=($siteIDreal=='s1')?'Введите корректный email!':'Enter a valid email!';
        }
    }

    if ($order_fields["delivery"]=="")
    {
        $result["errors"]['delivery']=($siteIDreal=='s1')?'Заполните данное поле!':'Fill in this field!';
        $needAddress='N';
        $dadataType='';
    }

    if ($needAddress=='Y')
    {
        if ($order_fields["NOBADR"]=="")
        {
            $result["errors"]['NOBADR']=($siteIDreal=='s1')?'Заполните данное поле!':'Fill in this field!';
        } else
        if ($dadataType!='' && $order_fields["NOBADR_FULL"]!="Y")
        {
            $result["errors"]['NOBADR']=($siteIDreal=='s1')?'Укажите полный адрес!':'Fill full address!';
        }
    }


    if (empty($result["errors"]))
    {
        global $USER;
        if ($USER->IsAuthorized())
        {
            $USER_ID = $USER->GetID();
        } else
        {
            $arUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => $email))->Fetch();
            if ($arUser)
            {
                $USER_ID = $arUser['ID'];
            } else
            {
                $pass=md5(time().rand(0,100));

                $reg_fields=[
                    "LOGIN"             => $email,
                    "EMAIL"             => $email,
                    "PASSWORD"          => $pass,
                    "CONFIRM_PASSWORD"  => $pass,
                    "ACTIVE"            => 'Y',
                    "GROUP_ID"          => [3,4],
                    "LID"               => $siteID
                ];
                $ID = $USER->Add($reg_fields);
                if (intval($ID) > 0)
                {
                    $USER_ID=$ID;
                } else
                {
                    $result["error_text"][] = $USER->LAST_ERROR;
                }
            }
        }

        $arLog[]='user_id='.$USER_ID;

        if (empty($result["error_text"]))
        {
            DiscountCouponsManager::init();

            $basket = \Bitrix\Sale\Basket::create($siteID);

            $item = $basket->createItem('catalog', $order_fields['skuID']);
            $item->setFields(array(
                'QUANTITY' => 1,
                'PRODUCT_PROVIDER_CLASS' => \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
                'LID' => $siteID,
            ));

            $currencyCode = CurrencyManager::getBaseCurrency();

            // Создаёт новый заказ
            $order = Order::create($siteID, $USER_ID);
            $order->setPersonTypeId(1);
            $order->setField('CURRENCY', $currencyCode);

            $comment=$order_fields["delivery"].' / '.$order_fields["PHONE"];
            if ($order_fields["COMMENT"]!='')
            {
                $comment.=' / '.$order_fields["COMMENT"];
            }
            $order->setField('USER_DESCRIPTION', $comment);

            $order->setBasket($basket);

            //свойства
            $propertyCollection = $order->getPropertyCollection();

            $property = getPropertyByCode($propertyCollection, 'FIO');
            $property->setValue($order_fields['NAME']);

            $property = getPropertyByCode($propertyCollection, 'EMAIL');
            $property->setValue($order_fields["EMAIL"]);

            $property = getPropertyByCode($propertyCollection, 'PHONE');
            $property->setValue($order_fields["PHONE"]);

            if ($needAddress=='Y')
            {
                $arAdr=[$order_fields["NOBADR"]];
                if ($order_fields["FLAT"])
                {
                    $arAdr[]='кв. '.$order_fields["FLAT"];
                }

                $property = getPropertyByCode($propertyCollection, 'ADDRESS_FULL');
                $property->setValue(join(', ',$arAdr));

                $property = getPropertyByCode($propertyCollection, 'ADDRESS');
                $property->setValue($order_fields["NOBADR"]);

                $property = getPropertyByCode($propertyCollection, 'FLAT');
                $property->setValue($order_fields["FLAT"]);

                if ($dadataType!='')
                {
                    $property = getPropertyByCode($propertyCollection, 'ZIP');
                    $property->setValue($order_fields["NOBZP"]);

                    $property = getPropertyByCode($propertyCollection, 'COUNTRY');
                    $property->setValue($order_fields["NOBCNTRY"]);

                    $property = getPropertyByCode($propertyCollection, 'REGION');
                    $property->setValue($order_fields["NOBRGION"]);

                    $property = getPropertyByCode($propertyCollection, 'AREA');
                    $property->setValue($order_fields["NOBAREA"]);

                    $property = getPropertyByCode($propertyCollection, 'CITY');
                    $property->setValue($order_fields["NOBCTY"]);

                    $property = getPropertyByCode($propertyCollection, 'SETTLEMENT');
                    $property->setValue($order_fields["NOBSETTLEMENT"]);

                    $property = getPropertyByCode($propertyCollection, 'STREET');
                    $property->setValue($order_fields["NOBSTRT"]);

                    $property = getPropertyByCode($propertyCollection, 'HOUSE');
                    $property->setValue($order_fields["NOBHSE"]);

                    $property = getPropertyByCode($propertyCollection, 'BLOCK');
                    $property->setValue($order_fields["NOBBLOCK"]);
                }
            }

            //доставка
            $shipmentCollection=$order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem();
            $service = Bitrix\Sale\Delivery\Services\Manager::getById(Bitrix\Sale\Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId());

            $shipmentItemCollection=$shipment->getShipmentItemCollection();
            foreach ($basket as $basketItem)
            {
                $arLog[]='basket_item='.$basketItem->getField('NAME').' '.$basketItem->getQuantity().'шт';
                $item=$shipmentItemCollection->createItem($basketItem);
                $item->setQuantity($basketItem->getQuantity());
            }

            $arLog[]='deliveryPrice='.$deliveryPrice;

            $shipment->setFields(array(
                'DELIVERY_ID'           => $service['ID'],
                'DELIVERY_NAME'         => $service['NAME'],
                'CUSTOM_PRICE_DELIVERY' => 'Y',
                'PRICE_DELIVERY'        => $deliveryPrice,
                'DISCOUNT_PRICE'        => 0,
                'BASE_PRICE_DELIVERY'   => $deliveryPrice,
                'CURRENCY'              => $currencyCode
            ));

            //оплата
            $paymentCollection=$order->getPaymentCollection();

            $payment=$paymentCollection->createItem(Sale\PaySystem\Manager::getObjectById($PAYMENT_ID));
            $payment->setField("SUM", $order->getPrice());
            $payment->setField("CURRENCY", $currencyCode);

            $order->doFinalAction(true);

            $resultOrder = $order->save();
            $orderId = $order->getField('ACCOUNT_NUMBER');

            if ($orderId)
            {
                file_put_contents($dir.$orderId,join("\n\n",$arLog));

                $result["success"]='Y';
                $result['ORDER_ID']=$orderId;
                $result['order_price']=$order->getPrice();

                $result['redirect_url']="/personal/order/payment/?ORDER_ID=".$orderId."&PAYMENT_ID=".$orderId."/1";

                $mes = "<b>Оформлен новый заказ на сайте!</b><br/>";
                $mes .= "Имя: ".(string)$order_fields['NAME']." <br/>";
                $mes .= "E-mail: ".(string)$order_fields['EMAIL']." <br/>";
                $mes .= "Телефон: ".(string)$order_fields['PHONE']." <br/>";

                if ($needAddress=='Y')
                {
                    $mes .= "Адрес: ".(string)$order_fields['NOBADR'];
                    if ($order_fields["FLAT"])
                    {
                        $mes .= ", кв. ".(string)$order_fields['FLAT'];
                    }
                    $mes .= "<br/>";
                }

                $mes .= "<b>Состав заказа</b><br />";

                $i=0;
                foreach ($order->getBasket() as $bitem)
                {
                    $i++;
                    $mes .= $i." Наименование товара: ".$bitem->getField('NAME').";<br /> Цена: ".round($bitem->getField('PRICE'), 3)." руб.;<br /> Количество: ".round($bitem->getField('QUANTITY'), 1)." шт;<br /><br />";
                }
                $mes .= "<b>Сумма заказа:</b> ".(float)round($order->getPrice(),2)." руб.<br />";
                $mes .= "<b>Способ доставки:</b> ".$order_fields["delivery"];

                if ($order_fields["COMMENT"]!='')
                {
                    $mes .= "<br><b>Комментарий:</b> ".$order_fields["COMMENT"];
                }

                \CEvent::Send(
                    'SEND_ATTACH',
                    's1',
                    ['EMAIL_TO' => 'info@nobconcept.com', 'MESSAGE' => $mes, 'ORDER_ID'=>$orderId],
                    'Y',
                    '',
                    [],
                    'ru'
                );
            } else
            {
                $result["success"]='N';
                $result["error_text"][]='Произошла ошибка оформления заказа. '.join("\n",$resultOrder->getErrors());
            }

            if ($result["success"]=='Y')
            {
                DiscountCouponsManager::clear(true);
            }
        }
    }
} else
{
    $result["error_text"][]='Сессия истекла, обновите страницу';
}

$result["error_text"]=join("<br>",$result["error_text"]);
echo json_encode($result);