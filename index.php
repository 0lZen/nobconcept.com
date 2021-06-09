<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, главная, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetPageProperty("title", "Интернет-магазин дизайнерской одежды – NOBconcept");
$APPLICATION->SetPageProperty("description", "Дизайнерская одежда от молодых российских дизайнеров с доставкой по всей России. ☎ +7 (495) 784-04-02");
$APPLICATION->SetTitle("Интернет-магазин дизайнерской одежды");
CModule::IncludeModule('iblock');
?>
<div class="block block-header block_dark" id="header">

    <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list", 
            "ytbVideoBlock", 
            array(
                "IBLOCK_TYPE" => "other",
                "IBLOCK_ID" => "10",
                "NEWS_COUNT" => "1",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "CHECK_DATES" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "N",
                "ACTIVE_DATE_FORMAT" => "j F Y",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SHOW_404" => "N",
            ),
            false
        );
    ?>  		

	<div class="block__inner">
		<!-- <div class="block-header__pic"></div> -->

		<div class="block-header__slides-wrapper">
      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_header", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-1",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "30",
          "LINE_ELEMENT_COUNT" => "30",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>
			<div class="block-header__note">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => "/includes/".LANGUAGE_ID."index_header_note.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
			</div>
		</div>

		<header class="block-header__header header">
			<div class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => "/includes/".LANGUAGE_ID."index_header_header_title.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
			</div>
		</header>
	</div>

	<div class="block-header__socials block-header-socials i-noselect">
		<a href="<?$APPLICATION->ShowProperty("instagram")?>" class="block-header-socials__item block-header-socials__item_instagram" target="_blank">
			<span class="block-header-socials__text">Instagram</span>
			<span class="block-header-socials__icon">&nbsp;</span>
		</a>
		<a href="<?$APPLICATION->ShowProperty("facebook")?>" class="block-header-socials__item block-header-socials__item_facebook" target="_blank">
			<span class="block-header-socials__text">Facebook</span>
			<span class="block-header-socials__icon">&nbsp;</span>
		</a>
	</div>
</div>
<!-- header -->

<div style="text-align:center;line-height: 1.1;">
    <h1><?$APPLICATION->ShowTitle(false)?></h1>
</div>

		<? if (isset($_GET['test'])) { ?>

<div class="block block-season" id="season2">
	<div class="block-season__square"></div>

	<div class="block__inner">
		<div class="block-season__slides-wrapper">

      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_season", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-8",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "30",
          "LINE_ELEMENT_COUNT" => "30",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>
		</div>

		<header class="block-season__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_season2_header_title.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>

			<div class="i-pc">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_season2_header_button.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</div>
		</header>

		<div class="i-mobile block-season__button">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/includes/" . LANGUAGE_ID . "index_season2_header_button.php",
					"EDIT_TEMPLATE" => ""
				)
			);?>
			</div>
	</div>
</div>
<!-- season -->

			    <?
/*
			    	$GLOBALS['arrFilterSeason'] = array("PROPERTY_SEZON_1_VALUE"=>"Лето");

						$APPLICATION->IncludeComponent(
						    "ameton:catalog.section",
						    "season_slider",
						    Array(
						        "IBLOCK_ID" => CATALOG_IBLOCK_ID,
						        "IBLOCK_TYPE" => "1c_catalog",
						        "INCLUDE_SUBSECTIONS" => "Y",
										"FILTER_NAME" => "arrFilterSeason",
						        "DISPLAY_BOTTOM_PAGER" => "N",
						        "DISPLAY_TOP_PAGER" => "N",
						        "ELEMENT_SORT_FIELD" => "sort",
						        "ELEMENT_SORT_FIELD2" => "id",
						        "ELEMENT_SORT_ORDER" => "asc",
						        "ELEMENT_SORT_ORDER2" => "desc",
						        "ACTION_VARIABLE" => "action",
						        "ADD_PICT_PROP" => "MORE_PHOTO",
						        "ADD_PROPERTIES_TO_BASKET" => "Y",
						        "ADD_SECTIONS_CHAIN" => "N",
						        "ADD_TO_BASKET_ACTION" => "ADD",
						        "AJAX_MODE" => "N",
						        "AJAX_OPTION_ADDITIONAL" => "",
						        "AJAX_OPTION_HISTORY" => "N",
						        "AJAX_OPTION_JUMP" => "N",
						        "AJAX_OPTION_STYLE" => "Y",
						        "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
						        "BASKET_URL" => "/personal/basket.php",
						        "BRAND_PROPERTY" => "BRAND_REF",
						        "BROWSER_TITLE" => "-",
						        "CACHE_FILTER" => "N",
						        "CACHE_GROUPS" => "Y",
						        "CACHE_TIME" => "36000000",
						        "CACHE_TYPE" => "A",
						        "COMPATIBLE_MODE" => "Y",
						        "CONVERT_CURRENCY" => "Y",
						        "CURRENCY_ID" => "RUB",
						        "CUSTOM_FILTER" => "",
						        "DATA_LAYER_NAME" => "dataLayer",
						        "DETAIL_URL" => "",
						        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
						        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
						        "ENLARGE_PRODUCT" => "PROP",
						        "ENLARGE_PROP" => "NEWPRODUCT",
						        "HIDE_NOT_AVAILABLE" => "N",
						        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
						        "LINE_ELEMENT_COUNT" => "1000",
						        "LOAD_ON_SCROLL" => "N",
						        "MESSAGE_404" => "",
						        "META_DESCRIPTION" => "-",
						        "META_KEYWORDS" => "-",
						        "OFFERS_CART_PROPERTIES" => array("ARTNUMBER","COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
						        "OFFERS_FIELD_CODE" => array("",""),
						        "OFFERS_LIMIT" => "",
						        "OFFERS_PROPERTY_CODE" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES",""),
						        "OFFERS_SORT_FIELD" => "sort",
						        "OFFERS_SORT_FIELD2" => "id",
						        "OFFERS_SORT_ORDER" => "asc",
						        "OFFERS_SORT_ORDER2" => "desc",
						        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
						        "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
						        "PAGER_BASE_LINK_ENABLE" => "N",
						        "PAGER_DESC_NUMBERING" => "N",
						        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						        "PAGER_SHOW_ALL" => "N",
						        "PAGER_SHOW_ALWAYS" => "N",
						        "PAGER_TEMPLATE" => ".default",
						        "PAGER_TITLE" => "Товары",
						        "PAGE_ELEMENT_COUNT" => "1000",
						        "PARTIAL_PRODUCT_PROPERTIES" => "N",
						        "PRICE_CODE" => array(""),
						        "PRICE_VAT_INCLUDE" => "Y",
						        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
						        "PRODUCT_DISPLAY_MODE" => "Y",
						        "PRODUCT_ID_VARIABLE" => "id",
						        "PRODUCT_PROPERTIES" => array(
	            				"IMAGE_PC",
	            				"IMAGE_MOBILE",
	            				"TITLE_RU",	
	            				"TITLE_EN",
	            				"SUBTITLE_RU",
	            				"SUBTITLE_EN",
	            				"LINK_DETAIL",
	          				),
						        "PRODUCT_PROPS_VARIABLE" => "prop",
						        "PRODUCT_QUANTITY_VARIABLE" => "",
						        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
						        "PRODUCT_SUBSCRIPTION" => "Y",
						        "PROPERTY_CODE" => array("NEWPRODUCT",""),
						        "PROPERTY_CODE_MOBILE" => array(),
						        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
						        "RCM_TYPE" => "personal",
						        "SECTION_CODE" => "",
						        "SECTION_ID" => "",
						        "SECTION_ID_VARIABLE" => "",
						        "SECTION_URL" => "",
						        "SECTION_USER_FIELDS" => array("",""),
						        "SEF_MODE" => "N",
						        "SET_BROWSER_TITLE" => "Y",
						        "SET_LAST_MODIFIED" => "N",
						        "SET_META_DESCRIPTION" => "Y",
						        "SET_META_KEYWORDS" => "Y",
						        "SET_STATUS_404" => "N",
						        "SET_TITLE" => "N",
						        "SHOW_404" => "N",
						        "SHOW_ALL_WO_SECTION" => "Y",
						        "SHOW_CLOSE_POPUP" => "N",
						        "SHOW_DISCOUNT_PERCENT" => "Y",
						        "SHOW_FROM_SECTION" => "N",
						        "SHOW_MAX_QUANTITY" => "N",
						        "SHOW_OLD_PRICE" => "N",
						        "SHOW_PRICE_COUNT" => "1",
						        "USE_ENHANCED_ECOMMERCE" => "Y",
						        "USE_MAIN_ELEMENT_SECTION" => "N",
						        "USE_PRICE_COUNT" => "N",
						        "USE_PRODUCT_QUANTITY" => "N",
						        "CURRENCY" => $_SESSION['CURRENCY_CURRENT'],
						    )
						);
*/
	     //  $APPLICATION->IncludeComponent("st:photo.section_slider", "index_new_slides", Array(
	     //      "AJAX_MODE" => "N",
      //         "CURRENCY" => $_SESSION['CURRENCY_CURRENT'],
	     //      "IBLOCK_TYPE" => "1c_catalog",
	     //      "IBLOCK_ID" => CATALOG_IBLOCK_ID,
	     //      "TEXT" => array("Yes","Да"),
	     //      "ELEMENT_SORT_FIELD" => "DATA_POYAVLENIYA_TOVARA",
	     //      "ELEMENT_SORT_ORDER" => "DESC",
	     //      "PAGE_ELEMENT_COUNT" => "30",
	     //      "LINE_ELEMENT_COUNT" => "30",
	     //      "SET_TITLE" => "N",
	     //      "PROPERTY_CODE" => array(
	     //        "IMAGE_PC",
	     //        "IMAGE_MOBILE",
	     //        "TITLE_RU",
	     //        "TITLE_EN",
	     //        "SUBTITLE_RU",
	     //        "SUBTITLE_EN",
	     //        "LINK_DETAIL",
	     //      ),
	     //      "INCLUDE_SUBSECTIONS" => "Y",
						// "FILTER_NAME" => "arrFilterSeason",
						// "SHOW_ALL_WO_SECTION" => "Y",
	     //    )
	     //  )

	      	?>
		<? } ?> 

<div class="block block-season" id="season">
	<div class="block-season__square"></div>

	<div class="block__inner">
		<div class="block-season__slides-wrapper">
      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_season", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-2",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "30",
          "LINE_ELEMENT_COUNT" => "30",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>
		</div>

		<header class="block-season__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_season_header_title.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>

			<div class="i-pc">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_season_header_button.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</div>
		</header>

		<div class="i-mobile block-season__button">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/includes/" . LANGUAGE_ID . "index_season_header_button.php",
					"EDIT_TEMPLATE" => ""
				)
			);?>
			</div>
	</div>
</div>
<!-- season -->

<div class="block block-discounts block_dark" id="discounts">
	<div class="block__inner">
		<div class="block-discounts__square block-discounts__square_top"></div>
		<div class="block-discounts__square block-discounts__square_bottom"></div>

		<div class="block-discounts__wrapper">
      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_discounts", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-3",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "1",
          "LINE_ELEMENT_COUNT" => "1",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>

			<header class="block-discounts__header header">
				<h2 class="header__title">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/includes/" . LANGUAGE_ID . "index_discounts_header_title.php",
							"EDIT_TEMPLATE" => ""
						)
					);?>
				</h2>

				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_discounts_header_button.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</header>
		</div>
	</div>
</div>
<!-- discounts -->

<div class="block block-week" id="week">
	<!-- <div class="block-week__pic block-week__pic_left i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/index/looks/left.jpg)"></div>
	<div class="block-week__pic block-week__pic_right i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/index/looks/right.jpg)"></div> -->

	<div class="block__inner">
		<div class="block-week__square"></div>


    <?$APPLICATION->IncludeComponent("st:photo.section", "index_week", Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "gallery",
        "IBLOCK_ID" => 7,
        "SECTION_CODE" => "brand_week",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "PAGE_ELEMENT_COUNT" => "1",
        "LINE_ELEMENT_COUNT" => "1",
        "SET_TITLE" => "N",
        "PROPERTY_CODE" => array(
          "IMAGE_PC",
          "IMAGE_MOBILE",
          "TITLE_RU",
          "TITLE_EN",
          "SUBTITLE_RU",
          "SUBTITLE_EN",
          "LINK_DETAIL",
        )
      )
    )?>


	</div>
</div>
<!-- week -->

<div class="block block-new" id="new">
	<div class="block__inner">
		<div class="block-new__square"></div>
    <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_new_preview", Array(
        "AJAX_MODE" => "N",
        "IBLOCK_TYPE" => "gallery",
        "IBLOCK_ID" => IBLOCK_ID__GALLERY,
        "SECTION_CODE" => "index-page-block-5-preview",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "PAGE_ELEMENT_COUNT" => "1",
        "LINE_ELEMENT_COUNT" => "1",
        "SET_TITLE" => "N",
        "PROPERTY_CODE" => array(
          "IMAGE_PC",
          "IMAGE_MOBILE",
          "TITLE_RU",
          "TITLE_EN",
          "SUBTITLE_RU",
          "SUBTITLE_EN",
          "LINK_DETAIL",
        )
      )
    )?>

		<div class="block-new__content">
			<header class="block-new__header header">
				<h2 class="header__title">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/includes/" . LANGUAGE_ID . "index_new_header_title.php",
							"EDIT_TEMPLATE" => ""
						)
					);?>
				</h2>

				<div class="i-pc">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/includes/" . LANGUAGE_ID . "index_new_header_button.php",
							"EDIT_TEMPLATE" => ""
						)
					);?>
				</div>
			</header>

			<div class="block-new__slides-wrapper">
	      <?$APPLICATION->IncludeComponent("st:photo.section_slider", "index_new_slides", Array(
	          "AJAX_MODE" => "N",
              "CURRENCY" => $_SESSION['CURRENCY_CURRENT'],
	          "IBLOCK_TYPE" => "gallery",
	          "IBLOCK_ID" => CATALOG_IBLOCK_ID,
	          "TEXT" => array("Yes","Да"),
	          "ELEMENT_SORT_FIELD" => "DATA_POYAVLENIYA_TOVARA",
	          "ELEMENT_SORT_ORDER" => "DESC",
	          "PAGE_ELEMENT_COUNT" => "30",
	          "LINE_ELEMENT_COUNT" => "30",
	          "SET_TITLE" => "N",
	          "PROPERTY_CODE" => array(
	            "IMAGE_PC",
	            "IMAGE_MOBILE",
	            "TITLE_RU",
	            "TITLE_EN",
	            "SUBTITLE_RU",
	            "SUBTITLE_EN",
	            "LINK_DETAIL",
	          )
	        )
	      )?>
			</div>
		</div>

		<div class="i-mobile block-new__button">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/includes/" . LANGUAGE_ID . "index_new_header_button.php",
					"EDIT_TEMPLATE" => ""
				)
			);?>
		</div>
	</div>
</div>
<!-- new -->

<div class="block block-looks" id="looks">
	<!-- <div class="block-looks__pic block-looks__pic_left i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/index/looks/left.jpg)"></div>
	<div class="block-looks__pic block-looks__pic_right i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/index/looks/right.jpg)"></div> -->

	<div class="block__inner">
		<header class="block-looks__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_looks_header_title.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>

			<div class="i-pc">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_looks_header_button.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</div>
		</header>

		<div class="block-looks__images">
      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_looks", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-6",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "1",
          "LINE_ELEMENT_COUNT" => "1",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>
		</div>

		<div class="i-mobile block-looks__button">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/includes/" . LANGUAGE_ID . "index_looks_header_button.php",
					"EDIT_TEMPLATE" => ""
				)
			);?>
		</div>
	</div>
</div>
<!-- looks -->

<div class="block block-city" id="city">
	<div class="block__inner">
		<!-- <div class="block-city__pic i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/index/city.png)"></div> -->

		<header class="block-city__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_city_header_title.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>

			<div class="i-pc">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/includes/" . LANGUAGE_ID . "index_city_header_button.php",
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</div>
		</header>

		<div class="block-city__images">
			<div class="block-city__square"></div>
      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "index_city", Array(
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "gallery",
          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
          "SECTION_CODE" => "index-page-block-7",
          "ELEMENT_SORT_FIELD" => "sort",
          "ELEMENT_SORT_ORDER" => "asc",
          "PAGE_ELEMENT_COUNT" => "1",
          "LINE_ELEMENT_COUNT" => "1",
          "SET_TITLE" => "N",
          "PROPERTY_CODE" => array(
            "IMAGE_PC",
            "IMAGE_MOBILE",
            "TITLE_RU",
            "TITLE_EN",
            "SUBTITLE_RU",
            "SUBTITLE_EN",
            "LINK_DETAIL",
          )
        )
      )?>
		</div>

		<div class="i-mobile block-city__button">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/includes/" . LANGUAGE_ID . "index_city_header_button.php",
					"EDIT_TEMPLATE" => ""
				)
			);?>
		</div>
	</div>
</div>
<!-- city -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
