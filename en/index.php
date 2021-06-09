<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, главная, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetPageProperty("title", "Online & Designer shopping - NOBconcept");
$APPLICATION->SetPageProperty("description", "Clothes by young Russian designers. Delivery over all Russia. ☎ +7 (495) 784-04-02");
$APPLICATION->SetTitle("Online & Designer shopping");
CModule::IncludeModule('iblock');
?>
<div class="block block-header block_dark" id="header">

<!-- 	<div class="block-header__video block-header-video" data-vide-bg="mp4: <?=SITE_TEMPLATE_PATH?>/assets/videos/index/header-f.mp4, webm: <?=SITE_TEMPLATE_PATH?>/assets/videos/index/header-f.webm, flv: <?=SITE_TEMPLATE_PATH?>/assets/videos/index/header-f.flv, poster: <?=SITE_TEMPLATE_PATH?>/assets/css/images/index/header.jpg" data-vide-options="posterType: jpg, loop: true, muted: true, position: 50% 50%, className: block-header-video__inner"></div> -->

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


    <?$APPLICATION->IncludeComponent("st:photo.section", "index_week_en", Array(
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
