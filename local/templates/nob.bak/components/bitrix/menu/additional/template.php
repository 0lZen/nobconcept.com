<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
ob_start();?>

<div class="block-navigation__additional navigation-additional i-noselect">
    <?
    foreach ($arResult as $arItem)
    {
        ?>
        <?if ($arItem["PARAMS"]["ACTION"] === "SEARCH") {?>
            #SEARCH#
        <?}?>

        <a href="<?=$arItem["LINK"]?>" class="navigation-additional__item additional-item <?=($arItem["PARAMS"]["ACTION"] ? "additional-item-" . htmlspecialcharsEx(mb_strtolower($arItem["PARAMS"]["ACTION"],'UTF-8')) : '')?> <?=($arItem["PARAMS"]["STATUS"] ? $arItem["PARAMS"]["STATUS"] : "")?> <?=($arItem["PARAMS"]["ACTION"] === "FAVORITE" || $arItem["PARAMS"]["ACTION"] === "CART" ? 'i-modal' : '')?>" style="background-image:url('<?=$arItem["PARAMS"]["ICON"]?>')" title="<?=$arItem["TEXT"]?>">
            <?
            if ($arItem["PARAMS"]["ACTION"] === "FAVORITE")
            {
                ?>
                <span class="additional-item-favorite__point js-favorite-header-state <?if(!empty(Favorites_getArr())){?> _active<?}?>">&nbsp;</span>
                <?
            } else
            if ($arItem["PARAMS"]["ACTION"] === "CART")
            {
                ?>
                <span class="additional-item-cart__num js-cart-total-cnt"><?=$arItem["PARAMS"]["CART_NUM"]?></span>
                <?
            }
            ?>
        </a>
        <?
    }
    ?>
</div>

<?$this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
ob_get_clean();