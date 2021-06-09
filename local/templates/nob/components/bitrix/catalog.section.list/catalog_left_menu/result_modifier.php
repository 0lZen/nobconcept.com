<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult['SECTIONS']))
{
    $arFilter = ['IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE' => 'Y', 'SECTION_ID' => $arResult['SECTION']['IBLOCK_SECTION_ID']];
    $db_list = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter, false, ['UF_NAME_EN']);
    while ($arSection = $db_list->GetNext())
    {
        $arResult['SECTIONS'][]=$arSection;
    }
}