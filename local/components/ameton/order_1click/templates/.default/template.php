<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="basket_order_form">
    <form class="modal__content js-order-form" method="POST" data-type="fast">
        <?=bitrix_sessid_post()?>
        <input type="hidden" name="order" value="Y" />
        <input type="hidden" name="skuID" value="<?=$arResult['skuID']?>" />
        <div class="modal__content-inner">
            <h2 class="modal__header">
                <?=GetMessage('TITLE')?>
            </h2>
            <div class="modal__main">
                <div class="form__fields">
                    <div class="form__input form__input_person form__input_required js-order-form-field-container" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/person.svg');">
                        <input type="text" id="fid-name" name="NAME" value="" class="js-order-form-field" placeholder="<?=GetMessage('INPUT_TITLE_NAME')?>" autocomplete="off">
                    </div>
                    <div class="form__input form__input_phone form__input_required form__input_required_email js-order-form-field-container" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/email.svg' );">
                        <input type="email" id="fid-email" name="EMAIL" value="" class="js-order-form-field" placeholder="<?=GetMessage('INPUT_TITLE_EMAIL')?>" autocomplete="off">
                    </div>

                    <div class="form__input form__input_phone form__input_required form__input_required_phone js-order-form-field-container" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/phone.svg');">
                        <input type="tel" id="fid-phone" name="PHONE" value="" class="js-order-form-field" placeholder="<?=GetMessage('INPUT_TITLE_PHONE')?>" autocomplete="off">
                    </div>
                    <select class="form__select form__input_required selectbox js-order-form-delivery js-order-form-select"
                        name="delivery" id="delivery"
                        data-placeholder="<?=GetMessage('INPUT_TITLE_DELIVERY')?>"
                    >
                         <?
                        foreach ($arResult["DELIVERIES"] as $item)
                        {
                            ?>
                            <option value="<?=$item['NAME']?>"
                                data-dadata-type="<?=$item['DADATA_TYPE']?>"
                                data-need-address="<?=$item['NEED_ADDRESS']?>"
                                data-val="<?=$item['PRICE']?>"
                                data-val-cur="<?=round(CCurrencyRates::ConvertCurrency($item['PRICE'], "RUB", $_SESSION['CURRENCY_CURRENT']),2)?>"
                            >
                                <?=$item['NAME']?>
                            </option>
                            <?
                        }
                        ?>
                    </select>
                    <div class="form__input form__input_addr form__input_required js-order-form-field-container js-order-form-group-address" style="display:none;background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/addr.svg')">
                        <textarea id="fid-nobadr" name="NOBADR" class="js-order-form-field" value="<?=$elFields["VALUE"]?>" autocomplete="off" placeholder="<?=GetMessage('INPUT_TITLE_ADDR')?>"></textarea>
                    </div>
                    <div class="form__input form__input_person js-order-form-field-container js-order-form-group-address" style="display:none;background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/flat.svg?v=5')">
                        <input type="text" id="fid-flat" name="FLAT" value="" class="js-order-form-field" placeholder="<?=GetMessage('FLAT')?>" autocomplete="off">
                    </div>
                    <div class="form__input form__input_addr js-order-form-field-container" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/message.svg')">
                        <textarea id="fid-comment" name="COMMENT" maxlength="1000" class="js-order-form-field" value="" placeholder="<?=GetMessage('COMMENT')?>"></textarea>
                    </div>
                    <div style="font-size:14px">
                        <input type="hidden" id="fid-nobadr-full" name="NOBADR_FULL" value="" placeholder="Полный aдрес выбран" style="width:100%" />
                        <input type="hidden" id="fid-nobzp" name="NOBZP" value="" placeholder="Индeкс" style="width:100%" />
                        <input type="hidden" id="fid-nobcntry" name="NOBCNTRY" value="" placeholder="Стрaна" style="width:100%" />
                        <input type="hidden" id="fid-nobrgion" name="NOBRGION" value="" placeholder="Рeгион" style="width:100%" />
                        <input type="hidden" id="fid-nobarea" name="NOBAREA" value="" placeholder="Рaйон" style="width:100%" />
                        <input type="hidden" id="fid-nobcty" name="NOBCTY" value="" placeholder="Гoрoд" style="width:100%" />
                        <input type="hidden" id="fid-nobsettlement" name="NOBSETTLEMENT" value="" placeholder="Пoселение" style="width:100%" />
                        <input type="hidden" id="fid-nobstrt" name="NOBSTRT" value="" placeholder="Улицa" style="width:100%" />
                        <input type="hidden" id="fid-nobhse" name="NOBHSE" value="" placeholder="Дoм" style="width:100%" />
                        <input type="hidden" id="fid-nobblock" name="NOBBLOCK" value="" placeholder="Кoрпус/стрoение" style="width:100%" />
                    </div>
                </div>

                <div class="form__submit">
                    <input type="submit" class="button button_important" name="submit" value="<?=GetMessage('MAKE_ORDER')?>">
                </div>

                <?
                if ($arResult['IS_CURRENCY_CONVERTED'])
                {
                    ?>
                    <div class="form-confidence" style="margin-bottom:10px">
                        <div class="form-confidence__checkbox i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/confidence.svg)"></div>
                        <div class="form-confidence__text">
                            <?=GetMessage('CONVERT_LABEL')?>
                        </div>
                    </div>
                    <?
                }
                ?>
                <div class="form-confidence">
                    <div class="form-confidence__checkbox" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/confidence.svg');"></div>
                    <div class="form-confidence__text">
                        <?=GetMessage('POLICY_LABEL')?>.
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="form-order__product">
    <div class="cart-order-list">
        <div class="cart-order-list__inner">
            <?
            $item=$arResult["ITEMS"][0];
            $arDataPrint=[];
            if ($item['SIZE'])
            {
                $arDataPrint[]=GetMessage('SIZE').': '.$item['SIZE'];
            }
            if ($item['COLOR'])
            {
                $arDataPrint[]=GetMessage('COLOR').': '.$item['COLOR'];
            }
            ?>
            <div class="product">
                <div class="product__images">
                    <div class="product__image product__image_main i-lazy" data-bg="url('<?=$item['IMG']?>')"
                         data-bg-mobile="url('<?=$item['IMG']?>')"></div>
                    <div class="product__image <?/*product__image_second*/?> i-lazy" data-bg="url('<?=$item['IMG']?>')"
                         data-bg-mobile="url('<?=$item['IMG']?>')"></div>
                </div>
                <div class="product__content" id="product_card_one_click">
                    <h3 class="product__brand"><?=$props['BRAND']?></h3>
                    <h4 class="product__title">
                        <?=$item['NAME']?>
                        <?
                        if (!empty($arDataPrint))
                        {
                            echo "<br>".join('<br>',$arDataPrint);
                        }
                        ?>
                    </h4>
                    <div class="product__price-wrapper
                        <?
                        if ($item['SRC_PRICE_BASE'] > $item['SRC_PRICE']){?>has-old<?}
                        if($props['PREDZAKAZ']){?> has-preorder<?}?>"
                    >
                        <?
                        if ($item['SRC_PRICE_BASE'] > $item['SRC_PRICE'])
                        {
                            ?>
                            <div class="product__old-price"><?=$item['SRC_TOTAL_PRICE_BASE_PRINT']?></div>
                            <div class="product__price"><?=$item['SRC_TOTAL_PRICE_PRINT']?></div>
                            <?
                        } else
                        {
                            ?>
                            <div class="product__price"><?=$item['SRC_TOTAL_PRICE_PRINT']?></div>
                            <?
                        }

                        if ($props['PREDZAKAZ'])
                        {
                            ?>
                            <div class="product__preorder">
                                <?=GetMessage('PREORDER')?>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                    <?
                    if ($arResult['IS_CURRENCY_CONVERTED'])
                    {
                        ?>
                        <div class="product__price-wrapper
                            <?
                            if ($item['SRC_PRICE_BASE'] > $item['SRC_PRICE']){?>has-old<?}
                            if($props['PREDZAKAZ']){?> has-preorder<?}?>"
                        >
                            (<?
                            if ($item['SRC_PRICE_BASE'] > $item['SRC_PRICE'])
                            {
                                ?>
                                <div class="product__old-price"><?=$item['TOTAL_PRICE_BASE_PRINT']?></div>
                                <div class="product__price"><?=$item['TOTAL_PRICE_PRINT']?></div>
                                <?
                            } else
                            {
                                ?>
                                <div class="product__price"><?=$item['TOTAL_PRICE_PRINT']?></div>
                                <?
                            }
                            ?>)
                            <?
                            if ($props['PREDZAKAZ'])
                            {
                                ?>
                                <div class="product__preorder">
                                    <?=GetMessage('PREORDER')?>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                        <?
                    }
                    ?>
                </div>
                <a href="<?=$item['URL']?>" class="product__link" title="<?=$item['NAME']?>"></a>
            </div>
        </div>
        <div class="cart-order__total i-pc">
            <div class="cart-order__total-inner">
                <?
                if (!$arResult['SRC_TOTAL_BASKET_PRICE']) $arResult['SRC_TOTAL_BASKET_PRICE']=0;
                if (!$arResult['TOTAL_BASKET_PRICE']) $arResult['TOTAL_BASKET_PRICE']=0;
                ?>
                <?=GetMessage('TOTAL')?>: &nbsp;&nbsp;<strong class="js-order-form-total-price" data-base-summ="<?=$arResult['SRC_TOTAL_BASKET_PRICE']?>"><?=$arResult["SRC_ORDER_PRICE_PRINT"]?></strong>
                <?
                if ($arResult['IS_CURRENCY_CONVERTED'])
                {
                    ?>
                    (<strong class="js-order-form-total-price-cur" data-cur="<?=$_SESSION['CURRENCY_CURRENT']?>" data-base-summ="<?=$arResult['TOTAL_BASKET_PRICE']?>"><?=$arResult["ORDER_PRICE_PRINT"]?></strong>)
                    <?
                }
                ?>
            </div>
        </div>
    </div>
</div>