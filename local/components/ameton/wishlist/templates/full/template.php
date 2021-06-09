<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!$arResult['IS_REFRESH']):
?>

        <h2 class="modal__header">
           <?=GetMessage('TITLE')?>
        </h2>
        <?endif;

        if(!empty($arResult['ITEMS']))
        {
            ?>
            <div class="favorite-main">
                <div class="favorite-scheme">
                    <div class="favorite-scheme__row favorite-scheme__row_header">
                        <div class="favorite-scheme__cell">&nbsp;</div>
                        <div class="favorite-scheme__cell"><div class="favorite-scheme__label"><?=GetMessage('PRODUCT')?></div></div>
                        <div class="favorite-scheme__cell"><div class="favorite-scheme__label"><?=GetMessage('SIZE')?></div></div>
                        <div class="favorite-scheme__cell"><div class="favorite-scheme__label"><?=GetMessage('COST')?></div></div>
                        <div class="favorite-scheme__cell">&nbsp;</div>
                    </div>
                    <?
                    foreach ($arResult['ITEMS'] as $item)
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
                        <div class="favorite-scheme__row">
                            <div class="favorite-scheme__cell favorite-scheme__cell_photo">
                                <img alt="<?=$item['NAME']?>" class="favorite-scheme__preview i-lazy" src="<?=$item['IMG']?>" data-src="<?=$item['IMG']?>" data-src-mobile="<?=$item['IMG']?>">
                            </div>
                            <div class="favorite-scheme__cell favorite-scheme__cell_info">
                                <div class="favorite-product__content">
                                    <h3 class="favorite-product__brand"><?=$item['BRAND']?></h3>
                                    <h4 class="favorite-product__title">
                                        <?=$item['NAME']?>
                                        <div class="i-mobile" style="font-size:14px">
                                            <?=$item['PRICE_PRINT']?>&nbsp;/&nbsp;1&nbsp;<?=GetMessage('PCS')?>
                                        </div>
                                    </h4>
                                    <div class="favorite-product__color i-pc"><?=$item['COLOR']?></div>
                                    <div class="favorite-product__color i-mobile">
                                        <?=join(', ',$mobProps)?>
                                    </div>
                                    <div class="i-mobile">
                                        <?
                                        if ($item['CAN_BUY'])
                                        {
                                            ?>
                                            <a href="javascript:void(0);" class="button button_important i-add-to-cart<?if($item['IN_CART']){?> i-add-to-cart_active<?}?>"
                                                data-product-id="<?=$item['PRODUCT_ID']?>"
                                                data-text-success="<?=GetMessage('TO_CART_MES')?>"
                                            >
                                                <?
                                                if ($item['IN_CART'])
                                                {
                                                    ?>
                                                    <?=GetMessage('IN_CART')?>
                                                    <?
                                                } else
                                                {
                                                    ?>
                                                    <?=GetMessage('TO_CART')?>
                                                    <?
                                                }
                                                ?>
                                            </a>
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
                                <a href="<?=$item['URL']?>" class="favorite-product__link" title="<?=$item['NAME']?>"></a>
                            </div>
                            <div class="favorite-scheme__cell favorite-scheme__cell_size">
                                <div class="favorite-scheme__value"><?=$item['SIZE']?></div>
                            </div>
                            <div class="favorite-scheme__cell favorite-scheme__cell_price i-pc <?
                                if ($item['PRICE_BASE'] > $item['PRICE'])
                                {
                                    ?>has-old<?
                                }
                                if ($item['PREDZAKAZ'])
                                {
                                    ?> has-preorder<?
                                }?>"
                            >
                                <div class="favorite-scheme__value">
                                    <?
                                    if ($item['PRICE_BASE'] > $item['PRICE'])
                                    {
                                        ?>
                                        <div class="favorite-scheme__old-price">
                                            <?=$item['PRICE_BASE_PRINT']?>
                                        </div>
                                        <?
                                    }
                                    ?>
                                    <div class="favorite-scheme__price">
                                        <?=$item['PRICE_PRINT']?>
                                    </div>
                                    <?
                                    if ($item['PREDZAKAZ'])
                                    {
                                        ?>
                                        <div class="favorite-scheme__preorder"><?=GetMessage('PREORDER')?></div>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="favorite-scheme__cell favorite-scheme__cell_controls">
                                <div class="favorite-scheme__controls i-noselect">
                                    <div class="i-font-default">
                                        <?
                                        if ($item['CAN_BUY'])
                                        {
                                            ?>
                                            <a href="javascript:void(0);" class="button button_important i-add-to-cart<?if($item['IN_CART']){?> i-add-to-cart_active<?}?>"
                                                data-product-id="<?=$item['PRODUCT_ID']?>"
                                                data-text-success="<?=GetMessage('TO_CART_MES')?>"
                                            >
                                                <?
                                                if ($item['IN_CART'])
                                                {
                                                    ?>
                                                    <?=GetMessage('IN_CART')?>
                                                    <?
                                                } else
                                                {
                                                    ?>
                                                    <?=GetMessage('TO_CART')?>
                                                    <?
                                                }
                                                ?>
                                            </a>
                                            <?
                                        } else
                                        {
                                            ?>
                                            <div style="font-size:14px;margin: 0 2.2em 0 0;">
                                                <?=GetMessage('NOT_AVAILABLE')?>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                    <a href="javascript:void(0)" class="favorite-scheme__control favorite-scheme__control_favorite js-favorite-add-remove _added _from_list"
                                        data-text-success="<?=GetMessage('ADDED_TO_FAVORITE')?>"
                                        data-text-fail="<?=GetMessage('REMOVED_FROM_FAVORITE')?>"
                                        data-product-id="<?=$item['PRODUCT_ID']?>"
                                        data-price="<?=$item['PRICE']?>"
                                        data-remove-text="<?=GetMessage('REMOVE_FROM_FAVORITE')?>"
                                        data-add-text="<?=GetMessage('ADD_TO_FAVORITE')?>"
                                    >
                                        <?=GetMessage('REMOVE_FROM_FAVORITE')?>
                                    </a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="i-remove-product i-mobile i-lazy js-favorite-add-remove _added _from_list"
                                data-product-id="<?=$item['PRODUCT_ID']?>"
                                data-text-success="<?=GetMessage('ADDED_TO_FAVORITE')?>"
                                data-text-fail="<?=GetMessage('REMOVED_FROM_FAVORITE')?>"
                                data-product-id="<?=$item['PRODUCT_ID']?>"
                                data-remove-text="<?=GetMessage('REMOVE_FROM_FAVORITE')?>"
                                data-add-text="<?=GetMessage('ADD_TO_FAVORITE')?>"
                                data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)">&nbsp;</a>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
            <?
        } else
        {
            ?>
            <div class="favorite-message favorite-message_active i-noselect"><?=GetMessage('EMPTY')?>.</div>
            <?
        }

        if (!$arResult['IS_REFRESH']):?>

<?endif;?>