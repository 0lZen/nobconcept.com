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

if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';

?>
	<?/*<div class="bx_pagination_section_two">
		<div class="bx_pg_section bx_pg_show_col">
			<span class="bx_wsnw"><?
			if ($arParams['USE_PAGE_SIZE'] == 'Y' && !$arResult["NavShowAll"])
			{
			?>
				<span class="bx_pg_text"><? echo GetMessage('nav_size_descr'); ?></span>
				<div class="bx_pagination_select_container">
					<select onchange="if (-1 < this.selectedIndex) {location.href='<? echo $strSelectPath; ?>'+this[selectedIndex].value};"><?
					foreach ($arResult['TPL_DATA']['PAGE_SIZES'] as &$intOneSize)
					{
						?><option value="<? echo $intOneSize; ?>"<? echo ($arResult['NavPageSize'] == $intOneSize ? ' selected="selected"' : ''); ?>><? echo $intOneSize; ?></option>
						<?
					}
					unset($intOneSize);
					?>
					</select>
				</div><?
			}
			?>
				<? echo $arResult["NavTitle"]; ?><?=$arResult["NavFirstRecordShow"]; ?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?>
			</span>
		</div>
	</div>*/?>

			<div class="block-catalog__paginator paginator i-noselect"><?
if ($arResult["NavShowAll"])
{
?>
				<span class="bx_pg_text"><? echo GetMessage('nav_all_descr'); ?></span>
				<ul>
					<li><a href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=0&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>"><? echo GetMessage('nav_show_pages'); ?></a></li>
				</ul>
<?
}
else
{
?>
				<?/*<span class="bx_pg_text"><? echo GetMessage('nav_pages'); ?></span>*/?>

<?
	if (true === $arResult["bDescPageNumbering"])
	{
		?><?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?>
			<a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>"><span class="paginator__control paginator__control_left arrow"></span></a><?
		}
		else
		{
			?><span class="paginator__control paginator__control_left paginator__control_ia arrow"></span><?
		}
		?><?
		$NavRecordGroup = $arResult["NavPageCount"];
		while ($NavRecordGroup >= 1)
		{
			$NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroupPrint)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?>
				<span class="paginator__control paginator__control_page paginator__control_page-current bx_active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroupPrint; ?></span>

				<?
			}
			elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
			{

				?>
				<a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" class="paginator__control paginator__control_page" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a>
				<?
			}
			else
			{
				?>
					<a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" class="paginator__control paginator__control_page" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a>
					<?
			}
			if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"]))
			{
				$middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?>

				<a class="paginator__control paginator__control_dots" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a>



				<?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"])
			{
				$middlePage = ceil(($arResult["nEndPage"] + 2)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><a class="paginator__control paginator__control_dots" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a><?
				$NavRecordGroup = 2;
			}
			else
			{
				$NavRecordGroup--;
			}
		}
		?><?
		if ($arResult["NavPageNomer"] > 1)
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" class="paginator__control paginator__control_right arrow" title="<? echo GetMessage('nav_next_title'); ?>"></a>
			<?
		}
		else
		{
			?><span class="paginator__control paginator__control_right arrow" title="<? echo GetMessage('nav_next_title'); ?>"></span><?
		}
		?><?
	}
	else
	{
?>
					<?
		if (1 < $arResult["NavPageNomer"])
		{
			?>
				<a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>" class="paginator__control paginator__control_left arrow"></a>
			<?
		}
		else
		{
			?><span class="paginator__control paginator__control_left paginator__control_ia arrow"></span><?
		}
		?><?
		$NavRecordGroup = 1;
		while($NavRecordGroup <= $arResult["NavPageCount"])
		{
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroup)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?>


				<span class="paginator__control paginator__control_page paginator__control_page-current bx_active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroup; ?></span>

				<?
			}
			elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false)
			{
				?>

				<a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>" class="paginator__control paginator__control_page"><?=$NavRecordGroup?></a>
				<?
			}
			else
			{
				?>
					<a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>" class="paginator__control paginator__control_page"><?=$NavRecordGroup?></a>

				<?
			}
			if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
			{
				$middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?>
				<a class="paginator__control paginator__control_dots" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a>

				<?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
			{
				$middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?><a class="paginator__control paginator__control_dots" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a><?
				$NavRecordGroup = $arResult["NavPageCount"]-1;
			}
			else
			{
				$NavRecordGroup++;
			}
		}
			?>
					<?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?>
				<a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" class="paginator__control paginator__control_right arrow" title="<? echo GetMessage('nav_next_title'); ?>"></a>
			<?
		}
		else
		{
			?><span class="paginator__control paginator__control_right paginator__control_ia arrow"></span><?
		}
		?><?
		if ($arResult["bShowAll"])
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=1&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageSize"]?>"><? echo GetMessage('nav_all'); ?></a><?
		}
	}
?>
				</div><?
}
?>
