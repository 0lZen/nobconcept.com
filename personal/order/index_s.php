<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
$order_id = (int)$_REQUEST['ORDER_ID'];
?>
<?
if($order_id){
    CModule::IncludeModule('sale');
    $arFields = array(
        "COMMENTS" => "Оплата заказа №".$order_id
    );
    $dd = CSaleOrder::Update($order_id, $arFields);
//https://nobconcept.com/personal/order/payment/?ORDER_ID=16&PAYMENT_ID=16/1
    $last_order_qq = CSaleOrder::GetList(array("ID" => "DESC"), array("ID" => $order_id), false, array("nPageSize" => 1));
    if($last_order = $last_order_qq->GetNext()){
        $last_order = $last_order;
        //echo "<pre>"; print_r($last_order); echo "</pre>";
        //$last_order = $last_order['ID'];
    }
    $last_order['USER_DESCRIPTION'] = explode(" / ", $last_order['USER_DESCRIPTION']);
    $last_order['USER_DESCRIPTION'] = $last_order['USER_DESCRIPTION'][0];

    if($last_order['USER_DESCRIPTION'] == 'Весь Мир - 2 500 рублей' || $last_order['USER_DESCRIPTION'] == 'The whole World - 2 500 rubles')
    {
        /*<div class="block block-contacts" id="contacts">

        <div class="block-contacts__square"></div>

        <div class="block__inner">
            <h1>Заказ №<?=$order_id?> успешно оформлен</h1>
            <p>
                Ваш заказ №<?=$order_id?> успешно оформлен. Ожидайте звонка менеджера для подтверждения заказа.
            </p>
            <br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
        </div>*/
        $arFields = array(
            "PRICE_DELIVERY" => 2500
        );
        $dd = CSaleOrder::Update($order_id, $arFields);
        LocalRedirect("/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
        //sleep(4);
    }elseif($last_order['USER_DESCRIPTION'] == 'Вся Россия - 500 рублей' || $last_order['USER_DESCRIPTION'] == 'All of Russia - 500 rubles'){
        $arFields = array(
            "PRICE_DELIVERY" => 500
        );
        $dd = CSaleOrder::Update($order_id, $arFields);
        //echo "<pre>"; var_dump($dd); echo "</pre>";
        #sleep(4);
        #header("Location: https://nobconcept.com/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
        LocalRedirect("/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");

    }elseif($last_order['USER_DESCRIPTION'] == 'Москва и МО - бесплатно' || $last_order['USER_DESCRIPTION'] == 'Moscow and Moscow region-free of charge')
    {
        #sleep(4);
        //echo "ssss";
        #header("Location: https://nobconcept.com/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
        LocalRedirect("/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
    }elseif($last_order['USER_DESCRIPTION'] == 'Самовывоз - бесплатно' || $last_order['USER_DESCRIPTION']=='Pickup - free of charge')
    {
        #sleep(4);
        //echo "ssss";
        #header("Location: https://nobconcept.com/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
        LocalRedirect("/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
    }
    else{
        if($last_order['DELIVERY_ID'] == 3){
            #sleep(4);
            //echo "ddd";
            LocalRedirect("/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
            #header("Location: https://nobconcept.com/personal/order/payment/?ORDER_ID=".$order_id."&PAYMENT_ID=".$order_id."/1");
        }else{
            ?>
            <div class="block block-contacts" id="contacts">

                <div class="block-contacts__square"></div>

            <? if (LANGUAGE_ID=='en') { ?>
                <div class="block__inner">
                    <h1>Order #<?=$order_id?> has been successfully paid.</h1>
                    <p>
                        Order #<?=$order_id?> has been successfully paid, you will receive a confirmation email.
                    </p>
                    <br/>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                </div>
            <? } else { ?>
                <div class="block__inner">
                    <h1>Заказ №<?=$order_id?> успешно оформлен</h1>
                    <p>
                        Ваш заказ №<?=$order_id?> успешно оформлен. Ожидайте звонка менеджера для подтверждения заказа.
                    </p>
                    <br/>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                </div>
            <? } ?>
            
            </div>
            <?
        }

    }

}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>