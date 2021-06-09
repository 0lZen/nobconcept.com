<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['MENU_CATALOG']=[];
$arFilter = Array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>1);
$db_list = CIBlockSection::GetList(Array('DEPTH_LEVEL'=>'ASC', 'SORT'=>'ASC'), $arFilter, false, ['UF_NAME_EN']);
while ($ar_result = $db_list->GetNext())
{
    if (LANGUAGE_ID=='en' && $ar_result['UF_NAME_EN'])
    {
        $ar_result['NAME']=$ar_result['UF_NAME_EN'];
    }
    $arResult['MENU_CATALOG'][$ar_result['ID']]=[
        'NAME'     => $ar_result['NAME'],
        'URL'      => $ar_result['SECTION_PAGE_URL']
    ];
}