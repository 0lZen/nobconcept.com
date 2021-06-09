<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle(strip_tags($arResult['PROPERTIES']['NAME_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']) . " | NOBCONCEPT");
?>

<div class="block block-article" id="article">

	<div class="block-article__square"></div>

	<div class="block__inner">
		<div class="block-article__inner">
			<header class="block-article__header header">
				<h1 class="header__title">
					<?=strip_tags($arResult['PROPERTIES']['NAME_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE'])?>
				</h1>
				<div class="block-article__date i-mobile">
          <?php if ($arResult['ACTIVE_FROM']) { ?>
            <?=ConvertDateTime($arResult['ACTIVE_FROM'], "DD")?>.<?=ConvertDateTime($arResult['ACTIVE_FROM'], "MM")?>.<?=ConvertDateTime($arResult['ACTIVE_FROM'], "YYYY")?>
          <?php } else { ?>
            ---
          <?php } ?>
				</div>
			</header>

			<div class="block-article__content">
				<?=Project::parseSlides($arResult['PROPERTIES']['DETAIL_TEXT_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT'], array(1 => $arResult['PROPERTIES']['SLIDER_1']['VALUE'], 2 => $arResult['PROPERTIES']['SLIDER_2']['VALUE'], 3 => $arResult['PROPERTIES']['SLIDER_3']['VALUE']), array(1 => $arResult['PROPERTIES']['SLIDER_1_MOBILE']['VALUE'], 2 => $arResult['PROPERTIES']['SLIDER_2_MOBILE']['VALUE'], 3 => $arResult['PROPERTIES']['SLIDER_3_MOBILE']['VALUE']))?>
			</div>
		</div>
		<div class="block-article__bottom">
			<div class="block-article__bottom-left i-pc">
				<a href="/news/" class="block-article__back article-back i-noselect"><span class="article-back__arrow">&nbsp;</span><?=GetMessage("BACK")?></a>
			</div>
			<div class="block-article__bottom-right">
				<div class="block-article__socials article-socials i-noselect">
					<div class="article-socials__label i-pc"><?=GetMessage("TELL_FRIENDS")?></div>
					<div class="article-socials__label i-mobile"><?=GetMessage("SHARE")?></div>
					<div class="article-socials__items">
		        <script async src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/share/es5-shims.min.js"></script>
		        <script async src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/share/share.js"></script>
		        <div class="ya-share2" data-services="vkontakte,odnoklassniki,facebook,twitter" data-counter=""></div>
					</div>
				</div>
				<div class="block-article__date i-pc">
          <?php if ($arResult['ACTIVE_FROM']) { ?>
            <?=ConvertDateTime($arResult['ACTIVE_FROM'], "DD")?>.<?=ConvertDateTime($arResult['ACTIVE_FROM'], "MM")?>.<?=ConvertDateTime($arResult['ACTIVE_FROM'], "YYYY")?>
          <?php } else { ?>
            ---
          <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- \Product -->