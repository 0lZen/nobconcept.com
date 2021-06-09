<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['SECTIONS']))
{
    ?>
    <div class="filter-category i-noselect filter-category_opened">
        <div class="filter-category__header">
            <div class="filter-category__title">
                <div class="filter-category__arrow i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)" data-was-processed="true" style="background-image: url(&quot;/local/templates/nob/assets/css/images/icons/arrow.svg&quot;);"></div>
                <?=GetMessage('TITLE')?>
            </div>
        </div>


        <div class="filter-group ">
            <div class="filter-group__inner">
                <?
                foreach ($arResult['SECTIONS'] as $sect)
                {
                    if (LANGUAGE_ID=='en' && $sect['UF_NAME_EN'])
                    {
                        $sect['NAME']=$sect['UF_NAME_EN'];
                    }
                    ?>
                    <div class="filter-checkbox">
                        <?
                        if ($sect['ID']==$arParams['SECTION_ID'])
                        {
                            ?>
                            <strong class="filter-checkbox__name" title="<?=$sect['NAME']?>">
                                <?=$sect['NAME']?>
                            </strong>
                            <?
                        } else
                        {
                            ?>
                            <a href="<?=$sect['SECTION_PAGE_URL']?>" class="filter-checkbox__name" title="<?=$sect['NAME']?>">
                                <?=$sect['NAME']?>
                            </a>
                            <?
                        }
                        ?>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
    <div class="filter-category i-noselect filter-category_opened"></div>
    <?
}