<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];
//echo "<pre>"; print_r($arResult['OFFERS']); echo "</pre>";
$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
$is_av_offer = false;
if($arResult['OFFERS']){
    foreach ($arResult['OFFERS'] as $offer){
        if($offer['MIN_PRICE']['VALUE'] > 0){
            $is_av_offer = true;
            break;
        }
    }
}

if (!$is_av_offer && !$arResult["CAN_BUY"])
{
    $arResult['MIN_PRICE']['VALUE']=false;
    $price=[];
}


if (count($arResult['OFFERS']) == 1)
{
    $cartFavID=$arResult['OFFERS'][0]['ID'];
} else
if (empty($arResult['OFFERS']))
{
    $cartFavID=$arResult['ID'];
} else
{
    $cartFavID='offer';
}
?>




<div class="block block-product <? if (isset($_GET['test'])) { ?> _new<? } ?>" id="product">
	<div class="block__inner">
		<a href="javascript:void(0);" class="i-add-to-favorite i-mobile js-favorite-add-remove"
           data-product-id="<?=$cartFavID?>"
           data-price="<?=$price['RATIO_PRICE']?>"
           data-text-success="<?=GetMessage('IN_FAV')?>"
           data-text-fail="<?=GetMessage('FROM_FAV')?>">&nbsp;</a>

		<div class="block-product__images-videos">
			<div class="block-product__images slides1" data-slick-slidestoshow="1" data-slick-slidestoscroll="1"
	             data-slick-infinite="false" data-slick-variable-width="false" data-slick-touch-threshold="20" data-slick-fade="true"
	             data-slick-adaptive-height="true" data-slick-swipe="false" data-slick-menu=".block-product-colors">

				<div class="block-product__images-page slides__item slides gallery js-nob21-detail-prod-slides" data-slick-slidestoshow="1"
	                 data-slick-slidestoscroll="1" data-slick-infinite="false" data-slick-variable-width="false" data-slick-touch-threshold="20"
	                 data-slick-fade="false" data-slick-adaptive-height="true" data-slick-disable-on-pc="true" data-slick-menu=".block-product__buttons"
	                 <?/*data-slick-nav-for=".block-product__images-page"*/?> itemscope itemtype="http://schema.org/ImageGallery">

	                <? if (false) { ?>
						<?foreach($arResult['SLIDER_PHOTOS'] as $image):?>
							<figure class="block-product__figure slides__item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
								<a href="<?=$image['FULL']?>" class="block-product__link" itemprop="contentUrl" data-hash="false" data-back-focus="false" data-fancybox="prodGallery">
		                            <img alt="<?=$arResult['NAME']?>" class="block-product__image i-lazy1" src="<?=$image['THUMB']?>" itemprop="thumbnail"></a>
							</figure>
						<?endforeach?>
					<? } else { ?>
						<?foreach($arResult['SLIDER_PHOTOS'] as $image):?>
							<figure class="block-product__figure slides__item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
								<a href="<?=$image['FULL']?>" class="block-product__link js-nob21-detail-prod-slides__item" itemprop="contentUrl">
		                            <img alt="<?=$arResult['NAME']?>" class="block-product__image i-lazy1 js-nob21-detail-prod-slides__item-img" src="<?=$image['THUMB']?>" itemprop="thumbnail"></a>
							</figure>
						<?endforeach?>
					<?} ?>

        			<? if (isset($_GET['test'])) { ?>

        				<div class="nob20-detail-video">

        					<?
        						foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $fileID) {
        						$fileRes = CFile::GetPath($fileID);
        						if (stristr($fileRes, '.mp4') == FALSE) continue;
        					?>
        						<video class="nob20-detail-video__player" src="<?=$fileRes;?>" controls="true" preload="auto" autoplay="true" loop="true" muted="muted"></video>
        					<? } ?>

        				</div>
        			<? } ?>

				</div>


				<?/*<div class="block-product__images-page slides__item slides gallery" data-slick-slidestoshow="1"
					data-slick-slidestoscroll="1" data-slick-infinite="true" data-slick-variable-width="false" data-slick-touch-threshold="20"
					data-slick-fade="true" data-slick-adaptive-height="true" data-slick-disable-on-pc="true" data-slick-menu=".block-product__buttons"
					data-slick-nav-for=".block-product__images-page">
					<?foreach($arResult['SLIDER_PHOTOS'] as $image):?>
						<figure class="block-product__figure slides__item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
						<a href="<?=$image['FULL']?>" class="block-product__link" itemprop="contentUrl" data-size="1900x2418">
	                        <img alt="<?=$arResult['NAME']?>" class="block-product__image i-lazy1" src="<?=$image['THUMB']?>" itemprop="thumbnail"></a>
						</figure>
					<?endforeach?>

        			<? if (isset($_GET['test'])) { ?>

        				<div class="nob20-detail-video">

        					<?
        						foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $fileID) {
        						$fileRes = CFile::GetPath($fileID);
        						if (stristr($fileRes, '.mp4') == FALSE) continue;
        					?>
        						<video class="nob20-detail-video__player" src="<?=$fileRes;?>" controls="true" preload="auto" autoplay="true" loop="true" muted="muted"></video>
        					<? } ?>

        				</div>
        			<? } ?>

				</div>*/?>

			</div>

			<? if (isset($_GET['test2'])) { ?>

				<div class="nob20-detail-video _under">

					<?
						foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $fileID) { 
						$fileRes = CFile::GetPath($fileID);
						if (stristr($fileRes, '.mp4') == FALSE) continue;
					?>
						<video class="nob20-detail-video__player" src="<?=$fileRes;?>" controls="true" preload="auto" autoplay="true" loop="true" muted="muted"></video>
					<? } ?>

				</div>
			<? } ?>

		</div>

		<div class="block-product__buttons slides-menu i-noselect i-mobile" data-slick=".block-product__images-page">
			<div class="slides-menu__item slides-menu__item_active" data-slick=".block-product__images-page"></div>
            <?
            for ($i=1;$i<count($arResult['SLIDER_PHOTOS']);$i++)
            {
                ?><div class="slides-menu__item" data-slick=".block-product__images-page"></div><?
            }
            ?>		</div>
		<div class="block-product__main">



			<?if($arResult['NAME']):?>
				<? if ($arResult['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE'] && LANGUAGE_ID == "en") { ?>
					<h1 class="block-product__title"><?=$arResult['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE']?></h1>
				<? } else { ?>
					<h1 class="block-product__title"><?=$arResult['NAME']?></h1>
				<? } ?>
			<?endif;?>

            <?if($arResult['PROPERTIES']['BREND']['VALUE']):?>
				<p class="block-product__subtitle"><?=$arResult['PROPERTIES']['BREND']['VALUE']?></p>
			<?endif;?>

			<div class="block-product__price-wrapper
			<?if (!empty($price)&& $price['RATIO_DISCOUNT'] > 0){?>has-old<?}?>
			<?if($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']){?>has-preorder<?}?>
            <?if(!$arResult['MIN_PRICE']['VALUE'] && !$is_av_offer && $arResult['PROPERTIES']['SOLDOUT']['VALUE']){?>has-sold<?}?>
">
                <?if (!empty($price)&& $price['RATIO_DISCOUNT'] > 0){?>
                    <div class="block-product__old-price"><? echo $price['PRINT_RATIO_BASE_PRICE'];?></div>
                <?}?>

                <?if(!$arResult['MIN_PRICE']['VALUE']  && !$is_av_offer && $arResult['PROPERTIES']['SOLDOUT']['VALUE']){?>
                <?}else{?>
                    <div class="block-product__price">
					<span id="<?=$itemIds['PRICE_ID']?>">
						<?=$price['PRINT_RATIO_PRICE']?>
					</span>
                    </div>
                <?}?>

                <?if($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']){?>
                    <div class="block-product__preorder"><?=GetMessage('PREORDER')?></div>
                <?}?>
                <?if(!$arResult['MIN_PRICE']['VALUE']  && !$is_av_offer && $arResult['PROPERTIES']['SOLDOUT']['VALUE']){?>
                    <div class="block-product__preorder"><?=GetMessage('Sold_out')?></div>
                <?}?>

			</div>

			<div>
				<?
                #echo "1<pre>"; print_r($arParams['PRODUCT_INFO_BLOCK_ORDER']); echo "</pre>";
                #echo "2<pre>"; print_r($haveOffers); echo "</pre>";
                #echo "3<pre>"; print_r($arResult['OFFERS_PROP']); echo "</pre>";
				foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
				{
					switch ($blockName)
					{
						case 'sku':
							if ($haveOffers && !empty($arResult['OFFERS_PROP']))
							{
								?>
								<div id="<?=$itemIds['TREE_ID']?>">
									<?                                    
									foreach ($arResult['SKU_PROPS'] as $key=> $skuProperty)
									{
										if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
											continue;

										$propertyId = $skuProperty['ID'];
										$skuProps[] = array(
											'ID' => $propertyId,
											'SHOW_MODE' => $skuProperty['SHOW_MODE'],
											'VALUES' => $skuProperty['VALUES'],
											'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
										);
										?>
										<div class="product-item-detail-info-container" data-entity="sku-line-block">
											<div class="product-item-scu-container">
												<div class="product-item-scu-block">
													<div class="product-item-scu-list">

														<?if ($skuProperty['SHOW_MODE'] === 'PICT' || $skuProperty['CODE'] =='TSVET'):?>
                                                            <?if($arResult['PROPERTIES']['PREDZAKAZ']['VALUE']){
                                                                //Февраль 2020
                                                                $date_admission = "";
                                                                $date_adm = explode("-", $arResult['PROPERTIES']['PREDZAKAZ']['VALUE']);
                                                                if($date_adm[1] && LANGUAGE_ID == 'ru'){
                                                                    if($date_adm[1] == "01"){
                                                                        $date_admission = "Январь";
                                                                    }
                                                                    if($date_adm[1] == "02"){
                                                                        $date_admission = "Февраль";
                                                                    }
                                                                    if($date_adm[1] == "03"){
                                                                        $date_admission = "Март";
                                                                    }
                                                                    if($date_adm[1] == "04"){
                                                                        $date_admission = "Апрель";
                                                                    }
                                                                    if($date_adm[1] == "05"){
                                                                        $date_admission = "Май";
                                                                    }
                                                                    if($date_adm[1] == "06"){
                                                                        $date_admission = "Июнь";
                                                                    }
                                                                    if($date_adm[1] == "07"){
                                                                        $date_admission = "Июль";
                                                                    }
                                                                    if($date_adm[1] == "08"){
                                                                        $date_admission = "Август";
                                                                    }
                                                                    if($date_adm[1] == "09"){
                                                                        $date_admission = "Сентябрь";
                                                                    }
                                                                    if($date_adm[1] == "10"){
                                                                        $date_admission = "Октябрь";
                                                                    }
                                                                    if($date_adm[1] == "11"){
                                                                        $date_admission = "Ноябрь";
                                                                    }
                                                                    if($date_adm[1] == "12"){
                                                                        $date_admission = "Декабрь";
                                                                    }
                                                                }
																if($date_adm[1] && LANGUAGE_ID == 'en'){
                                                                    if($date_adm[1] == "01"){
                                                                        $date_admission = "January";
                                                                    }
                                                                    if($date_adm[1] == "02"){
                                                                        $date_admission = "February";
                                                                    }
                                                                    if($date_adm[1] == "03"){
                                                                        $date_admission = "March";
                                                                    }
                                                                    if($date_adm[1] == "04"){
                                                                        $date_admission = "April";
                                                                    }
                                                                    if($date_adm[1] == "05"){
                                                                        $date_admission = "May";
                                                                    }
                                                                    if($date_adm[1] == "06"){
                                                                        $date_admission = "June";
                                                                    }
                                                                    if($date_adm[1] == "07"){
                                                                        $date_admission = "July";
                                                                    }
                                                                    if($date_adm[1] == "08"){
                                                                        $date_admission = "August";
                                                                    }
                                                                    if($date_adm[1] == "09"){
                                                                        $date_admission = "September";
                                                                    }
                                                                    if($date_adm[1] == "10"){
                                                                        $date_admission = "October";
                                                                    }
                                                                    if($date_adm[1] == "11"){
                                                                        $date_admission = "November";
                                                                    }
                                                                    if($date_adm[1] == "12"){
                                                                        $date_admission = "December";
                                                                    }
                                                                }
                                                                $date_admission .= " ".$date_adm[0];
                                                                ?>
                                                                <div class="block-product__preorder"><?=GetMessage('PREORDER')?></div>
                                                                <div class="block-product__admission">
                                                                    <?=GetMessage('ARRIVAL')?><span class="block-product__admission-date"><?=$date_admission?></span>
                                                                </div>
                                                            <?}?>

															<div class="block-product__color">

																<?
																	if (LANGUAGE_ID == "en") {
																		echo 'Color';
																	} else {
																		echo htmlspecialcharsEx($skuProperty['NAME']);
																	}
																?>

																: <span class="block-product-selectded-color">

																	<?
																		$arColors = [
																			'Синий' => 'Blue',
																			'Желтый' => 'Yellow',
																			'Красный' => 'Red',
																			'Черный' => 'Black',
																			'Белый' => 'White',
																			'Зелёный' => 'Green',
																			'Голубой' => 'Light blue',
																			'Бордовый' => 'Vinous',
																			'Розовый' => 'Pink',
																			'Серый' => 'Gray',
																			'Бежевый' => 'Beige',
																			'Мультиколор' => 'Multicolor',
																			'Оранжевый' => 'Orange',
																			'Сиреневый' => 'Lilac',
																			'Фиолетовый' => 'Violet',
																			'Хаки' => 'Khaki',
																			'Коричневый' => 'Brown',
																			'Бирюзовый' => 'Turquoise',
																			'Бежевый' => 'Beige',
																			'Мультиколор' => 'Multicolor',
																		];

																		if (LANGUAGE_ID == "en") { 
																			if(!$skuProperty['VALUES'][1]['NAME']){
		                                                                    	echo $arColors[current($skuProperty['VALUES'])['NAME']];
																			}else{
																				echo $arColors[$skuProperty['VALUES'][1]['NAME']];
																			}
																		} else {
																			if(!$skuProperty['VALUES'][1]['NAME']){
		                                                                    	echo current($skuProperty['VALUES'])['NAME'];
																			}else{
																				echo $skuProperty['VALUES'][1]['NAME'];
																			}																			
																		}
	                                                                ?>

                                                                </span></div>

															<ul class="block-product__colors block-product-colors slides-menu i-noselect" data-slick=".block-product__images">


																<?$counter = 0;?>
																<?foreach ($skuProperty['VALUES'] as &$value):

																	$bgImageItem = false;

																	if($value['NAME']=='Синий' || $value['NAME']=='Blue'):
									                                    $value['VALUE']='0000FF';
									                                elseif($value['NAME']=='Желтый' || $value['NAME']=='Yellow'):
									                                    $value['VALUE']='fdff00';
									                                elseif($value['NAME']=='Красный' || $value['NAME']=='Red'):
									                                    $value['VALUE']='ff0000';
									                                elseif($value['NAME']=='Черный' || $value['NAME']=='Black'):
									                                    $value['VALUE']='000000';
									                                elseif($value['NAME']=='Белый' || $value['NAME']=='White'):
									                                    $value['VALUE']='eaeaea';
									                                elseif($value['NAME']=='Зелёный' || $value['NAME']=='Green'):
									                                    $value['VALUE']='15ff00';
									                                elseif($value['NAME']=='Голубой' || $value['NAME']=='Light blue'):
									                                    $value['VALUE']='00ffdf';
									                                elseif($value['NAME']=='Бордовый' || $value['NAME']=='Vinous' ):
									                                    $value['VALUE']='800000';
									                                elseif($value['NAME']=='Розовый' || $value['NAME']=='Pink'):
									                                    $value['VALUE']='ff7bb0';
									                                elseif($value['NAME']=='Серый' || $value['NAME']=='Gray'):
									                                    $value['VALUE']='8d8d8d';
									                                elseif($value['NAME']=='Бежевый' || $value['NAME']=='Beige'):
									                                    $value['VALUE']='e0e094';
									                                elseif($value['NAME']=='Мультиколор' || $value['NAME']=='Multicolor'):
									                                    $value['VALUE']='c6f2ff';
																		$bgImageItem = '/upload/images/img-multicolor.png';
																	elseif($value['NAME']=='Оранжевый' || $value['NAME']=='Orange'):
									                                    $value['VALUE']='ffa500';
																	elseif($value['NAME']=='Сиреневый' || $value['NAME']=='Lilac'):
									                                    $value['VALUE']='c8a2c8';
																	elseif($value['NAME']=='Фиолетовый' || $value['NAME']=='Violet'):
									                                    $value['VALUE']='8b00ff';
																	elseif($value['NAME']=='Хаки' || $value['NAME']=='Khaki'):
									                                    $value['VALUE']='806b2a';
																	elseif($value['NAME']=='Коричневый' || $value['NAME']=='Brown'):
									                                    $value['VALUE']='964b00';
																	elseif($value['NAME']=='Бирюзовый' || $value['NAME']=='Turquoise'):
									                                    $value['VALUE']='30d5c8';
                                                                    elseif($value['ID']==0):
                                                                        continue;
									                                endif;

                                                                    //echo '<pre>'.print_r($value).'</pre>'; 

                                                                    $offer_id_size = 0;
                                                                    foreach ($arResult['OFFERS'] as $ofs){
                                                                        if($ofs['PROPERTIES']['TSVET']['VALUE'] == $value['NAME']) $offer_id_size = $ofs['ID'];
                                                                    }
                                                                    if($offer_id_size){
                                                                        $off_def = $offer_id_size;
                                                                    }


									                                $counter++;
																	$value['NAME'] = htmlspecialcharsbx($value['NAME']);?>

																	<? 	
																		if (LANGUAGE_ID == "en"):
																	?>
																		<li class="block-product-colors__item slides-menu__item <?if($counter==1){echo 'slides-menu__item_active';}?>" data-value="brown" data-label="<?=$arColors[$value['NAME']]?>" data-slick=".block-product__images" style="<? if ($bgImageItem) { ?>background-image: url(<?=$bgImageItem;?>); background-size: cover; <? } else { ?>background:#<?=$value['VALUE']?>;<? } ?>" title="<?=$arColors[$value['NAME']]?>"
																			data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																			data-onevalue="<?=$value['ID']?>" data-defsize="<?=$offer_id_size?>">
																		</li>
																	<? else: ?>
																		<li class="block-product-colors__item slides-menu__item <?if($counter==1){echo 'slides-menu__item_active';}?>" data-value="brown" data-label="<?=$value['NAME']?>" data-slick=".block-product__images" style="<? if ($bgImageItem) { ?>background-image: url(<?=$bgImageItem;?>); background-size: cover; <? } else { ?>background:#<?=$value['VALUE']?>;<? } ?>" title="<?=$value['NAME']?>"
																			data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																			data-onevalue="<?=$value['ID']?>" data-defsize="<?=$offer_id_size?>">
																		</li>
																	<? endif; ?>


																<?endforeach;?>
															</ul>

														<?else:?>
                                                        <?/*<div class="block-product__color"><?=htmlspecialcharsEx($skuProperty['NAME'])?>:</div>*/?>
														<div class="block-product__size-wrapper">
															<select class="selectbox selectbox__control select_size" data-placeholder="Выберите <?=htmlspecialcharsEx($skuProperty['NAME'])?>" data-modifier="custom-select_size">
                                                                <?
                                                                $ss = 0; $off_def = 0;
                                                                foreach ($skuProperty['VALUES'] as &$value):?>
                                                                    <?if($value['ID']==0) continue;
                                                                    $offer_id_size = 0;
                                                                    foreach ($arResult['OFFERS'] as $ofs){
                                                                        if($ofs['PROPERTIES']['RAZMER']['VALUE'] == $value['NAME']) $offer_id_size = $ofs['ID'];
                                                                    }
                                                                    if($offer_id_size){
                                                                        $off_def = $offer_id_size;
                                                                    }
                                                                    ?>
                                                                    <?$ss++; endforeach;?>
                                                                <option value="not" selected="selected"><?=GetMessage('CHOOSE_SIZE')?></option>
                                                                <?
                                                                $ss = 0;
                                                                foreach ($skuProperty['VALUES'] as &$value):?>
                                                                    <?if($value['ID']==0) continue;
                                                                    $offer_id_size = 0;
                                                                    //echo "<pre>"; print_r($value); echo "</pre>";
                                                                    foreach ($arResult['OFFERS'] as $ofs){
                                                                        if($ofs['PROPERTIES']['RAZMER']['VALUE'] == $value['NAME']) $offer_id_size = $ofs['ID'];
                                                                    }
                                                                    //<?if($ss == 0){selected="selected"}
                                                                    ?>

																	<?$value['NAME'] = htmlspecialcharsbx($value['NAME']);?>
																	<option value="<?=$offer_id_size?>" ><?=$value['NAME']?></option>
																<?$ss++; endforeach;?>
															</select>
														</div>

															<ul class="product-item-scu-item-list" style="display: none;">
																<?
																foreach ($skuProperty['VALUES'] as &$value)
																{
																	$value['NAME'] = htmlspecialcharsbx($value['NAME']);?>

																	<li class="product-item-scu-item-text-container" title="<?=$value['NAME']?>"
																		data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																		data-onevalue="<?=$value['ID']?>">
																		<div class="product-item-scu-item-text-block">
																			<div class="product-item-scu-item-text"><?=$value['NAME']?></div>
																		</div>
																	</li>
																		<?

																}
																?>
															</ul>
														<?endif;?>


														<div style="clear: both;"></div>
													</div>
												</div>
											</div>
										</div>
										<?
									}
									?>
								</div>
								<?
							}

							break;

						case 'props':
							if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
							{
								?>
								<div class="product-item-detail-info-container">
									<?
									if (!empty($arResult['DISPLAY_PROPERTIES']))
									{
										?>
										<dl class="product-item-detail-properties bla" >
											<?
											foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
											{
												if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]))
												{
													?>
													<dt><?=$property['NAME']?></dt>
													<dd><?=(is_array($property['DISPLAY_VALUE'])
															? implode(' / ', $property['DISPLAY_VALUE'])
															: $property['DISPLAY_VALUE'])?>
													</dd>
													<?
												}
											}
											unset($property);
											?>
										</dl>
										<?
									}

									if ($arResult['SHOW_OFFERS_PROPS'])
									{
										?>
										<dl class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_MAIN_PROP_DIV']?>"></dl>
										<?
									}
									?>
								</div>
								<?
							}

							break;
					}
				}
				?>
			</div>





			<div class="block-product__controls i-noselect">

				<div class="block-product__buttons-wrapper">
                    <?if(!$arResult['MIN_PRICE']['VALUE']  && !$is_av_offer){?>
                        <div class="block-product__buttons-only" id="<?=$itemIds['BASKET_ACTIONS_ID']?>">
                            <?/*<p style="margin-top: 25px;">
                                Распродано, ожидается поставка
                            </p>*/?>
                        </div>
                    <?}else{
                        if(count($arResult['OFFERS']) > 0){
                            ?>
                            <div class="block-product__buttons-only" id="<?=$itemIds['BASKET_ACTIONS_ID']?>">

                                <?
                                if ($showAddBtn)
                                {
                                    ?>
                                    <a href="javascript:void(0);" class="button button_important i-add-to-cart <?=$showButtonClassName?>"
                                       title="<?=GetMessage('CT_BCE_CATALOG_ADD')?>" data-text-success="<?=GetMessage('PROD_IN_BASKET')?>"
                                       data-product-id="<?=$cartFavID?>" data-price="<?=$price['RATIO_BASE_PRICE']?>" data-discount="<?=$price['RATIO_PRICE']?>" data-action="add_basket"
                                       id="add_basket_prod<?//=$itemIds['ADD_BASKET_LINK']?>"><?=GetMessage('CT_BCE_CATALOG_ADD')?></a>
                                    <?
                                }

                                if ($showBuyBtn)
                                {
                                    ?>
                                    <a href="javascript:void(0);" class="button button_important i-add-to-cart <?=$showButtonClassName?>"
                                       title="<?=GetMessage('CT_BCE_CATALOG_ADD')?>" data-text-success="<?=GetMessage('PROD_IN_BASKET')?>"
                                       data-product-id="<?=$cartFavID?>" data-price="<?=$price['RATIO_BASE_PRICE']?>" data-discount="<?=$price['RATIO_PRICE']?>"
                                       id="add_basket_prod<?//=$itemIds['BUY_LINK']?>"><?=GetMessage('CT_BCE_CATALOG_ADD')?></a>
                                    <?
                                }
                                ?>
                                <a href="<?if (LANGUAGE_ID == 'ru'){echo '#form-order';}else{echo '#form-order-en';}?>" class="button i-modal" id="fast-order"
                                   data-ib="<?if (LANGUAGE_ID == 'ru'){echo '4';}else{echo '9';}?>" data-prod="<?=$cartFavID?>"
                                   title="<?=GetMessage('FAST_BUY')?>"><?=GetMessage('FAST_BUY')?></a>
                            </div>
                            <a href="javascript:void(0);" id="add-to-favorite" class="i-add-to-favorite js-favorite-add-remove"
                               data-product-id="<?=$cartFavID?>" data-price="<?=$price['RATIO_BASE_PRICE']?>" data-discount="<?=$price['RATIO_PRICE']?>"
                               data-text-success="<?=GetMessage('IN_FAV')?>" data-text-fail="<?=GetMessage('FROM_FAV')?>">&nbsp;</a>
                            <?
                        }else{
                            ?>
                            <div class="block-product__buttons-only" id="<?=$itemIds['BASKET_ACTIONS_ID']?>">

                                <?
                                if ($showAddBtn)
                                {
                                    ?>
                                    <a href="javascript:void(0);" class="button button_important i-add-to-cart <?=$showButtonClassName?>"
                                       title="В корзину" data-product-id="<?=$arResult['ID']?>" data-text-success="<?=GetMessage('PROD_IN_BASKET')?>"
                                       data-product-id="<?=$arResult['ID']?>" data-price="<?=$price['RATIO_BASE_PRICE']?>" data-action="add_basket"
                                       data-discount="<?=$price['RATIO_PRICE']?>"
                                       id="add_basket_prod<?//=$itemIds['ADD_BASKET_LINK']?>"><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></a>
                                    <?
                                }

                                if ($showBuyBtn)
                                {
                                    ?>
                                    <a href="javascript:void(0);" class="button button_important i-add-to-cart <?=$showButtonClassName?>"
                                       title="В корзину" data-product-id="<?=$arResult['ID']?>" data-text-success="<?=GetMessage('PROD_IN_BASKET')?>"
                                       data-product-id="<?=$arResult['ID']?>" data-price="<?=$price['RATIO_BASE_PRICE']?>" data-discount="<?=$price['RATIO_PRICE']?>"
                                       data-action="add_basket"
                                       id="add_basket_prod<?//=$itemIds['BUY_LINK']?>"><?=$arParams['MESS_BTN_BUY']?></a>
                                    <?
                                }
                                ?>


                                <a href="<?if (LANGUAGE_ID == 'ru'){echo '#form-order';}else{echo '#form-order-en';}?>" class="button i-modal" id="fast-order"
                                   data-ib="<?if (LANGUAGE_ID == 'ru'){echo '4';}else{echo '9';}?>" data-prod="<?=$arResult['ID']?>"
                                   title="Быстрая покупка"><?=GetMessage('FAST_BUY')?></a>
                            </div>
                            <a href="javascript:void(0);" id="add-to-favorite" class="i-add-to-favorite js-favorite-add-remove"
                               data-product-id="<?=$arResult['ID']?>" data-price="<?=$price['RATIO_BASE_PRICE']?>"
                               data-discount="<?=$price['RATIO_PRICE']?>"
                               data-text-success="<?=GetMessage('IN_FAV')?>" data-text-fail="<?=GetMessage('FROM_FAV')?>">&nbsp;</a>
                            <?
                        }
                        ?>

                    <?}?>

				</div>
			</div>

			<?if($arResult['DETAIL_TEXT']):?>
				<div class="block-product__desc">
					<h4><?=GetMessage('DESC')?></h4>
					<p>
						<? if ($arResult['PROPERTIES']['ANLIYSKOE_OPISANIE']['VALUE'] && LANGUAGE_ID == "en") { ?>
							<?=$arResult['PROPERTIES']['ANLIYSKOE_OPISANIE']['VALUE'];?>	
						<? } else { ?>
							<?=$arResult['DETAIL_TEXT'];?>	
						<? } ?>
					</p>
				</div>
			<?endif;?>
<?if($arResult['PROPERTIES']['SOSTAV']['VALUE']):?>
			<div class="block-product__desc block-product__desc_params">
				<h4><?=GetMessage('SOSTAV')?></h4>
				<p>
					<? if ($arResult['PROPERTIES']['SOSTAV_NA_ANGLIYSKOM']['VALUE'] && LANGUAGE_ID == "en") { ?>
						<?=$arResult['PROPERTIES']['SOSTAV_NA_ANGLIYSKOM']['VALUE'];?>
					<? } else { ?>
						<?=$arResult['PROPERTIES']['SOSTAV']['VALUE'];?>
					<? } ?>
				</p>
			</div>
			<?endif;?>
			<?if($arResult['PROPERTIES']['PARAMETRY_MODELI']['VALUE']):?>
			<div class="block-product__desc block-product__desc_params">
				<h4><?=GetMessage('MODEL')?></h4>
				<? if ($arResult['PROPERTIES']['PARAMETRY_MODELI_NA_ANGLIYSKOM']['VALUE'] && LANGUAGE_ID == "en") { ?>
					<p>
						<?
							$two =  mb_substr($arResult['PROPERTIES']['PARAMETRY_MODELI_NA_ANGLIYSKOM']['VALUE'], 22,null,'UTF-8');
							$one =  mb_substr($arResult['PROPERTIES']['PARAMETRY_MODELI_NA_ANGLIYSKOM']['VALUE'], 0, 22,'UTF-8');
							echo $one ; echo '<br>';
							echo $two ;
						?>

					</p>	
				<? } else { ?>
					<p>
						<?
							$two =  mb_substr($arResult['PROPERTIES']['PARAMETRY_MODELI']['VALUE'], 20,null,'UTF-8');
							$one =  mb_substr($arResult['PROPERTIES']['PARAMETRY_MODELI']['VALUE'], 0, 20,'UTF-8');
							echo $one ; echo '<br>';
							echo $two ;
						?>

					</p>				
				<? } ?>
			</div>
			<?endif;?>
			<div class="block-product__share block-product-share i-noselect">
				<div class="block-product-share__header"><?=GetMessage('SHARE')?></div>
	      <div class="block-product-share__buttons">
	        <script async src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/share/es5-shims.min.js"></script>
	        <script async src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/share/share.js"></script>
	        <div class="ya-share2" data-services="whatsapp,telegram,facebook,vkontakte" data-counter=""></div>
	      </div>
			</div>
		</div>
	</div>
</div>
<!-- \Product -->

<div class="block block-info" id="info">
	<div class="block__inner">
		<div class="block-info__inner">
			<div class="block-info__tabs info-tabs slides-menu i-noselect" data-slick=".info-pages">
				<a href="#info-1" class="info-tabs__item slides-menu__item slides-menu__item_active" data-slick=".info-pages"><?=GetMessage("ABOUT_BRAND")?></a> 
				<a href="#info-2" class="info-tabs__item slides-menu__item" data-slick=".info-pages"><?=GetMessage("DELIVERY")?></a>
				<a href="#info-3" class="info-tabs__item slides-menu__item" data-slick=".info-pages"><?=GetMessage("PAYMENT")?></a>
				<a href="#info-4" class="info-tabs__item slides-menu__item" data-slick=".info-pages"><?=GetMessage("RETURNS")?></a>
			</div>
			<div class="block-info__pages info-pages slides" data-slick-slidestoshow="1"
                 data-slick-slidestoscroll="1" data-slick-infinite="false" data-slick-variable-width="false"
                 data-slick-touch-threshold="20" data-slick-fade="true" data-slick-adaptive-height="true" data-slick-disable-on-mobile="true" data-slick-menu=".info-tabs">
				<div class="info-pages__item slides__item info-pages__item_active" id="info-1">
					<h3><?=GetMessage("ABOUT_BRAND")?><span class="info-pages__arrow i-lazy i-mobile" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)">&nbsp;</span></h3>
					<div class="info-pages__content">
						<p>
						
                        <? if (LANGUAGE_ID == 'en'){echo $arResult['BRAND']['TEXT_EN'];}else{
                            if($arResult['BRAND']['TEXT']){
                                echo $arResult['BRAND']['TEXT'];
						}}
                        ?>
                        </p>
                        <?
                        if($arResult['BRAND']['PICTURE']){
                            ?><img alt="Roma Uvarov" class="info-pages__banner i-lazy" data-src="<?=$arResult['BRAND']['PICTURE']?>"><?
                            }
                        ?>

					</div>
				</div>
				<div class="info-pages__item slides__item" id="info-2">
					<h3><?=GetMessage("DELIVERY")?><span class="info-pages__arrow i-lazy i-mobile" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)">&nbsp;</span></h3>
					<div class="info-pages__content">
						<p>
                         							
							<? if (LANGUAGE_ID == 'en'){echo $arResult['TEXTS']['DELIVERY']['TEXT_EN'];}else{
                            if($arResult['TEXTS']['DELIVERY']['TEXT']){
                                echo $arResult['TEXTS']['DELIVERY']['TEXT'];
						}}
                        ?>
                        </p>
                        <?
                        if($arResult['TEXTS']['DELIVERY']['PICTURE']){
                            ?><img alt="<?=GetMessage("DELIVERY")?>" class="info-pages__banner i-lazy" data-src="<?=$arResult['TEXTS']['DELIVERY']['PICTURE']?>"><?
                        }
                        ?>
					</div>
				</div>
				<div class="info-pages__item slides__item" id="info-3">
					<h3><?=GetMessage("PAYMENT")?><span class="info-pages__arrow i-lazy i-mobile" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)">&nbsp;</span></h3>
					<div class="info-pages__content">
						<p>
                         
							<? if (LANGUAGE_ID == 'en'){echo $arResult['TEXTS']['PAYMENT']['TEXT_EN'];}else{
                            if($arResult['TEXTS']['PAYMENT']['TEXT']){
                                echo $arResult['TEXTS']['PAYMENT']['TEXT'];
						}}
                        ?>
                        </p>
                        <?
                        if($arResult['TEXTS']['PAYMENT']['PICTURE']){
                            ?><img alt="<?=GetMessage("PAYMENT")?>" class="info-pages__banner i-lazy" data-src="<?=$arResult['TEXTS']['PAYMENT']['PICTURE']?>"><?
                        }
                        ?>
					</div>
				</div>
				<div class="info-pages__item slides__item" id="info-4">
					<h3><?=GetMessage("RETURNS")?><span class="info-pages__arrow i-lazy i-mobile" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)">&nbsp;</span></h3>
					<div class="info-pages__content">
						<p>
                         
								<? if (LANGUAGE_ID == 'en'){echo $arResult['TEXTS']['RETURN']['TEXT_EN'];}else{
                            if($arResult['TEXTS']['RETURN']['TEXT']){
                                echo $arResult['TEXTS']['RETURN']['TEXT'];
						}}
                        ?>
                        </p>
                        <?
                        if($arResult['TEXTS']['RETURN']['PICTURE']){
                            ?><img alt="<?=GetMessage("RETURNS")?>" class="info-pages__banner i-lazy" data-src="<?=$arResult['TEXTS']['RETURN']['PICTURE']?>"><?
                        }
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- \Info -->

<div class="block block-look" id="look">
	<div class="block__inner">
		<header class="block-look__header header">
			<h2 class="header__title"><?$qq = CIBlockElement::GetByID(931); if($res = $qq->GetNext()){
if (LANGUAGE_ID == 'en'){echo "You might also like";}else{echo html_entity_decode($res['NAME']);}
				}?></h2>
		</header>



					<?
					$ids = [];
					if ($arResult['PROPERTIES']['REKOMENDUEMYY_TOVAR']['VALUE'])
                    {
                        $arts = explode(", ", $arResult['PROPERTIES']['REKOMENDUEMYY_TOVAR']['VALUE']);
                        $ss = 1;
                        foreach ($arts as $art)
                        {
                            $r = CIBlockElement::GetList(
                                array('ID' => 'DESC'),
                                array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', 'PROPERTY_CML2_ARTICLE' => $art),
                                false,
                                array('nTopCount' => 1),
                                array('ID')
                            );
                            while ($e = $r->Fetch())
                            {
                                $ids[] = $e['ID'];
                                $ss++;
                            }
                            if ($ss == 4) break;
                        }

                        $GLOBALS['arFilterDetail'] = ['ID'=>$ids];
                    } else
                    {
                        $r = CIBlockElement::GetList(
                            array('RAND' => 'rand'),
                            array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ACTIVE' => 'Y', '!ID' => $arResult['ID']),
                            false,
                            array('nTopCount' => 3),
                            array('ID')
                        );
                        while ($e = $r->Fetch())
                        {
                            $ids[] = $e['ID'];
                        }
                        $GLOBALS['arFilterDetail'] = ['ID'=>$ids];
                    }

					$APPLICATION->IncludeComponent("ameton:catalog.section",
					"slider",
					array(
                        "SITE_ID" => 's1',
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
						"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
						"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
						"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
						"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
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
						"FILTER_NAME" => 'arFilterDetail',
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
						"PAGE_ELEMENT_COUNT" => 3,
						"LINE_ELEMENT_COUNT" => 3,
						"PRICE_CODE" => $arParams["~PRICE_CODE"],
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

						"DISPLAY_TOP_PAGER" => 'N',
						"DISPLAY_BOTTOM_PAGER" => 'N',
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

						"SECTION_ID" => 0,
						"SECTION_CODE" => '',
						"SHOW_ALL_WO_SECTION" => "Y",
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
				?>


		<div class="block-look__buttons slides-menu i-noselect i-mobile" data-slick=".block-look__items">
			<div class="slides-menu__item slides-menu__item_active" data-slick=".block-look__items"></div>
			<div class="slides-menu__item" data-slick=".block-look__items"></div>
		</div>
	</div>
</div>




			<?/*<div style="display: none;" class="product-item-detail-pay-block">
							<?
							foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName)
							{
								switch ($blockName)
								{
									case 'rating':
										if ($arParams['USE_VOTE_RATING'] === 'Y')
										{
											?>
											<div class="product-item-detail-info-container">
												<?
												$APPLICATION->IncludeComponent(
													'bitrix:iblock.vote',
													'stars',
													array(
														'CUSTOM_SITE_ID' => isset($arParams['CUSTOM_SITE_ID']) ? $arParams['CUSTOM_SITE_ID'] : null,
														'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
														'IBLOCK_ID' => $arParams['IBLOCK_ID'],
														'ELEMENT_ID' => $arResult['ID'],
														'ELEMENT_CODE' => '',
														'MAX_VOTE' => '5',
														'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
														'SET_STATUS_404' => 'N',
														'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
														'CACHE_TYPE' => $arParams['CACHE_TYPE'],
														'CACHE_TIME' => $arParams['CACHE_TIME']
													),
													$component,
													array('HIDE_ICONS' => 'Y')
												);
												?>
											</div>
											<?
										}

										break;

									case 'price':
										?>

										<?
										break;

									case 'priceRanges':
										if ($arParams['USE_PRICE_COUNT'])
										{
											$showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
											$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
											?>
											<div class="product-item-detail-info-container"
												<?=$showRanges ? '' : 'style="display: none;"'?>
												data-entity="price-ranges-block">
												<div class="product-item-detail-info-container-title">
													<?=$arParams['MESS_PRICE_RANGES_TITLE']?>
													<span data-entity="price-ranges-ratio-header">
														(<?=(Loc::getMessage(
															'CT_BCE_CATALOG_RATIO_PRICE',
															array('#RATIO#' => ($useRatio ? $measureRatio : '1').' '.$actualItem['ITEM_MEASURE']['TITLE'])
														))?>)
													</span>
												</div>
												<dl class="product-item-detail-properties" data-entity="price-ranges-body">
													<?
													if ($showRanges)
													{
														foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range)
														{
															if ($range['HASH'] !== 'ZERO-INF')
															{
																$itemPrice = false;

																foreach ($arResult['ITEM_PRICES'] as $itemPrice)
																{
																	if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
																	{
																		break;
																	}
																}

																if ($itemPrice)
																{
																	?>
																	<dt>
																		<?
																		echo Loc::getMessage(
																				'CT_BCE_CATALOG_RANGE_FROM',
																				array('#FROM#' => $range['SORT_FROM'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																			).' ';

																		if (is_infinite($range['SORT_TO']))
																		{
																			echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
																		}
																		else
																		{
																			echo Loc::getMessage(
																				'CT_BCE_CATALOG_RANGE_TO',
																				array('#TO#' => $range['SORT_TO'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																			);
																		}
																		?>
																	</dt>
																	<dd><?=($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE'])?></dd>
																	<?
																}
															}
														}
													}
													?>
												</dl>
											</div>
											<?
											unset($showRanges, $useRatio, $itemPrice, $range);
										}

										break;

									case 'quantityLimit':
										if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
										{
											if ($haveOffers)
											{
												?>
												<div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>" style="display: none;">
													<div class="product-item-detail-info-container-title">
														<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
														<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
													</div>
												</div>
												<?
											}
											else
											{
												if (
													$measureRatio
													&& (float)$actualItem['PRODUCT']['QUANTITY'] > 0
													&& $actualItem['CHECK_QUANTITY']
												)
												{
													?>
													<div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>">
														<div class="product-item-detail-info-container-title">
															<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
															<span class="product-item-quantity" data-entity="quantity-limit-value">
																<?
																if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
																{
																	if ((float)$actualItem['PRODUCT']['QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
																	{
																		echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
																	}
																	else
																	{
																		echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
																	}
																}
																else
																{
																	echo $actualItem['PRODUCT']['QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
																}
																?>
															</span>
														</div>
													</div>
													<?
												}
											}
										}

										break;

									case 'quantity':
										if ($arParams['USE_PRODUCT_QUANTITY'])
										{
											?>
											<div class="product-item-detail-info-container" style="<?=(!$actualItem['CAN_BUY'] ? 'display: none;' : '')?>"
												data-entity="quantity-block">
												<div class="product-item-detail-info-container-title"><?=Loc::getMessage('CATALOG_QUANTITY')?></div>
												<div class="product-item-amount">
													<div class="product-item-amount-field-container">
														<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN_ID']?>"></span>
														<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY_ID']?>" type="number"
															value="<?=$price['MIN_QUANTITY']?>">
														<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP_ID']?>"></span>
														<span class="product-item-amount-description-container">
															<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
																<?=$actualItem['ITEM_MEASURE']['TITLE']?>
															</span>
															<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
														</span>
													</div>
												</div>
											</div>
											<?
										}

										break;

									case 'buttons':
										?>
										<div data-entity="main-button-container">

											<?
											if ($showSubscribe)
											{
												?>
												<div class="product-item-detail-info-container">
													<?
													$APPLICATION->IncludeComponent(
														'bitrix:catalog.product.subscribe',
														'',
														array(
															'CUSTOM_SITE_ID' => isset($arParams['CUSTOM_SITE_ID']) ? $arParams['CUSTOM_SITE_ID'] : null,
															'PRODUCT_ID' => $arResult['ID'],
															'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
															'BUTTON_CLASS' => 'btn btn-default product-item-detail-buy-button',
															'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
															'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
														),
														$component,
														array('HIDE_ICONS' => 'Y')
													);
													?>
												</div>
												<?
											}
											?>
											<div class="product-item-detail-info-container">
												<a class="btn btn-link product-item-detail-buy-button" id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
													href="javascript:void(0)"
													rel="nofollow" style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;">
													<?=$arParams['MESS_NOT_AVAILABLE']?>
												</a>
											</div>
										</div>
										<?
										break;
								}
							}

							if ($arParams['DISPLAY_COMPARE'])
							{
								?>
								<div class="product-item-detail-compare-container">
									<div class="product-item-detail-compare">
										<div class="checkbox">
											<label id="<?=$itemIds['COMPARE_LINK']?>">
												<input type="checkbox" data-entity="compare-checkbox">
												<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
											</label>
										</div>
									</div>
								</div>
								<?
							}
							?>
			</div>*/?>




<?//ЭТО НУЖНО ДЛЯ РАБОТЫ! НЕ УДАЛЯТЬ!?>
<div style="display: none;" class="bx-catalog-element bx-<?=$arParams['TEMPLATE_THEME']?>" id="<?=$itemIds['ID']?>" itemscope itemtype="http://schema.org/Product">
	<?/*<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="product-item-detail-slider-container" id="<?=$itemIds['BIG_SLIDER_ID']?>">
					<span class="product-item-detail-slider-close" data-entity="close-popup"></span>
					<div class="product-item-detail-slider-block
						<?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?>"
						data-entity="images-slider-block">
						<span class="product-item-detail-slider-left" data-entity="slider-control-left" style="display: none;"></span>
						<span class="product-item-detail-slider-right" data-entity="slider-control-right" style="display: none;"></span>
						<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>"
							<?=(!$arResult['LABEL'] ? 'style="display: none;"' : '' )?>>
							<?
							if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
							{
								foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
								{
									?>
									<div<?=(!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
										<span title="<?=$value?>"><?=$value?></span>
									</div>
									<?
								}
							}
							?>
						</div>
						<?
						if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
						{
							if ($haveOffers)
							{
								?>
								<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
									style="display: none;">
								</div>
								<?
							}
							else
							{
								if ($price['DISCOUNT'] > 0)
								{
									?>
									<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
										title="<?=-$price['PERCENT']?>%">
										<span><?=-$price['PERCENT']?>%</span>
									</div>
									<?
								}
							}
						}
						?>
						<div class="product-item-detail-slider-images-container" data-entity="images-container">
							<?
							if (!empty($actualItem['MORE_PHOTO']))
							{
								foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
								{
									?>
									<div class="product-item-detail-slider-image<?=($key == 0 ? ' active' : '')?>" data-entity="image" data-id="<?=$photo['ID']?>">
										<img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>"<?=($key == 0 ? ' itemprop="image"' : '')?>>
									</div>
									<?
								}
							}

							if ($arParams['SLIDER_PROGRESS'] === 'Y')
							{
								?>
								<div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
								<?
							}
							?>
						</div>
					</div>
					<?
					if ($showSliderControls)
					{
						if ($haveOffers)
						{
							foreach ($arResult['OFFERS'] as $keyOffer => $offer)
							{
								if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
									continue;

								$strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
								?>
								<div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>" style="display: <?=$strVisible?>;">
									<?
									foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo)
									{
										?>
										<div class="product-item-detail-slider-controls-image<?=($keyPhoto == 0 ? ' active' : '')?>"
											data-entity="slider-control" data-value="<?=$offer['ID'].'_'.$photo['ID']?>">
											<img src="<?=$photo['SRC']?>">
										</div>
										<?
									}
									?>
								</div>
								<?
							}
						}
						else
						{
							?>
							<div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_ID']?>">
								<?
								if (!empty($actualItem['MORE_PHOTO']))
								{
									foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
									{
										?>
										<div class="product-item-detail-slider-controls-image<?=($key == 0 ? ' active' : '')?>"
											data-entity="slider-control" data-value="<?=$photo['ID']?>">
											<img src="<?=$photo['SRC']?>">
										</div>
										<?
									}
								}
								?>
							</div>
							<?
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!--Small Card-->
	<?/*<div class="product-item-detail-short-card-fixed hidden-xs" id="<?=$itemIds['SMALL_CARD_PANEL_ID']?>">
		<div class="product-item-detail-short-card-content-container">
			<table>
				<tr>
					<td rowspan="2" class="product-item-detail-short-card-image">
						<img src="" style="height: 65px;" data-entity="panel-picture">
					</td>
					<td class="product-item-detail-short-title-container" data-entity="panel-title">
						<span class="product-item-detail-short-title-text"><?=$name?></span>
					</td>
					<td rowspan="2" class="product-item-detail-short-card-price">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<div class="product-item-detail-price-old" style="display: <?=($showDiscount ? '' : 'none')?>;"
								data-entity="panel-old-price">
								<?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?>
							</div>
							<?
						}
						?>
						<div class="product-item-detail-price-current" data-entity="panel-price">
							<?=$price['PRINT_RATIO_PRICE']?>
						</div>
					</td>
					<?
					if ($showAddBtn)
					{
						?>
						<td rowspan="2" class="product-item-detail-short-card-btn"
							style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
							data-entity="panel-add-button">
							<a class="btn <?=$showButtonClassName?> product-item-detail-buy-button"
								id="<?=$itemIds['ADD_BASKET_LINK']?>"
								href="javascript:void(0);">
								<span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
							</a>
						</td>
						<?
					}

					if ($showBuyBtn)
					{
						?>
						<td rowspan="2" class="product-item-detail-short-card-btn"
							style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
							data-entity="panel-buy-button">
							<a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button" id="<?=$itemIds['BUY_LINK']?>"
								href="javascript:void(0);">
								<span><?=$arParams['MESS_BTN_BUY']?></span>
							</a>
						</td>
						<?
					}
					?>
					<td rowspan="2" class="product-item-detail-short-card-btn"
						style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;"
						data-entity="panel-not-available-button">
						<a class="btn btn-link product-item-detail-buy-button" href="javascript:void(0)"
							rel="nofollow">
							<?=$arParams['MESS_NOT_AVAILABLE']?>
						</a>
					</td>
				</tr>
				<?
				if ($haveOffers)
				{
					?>
					<tr>
						<td>
							<div class="product-item-selected-scu-container" data-entity="panel-sku-container">
								<?
								$i = 0;

								foreach ($arResult['SKU_PROPS'] as $skuProperty)
								{
									if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
									{
										continue;
									}

									$propertyId = $skuProperty['ID'];

									foreach ($skuProperty['VALUES'] as $value)
									{
										$value['NAME'] = htmlspecialcharsbx($value['NAME']);
										if ($skuProperty['SHOW_MODE'] === 'PICT')
										{
											?>
											<div class="product-item-selected-scu product-item-selected-scu-color selected"
												title="<?=$value['NAME']?>"
												style="background-image: url('<?=$value['PICT']['SRC']?>'); display: none;"
												data-sku-line="<?=$i?>"
												data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
												data-onevalue="<?=$value['ID']?>">
											</div>
											<?
										}
										else
										{
											?>
											<div class="product-item-selected-scu product-item-selected-scu-text selected"
												title="<?=$value['NAME']?>"
												style="display: none;"
												data-sku-line="<?=$i?>"
												data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
												data-onevalue="<?=$value['ID']?>">
												<?=$value['NAME']?>
											</div>
											<?
										}
									}

									$i++;
								}
								?>
							</div>
						</td>
					</tr>
					<?
				}
				?>
			</table>
		</div>
	</div>*/?>


	<!--Top tabs-->
	<?/*<div class="product-item-detail-tabs-container-fixed hidden-xs" id="<?=$itemIds['TABS_PANEL_ID']?>">
		<ul class="product-item-detail-tabs-list">
			<?
			if ($showDescription)
			{
				?>
				<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
					</a>
				</li>
				<?
			}

			if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
					</a>
				</li>
				<?
			}

			if ($arParams['USE_COMMENTS'] === 'Y')
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
					</a>
				</li>
				<?
			}
			?>
		</ul>
	</div>*/?>

	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="description" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<?
	if ($haveOffers)
	{
		foreach ($arResult['JS_OFFERS'] as $offer)
		{
			$currentOffersList = array();

			if (!empty($offer['TREE']) && is_array($offer['TREE']))
			{
				foreach ($offer['TREE'] as $propName => $skuId)
				{
					$propId = (int)mb_substr($propName, 5,null,'UTF-8');

					foreach ($skuProps as $prop)
					{
						if ($prop['ID'] == $propId)
						{
							foreach ($prop['VALUES'] as $propId => $propValue)
							{
								if ($propId == $skuId)
								{
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
				<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
				<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
			<?
		}

		unset($offerPrice, $currentOffersList);
	}
	else
	{
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
		<?
	}
	?>
</div>
<?
if ($haveOffers)
{
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
	{
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($jsOffer['DISPLAY_PROPERTIES']))
			{
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
				{
					$current = '<dt>'.$property['NAME'].'</dt><dd>'.(
						is_array($property['VALUE'])
							? implode(' / ', $property['VALUE'])
							: $property['VALUE']
						).'</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
					{
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
		{
			$strPriceRangesRatio = '('.Loc::getMessage(
					'CT_BCE_CATALOG_RATIO_PRICE',
					array('#RATIO#' => ($useRatio
							? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
							: '1'
						).' '.$measureName)
				).')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
			{
				if ($range['HASH'] !== 'ZERO-INF')
				{
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
					{
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
						{
							break;
						}
					}

					if ($itemPrice)
					{
						$strPriceRanges .= '<dt>'.Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_FROM',
								array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
							).' ';

						if (is_infinite($range['SORT_TO']))
						{
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						}
						else
						{
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'].' '.$measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
	{
		?>
		<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
			<?
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
				{
					?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
					<?
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
				?>
				<table>
					<?
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
					{
						?>
						<tr>
							<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
							<td>
								<?
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								)
								{
									foreach ($propInfo['VALUES'] as $valueId => $value)
									{
										?>
										<label>
											<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
												value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"checked"' : '')?>>
											<?=$value?>
										</label>
										<br>
										<?
									}
								}
								else
								{
									?>
									<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
										<?
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"selected"' : '')?>>
												<?=$value?>
											</option>
											<?
										}
										?>
									</select>
									<?
								}
								?>
							</td>
						</tr>
						<?
					}
					?>
				</table>
				<?
			}
			?>
		</div>
		<?
	}

	unset($emptyProductProperties);
}
?>



<?
unset($actualItem, $itemIds, $jsParams);
