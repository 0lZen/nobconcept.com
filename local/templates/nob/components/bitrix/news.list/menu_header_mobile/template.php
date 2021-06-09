<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$hasBrands=false;
$hasCatalog=false;

?>
<div class="block-menu__menu menu-menu i-noselect">
    <?
    foreach ($arResult['ITEMS'] as $arItem)
    {
        if ($arItem['CODE']=='#CATALOG#')
        {
            $hasCatalog=true;
            foreach ($arResult['MENU_CATALOG'] as $id=>$arItem2)
            {
                ?>
                <div class="menu-menu__item-wrapper">
                    <a href="<?=$arItem2["URL"]?>" class="menu-menu__item" title="<?=$arItem2["NAME"]?>">
                        <?=$arItem2["NAME"]?>
                    </a>
                </div>
                <?
            }
        } else
        if ($arItem['CODE']=='#BRANDS#')
        {
            $hasBrands=true;
            ?>
            <div class="menu-menu__item-wrapper">
                <a href="<?=SITE_DIR?>catalog/" class="menu-menu__item menu-menu__item_brands" title="<?=$arItem["NAME"]?>">
                    <?=$arItem["NAME"]?>
                </a>
            </div>
            <?
        } else
        {
            ?>
            <div class="menu-menu__item-wrapper">
                <a href="<?=$arItem["CODE"]?>" class="menu-menu__item" title="<?=$arItem["NAME"]?>">
                    <?=$arItem["NAME"]?>
                </a>
            </div>
            <?
        }
    }
    ?>
</div>
<br><br>
<?