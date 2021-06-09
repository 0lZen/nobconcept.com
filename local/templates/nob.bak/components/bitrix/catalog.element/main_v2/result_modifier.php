<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arResult['BREADCRUMBS']=[];

foreach ($arResult['SECTION']['PATH'] as $sect)
{
    if ($arParams['LANGUAGE_ID']=='ru')
    {
        $arResult['BREADCRUMBS'][]=[
            'NAME' => $sect['NAME'],
            'URL'  => $sect['SECTION_PAGE_URL'],
        ];
    } else
    {
        $arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID'=>$sect['ID']);
        $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false,['UF_NAME']);
        while($ar_result = $db_list->Fetch())
        {
            if ($ar_result['UF_NAME'])
            {
                $arResult['BREADCRUMBS'][]=[
                    'NAME' => $ar_result['UF_NAME'],
                    'URL'  => $sect['SECTION_PAGE_URL'],
                ];
            } else
            {
                $arResult['BREADCRUMBS'][]=[
                    'NAME' => $sect['NAME'],
                    'URL'  => $sect['SECTION_PAGE_URL'],
                ];
            }
        }
    }
}

$arResult['SLIDER_PHOTOS'] = [];
if($arResult['DETAIL_PICTURE']['SRC']){
    $arResult['SLIDER_PHOTOS'][] = $arResult['DETAIL_PICTURE']['SRC'];
}
if($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']){
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value) {
         $arResult['SLIDER_PHOTOS'][] = CFile::GetPath($value);
    }
}

//тексты доставки + бренд
if($arResult['PROPERTIES']['BREND']['VALUE']){
    $qq = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_BRANDS, "NAME" => $arResult['PROPERTIES']['BREND']['VALUE_ENUM']));
    if($res_brand = $qq->GetNext()){
        $arResult['BRAND']['TEXT'] = $res_brand['PREVIEW_TEXT'];
        $arResult['BRAND']['TEXT_EN'] = $res_brand['DETAIL_TEXT'];
        if($res_brand['PREVIEW_PICTURE'])
            $arResult['BRAND']['PICTURE'] = CFile::GetPath($res_brand['PREVIEW_PICTURE']);
    }
}
$qq = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_CONTENT));
while($res_content = $qq->GetNext()){
    if($res_content['NAME'] == 'Доставка'){
        $arResult['TEXTS']['DELIVERY']['TEXT'] = $res_content['PREVIEW_TEXT'];
        $arResult['TEXTS']['DELIVERY']['TEXT_EN'] = $res_content['DETAIL_TEXT'];

        if($res_content['PREVIEW_PICTURE'])
            $arResult['TEXTS']['DELIVERY']['PICTURE'] = CFile::GetPath($res_content['PREVIEW_PICTURE']);
    }


    if($res_content['NAME'] == 'Оплата'){
        $arResult['TEXTS']['PAYMENT']['TEXT'] = $res_content['PREVIEW_TEXT'];
        $arResult['TEXTS']['PAYMENT']['TEXT_EN'] = $res_content['DETAIL_TEXT'];

        if($res_content['PREVIEW_PICTURE'])
            $arResult['TEXTS']['PAYMENT']['PICTURE'] = CFile::GetPath($res_content['PREVIEW_PICTURE']);
    }


    if($res_content['NAME'] == 'Возврат'){
        $arResult['TEXTS']['RETURN']['TEXT'] = $res_content['PREVIEW_TEXT'];
        $arResult['TEXTS']['RETURN']['TEXT_EN'] = $res_content['DETAIL_TEXT'];

        if($res_content['PREVIEW_PICTURE'])
            $arResult['TEXTS']['RETURN']['PICTURE'] = CFile::GetPath($res_content['PREVIEW_PICTURE']);
    }
}

$component = $this->getComponent();
$component->SetResultCacheKeys(array('PROPERTIES','BREADCRUMBS'));
$arParams = $component->applyTemplateModifications();
