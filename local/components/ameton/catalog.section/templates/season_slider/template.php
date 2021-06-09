<? 
    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<div class="nb21-season-slider-wrp">
    <div class="">
        <div class="nb21-season-slider-wrp__title">
            Лето
        </div>
        <div class="nb21-season-slider">
            <div class="nb21-season-slider__row js-nob21-season-slider">

                <? 
                    foreach ($arResult['ITEMS'] as $key => $arItem) { 

                    $img = false;
                    if ($arItem['PREVIEW_PICTURE']['ID']) {
                        $img = smart_resize_ameton($arItem['PREVIEW_PICTURE']['ID'],250,250,JPEG_QUALITY,false,false,true);    
                    }

                    $price=$arItem['PROPERTIES']['DISCOUNT_PRICE']['VALUE'];
                    $priceBase=$arItem['PROPERTIES']['BASE_PRICE']['VALUE'];

                    if (in_array($arParams['CURRENCY'],['EUR','USD']))
                    {
                        $price=round(CCurrencyRates::ConvertCurrency($price, "RUB", $arParams['CURRENCY']),2);
                        $priceBase=round(CCurrencyRates::ConvertCurrency($priceBase, "RUB", $arParams['CURRENCY']),2);
                    }

                    $pricePrint=CurrencyFormat($price, $arParams['CURRENCY']);
                    $priceBasePrint=CurrencyFormat($priceBase, $arParams['CURRENCY']);

                ?>
                
                <?// for ($i=1;$i<=20;$i++) { ?>
                    <div class="nb21-season-slider__col">
                        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="nb21-season-slider__item">
                            <div class="nb21-season-slider__item-img-wrp">
                                <? if ($img) { ?>
                                    <img src="<?=$img;?>" alt="" class="nb21-season-slider__item-img">
                                <? } ?>
                            </div>
                            <? if ($arItem['PROPERTIES']['BREND']['VALUE']) { ?>
                                <div class="nb21-season-slider__item-brand">
                                    <?=$arItem['PROPERTIES']['BREND']['VALUE'];?>
                                </div>
                            <? } ?>
                            <div class="nb21-season-slider__item-title">
                                <?
                                    if (LANGUAGE_ID =='en' && $arItem['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE'])
                                    {
                                        ?><?=$arItem['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE']?><?
                                    } else
                                    {
                                        ?><?=$arItem['NAME']?><?
                                    }
                                ?>
                            </div>
                            <div class="nb21-season-slider__item-price-wrp <?if ($priceBase > $price){?>has-old<?}
                                if ($arItem['PROPERTIES']['PREDZAKAZ']['VALUE']){?> has-preorder<?}?><?
                                if ($price <= 0){?> has-sold<?}?>"
                                >
                                <?
                                if ($priceBase > $price)
                                {
                                    ?>
                                    <span class="nb21-season-slider__item-price _old">
                                        <? echo $priceBasePrint;?>
                                    </span>
                                    <?
                                }
                                if ($price > 0)
                                {
                                    ?>
                                    <span class="nb21-season-slider__item-price">
                                        <?
                                        echo $pricePrint;
                                        ?>
                                    </span>
                                    <?
                                }
                                if($price <= 0 && $arItem['PROPERTIES']['SOLDOUT']['VALUE'])
                                {
                                    ?>
                                    <span class="nb21-season-slider__item-price"><?if (LANGUAGE_ID =='en'){echo 'Sold out';}else{ echo 'Распродано';}?></span>
                                    <?
                                }
                                if ($arItem['PROPERTIES']['PREDZAKAZ']['VALUE'])
                                {
                                    ?>
                                    <span class="nb21-season-slider__item-price"><?if (LANGUAGE_ID =='en'){echo 'Pre-order';}else{ echo 'Предзаказ';}?></span>
                                    <?
                                }
                                ?>
                            </div>

                        </a>
                    </div>
                    <? } ?>                
                <?// } ?>

            </div>
        </div>

    </div>    
</div>