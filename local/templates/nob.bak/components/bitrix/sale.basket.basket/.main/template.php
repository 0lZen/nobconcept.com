<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

		'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));

$this->addExternalCss('/bitrix/css/main/bootstrap.css_orig');
$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';






/*?>




<div class="modal__outer">
      <div class="close i-lazy" data-izimodal-close="" data-bg="url(/local/templates/nob/assets/css/images/icons/close.svg)" data-was-processed="true" style="background-image: url(&quot;/local/templates/nob/assets/css/images/icons/close.svg&quot;);"></div>

      <div class="modal__content">
        <h2 class="modal__header">
          Корзина
        </h2>
        <div class="cart-main">
          <div class="cart-end__side cart-end__side_left i-mobile">
            <a href="javascript:void(0)" class="i-clear-cart" title="Очистить корзину">Очистить корзину</a>
          </div>

          <div class="cart-scheme" style="margin: 0 auto">
            <div class="cart-scheme__row cart-scheme__row_header">
              <div class="cart-scheme__cell">&nbsp;</div>
              <div class="cart-scheme__cell"><div class="cart-scheme__label">Товар</div></div>
              <div class="cart-scheme__cell"><div class="cart-scheme__label">Размер</div></div>
              <div class="cart-scheme__cell"><div class="cart-scheme__label">Стоимость</div></div>
              <div class="cart-scheme__cell"><div class="cart-scheme__label">Кол-во</div></div>
              <div class="cart-scheme__cell"><div class="cart-scheme__label">Итого</div></div>
              <div class="cart-scheme__cell">&nbsp;</div>
            </div>


            <div class="cart-scheme__items">

	            <div class="cart-scheme__row">
	              <div class="cart-scheme__cell cart-scheme__cell_photo">
	                <img alt="Хлопковая футболка" class="cart-scheme__preview i-lazy loaded" data-src="/upload/fish/catalog/form/1.jpg" data-src-mobile="/upload/fish/catalog/form/mobile/1.jpg" src="/upload/fish/catalog/form/1.jpg" data-was-processed="true">
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_info">
	                <div class="cart-product__content">
	                  <h3 class="cart-product__brand">Roma Uvarov</h3>
	                  <h4 class="cart-product__title">Хлопковая футболка</h4>
	                  <div class="cart-product__color i-pc">Розовый</div>
	                  <div class="cart-product__color i-mobile">
	                    Количество: 1 <br>
	                    Размер: 52, Розовый
	                  </div>
	                </div>
	                <a href="/catalog/product/1/" class="cart-product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_size"><div class="cart-scheme__value">52</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_price"><div class="cart-scheme__value">5 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_num"><div class="cart-scheme__value">1</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_total"><div class="cart-scheme__value">5 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_controls">
	                <div class="cart-scheme__controls i-noselect">
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_favorite" title="В избранное" data-text-success="Товар добавлен в избранное" data-text-fail="Товар убран из избранного" data-remove-text="Убрать из избранного" data-add-text="В избранное">В избранное</a>
	                  <div class="i-clear"></div>
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_remove" title="Удалить">Удалить</a>
	                </div>
	              </div>

	              <a href="javascript:void(0);" class="i-add-to-favorite i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/favorite.svg)" data-product-id="1" data-text-success="Товар добавлен в избранное.">&nbsp;</a>
	              <a href="javascript:void(0);" class="i-remove-product i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/close.svg)">&nbsp;</a>
	            </div>
	            <div class="cart-scheme__row">
	              <div class="cart-scheme__cell cart-scheme__cell_photo">
	                <img alt="Кожаные кеды" class="cart-scheme__preview i-lazy loaded" data-src="/upload/fish/catalog/form/2.jpg" data-src-mobile="/upload/fish/catalog/form/mobile/2.jpg" src="/upload/fish/catalog/form/2.jpg" data-was-processed="true">
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_info">
	                <div class="cart-product__content">
	                  <h3 class="cart-product__brand">Roma Uvarov</h3>
	                  <h4 class="cart-product__title">Кожаные кеды</h4>
	                  <div class="cart-product__color i-pc">Красный</div>
	                  <div class="cart-product__color i-mobile">
	                    Количество: 1 <br>
	                    Размер: 43, Красный
	                  </div>
	                </div>
	                <a href="/catalog/product/2/" class="cart-product__link" title="Roma Uvarov | Кожаные кеды">Roma Uvarov | Кожаные кеды</a>
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_size"><div class="cart-scheme__value">43</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_price"><div class="cart-scheme__value">12 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_num"><div class="cart-scheme__value">1</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_total"><div class="cart-scheme__value">12 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_controls">
	                <div class="cart-scheme__controls i-noselect">
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_favorite" title="В избранное" data-text-success="Товар добавлен в избранное" data-text-fail="Товар убран из избранного" data-remove-text="Убрать из избранного" data-add-text="В избранное">В избранное</a>
	                  <div class="i-clear"></div>
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_remove" title="Удалить">Удалить</a>
	                </div>
	              </div>

	              <a href="javascript:void(0);" class="i-add-to-favorite i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/favorite.svg)" data-product-id="1" data-text-success="Товар добавлен в избранное.">&nbsp;</a>
	              <a href="javascript:void(0);" class="i-remove-product i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/close.svg)">&nbsp;</a>
	            </div>
	            <div class="cart-scheme__row">
	              <div class="cart-scheme__cell cart-scheme__cell_photo">
	                <img alt="Хлопковая футболка" class="cart-scheme__preview i-lazy loaded" data-src="/upload/fish/catalog/form/3.jpg" data-src-mobile="/upload/fish/catalog/form/mobile/3.jpg" src="/upload/fish/catalog/form/3.jpg" data-was-processed="true">
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_info">
	                <div class="cart-product__content">
	                  <h3 class="cart-product__brand">Roma Uvarov</h3>
	                  <h4 class="cart-product__title">Сумка-тоу</h4>
	                  <div class="cart-product__color i-pc">Желтый</div>
	                  <div class="cart-product__color i-mobile">
	                    Количество: 1 <br>
	                    Желтый
	                  </div>
	                </div>
	                <a href="/catalog/product/3/" class="cart-product__link" title="Roma Uvarov | Сумка-тоу">Roma Uvarov | Сумка-тоу</a>
	              </div>
	              <div class="cart-scheme__cell cart-scheme__cell_size">&nbsp;</div>
	              <div class="cart-scheme__cell cart-scheme__cell_price"><div class="cart-scheme__value">244 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_num"><div class="cart-scheme__value">1</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_total"><div class="cart-scheme__value">244 000 ₽</div></div>
	              <div class="cart-scheme__cell cart-scheme__cell_controls">
	                <div class="cart-scheme__controls i-noselect">
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_favorite" title="В избранное" data-text-success="Товар добавлен в избранное" data-text-fail="Товар убран из избранного" data-remove-text="Убрать из избранного" data-add-text="В избранное">В избранное</a>
	                  <div class="i-clear"></div>
	                  <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_remove" title="Удалить">Удалить</a>
	                </div>
	              </div>

	              <a href="javascript:void(0);" class="i-add-to-favorite i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/favorite.svg)" data-product-id="1" data-text-success="Товар добавлен в избранное.">&nbsp;</a>
	              <a href="javascript:void(0);" class="i-remove-product i-mobile i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/close.svg)">&nbsp;</a>
	            </div>
            </div>
          </div>

          <div class="cart-end">
            <div class="cart-end__side cart-end__side_left i-pc">
              <a href="javascript:void(0)" class="i-clear-cart" title="Очистить корзину">Очистить корзину</a>
            </div>
            <div class="cart-end__side">
              <a href="#cart-order" class="button button_important" data-source="Корзина" title="Оформить заказ">Оформить заказ на сумму: <span>261 000</span> ₽</a>
            </div>
          </div>
        </div>
        <div class="cart-message i-noselect">Ваша корзина пуста. Добавьте товар в <a href="/catalog/" title="Каталог">каталоге</a>.</div>
      </div>
    </div>

    <?*/















if (empty($arResult['ERROR_MESSAGE']))
{
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP')
	{
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		<?
	}

	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}
	?>
	<div id="basket-root" class="bx-basket bx-<?=$arParams['TEMPLATE_THEME']?> bx-step-opacity" style="opacity: 1;">
		<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
			<div class="row">
				<div class="col-xs-12" data-entity="basket-total-block"></div>
			</div>
			<?
		}
		?>



		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-warning alert-dismissable" id="basket-warning" style="display: none;">
					<span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
					<div data-entity="basket-general-warnings"></div>
					<div data-entity="basket-item-warnings">
						<?=Loc::getMessage('SBB_BASKET_ITEM_WARNING')?>
					</div>
				</div>
			</div>
		</div>




			<div class="modal__outer">
		      <div class="close i-lazy" data-izimodal-close="" data-bg="url(/local/templates/nob/assets/css/images/icons/close.svg)" data-was-processed="true" style="background-image: url(&quot;/local/templates/nob/assets/css/images/icons/close.svg&quot;);"></div>
				<div class="modal__content" id="basket-items-list-wrapper">
			        <h2 class="modal__header">
			          Корзина
			        </h2>
					<div class="cart-main" id="basket-items-list-container">


						<div class="basket-items-list-overlay" id="basket-items-list-overlay" style="display: none;"></div>
						 <div class="cart-end__side cart-end__side_left i-mobile">
				            <a href="javascript:void(0)" class="i-clear-cart" title="Очистить корзину">Очистить корзину</a>
				          </div>
						<div class="cart-scheme" style="margin: 0 auto" id="basket-item-list">
							<div class="basket-search-not-found" id="basket-item-list-empty-result" style="display: none;">
								<div class="basket-search-not-found-icon"></div>
								<div class="basket-search-not-found-text">
									<?=Loc::getMessage('SBB_FILTER_EMPTY_RESULT')?>
								</div>
							</div>

							<div class="cart-scheme__row cart-scheme__row_header">
				              <div class="cart-scheme__cell">&nbsp;</div>
				              <div class="cart-scheme__cell"><div class="cart-scheme__label">Товар</div></div>
				              <div class="cart-scheme__cell"><div class="cart-scheme__label">Размер</div></div>
				              <div class="cart-scheme__cell"><div class="cart-scheme__label">Стоимость</div></div>
				              <div class="cart-scheme__cell"><div class="cart-scheme__label">Кол-во</div></div>
				              <div class="cart-scheme__cell"><div class="cart-scheme__label">Итого</div></div>
				              <div class="cart-scheme__cell">&nbsp;</div>
				            </div>
							<div class="cart-scheme__items" id="basket-item-table">


							</div>
						  </div>

							<?
								if (
									$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
									&& in_array('bottom', $arParams['TOTAL_BLOCK_DISPLAY'])
								)
								{
									?>

									<div data-entity="basket-total-block"></div>

									<?
								}
							?>




						</div>

						<div class="cart-message i-noselect">Ваша корзина пуста. Добавьте товар в <a href="/catalog/" title="Каталог">каталоге</a>.</div>
						</div>
						</div>











	</div>
	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			siteTemplateId: '<?=CUtil::JSEscape($component->getSiteTemplateId())?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM')
	{
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		<?
	}
}
elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}
