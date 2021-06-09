<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("О нас");
?>

<div class="block block-about" id="about">

	<div class="block-about__square"></div>

	<div class="block__inner">
		<div class="block-about__inner">
			<header class="block-about__header header">
				<h2 class="header__title">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file", 
							"PATH" => "/includes/" . LANGUAGE_ID . "about_header_title.php", 
							"EDIT_TEMPLATE" => ""
						)
					);?>
				</h2>
			</header>

			<div class="block-about__content">
				<div class="block-about__column">
					<div class="block-about__column-inner">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
								"AREA_FILE_SHOW" => "file", 
								"PATH" => "/includes/" . LANGUAGE_ID . "about_column_1_text_1.php", 
								"EDIT_TEMPLATE" => ""
							)
						);?>

			      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "shop_image", Array(
			      		"SHOP_IMAGE" => "1",
			          "AJAX_MODE" => "N",
			          "IBLOCK_TYPE" => "gallery",
			          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
			          "SECTION_CODE" => "shop-page-image-1",
			          "ELEMENT_SORT_FIELD" => "sort",
			          "ELEMENT_SORT_ORDER" => "asc",
			          "PAGE_ELEMENT_COUNT" => "1",
			          "LINE_ELEMENT_COUNT" => "1",
			          "SET_TITLE" => "N",
			          "ADD_SECTIONS_CHAIN" => "N",
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
						
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
								"AREA_FILE_SHOW" => "file", 
								"PATH" => "/includes/" . LANGUAGE_ID . "about_column_1_text_2.php", 
								"EDIT_TEMPLATE" => ""
							)
						);?>
					</div>
				</div>
				<div class="block-about__column">
					<div class="block-about__column-inner">
			      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "shop_image", Array(
			      		"SHOP_IMAGE" => "2",
			          "AJAX_MODE" => "N",
			          "IBLOCK_TYPE" => "gallery",
			          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
			          "SECTION_CODE" => "shop-page-image-2",
			          "ELEMENT_SORT_FIELD" => "sort",
			          "ELEMENT_SORT_ORDER" => "asc",
			          "PAGE_ELEMENT_COUNT" => "1",
			          "LINE_ELEMENT_COUNT" => "1",
			          "SET_TITLE" => "N",
			          "ADD_SECTIONS_CHAIN" => "N",
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

						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
								"AREA_FILE_SHOW" => "file", 
								"PATH" => "/includes/" . LANGUAGE_ID . "about_column_2_text_1.php", 
								"EDIT_TEMPLATE" => ""
							)
						);?>

			      <?$APPLICATION->IncludeComponent("bitrix:photo.section", "shop_image", Array(
			      		"SHOP_IMAGE" => "3",
			          "AJAX_MODE" => "N",
			          "IBLOCK_TYPE" => "gallery",
			          "IBLOCK_ID" => IBLOCK_ID__GALLERY,
			          "SECTION_CODE" => "shop-page-image-3",
			          "ELEMENT_SORT_FIELD" => "sort",
			          "ELEMENT_SORT_ORDER" => "asc",
			          "PAGE_ELEMENT_COUNT" => "1",
			          "LINE_ELEMENT_COUNT" => "1",
			          "SET_TITLE" => "N",
			          "ADD_SECTIONS_CHAIN" => "N",
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
			</div>
		</div>
	</div>
</div>
<!-- \Catalog -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>