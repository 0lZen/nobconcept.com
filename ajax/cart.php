<?require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (IS_AJAX)
{
    $APPLICATION->IncludeComponent("ameton:cart", "full", Array(),false);
}
