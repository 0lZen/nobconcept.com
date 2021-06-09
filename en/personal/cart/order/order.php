<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ваши заказы");
$ORDER_NUMBER=trim(htmlspecialcharsbx($_GET["ORDER_NUMBER"]));
?>

    <h2>Заказ №<?=$ORDER_NUMBER?> сформирован</h2>
    <p>Подробная информация о заказе доступна <a href='/personal/?SECTION=orders&ID=<?=$ORDER_NUMBER?>'>по ссылке</a></p>
    <p>Отслеживайте свои заказы в <a href='/personal/'>личном кабинете</a></p>
<?php
if($USER->IsAuthorized())
{
    $user_id = $USER->getID();
    if($user_id && $ORDER_NUMBER)
    {
        $arFilter = Array(
            "USER_ID" => $user_id,
            "ACCOUNT_NUMBER" => $ORDER_NUMBER
            );

        $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
        if ($order = $db_sales->Fetch())
        {

            $db_vals = CSaleOrderPropsValue::GetList(
                  array(),
                  array(
                          "ORDER_ID" => $order['ID'],
                          //"ORDER_PROPS_ID" => $arProps["ID"]
                      )
              );
            $arNewFields = array();
            while ($arVals = $db_vals->Fetch())
            {
                if ($arVals['CODE'] == 'FIO')
                {
                    $arNewFields['NAME'] = $arVals['VALUE'];
                }
                if ($arVals['CODE'] == 'EMAIL')
                {
                    $arNewFields['EMAIL'] = $arVals['VALUE'];
                }
                if ($arVals['CODE'] == 'PHONE')
                {
                    $arNewFields['PERSONAL_PHONE'] = $arVals['VALUE'];
                }
                if ($arVals['CODE'] == 'LOCATION')
                {
                    $arNewFields['PERSONAL_CITY'] = $arVals['VALUE'];
                }
                if ($arVals['CODE'] == 'INDEX')
                {
                    $arNewFields['PERSONAL_ZIP'] = $arVals['VALUE'];
                }
                if ($arVals['CODE'] == 'ADDRESS')
                {
                    $addr = explode(',', $arVals['VALUE']);
                    if (isset($addr[0]))
                    {
                        $arNewFields['PERSONAL_STREET'] = str_replace('ул. ', '', $addr[0]);
                    }
                    if (isset($addr[1]))
                    {
                        $arNewFields['PERSONAL_STATE'] = str_replace(' д.', '', $addr[1]);
                    }
                    if (isset($addr[2]))
                    {
                        $arNewFields['PERSONAL_MAILBOX'] = str_replace(' кв.', '', $addr[2]);
                    }
                }
            }
            
            $user = new CUser;
            $user->Update($user_id, $arNewFields);
        
    

?>
    <?php $resbb = CSaleBasket::GetList(
    array('NAME' => 'ASC'),
    array('ORDER_ID' => $order['ID']),
    false,
    false
);
$jsProds_rr = array();
$ya_sum = 0;
while ($elb = $resbb->GetNext()) {
           $jsProds_rr[] = array(
            'id'       => $elb['PRODUCT_ID'],
            'qnt' => $elb['QUANTITY'],
            'price'    => $elb['PRICE']
        );
    }?>
<script type="text/javascript">
        var PRODS_RR = <? echo CUtil::PhpToJSObject($jsProds_rr, false, true); ?>;
        (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
            try {
                rrApi.order({
                    transaction: '<?=$order['ID']?>',
                    items: PRODS_RR
                });
            } catch(e) {}
        })
    </script>
    <? }}} ?>
<?/*$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "", array(
    "PAY_FROM_ACCOUNT" => "Y",
    "COUNT_DELIVERY_TAX" => "N",
    "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
    "ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
    "ALLOW_AUTO_REGISTER" => "Y",
    "SEND_NEW_USER_NOTIFY" => "Y",
    "DELIVERY_NO_AJAX" => "N",
    "TEMPLATE_LOCATION" => "popup",
    "PROP_1" => array(
    ),
    "PATH_TO_BASKET" => "/personal/cart/",
    "PATH_TO_PERSONAL" => "/personal/order/",
    "PATH_TO_PAYMENT" => "/personal/order/payment/",
    "PATH_TO_ORDER" => "/personal/order/make/",
    "SET_TITLE" => "Y" ,
    "DELIVERY2PAY_SYSTEM" => Array(),
    "SHOW_ACCOUNT_NUMBER" => "Y",
    "DELIVERY_NO_SESSION" => "Y"
),
    false
);*/?>

    <div style="margin-bottom: 30px"></div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
