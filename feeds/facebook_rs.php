<?
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ini_set('max_execution_time','0');
@ini_set("memory_limit", "3192M");

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"></rss>');

$channel = $xml->addChild('channel');
$channel->addChild('title','NOBconcept');
$channel->addChild('link','https://nobconcept.com');
$channel->addChild('description','NOBconcept - виртуальный концепт-стор с подборкой самых прогрессивных и ярких брендов от команды NOB.');

$arParents=[];
$res = CIBlockElement::GetList(['XML_ID'=>'ASC'],["IBLOCK_ID"=>CATALOG_IBLOCK_ID,"ACTIVE"=>'Y','PROPERTY_BREND'=>685],false,false,
    ['ID','NAME','DETAIL_PICTURE','DETAIL_TEXT','CATALOG_TYPE','CATALOG_QUANTITY','PROPERTY_BREND','PROPERTY_DISCOUNT_PRICE','CATALOG_GROUP_1']);
while($arFields = $res->Fetch())
{
    if ($arFields['DETAIL_PICTURE'])
    {
        $img = CFile::ResizeImageGet($arFields["DETAIL_PICTURE"], ['width'=>800, 'height'=>800]);
        $img=$img["src"];
    } else
    {
        $img='';
    }
    if ($arFields["CATALOG_TYPE"]==1)
    {
        $arSku[$arFields["ID"]]=[
            'ID'            => $arFields["ID"],
            'PARENT_ID'     => false,
            'NAME'          => $arFields["NAME"],
            'DESCR'         => $arFields["DETAIL_TEXT"],
            'BRAND'         => $arFields["PROPERTY_BREND_VALUE"],
            'IMG'           => $img,
            'URL'           => '/catalog/product/'.$arFields["ID"].'/',
            'PRICE'         => (float)$arFields["CATALOG_PRICE_1"],
            'SALE_PRICE'    => (float)$arFields["PROPERTY_DISCOUNT_PRICE_VALUE"],
            'Q'             => $arFields["CATALOG_QUANTITY"],
        ];

    } else
    {
        $arParents[$arFields['ID']]=[
            'ID'            => $arFields["ID"],
            'NAME'          => $arFields["NAME"],
            'DESCR'         => $arFields["DETAIL_TEXT"],
            'BRAND'         => $arFields["PROPERTY_BREND_VALUE"],
            'IMG'           => $img,
            'URL'           => '/catalog/product/'.$arFields["ID"].'/'
        ];
    }
}

if (!empty($arParents))
{
    $arSku=[];
    $res = CIBlockElement::GetList(['XML_ID'=>'ASC'],["IBLOCK_ID"=>SKU_IBLOCK_ID,"ACTIVE"=>'Y','PROPERTY_CML2_LINK'=>array_keys($arParents)],false,false,
        ['ID','NAME','PROPERTY_CML2_LINK','CATALOG_QUANTITY','PROPERTY_DISCOUNT_PRICE','CATALOG_GROUP_1','PROPERTY_RAZMER']);
    while($arFields = $res->Fetch())
    {
        $arSku[]=[
            'ID'            => $arFields["ID"],
            'PARENT_ID'     => $arFields["PROPERTY_CML2_LINK_VALUE"],
            #'NAME'          => $arFields["NAME"],
            'NAME'          => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['NAME'],
            'DESCR'         => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['DESCR'],
            'BRAND'         => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['BRAND'],
            'IMG'           => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['IMG'],
            #'URL'           => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['URL'].($arFields["PROPERTY_RAZMER_VALUE"]?'#size_'.$arFields["PROPERTY_RAZMER_VALUE"]:''),
            'URL'           => $arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]['URL'],
            'PRICE'         => (float)$arFields["CATALOG_PRICE_1"],
            'SALE_PRICE'    => (float)$arFields["PROPERTY_DISCOUNT_PRICE_VALUE"],
            'Q'             => $arFields["CATALOG_QUANTITY"],
        ];
    }
}

uasort($arSku, function ($a, $b) {
    if ($a['Q'] === $b['Q']) return 0;
    return $a['Q'] < $b['Q'] ? 1 : -1;
});



$usedParentIDs=[];
foreach ($arSku as $sku)
{
    if (!isset($usedParentIDs[$sku['PARENT_ID']]))
    {
        $usedParentIDs[$sku['PARENT_ID']]=true;

        if (mb_strlen($sku["NAME"],'UTF-8')>150)   $sku["NAME"]=mb_substr($sku["NAME"],0,146,'UTF-8')."...";
        if (mb_strlen($sku["DESCR"],'UTF-8')>5000) $sku["DESCR"]=mb_substr($sku["DESCR"],0,4996,'UTF-8')."...";

        $item = $channel->addChild('item');

        $item->addChild('xmlns:g:id',$sku["ID"]);
        if ($sku['PARENT_ID'])
        {
            #$item->addChild('g:item_group_id',$sku["PARENT_ID"]);
        }

        $item->addChild('xmlns:g:title',$sku["NAME"]);

        if ($sku["DESCR"]!='')
        {
            $item->addChild('xmlns:g:description','<![CDATA[ '.$sku["DESCR"].' ]]>');
        }

        $item->addChild('xmlns:g:condition','New');

        $item->addChild('xmlns:g:price',$sku["PRICE"]);
        if ($sku["SALE_PRICE"]>0 && $sku["PRICE"]>$sku["SALE_PRICE"])
        {
            $item->addChild('xmlns:g:sale_price',$sku["SALE_PRICE"]);
        }

        $item->addChild('xmlns:g:link','https://'.$_SERVER['SERVER_NAME'].$sku["URL"]);

        if ($sku["IMG"])
        {
            $item->addChild('xmlns:g:image_link','https://'.$_SERVER['SERVER_NAME'].$sku["IMG"]);
        }

        if ($sku["BRAND"])
        {
            $item->addChild('xmlns:g:brand',$sku["BRAND"]);
        }

        if ($sku["Q"]>0)
        {
            $item->addChild('xmlns:g:availability','in stock');
            $item->addChild('xmlns:g:visibility','published');
        } else
        {
            $item->addChild('xmlns:g:availability','out of stock');
            $item->addChild('xmlns:g:visibility','hidden');
        }
    }
}
global $APPLICATION;
$APPLICATION->RestartBuffer();
header ("Content-Type:text/xml");
echo $xml->asXML();