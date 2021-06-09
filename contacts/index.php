<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("Контакты");
?>

<div class="block block-contacts" id="contacts">

	<div class="block-contacts__square"></div>

	<div class="block__inner">
		<div class="block-contacts__inner">
			<div class="block-contacts__line"></div>

            <h1>Контакты</h1>
			<header class="block-contacts__header header">
				<h2 class="header__title">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file", 
							"PATH" => "/includes/" . LANGUAGE_ID . "contacts_header_title.php", 
							"EDIT_TEMPLATE" => ""
						)
					);?>
				</h2>
			</header>
			<div class="block-about__workhours">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file", 
							"PATH" => "/includes/" . LANGUAGE_ID . "contacts_workhours.php", 
							"EDIT_TEMPLATE" => ""
						)
					);?>
			</div>
			<div class="block-contacts__contacts contacts-contacts">
				<div class="contacts-contacts__item contacts-contacts__item_phone">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/phone.svg)"></div>
					<div class="contacts-contacts__text"><a href="tel:<?=str_replace(array("(", ")", "-", " "), "", $APPLICATION->GetDirProperty("phone_contacts"))?>" class="contacts-contacts__link" title="Позвонить"><?$APPLICATION->ShowProperty("phone_contacts")?></a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_facebook">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/facebook.svg)"></div>
					<div class="contacts-contacts__text"><a href="<?$APPLICATION->ShowProperty("facebook")?>" class="contacts-contacts__link" title="Мы в Facebook">Facebook</a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_email">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/email.svg)"></div>
					<div class="contacts-contacts__text"><a href="mailto:<?$APPLICATION->ShowProperty("email_contacts")?>" class="contacts-contacts__link" title="Написать email"><?$APPLICATION->ShowProperty("email_contacts")?></a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_instagram">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/instagram_2.svg)"></div>
					<div class="contacts-contacts__text"><a href="<?$APPLICATION->ShowProperty("instagram")?>" class="contacts-contacts__link" title="Мы в Instagram">Instagram</a></div>
				</div>
			</div>

			<div class="block-contacts__contacts contacts-contacts i-mobile">
				<div class="contacts-contacts__item contacts-contacts__item_phone">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/phone.svg)"></div>
					<div class="contacts-contacts__text"><a href="tel:<?=str_replace(array("(", ")", "-", " "), "", $APPLICATION->GetDirProperty("phone_contacts"))?>" class="contacts-contacts__link" title="Позвонить"><?$APPLICATION->ShowProperty("phone_contacts")?></a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_email">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/email.svg)"></div>
					<div class="contacts-contacts__text"><a href="mailto:<?$APPLICATION->ShowProperty("email_contacts")?>" class="contacts-contacts__link" title="Написать email"><?$APPLICATION->ShowProperty("email_contacts")?></a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_facebook">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/facebook.svg)"></div>
					<div class="contacts-contacts__text"><a href="<?$APPLICATION->ShowProperty("facebook")?>" class="contacts-contacts__link" title="Мы в Facebook">Facebook</a></div>
				</div>
				<div class="contacts-contacts__item contacts-contacts__item_instagram">
					<div class="contacts-contacts__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/socials/instagram_2.svg)"></div>
					<div class="contacts-contacts__text"><a href="<?$APPLICATION->ShowProperty("instagram")?>" class="contacts-contacts__link" title="Мы в Instagram">Instagram</a></div>
				</div>
			</div>
            <?/*<div class="contacts-contacts__text">ООО "Агентство НОБ"<br />
                ОГРН 1197746383064<br />
                ИНН 7708352789<br />
                Адрес: 101000, г.Москва, улица Казакова д.8 с2</div>
		</div>*/?>
	</div>
</div>
<!-- \Contacts -->

<div class="block block-map" id="map">
	<div class="block-map__inner">
		<div class="block-map__square"></div>
		<div class="block-map__maps" id="js-contacts-maps" data-coords="<?=CONTACTS_MAP_COORDS_TEXT?>" data-zoom="<?=CONTACTS_MAP_ZOOM_TEXT?>" data-addr="<?=CONTACTS_MAP_ADDR_TEXT?>"></div>
	</div>
</div>
<!-- \Map -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>