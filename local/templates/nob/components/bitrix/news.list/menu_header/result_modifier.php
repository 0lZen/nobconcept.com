<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['MENU_CATALOG']=[];
$arFilter = Array('IBLOCK_ID'=>CATALOG_IBLOCK_ID, 'ACTIVE'=>'Y', '<DEPTH_LEVEL'=>3);
$db_list = CIBlockSection::GetList(Array('DEPTH_LEVEL'=>'ASC', 'SORT'=>'ASC'), $arFilter, false,
    [
        'UF_NAME_EN','UF_IN_MENU_HEADER',
        'UF_BNR_1_TITLE','UF_BNR_1_TITLE_EN','UF_BNR_1_URL','UF_BNR_1_URL_EN','UF_BNR_1_FILE',
        'UF_BNR_2_TITLE','UF_BNR_2_TITLE_EN','UF_BNR_2_URL','UF_BNR_2_URL_EN','UF_BNR_2_FILE',
    ]
);
while ($ar_result = $db_list->GetNext())
{
    if (LANGUAGE_ID=='en' && $ar_result['UF_NAME_EN'])
    {
        $ar_result['NAME']=$ar_result['UF_NAME_EN'];
    }
    if (true || $ar_result['UF_IN_MENU_HEADER'])
    {
        if ($ar_result['DEPTH_LEVEL']==1)
        {
            $arBanners=[];

            /*if (LANGUAGE_ID=='en')
            {
                if ($ar_result['UF_BNR_1_TITLE_EN'])
                {
                    $ar_result['UF_BNR_1_TITLE']=$ar_result['UF_BNR_1_TITLE_EN'];
                }
                if ($ar_result['UF_BNR_2_TITLE_EN'])
                {
                    $ar_result['UF_BNR_2_TITLE']=$ar_result['UF_BNR_2_TITLE_EN'];
                }
                if ($ar_result['UF_BNR_1_URL_EN'])
                {
                    $ar_result['UF_BNR_1_URL']=$ar_result['UF_BNR_1_URL_EN'];
                }
                if ($ar_result['UF_BNR_2_URL_EN'])
                {
                    $ar_result['UF_BNR_2_URL']=$ar_result['UF_BNR_2_URL_EN'];
                }
            }

            if ($ar_result['UF_BNR_1_FILE'])
            {
                $arBanners[]=[
                    'IMG'   => smart_resize_ameton($ar_result['UF_BNR_1_FILE'],261,213,JPEG_QUALITY,true,false,true),
                    'TITLE' => $ar_result['UF_BNR_1_TITLE'],
                    'URL'   => $ar_result['UF_BNR_1_URL'],
                ];
            }

            if ($ar_result['UF_BNR_2_FILE'])
            {
                $arBanners[]=[
                    'IMG'   => smart_resize_ameton($ar_result['UF_BNR_2_FILE'],261,213,JPEG_QUALITY,true,false,true),
                    'TITLE' => $ar_result['UF_BNR_2_TITLE'],
                    'URL'   => $ar_result['UF_BNR_2_URL'],
                ];
            }*/

            $arResult['MENU_CATALOG'][$ar_result['ID']]=[
                'NAME'     => $ar_result['NAME'],
                'URL'      => $ar_result['SECTION_PAGE_URL'],
                'BANNERS'  => $arBanners,
                'SUB'      => []
            ];
        } else
        {
            if (isset($arResult['MENU_CATALOG'][$ar_result['IBLOCK_SECTION_ID']]['SUB']))
            {
                $arResult['MENU_CATALOG'][$ar_result['IBLOCK_SECTION_ID']]['SUB'][]=[
                    'NAME' => $ar_result['NAME'],
                    'URL'  => $ar_result['SECTION_PAGE_URL']
                ];
            }
        }
    }
}