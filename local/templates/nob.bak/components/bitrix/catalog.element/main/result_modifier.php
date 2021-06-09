<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */


if (in_array($arParams['CURRENCY'],['EUR','USD']))
{
    $keys=['VALUE_VAT','VALUE_NOVAT','DISCOUNT_VALUE_VAT','DISCOUNT_VALUE_NOVAT','ROUND_VALUE_VAT','ROUND_VALUE_NOVAT','VALUE','UNROUND_DISCOUNT_VALUE','DISCOUNT_VALUE','DISCOUNT_DIFF','DISCOUNT_VATRATE_VALUE'];
    $keys2=['UNROUND_BASE_PRICE','UNROUND_PRICE','BASE_PRICE','PRICE','DISCOUNT','RATIO_BASE_PRICE','RATIO_PRICE','RATIO_DISCOUNT'];

    if (!empty($arResult['OFFERS']))
    {
        foreach ($arResult['OFFERS'] as $key=>$offer)
        {
            foreach ($offer['PRICES'] as $key2=>$price)
            {
                foreach ($keys as $keyPrice)
                {
                    $arResult['OFFERS'][$key]['PRICES'][$key2][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['OFFERS'][$key]['PRICES'][$key2][$keyPrice], "RUB", $arParams['CURRENCY']),2);
                    $arResult['OFFERS'][$key]['PRICES'][$key2]['PRINT_'.$keyPrice]=CurrencyFormat($arResult['OFFERS'][$key]['PRICES'][$key2][$keyPrice], $arParams['CURRENCY']);
                }
            }
            foreach ($offer['ITEM_PRICES'] as $key2=>$price)
            {
                foreach ($keys2 as $keyPrice)
                {
                    $arResult['OFFERS'][$key]['ITEM_PRICES'][$key2][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['OFFERS'][$key]['ITEM_PRICES'][$key2][$keyPrice], "RUB", $arParams['CURRENCY']),2);
                    $arResult['OFFERS'][$key]['ITEM_PRICES'][$key2]['PRINT_'.$keyPrice]=CurrencyFormat($arResult['OFFERS'][$key]['ITEM_PRICES'][$key2][$keyPrice], $arParams['CURRENCY']);
                }
            }
            foreach ($keys as $keyPrice)
            {
                $arResult['OFFERS'][$key]['MIN_PRICE'][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['OFFERS'][$key]['MIN_PRICE'][$keyPrice], "RUB", $arParams['CURRENCY']),2);
                $arResult['OFFERS'][$key]['MIN_PRICE']['PRINT_'.$keyPrice]=CurrencyFormat($arResult['OFFERS'][$key]['MIN_PRICE'][$keyPrice], $arParams['CURRENCY']);
            }
            $arResult['OFFERS'][$key]['CATALOG_PRICE_1']=round(CCurrencyRates::ConvertCurrency($arResult['OFFERS'][$key]['CATALOG_PRICE_1'], "RUB", $arParams['CURRENCY']),2);
            $arResult['OFFERS'][$key]['~CATALOG_PRICE_1']=round(CCurrencyRates::ConvertCurrency($arResult['OFFERS'][$key]['~CATALOG_PRICE_1'], "RUB", $arParams['CURRENCY']),2);
        }
    } else
    {
        foreach ($arResult['PRICES'] as $key2=>$price)
        {
            foreach ($keys as $keyPrice)
            {
                $arResult['PRICES'][$key2][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['PRICES'][$key2][$keyPrice], "RUB", $arParams['CURRENCY']),2);
                $arResult['PRICES'][$key2]['PRINT_'.$keyPrice]=CurrencyFormat($arResult['PRICES'][$key2][$keyPrice], $arParams['CURRENCY']);
            }
        }
        foreach ($arResult['ITEM_PRICES'] as $key2=>$price)
        {
            foreach ($keys2 as $keyPrice)
            {
                $arResult['ITEM_PRICES'][$key2][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['ITEM_PRICES'][$key2][$keyPrice], "RUB", $arParams['CURRENCY']),2);
                $arResult['ITEM_PRICES'][$key2]['PRINT_'.$keyPrice]=CurrencyFormat($arResult['ITEM_PRICES'][$key2][$keyPrice], $arParams['CURRENCY']);
            }
        }
        foreach ($keys as $keyPrice)
        {
            $arResult['MIN_PRICE'][$keyPrice]=round(CCurrencyRates::ConvertCurrency($arResult['MIN_PRICE'][$keyPrice], "RUB", $arParams['CURRENCY']),2);
            $arResult['MIN_PRICE']['PRINT_'.$keyPrice]=CurrencyFormat($arResult['MIN_PRICE'][$keyPrice], $arParams['CURRENCY']);
        }
        $arResult['CATALOG_PRICE_1']=round(CCurrencyRates::ConvertCurrency($arResult['CATALOG_PRICE_1'], "RUB", $arParams['CURRENCY']),2);
        $arResult['~CATALOG_PRICE_1']=round(CCurrencyRates::ConvertCurrency($arResult['~CATALOG_PRICE_1'], "RUB", $arParams['CURRENCY']),2);
    }
}

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

/*if ($arResult['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE'] && $arParams['LANGUAGE_ID'] == "en")
{
    $arResult['BREADCRUMBS'][]=[
        'NAME' => $arResult['PROPERTIES']['ANGLIYSKOE_NAIMENOVANIE']['VALUE'],
        'URL'  => $arResult['DETAIL_PAGE_URL'],
    ];
} else
{
    $arResult['BREADCRUMBS'][]=[
        'NAME' => $arResult['NAME'],
        'URL'  => $arResult['DETAIL_PAGE_URL'],
    ];
}*/

$arResult['SLIDER_PHOTOS'] = [];
if ($arResult['DETAIL_PICTURE']['SRC'])
{

    $arResult['SLIDER_PHOTOS'][] = [
        'FULL'  => $arResult['DETAIL_PICTURE']['SRC'],
        'THUMB' => smart_resize_ameton($arResult['DETAIL_PICTURE']['ID'],600,764,JPEG_QUALITY,true,false,true)
    ];

    /*$arResult['SLIDER_PHOTOS'][] = [
        'FULL'  => $arResult['DETAIL_PICTURE']['SRC'],
        'THUMB' => $arResult['DETAIL_PICTURE']['SRC']
    ];*/


}
if ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])
{
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $value)
    {
        $arResult['SLIDER_PHOTOS'][] = [
            'FULL'  => CFile::GetPath($value),
            'THUMB' => smart_resize_ameton($value,600,764,JPEG_QUALITY,true,false,true)
        ];
        /*$arResult['SLIDER_PHOTOS'][] = [
            'FULL'  => CFile::GetPath($value),
            'THUMB' => CFile::GetPath($value)
        ];*/
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
