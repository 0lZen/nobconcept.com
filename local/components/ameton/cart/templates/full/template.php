<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!$arResult['IS_REFRESH']):
?>
<div class="modal__outer">
    <div class="modal__content">
        <h2 class="modal__header">
           <?=GetMessage('CART')?>
        </h2>
        <div class="cart-main js-cart-content">
            <?endif;?>
            <div class="cart-end__side cart-end__side_left i-mobile">
                <?
                if (!empty($arResult["ITEMS"]))
                {
                    ?>
                    <a href="javascript:void(0)" class="i-clear-cart" title="<?=GetMessage('CLEAR_CART')?>"><?=GetMessage('CLEAR_CART')?></a>
                    <?
                }
                ?>
            </div>

            <div class="cart-scheme">
                <div class="cart-scheme__row cart-scheme__row_header">
                    <div class="cart-scheme__cell">&nbsp;</div>
                    <div class="cart-scheme__cell"><div class="cart-scheme__label"><?=GetMessage('PRODUCT')?></div></div>
                    <div class="cart-scheme__cell"><div class="cart-scheme__label"><?=GetMessage('SIZE')?></div></div>
                    <div class="cart-scheme__cell"><div class="cart-scheme__label"><?=GetMessage('COST')?></div></div>
                    <div class="cart-scheme__cell" style="width:100px"><div class="cart-scheme__label"><?=GetMessage('QUANTITY_SHORT')?></div></div>
                    <div class="cart-scheme__cell"><div class="cart-scheme__label"><?=GetMessage('SUBTOTAL')?></div></div>
                    <div class="cart-scheme__cell">&nbsp;</div>
                </div>

                <?
                foreach ($arResult["ITEMS"] as $item)
                {
                    $mobProps=[];
                    if ($item['SIZE'])
                    {
                        $mobProps[]=GetMessage('SIZE').': '.$item['SIZE'];
                    }
                    if ($item['COLOR'])
                    {
                        $mobProps[]=$item['COLOR'];
                    }
                    ?>
                    <div class="cart-scheme__row">
                        <div class="cart-scheme__cell cart-scheme__cell_photo">
                            <img alt="<?=$item['NAME']?>" class="cart-scheme__preview" src="<?=$item['IMG']?>" data-src="<?=$item['IMG']?>" data-src-mobile="<?=$item['IMG']?>">
                        </div>

                        <div class="cart-scheme__cell cart-scheme__cell_info">
                            <div class="cart-product__content">
                                <h3 class="cart-product__brand"><?=$item['BRAND']?></h3>
                                <h4 class="cart-product__title">
                                    <?=$item['NAME']?>
                                    <div class="i-mobile" style="font-size:14px">
                                        <?=$item['PRICE_PRINT']?>&nbsp;/&nbsp;1&nbsp;<?=GetMessage('PCS')?>
                                    </div>
                                </h4>

                                <div class="cart-product__color i-pc"><?=$item['COLOR']?></div>
                                <div class="cart-product__color i-mobile">
                                    <?=join(', ',$mobProps)?>
                                    <div>
                                        <?
                                        if ($item["MAX_CNT"]>0)
                                        {
                                            ?>
                                            <div class="cart__quantity js-quantity">
                                                <a href="javascript:void(0)" class="cart__quantity-btn _dec js-cart-quantity-dec<?if($item["QUANTITY"]==1){?> _disabled<?}?>"></a>
                                                <input type="text" class="cart__quantity-input js-cart-quantity-input"
                                                    data-row-id="<?=$item['CART_ID']?>"
                                                    data-max="<?=$item["MAX_CNT"]?>"
                                                    value="<?=$item["QUANTITY"]?>"
                                                    data-old-value="<?=$item["QUANTITY"]?>"
                                                >
                                                <a href="javascript:void(0)" class="cart__quantity-btn _inc js-cart-quantity-inc<?if($item["QUANTITY"]==$item["MAX_CNT"]){?> _disabled<?}?>"></a>
                                            </div>
                                            <div style="font-size:12px">
                                                <?=GetMessage('AVAILABLE')?> <?=$item["MAX_CNT"]?>&nbsp;<?=GetMessage('PCS')?>
                                            </div>
                                            <?
                                        } else
                                        {
                                            ?>
                                            <div style="font-size:14px;">
                                                <?=GetMessage('NOT_AVAILABLE')?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <a href="<?=$item['URL']?>" class="cart-product__link" title="<?=$item['NAME']?>"></a>
                        </div>

                        <div class="cart-scheme__cell cart-scheme__cell_size">
                            <div class="cart-scheme__value"><?=$item['SIZE']?></div>
                        </div>

                        <div class="cart-scheme__cell cart-scheme__cell_price <?
                            if ($item['PRICE_BASE'] > $item['PRICE'])
                            {
                                ?>has-old<?
                            }
                            if ($item['PREDZAKAZ'])
                            {
                                ?> has-preorder<?
                            }?>"
                        >
                            <div class="cart-scheme__value">
                                <div class="i-pc">
                                    <?
                                    if ($item['PRICE_BASE'] > $item['PRICE'])
                                    {
                                        ?>
                                        <div class="cart-scheme__old-price">
                                            <?=$item['PRICE_BASE_PRINT']?>
                                        </div>
                                        <?
                                    }
                                    ?>
                                    <div class="cart-scheme__price">
                                        <?=$item['PRICE_PRINT']?>
                                    </div>
                                </div>
                                <div class="i-mobile">
                                    <?
                                    if ($item["MAX_CNT"]>0)
                                    {
                                        ?>
                                        <?=GetMessage('SUBTOTAL')?>:<br>
                                        <?
                                        if ($item['PRICE_BASE'] > $item['PRICE'])
                                        {
                                            ?>
                                            <div class="cart-scheme__old-price">
                                                <?=$item['TOTAL_PRICE_BASE_PRINT']?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                        <div class="cart-scheme__price">
                                            <?=$item['TOTAL_PRICE_PRINT']?>
                                        </div>
                                        <?
                                    }
                                    ?>
                                </div>
                                <?
                                if ($item['PREDZAKAZ'])
                                {
                                    ?>
                                    <div class="cart-scheme__preorder">
                                        <?=GetMessage('PREORDER')?>
                                    </div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>

                        <div class="cart-scheme__cell cart-scheme__cell_num" style="width:100px;">
                            <div>
                                <?
                                if ($item["MAX_CNT"]>0)
                                {
                                    ?>
                                    <div class="cart__quantity js-quantity">
                                        <a href="javascript:void(0)" class="cart__quantity-btn _dec js-cart-quantity-dec<?if($item["QUANTITY"]==1){?> _disabled<?}?>"></a>
                                        <input type="text" class="cart__quantity-input js-cart-quantity-input"
                                            data-row-id="<?=$item['CART_ID']?>"
                                            data-max="<?=$item["MAX_CNT"]?>"
                                            value="<?=$item["QUANTITY"]?>"
                                            data-old-value="<?=$item["QUANTITY"]?>"
                                        >
                                        <a href="javascript:void(0)" class="cart__quantity-btn _inc js-cart-quantity-inc<?if($item["QUANTITY"]==$item["MAX_CNT"]){?> _disabled<?}?>"></a>
                                    </div>
                                    <div style="font-size:12px">
                                        <?=GetMessage('AVAILABLE')?> <?=$item["MAX_CNT"]?>&nbsp;<?=GetMessage('PCS')?>
                                    </div>
                                    <?
                                } else
                                {
                                    ?>
                                    <div style="font-size:14px;">
                                        <?=GetMessage('NOT_AVAILABLE')?>
                                    </div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>

                        <div class="cart-scheme__cell cart-scheme__cell_total">
                            <?
                            if ($item["MAX_CNT"]>0)
                            {
                                ?>
                                <div class="cart-scheme__value"><?=$item['TOTAL_PRICE_PRINT']?></div>
                                <?
                            }
                            ?>
                        </div>
                        <div class="cart-scheme__cell cart-scheme__cell_controls">
                            <div class="cart-scheme__controls i-noselect">
                                <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_favorite js-favorite-add-remove<?if (Favorites_checkIn($item['PRODUCT_ID'])){?> _added<?}?>"
                                    data-text-success="<?=GetMessage('ADDED_TO_FAVORITE')?>"
                                    data-text-fail="<?=GetMessage('REMOVED_FROM_FAVORITE')?>"
                                    data-product-id="<?=$item['PRODUCT_ID']?>"
                                    data-remove-text="<?=GetMessage('REMOVE_FROM_FAVORITE')?>"
                                    data-add-text="<?=GetMessage('ADD_TO_FAVORITE')?>"
                                >
                                    <?
                                    if (Favorites_checkIn($item['PRODUCT_ID']))
                                    {
                                        ?><?=GetMessage('REMOVE_FROM_FAVORITE')?><?
                                    } else
                                    {
                                        ?><?=GetMessage('ADD_TO_FAVORITE')?><?
                                    }
                                    ?>
                                </a>
                                <div class="i-clear"></div>
                                <a href="javascript:void(0)" class="cart-scheme__control cart-scheme__control_remove js-cart-delete"
                                    data-id="<?=$item['CART_ID']?>"
                                    title="<?=GetMessage('REMOVE')?>"
                                >
                                    <?=GetMessage('REMOVE')?>
                                </a>
                            </div>
                        </div>

                        <a href="javascript:void(0);" class="i-add-to-favorite i-mobile i-lazy js-favorite-add-remove<?if (Favorites_checkIn($item['PRODUCT_ID'])){?> _added i-add-to-favorite_active<?}?>"
                            data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/favorite.svg)"
                            data-text-success="<?=GetMessage('ADDED_TO_FAVORITE')?>"
                            data-text-fail="<?=GetMessage('REMOVED_FROM_FAVORITE')?>"
                            data-product-id="<?=$item['PRODUCT_ID']?>"
                            data-remove-text="<?=GetMessage('REMOVE_FROM_FAVORITE')?>"
                            data-add-text="<?=GetMessage('ADD_TO_FAVORITE')?>"
                        >&nbsp;</a>
                        <a href="javascript:void(0);" class="i-remove-product i-mobile i-lazy js-cart-delete"
                            data-id="<?=$item['CART_ID']?>"
                            data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"
                        >&nbsp;</a>
                    </div>
                    <?
                }

                if (!empty($arResult["ITEMS"]))
                {
                    ?>
                    <div style="display:flex;padding-top:30px;align-items: flex-start;">
                        <span style="margin-right:15px">
                            <input type="text" class="js-basket-coupon" placeholder="<?=GetMessage('COUPON')?>" value="<?=$arResult['COUPON_LIST'][0]["COUPON"]?>" style="width: 100%;"/>
                            <?
                            if ($arResult['COUPON_LIST'][0]["STATUS_TEXT"])
                            {
                                ?><div style="font-size:13px"><?=$arResult['COUPON_LIST'][0]["STATUS_TEXT"]?></div><?
                            }
                            ?>
                        </span>
                        <a href="javascript:void(0)" class="js-basket-coupon-apply"><?=GetMessage('APPLY')?></a>
                    </div>
                    <?
                }
                ?>
            </div>

            <div class="cart-end">
                <div class="cart-end__side cart-end__side_left i-pc">
                    <?
                    if (!empty($arResult["ITEMS"]))
                    {
                        ?>
                        <a href="javascript:void(0)" class="i-clear-cart" title="<?=GetMessage('CLEAR_CART')?>"><?=GetMessage('CLEAR_CART')?></a>
                        <?
                    }
                    ?>
                </div>
                <div class="cart-end__side">
                    <a href="#cart-order" class="button button_important order_summ js-cart-sum" data-source="Корзина" title="<?=GetMessage('ORDERING')?>">
                        <?=GetMessage('ORDERING_FROM_SUM')?>: <span><?=$arResult['TOTAL_BASKET_PRICE_PRINT']?></span></a>
                </div>
            </div>
            <?if (!$arResult['IS_REFRESH']):?>
        </div>
    </div>
</div>
<?endif;?>