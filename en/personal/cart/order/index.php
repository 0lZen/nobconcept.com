<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Оформить заказ");
?>

<h1>Оформление заказа</h1>

	<div class="zakaz">
		<div id="prello"></div>
		<?$APPLICATION->IncludeComponent(
	"other:sale.order.custom", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PAY_FROM_ACCOUNT" => "Y",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"ALLOW_AUTO_REGISTER" => "N",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => ".default",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => array(
		),
		"PATH_TO_BASKET" => "basket.php",
		"PATH_TO_PERSONAL" => "index.php",
		"PATH_TO_PAYMENT" => "payment.php",
		"PATH_TO_AUTH" => "/auth/",
		"SET_TITLE" => "Y",
		"DISABLE_BASKET_REDIRECT" => "N",
		"PRODUCT_COLUMNS" => array(
		)
	),
	false
);?>
	</div>

<?php
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>