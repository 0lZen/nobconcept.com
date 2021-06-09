<?
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ini_set('max_execution_time','0');
@ini_set("memory_limit", "3192M");

$arParents=[];
$arBrandsBySku=[];

$res = CIBlockElement::GetList(['XML_ID'=>'ASC'],["IBLOCK_ID"=>[1,8,CATALOG_IBLOCK_ID],"!PROPERTY_BREND"=>false],false,false,
    ['ID','PROPERTY_BREND','CATALOG_TYPE']);
while($arFields = $res->Fetch())
{
    if ($arFields["CATALOG_TYPE"]==1)
    {
        $arBrandsBySku[$arFields["ID"]]=$arFields["PROPERTY_BREND_VALUE"];
    }
    $arParents[$arFields['ID']]=$arFields["PROPERTY_BREND_VALUE"];
}

if (!empty($arParents))
{
    $res = CIBlockElement::GetList(['XML_ID'=>'ASC'],["IBLOCK_ID"=>[4,9,SKU_IBLOCK_ID],'PROPERTY_CML2_LINK'=>array_keys($arParents)],false,false,
        ['ID','PROPERTY_CML2_LINK']);
    while($arFields = $res->Fetch())
    {
        if (isset($arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]]))
        {
            $arBrandsBySku[$arFields["ID"]]=$arParents[$arFields["PROPERTY_CML2_LINK_VALUE"]];
        }
    }
}

global $DB;

$userIDbyOrderID=[];
$res=$DB->query('SELECT `ID`,`USER_ID` FROM `b_sale_order` WHERE `PAYED`="Y"');
while ($row=$res->Fetch())
{
    $userIDbyOrderID[$row['ID']]=$row['USER_ID'];
}


$productsByUserID=[];
$res=$DB->query('SELECT PRODUCT_ID,QUANTITY,ORDER_ID,PRICE FROM b_sale_basket WHERE ORDER_ID>1');
while ($row=$res->Fetch())
{
    if ($userIDbyOrderID[$row['ORDER_ID']])
    {
        if (isset($arBrandsBySku[$row['PRODUCT_ID']]))
        {
            $productsByUserID [$userIDbyOrderID[$row['ORDER_ID']]] [$arBrandsBySku[$row['PRODUCT_ID']]] ['SUMM']+=$row['PRICE']*$row['QUANTITY'];
            $productsByUserID [$userIDbyOrderID[$row['ORDER_ID']]] [$arBrandsBySku[$row['PRODUCT_ID']]] ['ORDERS'] []=$row['ORDER_ID'];
        }
    }
}

$usersInfo=[];
$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"));
while ($ar_cur_user = $rsUsers->Fetch())
{
    $usersInfo[$ar_cur_user['ID']]=[
        'NAME'  => $ar_cur_user['NAME'],
        'EMAIL' => $ar_cur_user['EMAIL'],
        'PHONE' => $ar_cur_user['PERSONAL_PHONE']
    ];
}

$brandsTabs=[];

foreach ($productsByUserID as $userID=>$brands)
{
    foreach ($brands as $brand=>$info)
    {
        $brandsTabs[$brand][]=[
            $usersInfo[$userID]['NAME'],
            $usersInfo[$userID]['EMAIL'],
            $usersInfo[$userID]['PHONE'],
            count(array_unique($info['ORDERS'])),
            (float)$info['SUMM']
        ];
    }
}

/************************************************************************************************/
require($_SERVER["DOCUMENT_ROOT"].'/local/php_interface/classes/XLSXWriter.php');
$writer = new XLSXWriter();

foreach ($brandsTabs as $brand=>$rows)
{
    $header = [
        'Имя'       =>  'string',
        'E-mail'    =>  'string',
        'Телефон'   =>  'string',
        'Заказов'   =>  'integer',
        'Сумма'     =>  'integer',
    ];
    $writer->writeSheetHeader($brand, $header, ['widths'=>[20,40,20,10,10]] );
    foreach($rows as $row)
    {
         $writer->writeSheetRow($brand, $row);
    }
}

$file = 'brands.xlsx';
$writer->writeToFile($file);
if (file_exists($file))
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    unlink($file);
    exit;
}