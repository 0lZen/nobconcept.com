<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="block-subnavigation__menu subnavigation-menu i-noselect">
	<?
    $iMaxItems = 20;
    $i = 1;
    $iMaxBanners = 2;
    $b = 1;
    $sBanners = "";
    $bPageOpened = false;
    foreach ($arResult as $arItem)
    {
		if ($arItem['DEPTH_LEVEL'] === 1)
        {
			if ($bPageOpened)
            {
                ?>
				</div><div class="subnavigation-menu__banners"><?=$sBanners?></div></div>
			    <?
                $sBanners = "";
                $i = 0;
                $b = 0;
            }
            ?>
			<div class="subnavigation-menu__page">
				<a href="<?if (LANGUAGE_ID =='en'){echo '/en/pre-order/';}else{ echo '/pre-order/';}?>" class="subnavigation__preorder"><?if (LANGUAGE_ID =='en'){echo 'Pre-order';}else{ echo 'Предзаказ';}?></a>
				<div class="subnavigation-menu__items">
		        <?$bPageOpened = true;
        } else
        if ((!isset($arItem["PARAMS"]["IMAGE"]) || !$arItem["PARAMS"]["IMAGE"]) && ($i <= $iMaxItems))
        {
            ?>
			<div class="subnavigation-menu__item-wrapper">
				<a href="<?=$arItem["LINK"]?>" class="subnavigation-menu__item" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
			</div>
		    <?$i++;
        } elseif ((isset($arItem["PARAMS"]["IMAGE"]) && $arItem["PARAMS"]["IMAGE"]) && ($b <= $iMaxBanners))
		{
			$sBanners .= '<a href="' . $arItem["LINK"] . '" class="subnavigation-menu__banner subnavigation-banner" title="' . $arItem["TEXT"] . '"><span class="subnavigation-banner__image i-lazy" data-bg="url(\'' . $arItem["PARAMS"]["IMAGE"] . '\')">&nbsp;</span><span class="subnavigation-banner__title">' . $arItem["TEXT"] . '</span></a>';
		}
	}
	if ($bPageOpened)
    {
        ?>
		</div><div class="subnavigation-menu__banners"><?=$sBanners?></div></div>
	    <?
        $i = 0;
        $b = 0;
    }
    ?>
</div>