<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оплата заказа");

CModule::IncludeModule("sale");

$order_id = (int)$_REQUEST['ORDER_ID'];
if ($order_id)
{
    $saleOrder = Bitrix\Sale\Order::load($order_id);
    $saleOrderFields=$saleOrder->GetFields();

    $paymentCollection = $saleOrder->getPaymentCollection();
    foreach ($paymentCollection as $payment)
    {
        $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
        $context = \Bitrix\Main\Application::getInstance()->getContext();
        $service->initiatePay($payment, $context->getRequest());
        break;
    }
} else
{
    LocalRedirect('/');
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>