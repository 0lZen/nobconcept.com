<?
/**
 * IBLOCK IDs
 */
define('IBLOCK_ID__GALLERY', IBlockData::getByCode('gallery'));
define('IBLOCK_ID__NEWS', IBlockData::getByCode('news'));
define('IB_BRANDS', 5);//бренды
define('IB_CONTENT', 6);//тексты для карточки

define('CATALOG_IBLOCK_ID', 12);
define('SKU_IBLOCK_ID', 13);

define('DELIVERIES',[
    's1' => [
        [
            'NAME'          => 'Самовывоз - бесплатно',
            'PRICE'         => 0,
            'NEED_ADDRESS'  => 'N',
            'DADATA_TYPE'   => ''
        ],
        [
            'NAME'          => 'Москва и МО - бесплатно',
            'PRICE'         => 0,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => 'MSK'
        ],
        [
            'NAME'          => 'Вся Россия - 500 рублей',
            'PRICE'         => 500,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => 'RUSSIA'
        ],
        [
            'NAME'          => 'Весь Мир - 2 500 рублей',
            'PRICE'         => 2500,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => ''
        ]
    ],
    's2' => [
        [
            'NAME'          => 'Pickup - free of charge',
            'PRICE'         => 0,
            'NEED_ADDRESS'  => 'N',
            'DADATA_TYPE'   => ''
        ],
        [
            'NAME'          => 'Moscow and Moscow region-free of charge',
            'PRICE'         => 0,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => 'MSK'
        ],
        [
            'NAME'          => 'All of Russia - 500 rubles',
            'PRICE'         => 500,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => 'RUSSIA'
        ],
        [
            'NAME'          => 'The whole World - 2 500 rubles',
            'PRICE'         => 2500,
            'NEED_ADDRESS'  => 'Y',
            'DADATA_TYPE'   => ''
        ]
    ]
]);

define('DEFAULT_LANG', 'ru');
define('JPEG_QUALITY', 75);

global $arMenuBrands;
$arMenuBrands=[];

$cache = new CPHPCache;
$cacheTime = 300;
$cacheID = md5('menuBrands_'.SITE_ID);
$cachePath = '/menuBrands3';

if ($cache->InitCache($cacheTime, $cacheID, $cachePath))
{
    $arMenuBrands = $cache->GetVars();
} else
{
    $propID=245;

    $resBrands = CIBlockElement::GetList([], ["IBLOCK_ID"=>IB_BRANDS, "ACTIVE"=>'Y'], false, false, ['ID','NAME','CODE']);
    while ($arFieldsBrand = $resBrands->Fetch())
    {
        $arMenuBrands[$arFieldsBrand['ID']] = [
            "NAME"         => $arFieldsBrand['NAME'],
            "URL"          => $arFieldsBrand['CODE']
        ];
    }

    $arBrandsChecked=[];
    $facet = new \Bitrix\Iblock\PropertyIndex\Facet(CATALOG_IBLOCK_ID);
    $resFacet = $facet->query(array('ACTIVE' => 'Y','CATALOG_AVAILABLE' => 'Y'));
    while ($rowFacet = $resFacet->fetch())
    {
        $PID = \Bitrix\Iblock\PropertyIndex\Storage::facetIdToPropertyId($rowFacet["FACET_ID"]);
        if ($PID==$propID)
        {
            if ($rowFacet["ELEMENT_COUNT"]>0)
            {
                $arBrandsChecked[$rowFacet["VALUE"]]=true;
            }
        }
    }

    foreach ($arMenuBrands as $brandID=>$arMenuBrand)
    {
        if (!isset($arBrandsChecked[$brandID]))
        {
            unset($arMenuBrands[$brandID]);
        }
    }

    $cache->StartDataCache();
    $cache->EndDataCache($arMenuBrands);
}

// определяем тип устройства, с которого зашёл посетитель -------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/classes/Mobile_Detect.php');
$detectDevice = new Mobile_Detect;
if ($detectDevice->isMobile())
{
    define('IS_GADGET', 1);
    if ($detectDevice->isTablet())
    {
        define('IS_TABLET', 1);
        define('IS_PHONE', 0);
    } else
    {
        define('IS_TABLET', 0);
        define('IS_PHONE', 1);
    }
    if ($detectDevice->isIphone() || $detectDevice->isIpad())
    {
        define('IS_IPHONE', 1);
        define('IS_ANDROID', 0);
    } else
    if ($detectDevice->version('Android'))
    {
        define('IS_IPHONE', 0);
        define('IS_ANDROID', 1);
    } else
    {
        define('IS_IPHONE', 0);
        define('IS_ANDROID', 0);
    }
} else
{
    define('IS_GADGET', 0);
    define('IS_PHONE', 0);
    define('IS_TABLET', 0);
    define('IS_IPHONE', 0);
    define('IS_ANDROID', 0);
}
// конец --- определяем тип устройства, с которого зашёл посетитель ----------------------------------------

if(
    (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ||
    (isset($_SERVER['HTTP_BX_AJAX']) && $_SERVER['HTTP_BX_AJAX']) ||
    $_GET["testajax"]=='Y'
)
{
    define("IS_AJAX",true);
} else
{
    define("IS_AJAX",false);
}

//получаем настройки
$arSelect = Array("ID", "CODE", "PROPERTY_VALUE","PROPERTY_VALUE_EN", "PROPERTY_FILE");
$arFilter = Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
while($arFields = $res->Fetch())
{
    if ($arFields["PROPERTY_FILE_VALUE"]>0)
    {
        $src=CFile::GetFileArray($arFields["PROPERTY_FILE_VALUE"]);
        $src=$src["SRC"];
        define(strtoupper($arFields["CODE"]."_FILE"),$src);
    } else
    {
        define(strtoupper($arFields["CODE"]."_FILE"),"");
    }
    if (trim($arFields["PROPERTY_VALUE_VALUE"])!="")
    {
        $val=trim(str_replace("\n","<br />",$arFields["PROPERTY_VALUE_VALUE"]));
        $val=str_replace("\r\n","",$val);
        $val=str_replace("\r","",$val);

        if ($arFields["CODE"]=="PHONE")
        {
            $phone=preg_replace("/[^\d]/i","",$val);
            $phoneValURL=$phone[0]."-".$phone[1].$phone[2].$phone[3]."-".$phone[4].$phone[5].$phone[6]."-".$phone[7].$phone[8].$phone[9].$phone[10];
            if ($phone[0]=="7")
            {
                $phoneValURL="+".$phoneValURL;
            }
            define(strtoupper($arFields["CODE"]."_TEXT"),$val);
            define("PHONE_1_URL_TEXT",$phoneValURL);
        } else
        {
            define(strtoupper($arFields["CODE"]."_TEXT"),$val);
        }
    } else
    {
        define(strtoupper($arFields["CODE"]."_TEXT"),"");
    }
    if (trim($arFields["PROPERTY_VALUE_EN_VALUE"])!="")
    {
        $val=trim(str_replace("\n","<br />",$arFields["PROPERTY_VALUE_EN_VALUE"]));
        $val=str_replace("\r\n","",$val);
        $val=str_replace("\r","",$val);

        define(strtoupper('EN_'.$arFields["CODE"]."_TEXT"),$val);
    } else
    {
        define(strtoupper('EN_'.$arFields["CODE"]."_TEXT"),"");
    }
    define(strtoupper($arFields["CODE"]."_ID"),$arFields["ID"]);
}

//ЗАПРЕТ УДАЛЕНИЯ ЭЛЕМЕНТОВ из инфоблока настроек
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", "OnBeforeIBlockElementDeleteHandler");
function OnBeforeIBlockElementDeleteHandler($ID)
{
    $res = CIBlockElement::GetByID($ID);
    if($ar_res = $res->GetNext())
    {
        global $USER;
        if (in_array($ar_res['IBLOCK_ID'],[
            11
        ]))
        {
            global $APPLICATION;
            $APPLICATION->throwException("Элементы в данном инфоблоке нельзя удалить");
            return false;
        }
    }
}