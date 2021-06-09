<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if ($arResult["TOTAL"] > 0) {
  $arItem = $arResult["ITEMS"][0];
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
	<div class="block-week__product week-product" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
		<div class="week-product__image i-lazy" data-bg="url('<?=$arItem["PREVIEW_PC"]["src"]?>')" data-bg-mobile="url('<?=$arItem["PREVIEW_MOBILE"]["src"]?>')"></div>
		<div class="week-product__content">
			<h3 class="week-product__title">
				<?=$arItem["PROPERTIES"]["TITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"]?>
			</h3>
			<div class="week-product__price">
				<?=$arItem["PROPERTIES"]["SUBTITLE_" . mb_strtoupper(LANGUAGE_ID,'UTF-8')]["~VALUE"]["TEXT"]?>
			</div>
		</div>
	</div>


    <header class="block-week__header header">
            <div class="block-week__label i-pc">
                <?if($arItem["PROPERTIES"]["TEXT_BRAND_WEEK"]['VALUE']):?>
                    <?=$arItem["PROPERTIES"]["TEXT_BRAND_WEEK"]['VALUE'];?>
                <?else:?>
                    Бренд недели
                <?endif;?>
            </div>

            <h2 class="header__title">
                <?if($arItem['PROPERTIES']['TEXT_BRAND']['ARRAY']):?>
                    <?foreach ($arItem['PROPERTIES']['TEXT_BRAND']['ARRAY'] as $key => $value) {
                        echo $value.'<br>';
                    }?>
                <?else:?>
                    Roma<br>Uvarov<br>Design
                <?endif;?>
            </h2>

            <div class="block-week__label i-mobile">
                <?if($arItem["PROPERTIES"]["TEXT_BRAND_WEEK"]['VALUE']):?>
                    <?=$arItem["PROPERTIES"]["TEXT_BRAND_WEEK"]['VALUE'];?>
                <?else:?>
                    Бренд недели
                <?endif;?>
            </div>

            <div class="i-pc">
                <a href="<?=$arItem['PROPERTIES']['LINK_DETAIL']['VALUE']?>" title="Посмотреть подборку" class="button">
                    <?if($arItem["PROPERTIES"]["TEXT_BRAND_SEE"]['VALUE']):?>
                        <?=$arItem["PROPERTIES"]["TEXT_BRAND_SEE"]['VALUE'];?>
                    <?else:?>
                        Посмотреть подборку
                    <?endif;?>
                </a>
            </div>
        </header>

        <div class="i-mobile block-week__button">
            <a href="<?=$arItem['PROPERTIES']['LINK_DETAIL']['VALUE']?>" title="Посмотреть подборку" class="button">
                <?if($arItem["PROPERTIES"]["TEXT_BRAND_SEE"]['VALUE']):?>
                    <?=$arItem["PROPERTIES"]["TEXT_BRAND_SEE"]['VALUE'];?>
                <?else:?>
                    Посмотреть подборку
                <?endif;?>
            </a>
        </div>
<?}?>
