<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

// delayed function must return a string
if (empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="breadcrumbs i-noselect i-pc" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0 ? '<span class="breadcrumbs__divider"></span>' : '');

	if($arResult[$index]["LINK"] != "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<div class="breadcrumbs__item breadcrumbs__item_link" id="breadcrumbs_' . $index .'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">
					<span class="breadcrumbs__name" itemprop="name">'.$title.'</span>
				</a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</div>';
	}
	else
	{
		$strReturn .= '
			<div class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				'.$arrow.'
				<span class="breadcrumbs__name" itemprop="name">'.$title.'</span>
				<meta itemprop="position" content="'.($index + 1).'" />
			</div>';
	}
}

$strReturn .= '</div>';

$strReturn .= '<div class="breadcrumbs i-noselect i-mobile">';
$strReturn .= '<a href="javascript:goBack();" class="breadcrumbs__item breadcrumbs__link" title="' . GetMessage("BACK_ON_MAIN") . '"><span class="breadcrumbs__arrow">&nbsp;</span>' . GetMessage("BACK") . '</a>';
$strReturn .= '</div>';

return $strReturn;