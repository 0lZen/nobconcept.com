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

    $siteID=Bitrix\Main\Context::getCurrent()->getSite();

    $arLog[]='site_id='.$siteID;
    $arLog[]='post='.print_r($_POST,true);

    $order_fields=array();
    foreach ($_POST as $key=>$val)
    {
        $order_fields[$key]=trim(htmlspecialchars($val));
    }

    $arLog[]='order_fields='.print_r($order_fields,true);

    $DELIVERY_ID=1;
    $PAYMENT_ID=3;

    if (!$order_fields['skuID'])
    {
        $result["error_text"][]='Ошибка, обновите страницу';
    }
    if ($order_fields["NAME"]=="")
    {
        $result["errors"]["NAME"]=($siteID=='s1')?'Заполните данное поле!':'Fill in this field!';
    }

    $phone=preg_replace("/[^\d]/","",$order_fields["PHONE"]);
    if (strlen($phone)<6)
    {
        $result["errors"]['PHONE']=($siteID=='s1')?'Заполните данное поле!':'Fill in this field!';
    }

    $email=$order_fields["EMAIL"];
    if ($email=="")
    {
        $result["errors"]['EMAIL']=($siteID=='s1')?'Заполните данное поле!':'Fill in this field!';
    } else
    {
        $res=preg_match("/^([a-z0-9_\-+.]+\.)*[a-z0-9_\-+.]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,10}$/i", $email, $found);
        if (!$res)
        {
            $result["errors"]['EMAIL']=($siteID=='s1')?'Введите корректный email!':'Enter a valid email!';
        }
    }

    if ($order_fields["ADDRESS"]=="")
    {
        $result["errors"]['ADDRESS']=($siteID=='s1')?'Заполните данное поле!':'Fill in this field!';
    }

    if ($order_fields["delivery"]=="")
    {
        $result["errors"]['delivery']=($siteID=='s1')?'Заполните данное поле!':'Fill in this field!';
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

            $order->setField('USER_DESCRIPTION', $order_fields["delivery"].' / '.$order_fields["PHONE"]);

            $order->setBasket($basket);

            //свойства
            $propertyCollection = $order->getPropertyCollection();

            $property = getPropertyByCode($propertyCollection, 'FIO');
            $property->setValue($order_fields['NAME']);

            $property = getPropertyByCode($propertyCollection, 'EMAIL');
            $property->setValue($order_fields["EMAIL"]);

            $property = getPropertyByCode($propertyCollection, 'PHONE');
            $property->setValue($order_fields["PHONE"]);

            $property = getPropertyByCode($propertyCollection, 'ADDRESS');
            $property->setValue($order_fields["ADDRESS"]);

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

            $deliveryPrice=0;
            foreach (DELIVERIES[$siteID] as $item)
            {
                if ($item['NAME']==$order_fields["delivery"])
                {
                    $deliveryPrice=$item['PRICE'];
                    break;
                }
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

                $result['redirect_url']="/personal/order/payment/?ORDER_ID=".$orderId."&PAYMENT_ID=".$orderId."/1";

                $mes = "<b>Оформлен новый заказ на сайте!</b><br/>";
                $mes .= "Имя: ".(string)$order_fields['NAME']." <br/>";
                $mes .= "E-mail: ".(string)$order_fields['EMAIL']." <br/>";
                $mes .= "Телефон: ".(string)$order_fields['PHONE']." <br/>";
                $mes .= "Адрес: ".(string)$order_fields['ADDRESS']." <br/>";
                $mes .= "<b>Состав заказа</b><br />";

                $i=0;
                foreach ($order->getBasket() as $bitem)
                {
                    $i++;
                    $mes .= $i." Наименование товара: ".$bitem->getField('NAME').";<br /> Цена: ".round($bitem->getField('PRICE'), 3)." руб.;<br /> Количество: ".round($bitem->getField('QUANTITY'), 1)." шт;<br /><br />";
                }
                $mes .= "<b>Сумма заказа:</b> ".(float)round($order->getPrice(),2)." руб.<br />";
                $mes .= "<b>Способ доставки:</b> ".$order_fields["delivery"];

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