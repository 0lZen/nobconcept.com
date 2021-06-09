<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оплата заказа");
$order_id = (int)$_REQUEST['ORDER_ID'];
if($order_id && !$USER->IsAuthorized()){
    CModule::IncludeModule('sale');
    $last_order_qq = CSaleOrder::GetList(array("ID" => "DESC"), array("ID" => $order_id), false, array("nPageSize" => 1));
    if($last_order = $last_order_qq->GetNext()){
        $USER->Authorize($last_order['USER_ID']);
    }
}
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment",
	"",
	Array(
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>