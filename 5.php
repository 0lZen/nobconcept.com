<?require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
die();
$DB->query('delete from `b_sale_order_props_value` where `ORDER_PROPS_ID`=15');

$ar=[];
global $DB;
$res=$DB->query('select * from `b_sale_order_props_value` where `ORDER_PROPS_ID` IN (4,14) ORDER BY ORDER_ID desc');
while ($row=$res->Fetch())
{
    if ($row['ORDER_PROPS_ID']==4)
    {
        $ar[$row['ORDER_ID']]['ADR']=$row['VALUE'];
    } else
    if ($row['ORDER_PROPS_ID']==14)
    {
        $ar[$row['ORDER_ID']]['FLAT']=$row['VALUE'];
    }
}

foreach ($ar as $orderID=>$arAdr)
{
    if ($arAdr['ADR'])
    {
        $adr=[$arAdr['ADR']];
        if ($arAdr['FLAT'])
        {
            $adr[]='кв. '.$arAdr['FLAT'];
        }

        $arQueue=[
            'NAME'             => "'Полный адрес'",
            'CODE'             => "'ADDRESS_FULL'",
            'VALUE'            => "'".$DB->ForSql(join(', ',$adr))."'",
            'ORDER_ID'         => $orderID,
            'ORDER_PROPS_ID'   => 15,
        ];

        $DB->Insert('b_sale_order_props_value', $arQueue, $error.__LINE__, true, false, true);
    }
}

die();

$arSelect = Array("ID", "PROPERTY_BREND");
$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false,false, $arSelect);
while ($arFields = $res->Fetch())
{

    $brandName=$arFields["PROPERTY_BREND_VALUE"];

    $res2 = CIBlockElement::GetList([], ["IBLOCK_ID"=>IB_BRANDS, "NAME"=>$brandName], false, false, ['ID']);
    if ($arFieldsBrand = $res2->Fetch())
    {
        $brandID=$arFieldsBrand["ID"];
    } else
    {
        $el = new CIBlockElement;
        $arLoadProductArray = Array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => IB_BRANDS,
            "NAME"              => $brandName,
            "ACTIVE"            => "Y",
            "CODE"              => CUtil::translit($brandName, "ru" , [
                                    "max_len" => "100", // обрезает символьный код до 100 символов
                                    "change_case" => "L", // буквы преобразуются к нижнему регистру
                                    "replace_space" => "-", // меняем пробелы на нижнее подчеркивание
                                    "replace_other" => "-", // меняем левые символы на нижнее подчеркивание
                                    "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
                                    "use_google" => "false", // отключаем использование google
                                ])
        );
        $brandID = $el->Add($arLoadProductArray);
    }

    if ($brandID)
    {
        CIBlockElement::SetPropertyValues($arFields['ID'], CATALOG_IBLOCK_ID, $brandID, 'BRAND');
    }
}

die();
echo getUserIP();
$geoResult = \Bitrix\Main\Service\GeoIp\Manager::getDataResult(getUserIP());
if ($geoResult)
{
    if ($geoResult->isSuccess())
    {
        $geoResult=$geoResult->getGeoData();
        ?><pre><?print_r($geoResult)?></pre><?
    }
}

die();
$arSelect = Array("ID", "PROPERTY_NAME_RU","PROPERTY_NAME_EN");
$arFilter = Array("IBLOCK_ID"=>2, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false,false, $arSelect);
while ($arFields = $res->Fetch())
{

    $href=explode('href="',$arFields['PROPERTY_NAME_RU_VALUE']);
    $href=$href[1];
    $href=explode('"',$href);
    $hrefRU=$href[0];

    $title=explode('">',$arFields['PROPERTY_NAME_RU_VALUE']);
    $title=$title[1];
    $title=explode('</a>',$title);
    $titleRU=$title[0];

    $href=explode('href="',$arFields['PROPERTY_NAME_EN_VALUE']);
    $href=$href[1];
    $href=explode('"',$href);
    $hrefEN=$href[0];

    $title=explode('">',$arFields['PROPERTY_NAME_EN_VALUE']);
    $title=$title[1];
    $title=explode('</a>',$title);
    $titleEN=$title[0];

    CIBlockElement::SetPropertyValues($arFields['ID'], 2, $hrefRU, 'URL_RU');
    CIBlockElement::SetPropertyValues($arFields['ID'], 2, $titleRU, 'NAME_RU_NEW');
    CIBlockElement::SetPropertyValues($arFields['ID'], 2, $hrefEN, 'URL_EN');
    CIBlockElement::SetPropertyValues($arFields['ID'], 2, $titleEN, 'NAME_EN_NEW');
    ?><pre><?print_r($arFields)?></pre><?
    echo "\n".$hrefRU."\n";
    echo $hrefEN."\n";
    echo $titleRU."\n";
    echo $titleEN."\n\n";
}

die();
$enums=[];
$property_enums_qq = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID"=>8, "PROPERTY_ID"=>106));
while ($property_enums = $property_enums_qq->Fetch())
{
    $enums[$property_enums['VALUE']]=$property_enums['ID'];
    if ($property_enums['ID']>221 && $property_enums['ID']<630)
    {
        #echo $property_enums['ID'].' '.$property_enums['VALUE'].'<br>';
        #\CIBlockPropertyEnum::delete($property_enums['ID']);
        #die();
    }
}

$sects=[];
$sec = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 8),false,['UF_NAME']);
while ($arSec=$sec->Fetch())
{
    if ($arSec['UF_NAME'])
    {
        $sects[$arSec['ID']]=$arSec['UF_NAME'];
    }
}

$arSelect = Array("ID", "NAME","PROPERTY_RAZDEL", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>8, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false,false, $arSelect);
while ($arFields = $res->Fetch())
{
    if ($sects[$arFields['IBLOCK_SECTION_ID']])
    {
        if ($enums[$sects[$arFields['IBLOCK_SECTION_ID']]])
        {
            echo '+++ '.$arFields['NAME']." --- ".$sects[$arFields['IBLOCK_SECTION_ID']].' '.$enums[$sects[$arFields['IBLOCK_SECTION_ID']]].'<br>';
            CIBlockElement::SetPropertyValues($arFields['ID'], 8, $enums[$sects[$arFields['IBLOCK_SECTION_ID']]], 'RAZDEL');
        } else
        {
            $ibpenum = new CIBlockPropertyEnum;
            $propid=$ibpenum->Add(array('PROPERTY_ID'=>106, 'VALUE'=>$sects[$arFields['IBLOCK_SECTION_ID']]));
            CIBlockElement::SetPropertyValues($arFields['ID'], 8, $propid, 'RAZDEL');
            echo '+++ '. $arFields['NAME']." --- ".$sects[$arFields['IBLOCK_SECTION_ID']].' '.$enums[$sects[$arFields['IBLOCK_SECTION_ID']]].'<br>';
            #die();
        }
    } else
    {
        echo '--- '. $arFields['NAME']." --- ".$sects[$arFields['IBLOCK_SECTION_ID']].' '.$enums[$sects[$arFields['IBLOCK_SECTION_ID']]].'<br>';
        CIBlockElement::SetPropertyValues($arFields['ID'], 8, false, 'RAZDEL');
    }
}