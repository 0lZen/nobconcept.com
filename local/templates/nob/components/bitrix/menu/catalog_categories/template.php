<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block-catalog__menu catalog-menu i-noselect">
	<?
    foreach ($arResult as $arItem)
    {
        ?>
		<a onclick="return true;" href="<?=$arItem["LINK"]?>" class="catalog-menu__item <?=($arItem["SELECTED"] ? "catalog-menu__item_active" : "")?>"
           title="<?if(LANGUAGE_ID =='en'){
				switch ($arItem["TEXT"]) {
					case 'Все':
						echo "All";
						break;
					
					case 'Мужское':
						echo "Men";
						break;
					
					case 'Женское':
						echo "Woman";
						break;
					
					
				}
			}else{echo $arItem["TEXT"];}?>">
		   <?if(LANGUAGE_ID =='en'){
				switch ($arItem["TEXT"]) {
					case 'Все':
						echo "All";
						break;
					
					case 'Мужское':
						echo "Men";
						break;
					
					case 'Женское':
						echo "Woman";
						break;
					
					
				}
			}else{echo $arItem["TEXT"];}?>
		   </a>
	<?}?>
</div>