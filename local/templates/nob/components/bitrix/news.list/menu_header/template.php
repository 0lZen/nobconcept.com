<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$hasBrands=false;
$hasCatalog=false;

?>

<div class="block-navigation__menu navigation-menu i-noselect">
    <?
    foreach ($arResult['ITEMS'] as $arItem)
    {
        if ($arItem['CODE']=='#CATALOG#')
        {
            $hasCatalog=true;
            foreach ($arResult['MENU_CATALOG'] as $id=>$arItem2)
            {
                if (!empty($arItem2['SUB']))
                {
                    ?>
                    <a href="<?=$arItem2["URL"]?>" class="navigation-menu__item has" title="<?=$arItem2["NAME"]?>" data-id="SECTION_<?=$id?>">
                        <?=$arItem2["NAME"]?>
                    </a>
                    <?
                } else
                {
                    ?>
                    <a href="<?=$arItem2["URL"]?>" class="navigation-menu__item" title="<?=$arItem2["NAME"]?>">
                        <?=$arItem2["NAME"]?>
                    </a>
                    <?
                }
            }
        } else
        if ($arItem['CODE']=='#BRANDS#')
        {
            $hasBrands=true;
            ?>
            <a href="<?=SITE_DIR?>catalog/" class="navigation-menu__item has" title="<?=$arItem["NAME"]?>" data-id="BRANDS">
                <?=$arItem["NAME"]?>
            </a>
            <?
        } else
        {
            ?>
            <a href="<?=$arItem["CODE"]?>" class="navigation-menu__item" title="<?=$arItem["NAME"]?>">
                <?=$arItem["NAME"]?>
            </a>
            <?
        }
    }
    ?>
</div>

<?$this->SetViewTarget("brands_mobile_subnavigation");
if ($hasBrands)
{
    ?>
    <nav class="block block-menu block-menu_brands i-mobile" id="menu-brands">
        <div class="block__inner">
            <div class="block-menu__close i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

            <div class="block-menu__top">
                <div class="block-menu__logo-wrapper">
                    <a href="<?=SITE_DIR?>" class="logo-link" title="<?=GetMessage("BACK_ON_MAIN")?>">
                        <img alt="NOBCONCEPT" class="logo i-lazy loaded" src="<?=SITE_TEMPLATE_PATH?>/assets/css/images/logo_dark.svg">
                    </a>
                </div>

                <div class="block-menu__menu menu-menu i-noselect">
                    <?
                    /*<div class="menu-menu__item-wrapper">
                        <a href="<?=$arParams['SITE_DIR']?>pre-order/" class="menu-menu__item" title="<?=GetMessage("PREORDER")?>">
                            <?=GetMessage("PREORDER")?>
                        </a>
                    </div>
                    <?*/
                    global $arMenuBrands;
                    foreach ($arMenuBrands as $brand)
                    {
                        ?>
                        <div class="menu-menu__item-wrapper">
                            <a href="<?=SITE_DIR."catalog/filter/brand-is-".mb_strtolower($brand["URL"])."/apply/"?>" class="menu-menu__item" title="<?=$brand["NAME"]?>">
                                <?=$brand["NAME"]?>
                            </a>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?
}
$this->EndViewTarget();

$this->SetViewTarget("subnavigation");?>
<nav class="block block-subnavigation i-pc" id="subnavigation">
    <div class="block__inner">

        <div class="block-subnavigation__menu subnavigation-menu i-noselect">
            <?
            if ($hasBrands)
            {
                ?>
                <div class="subnavigation-menu__page" data-id="BRANDS">
                    <?/*<a href="<?=$arParams['SITE_DIR']?>pre-order/" class="subnavigation__preorder">
                        <?=GetMessage("PREORDER")?>
                    </a>*/?>
                    <div class="subnavigation-menu__items">
                        <?
                        global $arMenuBrands;
                        foreach ($arMenuBrands as $brand)
                        {
                            ?>
                    		<div class="subnavigation-menu__item-wrapper">
                                <a href="<?=SITE_DIR."catalog/filter/brand-is-".mb_strtolower($brand["URL"])."/apply/"?>" class="subnavigation-menu__item" title="<?=$brand["NAME"]?>">
                                    <?=$brand["NAME"]?>
                                </a>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                    <div class="subnavigation-menu__banners"></div>
                </div>
                <?
            }
            if ($hasCatalog)
            {
                foreach ($arResult['MENU_CATALOG'] as $id=>$section)
                {
                    ?>
                    <div class="subnavigation-menu__page" data-id="SECTION_<?=$id?>">
                        <a href="<?=$arParams['SITE_DIR']?>pre-order/" class="subnavigation__preorder">
                            <?=GetMessage("PREORDER")?>
                        </a>
                        <div class="subnavigation-menu__items">
                            <div class="subnavigation-menu__item-wrapper">
                                <a href="<?=$section['URL']?>" class="subnavigation-menu__item" title="<?=GetMessage("ALL_PRODS")?>">
                                    <?=GetMessage("ALL_PRODS")?>
                                </a>
                            </div>
                            <?
                            $cnt=0;
                            foreach ($section['SUB'] as $subSection)
                            {
                                ?>
                                <div class="subnavigation-menu__item-wrapper">
                                    <a href="<?=$subSection['URL']?>" class="subnavigation-menu__item" title="<?=$subSection['NAME']?>">
                                        <?=$subSection['NAME']?>
                                    </a>
                                </div>
                                <?
                                $cnt++;
                                #if ($cnt==9) break;
                            }
                            ?>
                        </div>
                        <?
                        if (!empty($section['BANNERS']))
                        {
                            ?>
                            <div class="subnavigation-menu__banners">
                                <?
                                foreach ($section['BANNERS'] as $bnr)
                                {
                                    if ($bnr['URL'])
                                    {
                                        ?>
                                        <a href="<?=$bnr['URL']?>" class="subnavigation-menu__banner subnavigation-banner" title="<?=$bnr['TITLE']?>">
                                            <span class="subnavigation-banner__image i-lazy" data-bg="url(<?=$bnr['IMG']?>)">&nbsp;</span>
                                            <?
                                            if ($bnr['TITLE'])
                                            {
                                                ?>
                                                <span class="subnavigation-banner__title"><?=$bnr['TITLE']?></span>
                                                <?
                                            }
                                            ?>
                                        </a>
                                        <?
                                    } else
                                    {
                                        ?>
                                        <span class="subnavigation-menu__banner subnavigation-banner" title="<?=$bnr['TITLE']?>">
                                            <span class="subnavigation-banner__image i-lazy" data-bg="url(<?=$bnr['IMG']?>)">&nbsp;</span>
                                            <?
                                            if ($bnr['TITLE'])
                                            {
                                                ?>
                                                <span class="subnavigation-banner__title"><?=$bnr['TITLE']?></span>
                                                <?
                                            }
                                            ?>
                                        </span>
                                        <?
                                    }
                                }
                                ?>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                    <?
                }
            }
            ?>
        </div>
    </div>
</nav>
<?
$this->EndViewTarget();