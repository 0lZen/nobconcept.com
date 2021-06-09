<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="block">
    <div class="block-about__square"></div>

    <div class="block__inner">
        <div class="block-about__inner">
            <header class="block-about__header header">
                <h1 class="header__title">
                    <?
                    if (LANGUAGE_ID=='ru')
                    {
                        ?>Бренды<?
                    } else
                    {
                        ?>Brands<?
                    }
                    ?>
                </h1>
            </header>
            <div class="BrandsList">
                <?
                foreach($arResult["ITEMS"] as $arItem)
                {
                    if (!$arItem['PREVIEW_PICTURE']['SRC'] || !in_array($arItem['ID'],$arParams['ACTIVE_BRANDS'])) continue;

                    ?>
                	<div class="BrandsListItem">
                        <div class="BrandsListItem--img">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                            </a>
                        </div>
                        <div class="BrandsListItem--text">
                            <p>
                                <?
                                if (LANGUAGE_ID=='ru')
                                {
                                    ?>
                                    <?=$arItem['PROPERTIES']['ANONS']["~VALUE"]?>
                                    <?
                                } else
                                {
                                    ?>
                                    <?=$arItem['PROPERTIES']['ANONS_EN']["~VALUE"]?>
                                    <?
                                }
                                ?>
                            </p>
                            <a class="BrandsListItem--url" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                                <?
                                if (LANGUAGE_ID=='ru')
                                {
                                    ?>Узнать подробнее<?
                                } else
                                {
                                    ?>Show more<?
                                }
                                ?>
                            </a>
                        </div>
                	</div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
</div>
