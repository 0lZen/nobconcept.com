<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("Каталог");

if (strpos($APPLICATION->GetCurDir(),'catalog/filter/')!==false)
{
    $sefSection='';
} else
{
    $sefSection='#SECTION_CODE_PATH#/';
}

if (strpos($APPLICATION->GetCurDir(),'/catalog/product/')!==false)
{
    $AJAX_MODE='N';
} else
{
    $AJAX_MODE='Y';
}

?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	"main",
	array(
        "CURRENCY" => $_SESSION['CURRENCY_CURRENT'],
        "CONVERT_CURRENCY" => 'N',
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => $AJAX_MODE,
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"BIG_DATA_RCM_TYPE" => "personal",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "Y",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"LIST_PROPERTY_CODE" => array(
			0 => "ANGLIYSKOE_NAIMENOVANIE",
		),
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
			0 => "BUY",
		),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(
			0 => "POPUP",
			1 => "MAGNIFIER",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_POPULAR" => "N",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "CATALOG_AVAILABLE",
		"ELEMENT_SORT_FIELD2" => "PROPERTY_DATA_POYAVLENIYA_TOVARA",
		"ELEMENT_SORT_ORDER" => "DESC,NULLS",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_HIDE_ON_MOBILE" => "Y",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "Y",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_OFFERS_LIMIT" => "5",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':true},{'VARIANT':'3','BIG_DATA':true},{'VARIANT':'3','BIG_DATA':true}]",
		"LIST_SHOW_SLIDER" => "Y",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"OFFERS_SORT_FIELD" => "id",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "9",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "active_from",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "asc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "5",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_BIG_DATA" => "N",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "Y",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"USE_GIFTS_SECTION" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_SALE_BESTSELLERS" => "N",
		"USE_STORE" => "N",
		"COMPONENT_TEMPLATE" => "main",
		"FILTER_NAME" => "arrFilter",
		"PREFILTER_NAME" => "smartPreFilter",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "TSVETT",
			1 => "RAZMER",
			2 => "CML2_MANUFACTURER",
			3 => "TSVET",
			4 => "",
		),
		"SEF_FOLDER" => "/catalog/",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(
		),
		"DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(
			0 => "TSVET",
			0 => "TSVETT",
			1 => "RAZMER",
		),
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"FILE_404" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => $sefSection,
			"element" => "product/#ELEMENT_ID#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => $sefSection."filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?>
<?/*
<div class="block block-catalog" id="catalog">
	<div class="block__inner">
		<header class="block-catalog__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "catalog_header_title.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>
		</header>

		<div class="block-catalog__top i-pc">
      <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "catalog_categories",
        Array(
          "ROOT_MENU_TYPE" => "left",
          "MAX_LEVEL" => "1"
         )
      );?>

      <div class="block-catalog__sort catalog-sort i-noselect">
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'asc' : 'desc')))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="new" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'возрастанию' : 'убыванию')?>">По новизне<span class="catalog-sort__direction">&nbsp;</span></a>
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'asc' : 'desc')))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="price" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'возрастанию' : 'убыванию')?>">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      </div>
		</div>

		<div class="block-catalog__top catalog-top i-mobile i-noselect">
      <a href="#catalog-filter" class="catalog-top__item catalog-top__item_filter i-modal">Фильтр<span class="catalog-top__filter-num"> (<span>0</span>)</span></a>
      <div class="catalog-top__item catalog-top__item_sort">Сортировка
      <div class="block-catalog__sort catalog-sort i-noselect">
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => 'desc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' && UrlManipulation::getParam('sort_order') === 'desc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_desc" data-value="price" title="Сортировать по убыванию">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => 'asc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' && UrlManipulation::getParam('sort_order') === 'asc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_asc" data-value="price" title="Сортировать по возрастанию">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      	<!-- <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => 'desc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' && UrlManipulation::getParam('sort_order') === 'desc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_desc" data-value="new" title="Сортировать по убыванию">По новизне<span class="catalog-sort__direction">&nbsp;</span></a> -->
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => 'asc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' && UrlManipulation::getParam('sort_order') === 'asc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_asc" data-value="new" title="Сортировать по возрастанию">По новизне<!-- <span class="catalog-sort__direction">&nbsp;</span> --></a>
      </div>
      </div>
		</div>

		<div class="block-catalog__main">
			<div class="block-catalog__filter">
				<? $filter['clothing'] = (isset($_GET['clothing']) && is_string($_GET['clothing']) ? explode(',', $_GET['clothing']) : array()); if (count($filter['clothing']) === 1 && $filter['clothing'][0] == '') $filter['clothing'] = array(); ?>
				<div class="filter-category filter-category_opened i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Одежда</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_long" data-key="clothing">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('trousers', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Брюки</div>
								<div class="filter-checkbox__additional">(32)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jeans', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Джинсы</div>
								<div class="filter-checkbox__additional">(24)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('vests', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Жилеты</div>
								<div class="filter-checkbox__additional">(4)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сardigans', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Кардиганы</div>
								<div class="filter-checkbox__additional">(44)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('suits', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Костюмы</div>
								<div class="filter-checkbox__additional">(75)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jackets', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Куртки</div>
								<div class="filter-checkbox__additional">(36)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пальто и плащи</div>
								<div class="filter-checkbox__additional">(6)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('coats', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пиджаки</div>
								<div class="filter-checkbox__additional">(13)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('polo', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Поло</div>
								<div class="filter-checkbox__additional">(50)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shirts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Рубашки</div>
								<div class="filter-checkbox__additional">(63)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('sweaters', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Свитеры</div>
								<div class="filter-checkbox__additional">(22)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('smokings', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Смокинги</div>
								<div class="filter-checkbox__additional">(9)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('t-shirts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Футболки</div>
								<div class="filter-checkbox__additional">(87)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shorts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Шорты</div>
								<div class="filter-checkbox__additional">(12)</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['footwear'] = (isset($_GET['footwear']) && is_string($_GET['footwear']) ? explode(',', trim($_GET['footwear'])) : array()); if (count($filter['footwear']) === 1 && $filter['footwear'][0] == '') $filter['footwear'] = array(); ?>
				<div class="filter-category <?=(count($filter['footwear']) ? 'filter-category_opened' : '')?> i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Обувь</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_long" data-key="footwear">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('trousers', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Брюки</div>
								<div class="filter-checkbox__additional">(32)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jeans', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Джинсы</div>
								<div class="filter-checkbox__additional">(24)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('vests', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Жилеты</div>
								<div class="filter-checkbox__additional">(4)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сardigans', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Кардиганы</div>
								<div class="filter-checkbox__additional">(44)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('suits', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Костюмы</div>
								<div class="filter-checkbox__additional">(75)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jackets', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Куртки</div>
								<div class="filter-checkbox__additional">(36)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пальто и плащи</div>
								<div class="filter-checkbox__additional">(6)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('coats', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пиджаки</div>
								<div class="filter-checkbox__additional">(13)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('polo', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Поло</div>
								<div class="filter-checkbox__additional">(50)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shirts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Рубашки</div>
								<div class="filter-checkbox__additional">(63)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('sweaters', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Свитеры</div>
								<div class="filter-checkbox__additional">(22)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('smokings', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Смокинги</div>
								<div class="filter-checkbox__additional">(9)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('t-shirts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Футболки</div>
								<div class="filter-checkbox__additional">(87)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shorts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Шорты</div>
								<div class="filter-checkbox__additional">(12)</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['bags'] = (isset($_GET['bags']) && is_string($_GET['bags']) ? explode(',', $_GET['bags']) : array()); if (count($filter['bags']) === 1 && $filter['bags'][0] == '') $filter['bags'] = array(); ?>
				<div class="filter-category <?=(count($filter['bags']) ? 'filter-category_opened' : '')?> i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Сумки</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_long" data-key="bags">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('trousers', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Брюки</div>
								<div class="filter-checkbox__additional">(32)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jeans', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Джинсы</div>
								<div class="filter-checkbox__additional">(24)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('vests', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Жилеты</div>
								<div class="filter-checkbox__additional">(4)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сardigans', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Кардиганы</div>
								<div class="filter-checkbox__additional">(44)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('suits', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Костюмы</div>
								<div class="filter-checkbox__additional">(75)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jackets', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Куртки</div>
								<div class="filter-checkbox__additional">(36)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пальто и плащи</div>
								<div class="filter-checkbox__additional">(6)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('coats', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пиджаки</div>
								<div class="filter-checkbox__additional">(13)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('polo', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Поло</div>
								<div class="filter-checkbox__additional">(50)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shirts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Рубашки</div>
								<div class="filter-checkbox__additional">(63)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('sweaters', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Свитеры</div>
								<div class="filter-checkbox__additional">(22)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('smokings', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Смокинги</div>
								<div class="filter-checkbox__additional">(9)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('t-shirts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Футболки</div>
								<div class="filter-checkbox__additional">(87)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shorts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Шорты</div>
								<div class="filter-checkbox__additional">(12)</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['accessories'] = (isset($_GET['accessories']) && is_string($_GET['accessories']) ? explode(',', $_GET['accessories']) : array()); if (count($filter['accessories']) === 1 && $filter['accessories'][0] == '') $filter['accessories'] = array(); ?>
				<div class="filter-category <?=(count($filter['accessories']) ? 'filter-category_opened' : '')?> i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Аксессуары</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_long" data-key="accessories">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('trousers', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Брюки</div>
								<div class="filter-checkbox__additional">(32)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jeans', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Джинсы</div>
								<div class="filter-checkbox__additional">(24)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('vests', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Жилеты</div>
								<div class="filter-checkbox__additional">(4)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сardigans', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Кардиганы</div>
								<div class="filter-checkbox__additional">(44)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('suits', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Костюмы</div>
								<div class="filter-checkbox__additional">(75)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('jackets', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Куртки</div>
								<div class="filter-checkbox__additional">(36)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пальто и плащи</div>
								<div class="filter-checkbox__additional">(6)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('coats', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Пиджаки</div>
								<div class="filter-checkbox__additional">(13)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('polo', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Поло</div>
								<div class="filter-checkbox__additional">(50)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shirts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Рубашки</div>
								<div class="filter-checkbox__additional">(63)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('sweaters', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Свитеры</div>
								<div class="filter-checkbox__additional">(22)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('smokings', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Смокинги</div>
								<div class="filter-checkbox__additional">(9)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('t-shirts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Футболки</div>
								<div class="filter-checkbox__additional">(87)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('shorts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Шорты</div>
								<div class="filter-checkbox__additional">(12)</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['size'] = (isset($_GET['size']) && is_string($_GET['size']) ? explode(',', $_GET['size']) : array()); if (count($filter['size']) === 1 && $filter['size'][0] == '') $filter['size'] = array(); ?>
				<div class="filter-category filter-category_opened i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Размер</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_columns-3" data-key="size">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('40', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="40">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">40</div>
							</div>
							<div class="filter-checkbox <?=(in_array('42', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="42">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">42</div>
							</div>
							<div class="filter-checkbox <?=(in_array('46', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="46">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">46</div>
							</div>
							<div class="filter-checkbox <?=(in_array('40', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="48">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">48</div>
							</div>
							<div class="filter-checkbox <?=(in_array('50', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="50">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">50</div>
							</div>

							<div class="filter-checkbox <?=(in_array('52', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="52">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">52</div>
							</div>
							<div class="filter-checkbox <?=(in_array('54', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="54">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">54</div>
							</div>
							<div class="filter-checkbox <?=(in_array('56', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="56">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">56</div>
							</div>
							<div class="filter-checkbox <?=(in_array('58', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="58">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">58</div>
							</div>
							<div class="filter-checkbox <?=(in_array('60', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="60">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">60</div>
							</div>

							<div class="filter-checkbox <?=(in_array('62', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="62">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">62</div>
							</div>
							<div class="filter-checkbox <?=(in_array('64', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="64">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">64</div>
							</div>
							<div class="filter-checkbox <?=(in_array('66', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="66">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">66</div>
							</div>
							<div class="filter-checkbox <?=(in_array('68', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="68">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">68</div>
							</div>
							<div class="filter-checkbox <?=(in_array('70', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="70">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">70</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['color'] = (isset($_GET['color']) && is_string($_GET['color']) ? explode(',', $_GET['color']) : array()); if (count($filter['color']) === 1 && $filter['color'][0] == '') $filter['color'] = array(); ?>
				<div class="filter-category filter-category_opened i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Цвет</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_inline filter-group_color" data-key="color">
						<div class="filter-group__inner">
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('white', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="white">
								<div class="filter-checkbox__radio" style="background:#f8f8f8;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('black', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="black">
								<div class="filter-checkbox__radio" style="background:#000000;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('antique-brass', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="antique-brass">
								<div class="filter-checkbox__radio" style="background:#daa99a;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('beige-gray', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="beige-gray">
								<div class="filter-checkbox__radio" style="background:#c2b089;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('gray', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="gray">
								<div class="filter-checkbox__radio" style="background:#a1a1a1;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('blue', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="blue">
								<div class="filter-checkbox__radio" style="background:#5990c3;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('orange', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="orange">
								<div class="filter-checkbox__radio" style="background:#dba76a;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('green', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="green">
								<div class="filter-checkbox__radio" style="background:#77af6a;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('pale-carmine', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="pale-carmine">
								<div class="filter-checkbox__radio" style="background:#d87272;"></div>
							</div>
							<div class="filter-checkbox filter-checkbox_color <?=(in_array('pale-purple', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="pale-purple">
								<div class="filter-checkbox__radio" style="background:#c4adc7;"></div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['brand'] = (isset($_GET['brand']) && is_string($_GET['brand']) ? explode(',', $_GET['brand']) : array()); if (count($filter['brand']) === 1 && $filter['brand'][0] == '') $filter['brand'] = array(); ?>
				<div class="filter-category filter-category_brand filter-category_opened i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Бренд</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group" data-key="brand">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('roma-uvarov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="roma-uvarov">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Roma Uvarov</div>
								<div class="filter-checkbox__additional">(56)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('vlad-molodez', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="vlad-molodez">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Vlad Molodez</div>
								<div class="filter-checkbox__additional">(22)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('alexey-nikishin', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="alexey-nikishin">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Alexey Nikishin</div>
								<div class="filter-checkbox__additional">(39)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('maxim-matveev', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="maxim-matveev">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Maxim Matveev</div>
								<div class="filter-checkbox__additional">(40)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('oleg-ivanov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="oleg-ivanov">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Oleg Ivanov</div>
								<div class="filter-checkbox__additional">(42)</div>
							</div>
							<div class="filter-checkbox <?=(in_array('long-textov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="long-textov">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Long Textov</div>
								<div class="filter-checkbox__additional">(13)</div>
							</div>
						</div>
					</div>
				</div>
				<? $filter['additional'] = (isset($_GET['additional']) && is_string($_GET['additional']) ? explode(',', $_GET['additional']) : array()); if (count($filter['additional']) === 1 && $filter['additional'][0] == '') $filter['additional'] = array(); ?>
				<div class="filter-category filter-category_opened i-noselect">
					<div class="filter-category__header">
						<div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Другое</div>
						<a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
					</div>
					<div class="filter-group filter-group_columns-2" data-key="additional">
						<div class="filter-group__inner">
							<div class="filter-checkbox <?=(in_array('new', $filter['additional']) ? 'filter-checkbox_active' : '')?>" data-value="new">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Новинка</div>
							</div>
							<div class="filter-checkbox <?=(in_array('discount', $filter['additional']) ? 'filter-checkbox_active' : '')?>" data-value="discount">
								<div class="filter-checkbox__radio"></div>
								<div class="filter-checkbox__name">Со скидкой</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block-catalog__products">
				<div class="block-catalog__items">
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/1_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/1_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">12 950 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/1/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/2_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/2_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">8 950 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/2/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/3_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/3_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">5 000 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/3/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/4_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/4_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">11 200 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/4/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/5_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/5_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">4 900 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/5/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/6_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/6_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">6 600 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/6/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/7_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/7_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">12 000 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/7/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/8_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/8_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">9 900 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/8/" class="product__link" title="Roma Uvarov | Хлопковая футболка">"Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/9_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/9_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">7 400 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/9/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
				</div>
				<div class="block-catalog__bottom">
					<a href="javascript:void(0);" class="block-catalog__more">Показать еще товары</a>
					<div class="block-catalog__paginator paginator i-noselect">
						<span class="paginator__control paginator__control_left paginator__control_ia arrow"></span>
						<span class="paginator__control paginator__control_page paginator__control_page-current" title="Страница №1">1</span>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №2">2</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №3">3</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №4">4</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №5">5</a>
						<span class="paginator__control paginator__control_dots">...</span>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №83">83</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_right arrow" title="Следующая страница"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- \Catalog -->
*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
