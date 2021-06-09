<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="block-news__items wf-container">
	<?foreach($arResult["ITEMS"] as $arItem){
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news-item wf-box" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<img alt="<?=strip_tags($arItem['PROPERTIES']['NAME_' . mb_strtoupper(LANGUAGE_ID,'UTF-8').'_NEW']['~VALUE'])?>" class="news-item__preview i-lazy" data-src="<?=$arItem['PREVIEW_PC']["src"]?>" data-src-mobile="<?=$arItem['PREVIEW_MOBILE']["src"]?>">
			<div class="news-item__content">
				<div class="news-item__date">
          <?php if ($arItem['ACTIVE_FROM']) { ?>
            <?=ConvertDateTime($arItem['ACTIVE_FROM'], "DD")?>.<?=ConvertDateTime($arItem['ACTIVE_FROM'], "MM")?>.<?=ConvertDateTime($arItem['ACTIVE_FROM'], "YYYY")?>
          <?php } else { ?>
            ---
          <?php } ?>
				</div>
				<h3 class="news-item__title">
					<a href="<?=$arItem['PROPERTIES']['URL_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']?>" class="news-item__link" rel="nofollow" target="_blank" title="<?=strip_tags($arItem['PROPERTIES']['NAME_' . mb_strtoupper(LANGUAGE_ID,'UTF-8').'_NEW']['~VALUE'])?>">
					    <?=$arItem['PROPERTIES']['NAME_' . mb_strtoupper(LANGUAGE_ID,'UTF-8').'_NEW']['~VALUE']?>
                    </a>
				</h3>
				<div class="news-item__shorttext">
					<?=$arItem['PROPERTIES']['PREVIEW_TEXT_' . mb_strtoupper(LANGUAGE_ID,'UTF-8')]['~VALUE']['TEXT']?>
				</div>
			</div>
		</div>
	<?}?>
</div>

<div class="block-news__bottom">
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>