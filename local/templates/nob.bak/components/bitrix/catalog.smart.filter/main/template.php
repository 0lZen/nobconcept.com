<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

$bi = array(
    $arResult['ITEMS'][58],
    $arResult['ITEMS'][106],
    $arResult['ITEMS'][53],
    $arResult['ITEMS'][52],
    $arResult['ITEMS'][14],
    $arResult['ITEMS'][60],
    $arResult['ITEMS'][104],
    $arResult['ITEMS'][105],

    $arResult['ITEMS'][84],
    $arResult['ITEMS'][90],
    $arResult['ITEMS'][112],
    $arResult['ITEMS'][113],
);
$arResult['ITEMS'] = $bi; 
?>


<?/*<div class="bx_filter <?=$templateData["TEMPLATE_CLASS"]?>">
	<div class="bx_filter_section">
		<div class="bx_filter_title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div>*/?>
<?//<div class="block-catalog__filter">?>

<?
require('include/desktop.php');
if (!$arParams["IS_AJAX"])
{
    require('include/mobile.php');
}
?>



<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'vertical');
</script>



<script>
function reloadTarget()
{
    location.reload();
}
function reloadClose()
{
    //window.location.href = "/catalog/";
    //window.location.href = "/sale/";
    $('#catalog-filter').iziModal('close');
}
</script>
