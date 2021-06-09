<?
Bitrix\Main\Localization\Loc::loadMessages($_SERVER["DOCUMENT_ROOT"]."/local/templates/nob/components/nob/catalog/main/section_vertical.php");
$arSections=[
    SITE_DIR.'catalog/' => ["TITLE"=>GetMessage('ALL'),"VALUE"=>"all"],
    SITE_DIR.'catalog/men/' => ["TITLE"=>GetMessage('MEN'),"VALUE"=>"male"],
    SITE_DIR.'catalog/women/' => ["TITLE"=>GetMessage('WOMAN'),"VALUE"=>"female"],
];
foreach ($arSections as $link=>$item)
{
    if (mb_strpos($link,'/catalog/men',0,'UTF-8')!==false && mb_strpos($APPLICATION->GetCurDir(),'gender-is-male',0,'UTF-8')!==false)
    {
        $SELECTED=true;
    } else
    if (mb_strpos($link,'/catalog/women',0,'UTF-8')!==false && mb_strpos($APPLICATION->GetCurDir(),'gender-is-female',0,'UTF-8')!==false)
    {
        $SELECTED=true;
    } else
    if (mb_strpos($link,'/catalog/women',0,'UTF-8')===false && mb_strpos($link,'/catalog/men',0,'UTF-8')===false && mb_strpos($APPLICATION->GetCurDir(),'gender-is-',0,'UTF-8')===false)
    {
        $SELECTED=true;
    } else
    {
        $SELECTED=false;
    }
    ?>
    <a onclick="return true;" <?if($item["VALUE"]!="all"){?>style="display:none"<?}?> data-value="<?=$item["VALUE"]?>" href="<?=$link?>" class="js-catalog-top-menu-filter catalog-menu__item<?if($SELECTED){?> catalog-menu__item_active<?}?>" title="<?=$item["TITLE"]?>"><?=$item["TITLE"]?></a>
    <?
}