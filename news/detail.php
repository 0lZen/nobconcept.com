<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("Статья | NOBCONCEPT");
?>

<?$APPLICATION->IncludeComponent(
  "bitrix:news.detail",
  "news_detail", // шаблон
  Array(
    "CACHE_TYPE" => "N",
    "IBLOCK_ID" => IBLOCK_ID__NEWS,  // ID информационного блока
    "IBLOCK_TYPE" => "news",  // тип информационного блока
    "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],  // параметр передаваемой страницы
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    "ADD_SECTIONS_CHAIN" => "N",
    "SET_BROWSER_TITLE" => "Y",
    "SET_META_DESCRIPTION" => "Y",
    "SET_TITLE" => "Y",
    "ADD_ELEMENT_CHAIN" => "Y",
    "FIELD_CODE" => array(  // Поля
      0 => "CODE",
      1 => "NAME",
      2 => "ACTIVE_FROM",
    ),
    "PROPERTY_CODE" => array( // Свойства
      "NAME_RU",
      "NAME_EN",
      "PREVIEW_TEXT_RU",
      "PREVIEW_TEXT_EN",
      "DETAIL_TEXT_RU",
      "DETAIL_TEXT_EN",
      "SLIDER_1",
      "SLIDER_2",
      "SLIDER_3",
      "SLIDER_1_MOBILE",
      "SLIDER_2_MOBILE",
      "SLIDER_3_MOBILE",
    ),
  ),
  false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>