<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?>
<h1>Корзина</h1><?$APPLICATION->IncludeComponent(
	"dresscode:sale.basket.basket", 
	"standartOrder", 
	array(
		"COMPONENT_TEMPLATE" => "standartOrder",
		"HIDE_MEASURES" => "N",
		"BASKET_PICTURE_WIDTH" => "",
		"BASKET_PICTURE_HEIGHT" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>