<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/autoload.php');
require($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/constants.php');
require($_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/includes/catalog_basket.php');

AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
function BeforeIndexHandler($arFields)
{
    if ($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == CATALOG_IBLOCK_ID && substr($arFields["ITEM_ID"], 0, 1) != "S")
    {
        CModule::IncludeModule("iblock");
        $db_props = CIBlockElement::GetProperty(CATALOG_IBLOCK_ID, $arFields["ITEM_ID"], Array("sort" => "asc"), Array("CODE"=>"ANGLIYSKOE_NAIMENOVANIE"));
        if ($ob = $db_props->Fetch())
        {
            $arFields["TITLE"]=$arFields['TITLE'].' '.$ob["VALUE"];
        }
    }

    return $arFields;
}

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("ControlHandler", "OnBeforeIBlockElementAddUpdateHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ControlHandler", "OnBeforeIBlockElementAddUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockPropertyUpdate", Array("ControlHandler", "OnAfterIBlockPropertyUpdateHandler"));
//AddEventHandler('sale', 'OnOrderNewSendEmail', array('CSendOrderTable', 'OnOrderNewSendEmailHandler'));
//AddEventHandler('sale', 'OnOrderStatusSendEmail', array('CSendOrderTable', 'OnSaleStatusEMailHandler'));
AddEventHandler('sale', 'OnOrderPaySendEmail', array('CSendOrderTable', 'OnOrderNewSendEmailHandler'));
AddEventHandler('sale', 'OnOrderStatusSendEmail', array('CSendOrderTable', 'OnSaleStatusEMailHandler'));
class ControlHandler
{

    function OnBeforeIBlockElementAddUpdateHandler(&$arFields)
    {
        if ($arFields['IBLOCK_ID'] == CATALOG_IBLOCK_ID)
        {
            $brandNameID=end($arFields['PROPERTY_VALUES'][173]);
            $brandNameID=trim($brandNameID['VALUE']);

            if ($brandNameID)
            {
                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, "CODE"=>"BREND", "ID"=>$brandNameID));
                if ($enum_fields = $property_enums->Fetch())
                {
                    $brandName=$enum_fields["VALUE"];

                    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>IB_BRANDS, "NAME"=>$brandName], false, false, ['ID']);
                    if ($arFieldsBrand = $res->Fetch())
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

                    $arFields["PROPERTY_VALUES"]["245"]["n0"]["VALUE"]=$brandID;
                }
            }
        }
    }


    /*function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if($arFields["ID"]>0){
            if($arFields['ID'] == 176){
                $arFields['ACTIVE'] = "N";
            }
        }

        if($arFields["IBLOCK_ID"] == 8){
            $el_val = "";
            foreach ($arFields['PROPERTY_VALUES'][91] as $pv){
                $el_val = $pv;
            }

            if($el_val){
                $arFields['PROPERTY_VALUES'][79][0] = $el_val;
            }
        }

        if ($arFields['IBLOCK_ID'] == 1)
        {
            if ($arFields['IBLOCK_SECTION'][0])
            {
                $sec = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 1, "ID" => $arFields['IBLOCK_SECTION'][0]))->GetNext();
                $property_enums_qq = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID"=>1, "PROPERTY_ID"=>58, "VALUE" => $sec['NAME']));
                if($property_enums = $property_enums_qq->GetNext())
                {
                    $arFields['PROPERTY_VALUES'][58] = $property_enums['ID'];
                }
                else
                {
                    $ibpenum = new CIBlockPropertyEnum;
                    $propid=$ibpenum->Add(array('PROPERTY_ID'=>58, 'VALUE'=>$sec['NAME']));
                    $arFields['PROPERTY_VALUES'][58] = $propid;
                }
            }

            if (!empty($arFields['IBLOCK_SECTION']))
            {
                $nav = CIBlockSection::GetNavChain(false,$arFields['IBLOCK_SECTION'][0])->GetNext();
                if ($nav['ID']==1)
                {
                    $arFields['PROPERTY_VALUES'][112] = 228;
                } else
                if ($nav['ID']==3)
                {
                    $arFields['PROPERTY_VALUES'][112] = 229;
                } else
                {
                    $arFields['PROPERTY_VALUES'][113] = false;
                }
            }
        } else
        if ($arFields['IBLOCK_ID'] == 8)
        {
            #file_put_contents($_SERVER["DOCUMENT_ROOT"]."/ib8",print_r($arFields, true),FILE_APPEND);
            if ($arFields['IBLOCK_SECTION'][0])
            {
                $sec = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 8, "ID" => $arFields['IBLOCK_SECTION'][0]),false,['UF_NAME'])->Fetch();
                if ($sec['UF_NAME'])
                {
                    $property_enums_qq = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID"=>8, "PROPERTY_ID"=>106, "VALUE" => trim($sec['UF_NAME'])));
                    if($property_enums = $property_enums_qq->Fetch())
                    {
                        #file_put_contents($_SERVER["DOCUMENT_ROOT"]."/ib8",'106='.print_r($property_enums, true)."\n",FILE_APPEND);
                        $arFields['PROPERTY_VALUES'][106] = $property_enums['ID'];
                    } else
                    {
                        #file_put_contents($_SERVER["DOCUMENT_ROOT"]."/ib8",'106 add'.$sec['UF_NAME']."\n",FILE_APPEND);
                        $ibpenum = new CIBlockPropertyEnum;
                        $propid=$ibpenum->Add(array('PROPERTY_ID'=>106, 'VALUE'=>trim($sec['UF_NAME'])));
                        $arFields['PROPERTY_VALUES'][106] = $propid;
                    }
                } else
                {
                    $arFields['PROPERTY_VALUES'][106]=false;
                }
            } else
            {
                $arFields['PROPERTY_VALUES'][106]=false;
            }

            if (!empty($arFields['IBLOCK_SECTION']))
            {
                $nav = CIBlockSection::GetNavChain(false,$arFields['IBLOCK_SECTION'][0])->GetNext();
                if ($nav['ID']==79)
                {
                    $arFields['PROPERTY_VALUES'][113] = 230;
                } else
                if ($nav['ID']==90)
                {
                    $arFields['PROPERTY_VALUES'][113] = 231;
                } else
                {
                    $arFields['PROPERTY_VALUES'][113] = false;
                }
            }
        }
    }*/

    function OnAfterIBlockPropertyUpdateHandler(&$arFields)
    {
        if($arFields['CODE'] == 'BREND'){

            $arPropsBrand = [];
            $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>7, "CODE"=>"TEXT_BRAND"));
            while($enum_fields = $property_enums->GetNext())
            {
                $arPropsBrand[$enum_fields["ID"]] = $enum_fields["VALUE"];
            }

            foreach ($arFields['VALUES'] as $key => $value) {
                $property_enums = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID"=>7, "PROPERTY_ID"=>68, "VALUE" => $value['VALUE']));
                if(intval($property_enums->SelectedRowsCount())>0)
                {
                    if (($key = array_search($value['VALUE'], $arPropsBrand)) !== false) {
                        unset($arPropsBrand[$key]);
                    }
                }
                else
                {
                    $ibpenum = new CIBlockPropertyEnum;
                    $propid=$ibpenum->Add(array('PROPERTY_ID'=>68, 'VALUE'=>$value['VALUE']));
                }
            }

            if($arPropsBrand){
                foreach ($arPropsBrand as $key => $value) {
                    if($key>0 && !empty($value)){
                        $ibpenumD = new CIBlockPropertyEnum;
                        $propid=$ibpenumD->Delete($key);
                    }
                }
            }
        }

    }
}

AddEventHandler('main', 'OnBeforeEventSend', Array("SendMail", "my_OnBeforeEventSend"));
class SendMail
{
    function my_OnBeforeEventSend($arFields, $arTemplate)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/filenameOrder1.txt",print_r($arFields,true), FILE_APPEND);
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/filenameOrder2.txt",print_r($arTemplate,true), FILE_APPEND);

    }
}

class CSendOrderTable {
    public static function OnOrderNewSendEmailHandler($ID, &$eventName, &$arFields)
    {
        if ($ID>0 && CModule::IncludeModule('iblock') && CModule::IncludeModule('sale'))
        {
            $arOrder = CSaleOrder::GetByID($ID);

            $arOrder['USER_DESCRIPTION'] = explode(" / ", $arOrder['USER_DESCRIPTION']);

            $arFields['ORDER_DELIVERY'] = $arOrder['USER_DESCRIPTION'][0];
            $price = 0;

            if($arFields['ORDER_DELIVERY'] =='Самовывоз - бесплатно'){
                $arFields['DELIVERY_TYPE'] = 'Самовывоз';
                $arFields['DELIVERY_PRICE'] = '0';
            }elseif($arFields['ORDER_DELIVERY'] =='Москва и МО - бесплатно'){
                $arFields['DELIVERY_TYPE'] = 'Москва и МО';
                $arFields['DELIVERY_PRICE'] = '0';
            }elseif($arFields['ORDER_DELIVERY'] =='Вся Россия - 500 рублей'){
                $arFields['DELIVERY_TYPE'] = 'Вся Россия';
                $arFields['DELIVERY_PRICE'] = '500';
                $price = 500;
            }elseif($arFields['ORDER_DELIVERY'] =='Весь Мир - 2 500 рублей'){
                $arFields['DELIVERY_TYPE'] = 'Весь Мир';
                $arFields['DELIVERY_PRICE'] = '2 500';
                $price = 2500;
            } elseif($arFields['ORDER_DELIVERY'] =='Pickup - free of charge'){
                $arFields['DELIVERY_TYPE'] = 'Самовывоз';
                $arFields['DELIVERY_PRICE'] = '0';
            }elseif($arFields['ORDER_DELIVERY'] =='Moscow and Moscow region-free of charge'){
                $arFields['DELIVERY_TYPE'] = 'Москва и МО';
                $arFields['DELIVERY_PRICE'] = '0';
            }elseif($arFields['ORDER_DELIVERY'] =='All of Russia - 500 rubles'){
                $arFields['DELIVERY_TYPE'] = 'Вся Россия';
                $arFields['DELIVERY_PRICE'] = '500';
                $price = 500;
            }elseif($arFields['ORDER_DELIVERY'] =='The whole World - 2 500 rubles'){
                $arFields['DELIVERY_TYPE'] = 'Весь Мир';
                $arFields['DELIVERY_PRICE'] = '2 500';
                $price = 2500;
            }

            $arOrderParams = [];
            $db_props = CSaleOrderPropsValue::GetOrderProps($ID);
            while ($arProps = $db_props->Fetch())
            {
                $arOrderParams[$arProps['CODE']] = $arProps['VALUE'];
            }

            $arFields['USER_PHONE'] = $arOrderParams['PHONE'];
            $arFields['ORDER_USER'] = $arOrderParams['FIO'];
            $arFields['USER_PHONE'] = $arOrder['USER_DESCRIPTION'][1];
            if(!$arFields['USER_PHONE']){
                if ($prop = CSaleOrderProps::GetList([], ['CODE' => 'PHONE', "ORDER_ID" => $ID])->Fetch()) {
                    $arFields['USER_PHONE'] = $prop['VALUE'];
                }
            }
            $arFields['ORDER_LIST'] = '<table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 700px;">';
            $rsBasket = CSaleBasket::GetList(array(), array('ORDER_ID' => $ID));

            $ss = 1;
            while ($arBasket = $rsBasket->GetNext()) {

                $arPicture = false;
                $prod = $art = $size = $color = "-";
                if ($arProduct_qq = CIBlockElement::GetByID($arBasket['PRODUCT_ID'])->GetNextElement()) {
                    $arProduct = $arProduct_qq->GetFields();
                    $arProduct_props = $arProduct_qq->GetProperties();
                    $art = $arProduct_props['CML2_ARTICLE']['VALUE'];
                    $size = $arProduct_props['RAZMER']['VALUE'];
                    $color = $arProduct_props['TSVETT']['VALUE'];

                    if ($arProduct['PREVIEW_PICTURE'] > 0) {
                        $fileID = $arProduct['PREVIEW_PICTURE'];
                    } elseif ($arProduct['DETAIL_PICTURE'] > 0) {
                        $fileID = $arProduct['DETAIL_PICTURE'];
                    } else {
                        $fileID = 0;
                    }
                    $prod = $arBasket['PRODUCT_ID'];
                    $arPicture = CFile::ResizeImageGet($fileID, array('width' => 90, 'height' => 110));
                    $arPicture['SIZE'] = getimagesize($_SERVER['DOCUMENT_ROOT'].$arPicture['src']);
                }

                if($fileID==0){
                    $mxResult = CCatalogSku::GetProductInfo($arBasket['PRODUCT_ID']);
                    if ($arProduct_qq = CIBlockElement::GetByID($mxResult['ID'])->GetNextElement()) {
                        $arProduct = $arProduct_qq->GetFields();
                        $arProduct_props = $arProduct_qq->GetProperties();

                        $art = $arProduct_props['CML2_ARTICLE']['VALUE'];
                        if ($arProduct['PREVIEW_PICTURE'] > 0) {
                            $fileID = $arProduct['PREVIEW_PICTURE'];
                        } elseif ($arProduct['DETAIL_PICTURE'] > 0) {
                            $fileID = $arProduct['DETAIL_PICTURE'];
                        } else {
                            $fileID = 0;
                        }
                        $prod = $arProduct['ID'];
                        $arPicture = CFile::ResizeImageGet($fileID, array('width' => 90, 'height' => 110));
                        $arPicture['SIZE'] = getimagesize($_SERVER['DOCUMENT_ROOT'].$arPicture['src']);
                    }
                }


                $arFields['ORDER_LIST'] .= '<tr>'
                    . '<td style="width: 10%;">'.($arPicture ? '<img src="//'.$GLOBALS['SERVER_NAME'].(str_replace(array('+', ' '), '%20', $arPicture['src'])).'" <img style="width: 70px;max-width: 100%;padding-top: 15px;padding-bottom: 15px;">' : '').'</td>'
                    . '<td style="width:35%;padding-left: 15px;"><a href="//'.$GLOBALS['SERVER_NAME'].'/catalog/product/'.$prod.'/"><b>'.$arBasket['NAME'].'</b></a></td>';

                $arFields['ORDER_LIST'] .= '<td style="width: 40%;">
                Артикул <br /><b>'.$art.'</b><br />
                Размер <br /><b>'.$size.'</b><br />
                <b>'.(int)$arBasket['QUANTITY'].' шт.</b><br />
                Цвет<br /><b>'.$color.'</b><br />
                </td>';


                $arFields['ORDER_LIST'] .= '<td style="width:15%;text-align: right;"><b>'.number_format($arBasket['PRICE'], 2, '.', ' ').' &#8381;</b></td>'
                    . '</tr>';
                if($ss < count($arBasket)){
                    $arFields['ORDER_LIST'] .= '<tr>
            <td colspan="4"><span style="border-bottom-color:#eaeaea;border-bottom-style:solid;border-bottom-width:1px;display:block;height:1px;width:100%;margin-top: 7px;margin-bottom: 7px;"></span></td>
        </tr>';
                }

                $price += $arBasket['PRICE']*(int)$arBasket['QUANTITY'];
                $ss++;
            }
            $arFields['PRICE'] = number_format($price, 2, '.', ' ')."  &#8381;";
            $arFields['ORDER_LIST'] .= '</table>';

            CEvent::Send("MY_SALE_ORDER_PAID", $arOrder["LID"], $arFields,"");

            return false;
        }
    }

    public static function OnSaleStatusEMailHandler($ID, &$eventName, &$arFields, $val) {
        if ($ID>0 && CModule::IncludeModule('iblock') && CModule::IncludeModule('sale')){
            $arOrderParams = [];
            $db_props = CSaleOrderPropsValue::GetOrderProps($ID);
            while ($arProps = $db_props->Fetch())
            {
                $arOrderParams[$arProps['CODE']] = $arProps['VALUE'];
            }
            /*ob_start();
            echo "11<pre>"; print_r($arOrderParams); echo "</pre>";
            $res = ob_get_contents();
            ob_end_clean();
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/tessst_props'.time().rand(100,3000000).'.txt',$res);*/
            $arFields['FIO'] = $arOrderParams['FIO'];

            if ($val=='J')
            {
                $arOrder = CSaleOrder::GetByID($ID);
                CEvent::Send("MY_SALE_STATUS_CHANGED_J", $arOrder["LID"], $arFields,"");
                return false;
            }
        }
    }

}

function products_search($q,$iblockID,$stemmingFirst=true,$onlyIDinResult=true,$countOnPage=500,$pageNumber=false,$pagerTemplate='.default')
{
    $arResult=array();

    $q=trim($q);
    if ($q!="" && $iblockID>0)
    {
        CPageOption::SetOptionString("main", "nav_page_in_session", "N");

        CModule::IncludeModule("search");
        $obSearch = new CSearch;
        $obSearch->SetOptions(array('ERROR_ON_EMPTY_STEM' => false));

        $paramArr1=array('QUERY' => $q, 'SITE_ID' => LANG, 'MODULE_ID' => 'iblock','CHECK_DATES' => 'Y');
        $paramArr2=array("TITLE_RANK" => "DESC", "RANK"=>"DESC");
        $paramArr3=array(array("=MODULE_ID" => "iblock", "!ITEM_ID" => "S%", "=PARAM2" => array($iblockID)));

        $paramArr3['STEMMING']=$stemmingFirst;
        $obSearch->Search($paramArr1,$paramArr2,$paramArr3);

        //Если ничего не нашлось, меняем способ поиска и пробум искать ещё раз
        if (!$obSearch->result->num_rows)
        {
            $stemmingFirst ? $stemmingFirst=false : $stemmingFirst=true;

            $paramArr3['STEMMING']=$stemmingFirst;
            $obSearch->Search($paramArr1,$paramArr2,$paramArr3);
        }

        if ($pageNumber)
        {
            $obSearch->NavStart($countOnPage, false, $pageNumber);
        } else
        {
            $obSearch->NavStart($countOnPage, false);
        }

        while ($arSearch = $obSearch->Fetch())
        {
            if ($onlyIDinResult)
            {
                $arResult["ITEMS"][]=$arSearch["ITEM_ID"];
            } else
            {
                $arResult["ITEMS"][]=$arSearch;
            }
        }

        $navComponentObject = null;
        if ($obSearch->NavPageCount>1)
        {
            $arResult["NAV_STRING"] = $obSearch->GetPageNavStringEx($navComponentObject,  '', $pagerTemplate, 'N');
        } else
        {
            $arResult["NAV_STRING"]='';
        }
        $arResult["ELEMENTS_COUNT"]=$obSearch->NavRecordCount;
        $arResult["PAGES_COUNT"]=$obSearch->NavPageCount;
    }

    return $arResult;
}

// Ресайз фоток //////////////////////////////////////////////////////////////////////////////////////////////////////////////
function smart_resize_ameton($fileID,$width=1000,$height=1000,$quality=70,$crop=false,$isOptimizeOnly=false,$pngToJpg=false)
{
    if (is_array($fileID)) $fileID = $fileID['ID'];

    if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/upload/resize/')) mkdir($_SERVER['DOCUMENT_ROOT'].'/upload/resize/');

    if ($fileID!="")
    {
        $sFileDest=$fileID.'_'.$width.'x'.$height.'x'.$quality;
        if ($crop)
        {
            $sFileDest.='_c';
        }
        if ($isOptimizeOnly)
        {
            $sFileDest.='_o';
        }
        $sDirDest='/upload/resize/'.$fileID;
        if (!is_dir($_SERVER['DOCUMENT_ROOT'].$sDirDest)) mkdir($_SERVER['DOCUMENT_ROOT'].$sDirDest);

        $src=$sDirDest.'/'.$sFileDest.'.jpg';
        if (is_file($_SERVER['DOCUMENT_ROOT'].$src))
        {
            return $src;
        }

        if (!$pngToJpg)
        {
            $src=$sDirDest.'/'.$sFileDest.'.png';
            if (is_file($_SERVER['DOCUMENT_ROOT'].$src))
            {
                return $src;
            }
        }
    }

    $src=CFile::GetFileArray($fileID);

    $name = $fileID;

    $file=$_SERVER['DOCUMENT_ROOT'].$src["SRC"];
    $fileWidth=$src["WIDTH"];
    $fileHeight=$src["HEIGHT"];

    if ($fileWidth<$width && $fileHeight<$height)
    {
        $isOptimizeOnly=true;
    }

    if (!is_file($file))
    {
        return '';
    }

    $info = pathinfo($file);
    $ext = $info['extension'];

    if ($ext=="gif")
    {
        $pic = CFile::ResizeImageGet($fileID, array('width' => $width, 'height' => $height));
        $src = $pic["src"];
    } else
    {

        $result=array();
        $ext = $ext=='jpeg' ? 'jpg' : $ext;
        $sFileDest=$name.'_'.$width.'x'.$height.'x'.$quality;
        if ($crop)
        {
            $sFileDest.='_c';
        }
        if ($isOptimizeOnly)
        {
            $sFileDest.='_o';
        }

        $sDirDest='/upload/resize/'.$fileID;
        if (!is_dir($_SERVER['DOCUMENT_ROOT'].$sDirDest)) mkdir($_SERVER['DOCUMENT_ROOT'].$sDirDest);

        if ($pngToJpg && $ext=='png')
        {
            $ext='jpg';
        }

        $src=$sDirDest.'/'.$sFileDest.'.'.mb_strtolower($ext,'UTF-8');
        if (!is_file($_SERVER['DOCUMENT_ROOT'].$src))
        {
            if (!$isOptimizeOnly)
            {
                if ($crop)
                {
                    $command="convert {$file} -interlace Plane -strip -quality $quality -resize {$width}x{$height}^ -gravity Center -extent {$width}x{$height} ".$_SERVER['DOCUMENT_ROOT'].$src;
                } else
                {
                    $command="convert {$file} -interlace Plane -strip -quality $quality -resize {$width}x{$height} ".$_SERVER['DOCUMENT_ROOT'].$src;
                }

                exec($command, $output);
                if (stristr($ext,'png'))
                {
                    $command = "optipng -o7 ".$_SERVER['DOCUMENT_ROOT'].$src." -out ".$_SERVER['DOCUMENT_ROOT'].$src;
                    exec($command, $output);
                } else
                if ($ext!='webp')
                {
                    $command = "jpegtran -copy none -optimize -progressive -outfile ".$_SERVER['DOCUMENT_ROOT'].$src." ".$_SERVER['DOCUMENT_ROOT'].$src;
                    exec($command, $output);
                }
            } else
            {
                copy($file,$_SERVER['DOCUMENT_ROOT'].$src);
                if (stristr($ext,'png'))
                {
                    $command = "optipng -o7 ".$file." -out ".$_SERVER['DOCUMENT_ROOT'].$src;
                    exec($command, $output);
                } else
                {
                    $command = "jpegtran -copy none -optimize -progressive -outfile ".$_SERVER['DOCUMENT_ROOT'].$src." ".$file;
                    exec($command, $output);
                }
            }
        }
    }
    return $src;
}

AddEventHandler("main", "OnFileDelete", "customFileDelete");
function customFileDelete($arFile)
{
    $fileId = $arFile['ID'];
    $dir = $_SERVER['DOCUMENT_ROOT'].'/upload/resize/'.$fileId.'/';
    if (is_dir($dir)) customFileRemoveDirectory($dir);
}

function customFileRemoveDirectory($path)
{
    $files = glob($path . '/*');
    foreach ($files as $file) is_dir($file) ? customFileRemoveDirectory($file) : unlink($file);
    rmdir($path);
    return;
}
// Конец --- Ресайз фоток //////////////////////////////////////////////////////////////////////////////////////////////////////////////

AddEventHandler("main", "OnBeforeProlog", "MyOnBeforePrologHandler");
function MyOnBeforePrologHandler()
{
    if ($_GET['enable_currency']=='Y')
    {
        $_SESSION['enable_currency']='Y';
    } else
    if ($_GET['enable_currency']=='N')
    {
        unset($_SESSION['enable_currency']);
    }

    $_SESSION['enable_currency']='Y';
    if ($_SESSION['enable_currency']=='Y')
    {
        if (!isUserAgentBot())
        {
            if ($_COOKIE['CURRENCY_CATALOG'])
            {
                $_SESSION['CURRENCY_CURRENT']=$_COOKIE['CURRENCY_CATALOG'];
            } else
            {
                if (!$_SESSION['IP_COUNTRY'])
                {
                    $_SESSION['IP_COUNTRY']='RU';

                    $geoResult = \Bitrix\Main\Service\GeoIp\Manager::getDataResult(getUserIP());
                    if ($geoResult)
                    {
                        if ($geoResult->isSuccess())
                        {
                            $geoResult=$geoResult->getGeoData();
                            if ($geoResult->countryCode)
                            {
                                $_SESSION['IP_COUNTRY']=$geoResult->countryCode;
                            }
                        }
                    }
                }

                if ($_SESSION['IP_COUNTRY']=='US')
                {
                    $_SESSION['CURRENCY_CURRENT']='USD';
                } else
                if ($_SESSION['IP_COUNTRY']=='RU')
                {
                    $_SESSION['CURRENCY_CURRENT']='RUB';
                } else
                {
                    $_SESSION['CURRENCY_CURRENT']='EUR';
                }
            }
        } else
        {
            $_SESSION['CURRENCY_CURRENT']='RUB';
        }
    } else
    {
        $_SESSION['CURRENCY_CURRENT']='RUB';
    }
}

function getUserIP()
{
    return $_SERVER['REMOTE_ADDR'];
}

function isUserAgentBot()
{
    $ua=trim($_SERVER['HTTP_USER_AGENT']);

    if (mb_strpos($ua,'1C+Enterprise')!==false || mb_strpos($ua,'1C Enterprise')!==false) return 1;

    global $USER;
    if ($USER->IsAuthorized()) return 0;

    if ($ua=="") return 1;
    if ($ua=="Mozilla/5.0") return 1;
    if (mb_strpos($ua,'YandexSearchBrowser')!==false) return 0;
    if (mb_strpos($ua,'Yandex')!==false && mb_strpos($ua,'Android')!==false) return 0;

    return preg_match("~(BitrixCloud|Google|Go-http-client|Wallarm|Sleuth|letsencrypt|OpenStreetMap|Fuzz|2ip|haskell|Office|SkypeUriPreview|HeadlessChrome|Riddler|axios|AHC|github|CFNetwork|Datanyze|DarkStore|BingPreview|python|XMLRPC|Yahoo|alexa|WhatsApp|okhttp|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl|vkShare|facebook)~i",$ua);
}

function getPropertyByCode($propertyCollection, $code)  {
    foreach ($propertyCollection as $property)
    {
        if($property->getField('CODE') == $code)
            return $property;
    }
}