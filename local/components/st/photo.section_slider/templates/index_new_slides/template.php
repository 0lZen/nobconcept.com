<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="block-new__slides slides" data-slick-slidestoshow="3" data-slick-mobile-slidestoshow="1" data-slick-mobile-slidestoscroll="1" data-slick-slidestoscroll="3" data-slick-infinite="true" data-slick-touch-threshold="20" data-slick-variable-width="true" data-slick-disable-on-mobile="false" data-slick-mobile-fade="false" data-slick-menu=".block-new__slides-menu" data-slick-autoplay="<?=($arResult["SECTION_USER_FIELDS"]["UF_AUTOPLAY"] ? 'true' : 'false')?>" data-slick-autoplayspeed="<?=$arResult["SECTION_USER_FIELDS"]["UF_SLIDER_DELAY"]?>" data-slick-controls=".block-new__slides-controls">

<?
foreach($arResult["ITEMS"] as $k => $arItem)
{
    $price=$arItem['PROPERTIES']['DISCOUNT_PRICE']['VALUE'];
    $priceBase=$arItem['PROPERTIES']['BASE_PRICE']['VALUE'];

    if (in_array($arParams['CURRENCY'],['EUR','USD']))
    {
        $price=round(CCurrencyRates::ConvertCurrency($price, "RUB", $arParams['CURRENCY']),2);
        $priceBase=round(CCurrencyRates::ConvertCurrency($priceBase, "RUB", $arParams['CURRENCY']),2);
    }

    $pricePrint=CurrencyFormat($price, $arParams['CURRENCY']);
    $priceBasePrint=CurrencyFormat($priceBase, $arParams['CURRENCY']);

    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="slides__item new-slide">
        <a href="<?=$arItem['FIELDS']['DETAIL_PAGE_URL']?>">
            <img alt="<?=strip_tags($arItem['PROPERTIES']['TITLE_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT'])?>" class="new-slide__image i-lazy" data-src="<?=$arItem['PREVIEW_PC']['src']?>" data-src-mobile="<?=$arItem['PREVIEW_MOBILE']['src']?>">

            <div class="product__content">
                <h3 class="product__brand"><?=$arItem['PROPERTIES']['BREND']['VALUE']?></h3>
        		<h4 class="product__title">
        		    <?
                    if (LANGUAGE_ID =='en' && $arItem['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE'])
                    {
                        ?><?=$arItem['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE']?><?
                    } else
                    {
                        ?><?=$arItem['FIELDS']['NAME']?><?
                    }
                    ?>
                </h4>
        		<div class="product__price-wrapper <?if ($priceBase > $price){?>has-old<?}
            		if ($arItem['PROPERTIES']['PREDZAKAZ']['VALUE']){?> has-preorder<?}?><?
            		if ($price <= 0){?> has-sold<?}?>"
                    >
                    <?
                    if ($priceBase > $price)
                    {
                        ?>
                        <div class="product__old-price">
                            <? echo $priceBasePrint;?>
                        </div>
                        <?
                    }
                    if ($price > 0)
                    {
                        ?>
                        <div class="product__price">
                            <?
                            echo $pricePrint;
                            ?>
                        </div>
                        <?
                    }
                    if($price <= 0 && $arItem['PROPERTIES']['SOLDOUT']['VALUE'])
                    {
                        ?>
                        <div class="product__preorder"><?if (LANGUAGE_ID =='en'){echo 'Sold out';}else{ echo 'Распродано';}?></div>
                        <?
                    }
                    if ($arItem['PROPERTIES']['PREDZAKAZ']['VALUE'])
                    {
                        ?>
                        <div class="product__preorder"><?if (LANGUAGE_ID =='en'){echo 'Pre-order';}else{ echo 'Предзаказ';}?></div>
                        <?
                    }
                    ?>
        		</div>
            </div>
        </a>
    </div>

    <?}?>

</div>

<?if ($arResult['TOTAL'] > 1) {?>
    <div class="block-new__slides-controls slides-controls i-noselect" data-slick=".block-new__slides">
        <div class="slides-controls__item slides-controls__item_left arrow" data-slick=".block-new__slides"></div>
        <div class="slides-controls__item slides-controls__item_right arrow" data-slick=".block-new__slides"></div>
    </div>

    <div class="block-new__slides-menu slides-menu i-noselect i-mobile" data-slick=".block-new__slides">
        <?for ($i = 1; $i <= $arResult['TOTAL']; $i++) {?>
            <div class="slides-menu__item <?=($i == 1 ? 'slides-menu__item_active' : '')?>" data-slick=".block-new__slides"></div>
        <?}?>
    </div>
<?}?>