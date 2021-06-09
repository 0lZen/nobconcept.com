<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true); 
?>

<? foreach ($arResult['ITEMS'] as $arItem) { ?>
	<? if ($arItem['CODE']) { ?>
		<div class="block-header__ytb-video">
			<div id="bgndVideo" class="player" data-property="{videoURL:'http://youtu.be/<?=$arItem['CODE'];?>', containment:'#bgndVideo', autoPlay:true, mute:true, startAt:0, opacity:1, showControls: false, loop: true, realfullscreen: true, stopMovieOnBlur: false}"></div>
		</div>
	<? } ?>
<? } ?>