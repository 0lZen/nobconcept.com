<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
}
else
{
	$basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}

if ($arParams["HIDE_NOT_AVAILABLE"]=='N')
{
    $GLOBALS[$arParams["FILTER_NAME"]][]=[
        "LOGIC" => "OR",
        "CATALOG_AVAILABLE" => "Y",
        "!PROPERTY_SOLDOUT" => false
    ];
    $GLOBALS[$arParams["PREFILTER_NAME"]][]=[
        "LOGIC" => "OR",
        "CATALOG_AVAILABLE" => "Y",
        "!PROPERTY_SOLDOUT" => false
    ];

}
?>


<div class="block__inner">


	<header class="block-catalog__header header">
		<h2 class="header__title">
            <?if(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/',0,'UTF-8') === 0){
                ?>
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/includes/" . LANGUAGE_ID . "catalog_header_title.php",
                        "EDIT_TEMPLATE" => ""
                    )
                );?>
                <?
            }elseif(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'pre-order/',0,'UTF-8') === 0){
                ?>Предзаказ<?
            }elseif(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'sale/',0,'UTF-8') === 0){
                ?>Скидки<?
            }?>
		</h2>
	</header>

	<div class="block-catalog__top i-pc">
        <?if(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/',0,'UTF-8') === 0){
            ?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_categories",
                Array(
                    "ROOT_MENU_TYPE" => "left",
                    "MAX_LEVEL" => "1"
                )
            );?>
            <?
        }elseif(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'pre-order/',0,'UTF-8') === 0){
            ?><div class="block-catalog__menu catalog-menu i-noselect">
                <a onclick="return true;" href="/catalog/" class="catalog-menu__item catalog-menu__item_active" title="Все">Все</a>
                <a onclick="return true;" href="/catalog/men/" class="catalog-menu__item " title="Мужское">Мужское</a>
                <a onclick="return true;" href="/catalog/women/" class="catalog-menu__item " title="Женское">Женское</a>
            </div><?
        }elseif(mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'sale/',0,'UTF-8') === 0){
            ?><div class="block-catalog__menu catalog-menu i-noselect">
                <a onclick="return true;" href="/catalog/" class="catalog-menu__item catalog-menu__item_active" title="Все">Все</a>
                <a onclick="return true;" href="/catalog/men/" class="catalog-menu__item " title="Мужское">Мужское</a>
                <a onclick="return true;" href="/catalog/women/" class="catalog-menu__item " title="Женское">Женское</a>
            </div><?
        }?>
        <?
        $sort1 = UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'asc' : 'desc')));
        $sort1 = explode("&", $sort1);
        foreach ($sort1 as $ss){
            if(mb_stripos($ss, "bxajaxid",0,'UTF-8') !== false  || mb_stripos($ss, "clear_cache",0,'UTF-8') !== false){
                $dd = 1;
            }else{
                $sort_new.= $ss."&";
            }
        }
        $sort_new = mb_substr($sort_new, 0, -1,'UTF-8');
        $sort2 = UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'asc' : 'desc')));
        $sort2 = explode("&", $sort2);
        foreach ($sort2 as $ss){
            if(mb_stripos($ss, "bxajaxid",0,'UTF-8') !== false  || mb_stripos($ss, "clear_cache",0,'UTF-8') !== false){
                $dd = 1;
            }else{
                $sort_price.= $ss."&";
            }
        }
        $sort_price = mb_substr($sort_price, 0, -1,'UTF-8');
        //$sort_price = $sort2[1]."&".$sort2[2];
        ?>
        <div class="block-catalog__sort catalog-sort i-noselect">
            <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<? echo  $sort_new;?>"
                <?/*onclick="location.href = <?=$APPLICATION->GetCurPage()?>+'?<? echo $sort_new;?>';"*/?>
               class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="new" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'возрастанию' : 'убыванию')?>">По новизне<span class="catalog-sort__direction">&nbsp;</span></a>
            <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<? echo  $sort_price;?>"
                <?/*onclick="location.href = <?=$APPLICATION->GetCurPage()?>+'?<? echo $sort_new;?>';"*/?>
               class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="price" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'возрастанию' : 'убыванию')?>">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
        </div>
		</div>


    <div class="block-catalog__top catalog-top i-mobile i-noselect">
        <a href="#catalog-filter" class="catalog-top__item catalog-top__item_filter i-modal">Фильтр<span class="catalog-top__filter-num catalog-top__filter-num_active"> (<span>1</span>)</span></a>
        <div class="catalog-top__item catalog-top__item_sort">Сортировка
            <div class="block-catalog__sort catalog-sort i-noselect">
                <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<? echo  $sort_new;?>"
                   class="catalog-sort__item  <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="new" title="Сортировать по <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'Возрастанию' : 'Убыванию')?>">По новизне<span class="catalog-sort__direction">&nbsp;</span></a>
                <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<? echo  $sort_price;?>"
                   class="catalog-sort__item  <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="price" title="Сортировать по <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'Возрастанию' : 'Убыванию')?>">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
            </div>
        </div>
    </div>



<div class="block-catalog__main">
<?
if ($isFilter || $isSidebar): ?>
	<div class="block-catalog__filter">

		<? if ($isFilter): ?>

				<?
				//if($sectionPath==0){
					$arBuferFilterParams["SECTION_ID"] = 0;
					$arBuferFilterParams["SHOW_ALL_WO_SECTION"] = "Y";
				/*}else{
					$arBuferFilterParams["SECTION_ID"] = $arCurSection['ID'];
					$arBuferFilterParams["SHOW_ALL_WO_SECTION"] = "N";
				}*/
				?>

				<?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"main",
					array(
						"SHOW_ALL_WO_SECTION" => $arBuferFilterParams["SHOW_ALL_WO_SECTION"],
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SECTION_ID" => $arBuferFilterParams["SECTION_ID"],
						"FILTER_NAME" => 'arrPreorder',
						"PRICE_CODE" => $arParams["~PRICE_CODE"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SAVE_IN_SESSION" => "N",
						"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
						"XML_EXPORT" => "N",
						"SECTION_TITLE" => "NAME",
						"SECTION_DESCRIPTION" => "DESCRIPTION",
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						"SEF_MODE" => $arParams["SEF_MODE"],
						"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
						"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>

		<? endif ?>
		<? if ($isSidebar): ?>
			<div class="hidden-xs">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => $arParams["SIDEBAR_PATH"],
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?endif?>
	</div>
<?endif?>
<div class="block-catalog__products">


			<?
			if (ModuleManager::isModuleInstalled("sale"))
			{
				$arRecomData = array();
				$recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
				$obCache = new CPHPCache();
				if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
				{
					$arRecomData = $obCache->GetVars();
				}
				elseif ($obCache->StartDataCache())
				{
					if (Loader::includeModule("catalog"))
					{
						$arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
						$arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
					}
					$obCache->EndDataCache($arRecomData);
				}
				if (!empty($arRecomData) && $arParams['USE_GIFTS_SECTION'] === 'Y')
				{
					?>
					<div data-entity="parent-container">
						<?
						if (!isset($arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE'] !== 'Y')
						{
							?>
							<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
								<?=($arParams['GIFTS_SECTION_LIST_BLOCK_TITLE'] ?: \Bitrix\Main\Localization\Loc::getMessage('CT_GIFTS_SECTION_LIST_BLOCK_TITLE_DEFAULT'))?>
							</div>
							<?
						}

						CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.section');
						$APPLICATION->IncludeComponent(
							'bitrix:sale.products.gift.section',
							'.default',
							array(
								'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],

								'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
								'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
								'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

								'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
								'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action').'_spgs',

								'PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
									SaleProductsGiftSectionComponent::predictRowVariants(
										$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
										$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']
									)
								),
								'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
								'DEFERRED_PRODUCT_ROW_VARIANTS' => '',
								'DEFERRED_PAGE_ELEMENT_COUNT' => 0,

								'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
								'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
								'PRODUCT_DISPLAY_MODE' => 'Y',
								'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
								'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

								'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

								'LABEL_PROP_'.$arParams['IBLOCK_ID'] => array(),
								'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => array(),
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

								'ADD_TO_BASKET_ACTION' => $basketAction,
								'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
								'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
								'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
								'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

								'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
								'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
								'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],

								'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
								'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
								'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
								'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
								'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],

								'HIDE_NOT_AVAILABLE' => 'Y',
								'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
								'PRICE_CODE' => $arParams['~PRICE_CODE'],
								'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
								'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'BASKET_URL' => $arParams['BASKET_URL'],
								'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
								'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
								'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
								'USE_PRODUCT_QUANTITY' => 'N',
								'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

								'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
								'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
								'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);
						?>
					</div>
					<?
				}
			}
			?>


			<?

			//if($sectionPath==0){
				$arBuferParams["SECTION_ID"] = 0;
				$arBuferParams["SECTION_CODE"] = '';
				$arBuferParams["SHOW_ALL_WO_SECTION"] = "Y";
			/*}else{
				$arBuferParams["SECTION_ID"] = $arResult["VARIABLES"]["SECTION_ID"];
				$arBuferParams["SECTION_CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
				$arBuferParams["SHOW_ALL_WO_SECTION"] = "N";
			}*/


			/*$arAvailableSort = array(
   "name" => Array("name", "asc";),
  // "price" => Array('catalog_PRICE_'.$arResult['_PRICE_ID'], "asc";),
   "price" => Array('PROPERTY_MINIMUM_PRICE', "asc";),
 "date" => Array('PROPERTY_NEWPRODUCT', "desc";),

я точно не комментарила сортировку по  цене, видимо в установочном пакете так было. Сделала вот так:

 			"price" => Array('catalog_PRICE_'.$arResult['_PRICE_ID'], "asc"),*/

 			if($_GET['sort_by']=='price'){
 				$arParams["ELEMENT_SORT_FIELD2"] = 'catalog_PRICE_1';
 			}
 			if($_GET['sort_by']=='new'){
 				$arParams["ELEMENT_SORT_FIELD2"] = 'date_create';
 			}
 			if($_GET['sort_order']=='desc'){
 				$arParams["ELEMENT_SORT_ORDER2"] = 'desc';
 			}
 			if($_GET['sort_order']=='asc'){
 				$arParams["ELEMENT_SORT_ORDER2"] = 'asc';
 			}

            if ($_GET['showmore']=='Y')
            {
                $APPLICATION->RestartBuffer();
            }
			$intSectionID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"main",
				array(
                    'IS_SHOW_MORE' => $_GET['showmore'],
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
					"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
					"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
					"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
					"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
					"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
					"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
					"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"MESSAGE_404" => $arParams["~MESSAGE_404"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"SHOW_404" => $arParams["SHOW_404"],
					"FILE_404" => $arParams["FILE_404"],
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PRICE_CODE" => $arParams["~PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
					"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
					"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
					"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
					"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
					"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
					"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
					"LAZY_LOAD" => $arParams["LAZY_LOAD"],
					"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
					"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

					"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
					"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
					"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

					"SECTION_ID" => $arBuferParams["SECTION_ID"],
					"SECTION_CODE" => $arBuferParams["SECTION_CODE"],
					"SHOW_ALL_WO_SECTION" => $arBuferParams["SHOW_ALL_WO_SECTION"],


					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

					'LABEL_PROP' => $arParams['LABEL_PROP'],
					'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
					'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
					'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
					'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
					'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
					'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
					'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
					'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
					'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
					'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
					'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

					'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
					'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
					'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
					'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
					'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
					'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
					'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
					'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
					'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
					'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
					'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
					'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
					'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
					'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
					'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
					'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
					'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

					'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
					'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
					'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

					'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					"ADD_SECTIONS_CHAIN" => "N",
					'ADD_TO_BASKET_ACTION' => $basketAction,
					'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
					'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
					'COMPARE_NAME' => $arParams['COMPARE_NAME'],
					'USE_COMPARE_LIST' => 'Y',
					'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
					'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
					'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
				),
				$component
			);
            if ($_GET['showmore']=='Y')
            {
                die();
            }
			?>

		<?
		$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;

		if (ModuleManager::isModuleInstalled("sale"))
		{
			if (!empty($arRecomData))
			{
				if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
				{
					/*?>
					<div class="col-xs-12" data-entity="parent-container">
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=GetMessage('CATALOG_PERSONAL_RECOM')?>
						</div>
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:catalog.section",
							"",
							array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
								"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
								"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
								"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
								"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
								"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
								"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
								"BASKET_URL" => $arParams["BASKET_URL"],
								"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
								"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
								"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
								"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
								"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_FILTER" => $arParams["CACHE_FILTER"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
								"PAGE_ELEMENT_COUNT" => 0,
								"PRICE_CODE" => $arParams["~PRICE_CODE"],
								"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
								"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"ADD_SECTIONS_CHAIN" => "N",

								"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
								"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
								"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
								"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
								"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

								"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
								"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
								"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
								"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
								"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
								"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
								"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
								"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

								"SECTION_ID" => $intSectionID,
								"SECTION_CODE" => "",
								"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
								"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
								"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
								'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

								'LABEL_PROP' => $arParams['LABEL_PROP'],
								'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
								'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
								'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
								'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
								'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
								'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
								'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
								'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

								"DISPLAY_TOP_PAGER" => 'N',
								"DISPLAY_BOTTOM_PAGER" => 'N',
								"HIDE_SECTION_DESCRIPTION" => "Y",

								"RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
								"SHOW_FROM_SECTION" => 'Y',

								'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
								'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
								'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
								'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
								'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
								'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
								'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
								'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
								'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
								'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
								'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
								'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
								'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
								'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

								'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
								'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
								'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

								'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								'ADD_TO_BASKET_ACTION' => $basketAction,
								'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
								'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
								'COMPARE_NAME' => $arParams['COMPARE_NAME'],
								'USE_COMPARE_LIST' => 'Y',
								'BACKGROUND_IMAGE' => '',
								'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
							),
							$component
						);
						?>
					</div>*/?>
					<?
				}
			}
		}
		?>

	</div>
</div>

</div>
