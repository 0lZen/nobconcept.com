<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

if (!$_GET['sort_by']) $_GET['sort_by']='new';
if (!$_GET['sort_order']) $_GET['sort_order']='desc';

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

$is404=false;

if (!$isAllCatalog)
{
    if (
        mb_strpos($APPLICATION->GetCurDir(),'catalog/filter/')!==false
        || mb_strpos($APPLICATION->GetCurDir(),'sale/filter/')!==false
        || mb_strpos($APPLICATION->GetCurDir(),'pre-order/filter/')!==false
    )
    {
        $isAllCatalog=true;
    }
}

$q=trim(htmlspecialcharsbx($_GET['q']));

$arSection=[];
if (!$isAllCatalog)
{
    if ($arResult["VARIABLES"]["SECTION_ID"])
    {
        $arFilter = ['IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE' => 'Y', 'ID' => $arResult["VARIABLES"]["SECTION_ID"]];
        $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, ['UF_NAME_EN','UF_NAME_TITLE','UF_NAME_TITLE_EN','UF_NAME_DESCR','UF_NAME_DESCR_EN','UF_NAME_H1','UF_NAME_H1_EN']);
        if ($arSection = $db_list->GetNext())
        {
            $SECTION_NAME_TITLE=false;
            $SECTION_NAME_DESCR=false;
            $SECTION_NAME_H1=false;

            if (LANGUAGE_ID=='en')
            {
                if ($arSection['UF_NAME_EN'])
                {
                    $arSection['NAME']=$arSection['UF_NAME_EN'];
                }

                if ($arSection['UF_NAME_TITLE_EN'])
                {
                    $SECTION_NAME_TITLE=$arSection['UF_NAME_TITLE_EN'];
                } else
                {
                    $SECTION_NAME_TITLE=$arSection['NAME'];
                }

                if ($arSection['UF_NAME_DESCR_EN'])
                {
                    $SECTION_NAME_DESCR=$arSection['UF_NAME_DESCR_EN'];
                } else
                {
                    $SECTION_NAME_DESCR=$arSection['NAME'];
                }

                if ($arSection['UF_NAME_H1_EN'])
                {
                    $SECTION_NAME_H1=$arSection['UF_NAME_H1_EN'];
                } else
                {
                    $SECTION_NAME_H1=$arSection['NAME'];
                }
            } else
            {
                if ($arSection['UF_NAME_TITLE'])
                {
                    $SECTION_NAME_TITLE=$arSection['UF_NAME_TITLE'];
                } else
                {
                    $SECTION_NAME_TITLE=$arSection['NAME'];
                }

                if ($arSection['UF_NAME_DESCR'])
                {
                    $SECTION_NAME_DESCR=$arSection['UF_NAME_DESCR'];
                } else
                {
                    $SECTION_NAME_DESCR=$arSection['NAME'];
                }

                if ($arSection['UF_NAME_H1'])
                {
                    $SECTION_NAME_H1=$arSection['UF_NAME_H1'];
                } else
                {
                    $SECTION_NAME_H1=$arSection['NAME'];
                }
            }

            $APPLICATION->SetTitle($SECTION_NAME_H1);
            $APPLICATION->SetPageProperty('title', $SECTION_NAME_TITLE);
            $APPLICATION->SetPageProperty('description', $SECTION_NAME_DESCR);

            if ($arSection['DEPTH_LEVEL']>1)
            {
                $nav = CIBlockSection::GetNavChain(false, $arSection['ID']);
                while ($item = $nav->GetNext())
                {
                    if ($item['ID']==$arSection['ID'])
                    {
                        $APPLICATION->AddChainItem($arSection['NAME'], $arSection['SECTION_PAGE_URL']);
                    } else
                    {
                        if (LANGUAGE_ID=='en')
                        {
                            $arFilter = ['IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE' => 'Y', 'ID' => $item["ID"]];
                            $db_list_nav = CIBlockSection::GetList(Array($by=>$order), $arFilter, false, ['UF_NAME_EN']);
                            if ($arSectionNav = $db_list_nav->GetNext())
                            {
                                if ($arSectionNav['UF_NAME_EN'])
                                {
                                    $item['NAME']=$arSectionNav['UF_NAME_EN'];
                                }
                            }
                        }
                        $APPLICATION->AddChainItem($item['NAME'], $item['SECTION_PAGE_URL']);
                    }
                }
            } else
            {
                $APPLICATION->AddChainItem($arSection['NAME'], $arSection['SECTION_PAGE_URL']);
            }
        } else
        {
            $is404=true;
        }
    } else
    {
        $is404=true;
    }
}

if (!$is404)
{
    ?>
    <div class="block block-common-top" id="common-top">
        <div class="block__inner">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "common",
            array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => SITE_ID,
                "COMPONENT_TEMPLATE" => "common"
            ),
            false
        );?>
        </div>
    </div>

    <div class="block block-catalog<? if ($arParams["IS_SALE"] === "Y") { ?> _sale<? } ?>" id="catalog">
        <div class="block__inner">


    	<header class="block-catalog__header header">
    		<h1 class="header__title">
    			<?$APPLICATION->ShowTitle(false);?>
    		</h1>
            <?
            if ($q)
            {
                ?>
                <h3><?=GetMessage('SEARCH_TITLE')?> &laquo;<?=$q?>&raquo;</h3>
                <?
            }
            ?>
    	</header>

    	<div class="block-catalog__top i-pc">
            <?
            $sort1 = UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'asc' : 'desc')));
            $sort1 = explode("&", $sort1);
            foreach ($sort1 as $ss)
            {
                if (mb_stripos($ss, "bxajaxid",0,'UTF-8') !== false  || mb_stripos($ss, "clear_cache",0,'UTF-8') !== false)
                {
                    $dd = 1;
                } else
                {
                    $sort_new.= $ss."&";
                }
            }
            $sort_new = mb_substr($sort_new, 0, -1,'UTF-8');
            $sort2 = UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'asc' : 'desc')));
            $sort2 = explode("&", $sort2);
            foreach ($sort2 as $ss)
            {
                if (mb_stripos($ss, "bxajaxid",0,'UTF-8') !== false  || mb_stripos($ss, "clear_cache",0,'UTF-8') !== false)
                {
                    $dd = 1;
                } else {
                    $sort_price.= $ss."&";
                }
            }
            $sort_price = mb_substr($sort_price, 0, -1,'UTF-8');
            ?>
      	    <div class="block-catalog__sort catalog-sort i-noselect">
          	    <a href="javascript:void(0)" data-href="<?=$APPLICATION->GetCurPage()?>?<? echo  $sort_new;?>"
                    class="js-catalog-sort catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>"
                    data-value="new"
                    title="<?=GetMessage('SORT_BY')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? GetMessage('SORT_ASC') : GetMessage('SORT_DESC'))?>"
                >
                    <?=GetMessage('SORT_NEW')?><span class="catalog-sort__direction">&nbsp;</span>
                </a>
          	    <a href="javascript:void(0)" data-href="<?=$APPLICATION->GetCurPage()?>?<? echo  $sort_price;?>"
                    class="js-catalog-sort catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>"
                    data-value="price"
                    title="<?=GetMessage('SORT_BY')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? GetMessage('SORT_ASC') : GetMessage('SORT_DESC'))?>"
                >
                    <?=GetMessage('SORT_PRICE')?><span class="catalog-sort__direction">&nbsp;</span>
                </a>
            </div>
    	</div>


        <div class="block-catalog__top catalog-top i-mobile i-noselect">
              <a href="#catalog-filter" class="catalog-top__item catalog-top__item_filter i-modal"><?=GetMessage('FILTER')?><span class="catalog-top__filter-num catalog-top__filter-num_active"> (<span>1</span>)</span></a>
              <div class="catalog-top__item catalog-top__item_sort"><?=GetMessage('SORT')?>
              <div class="block-catalog__sort catalog-sort i-noselect">
              	<a href="javascript:void(0)" data-href="<?=$APPLICATION->GetCurPage()?>?<? echo  $sort_new;?>"
                   class="js-catalog-sort catalog-sort__item  <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>"
                   data-value="new"
                   title="<?=GetMessage('SORT_BY')?> <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? GetMessage('SORT_ASC') : GetMessage('SORT_DESC'))?>"
                >
                       <?=GetMessage('SORT_NEW')?><span class="catalog-sort__direction">&nbsp;</span>
                </a>
              	<a href="javascript:void(0)" data-href="<?=$APPLICATION->GetCurPage()?>?<? echo  $sort_price;?>"
                   class="js-catalog-sort catalog-sort__item  <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>"
                   data-value="price"
                   title="<?=GetMessage('SORT_BY')?> <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? GetMessage('SORT_ASC') : GetMessage('SORT_DESC'))?>"
                >
                    <?=GetMessage('SORT_PRICE')?><span class="catalog-sort__direction">&nbsp;</span>
                </a>
              </div>
              </div>
        </div>

        <div class="block-catalog__main">
            <div class="block-catalog__filter">
                <?
                $GLOBALS[$arParams["FILTER_NAME"]][]=[
                    "LOGIC" => "OR",
                    "CATALOG_AVAILABLE" => "Y",
                    "!PROPERTY_SOLDOUT" => false
                ];
                if ($arParams["FILTER_NAME"]!=$arParams["PREFILTER_NAME"])
                {
                    $GLOBALS[$arParams["PREFILTER_NAME"]][]=[
                        "LOGIC" => "OR",
                        "CATALOG_AVAILABLE" => "Y",
                        "!PROPERTY_SOLDOUT" => false
                    ];
                }

                if ($q)
                {
                    $ids=products_search($q,CATALOG_IBLOCK_ID,true,true);
                    if (!$ids['ITEMS'])
                    {
                        $ids['ITEMS']=0;
                    }
                    $GLOBALS[$arParams["FILTER_NAME"]]['ID'] = $ids['ITEMS'];
                    $GLOBALS[$arParams["PREFILTER_NAME"]]['ID'] = $ids['ITEMS'];
                }

                if ($arParams["IS_SALE"] === "Y")
                {
                    $GLOBALS[$arParams["FILTER_NAME"]]['PROPERTY_HAS_DISCOUNT'] = 'Y';
                    $GLOBALS[$arParams["PREFILTER_NAME"]]['PROPERTY_HAS_DISCOUNT'] = 'Y';
                }

                if ($arParams["IS_PREORDER"] === "Y")
                {
                    $GLOBALS[$arParams["FILTER_NAME"]]['!PROPERTY_PREDZAKAZ'] = false;
                    $GLOBALS[$arParams["PREFILTER_NAME"]]['!PROPERTY_PREDZAKAZ'] = false;
                }

                global $NavNum;
                $NavNum=0;

                if ($arParams["IS_SALE"] !== "Y" && $arParams["IS_PREORDER"] !== "Y" && !$q)
                {
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "catalog_left_menu",
                        Array(
                            "VIEW_MODE" => "TEXT",
                            "SHOW_PARENT_NAME" => "Y",
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => "",
                            "SECTION_URL" => "",
                            "COUNT_ELEMENTS" => "N",
                            "TOP_DEPTH" => "1",
                            "SECTION_FIELDS" => "",
                            "SECTION_USER_FIELDS" => ['UF_NAME_EN'],
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_NOTES" => "",
                            "CACHE_GROUPS" => "N"
                        )
                    );
                }

                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "main",
                    array(
                        "SHOW_ALL_WO_SECTION" => $isAllCatalog?"Y":"N",
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "PREFILTER_NAME" => $arParams["PREFILTER_NAME"],
                        "PRICE_CODE" => [],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SAVE_IN_SESSION" => "N",
                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "NAME",
                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        "SEF_MODE" => $arParams["SEF_MODE"],
                        "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );

                /*if ($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_173'][0]
                    && count($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_173'])==1
                )
                {
                    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ID"=>$GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_173'][0]));
                    if ($enum_fields = $property_enums->GetNext())
                    {

                        $APPLICATION->SetTitle(trim($arSection['NAME'].' '.$enum_fields['VALUE']));
                        $APPLICATION->SetPageProperty('title', trim($arSection['NAME'].' '.$enum_fields['VALUE']));
                    }
                }*/

                $isTitleSetted=false;
                if ($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_245'][0]
                    && count($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_245'])==1
                )
                {
                    $res = CIBlockElement::GetList([], ["IBLOCK_ID"=>IB_BRANDS, "ID"=>$GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_245'][0]], false, false,
                        ['ID','NAME','PROPERTY_DETAIL_TEXT','PROPERTY_DETAIL_TEXT_EN','PREVIEW_PICTURE',
                        'PROPERTY_NAME_TITLE','PROPERTY_NAME_TITLE_EN','PROPERTY_NAME_DESCR','PROPERTY_NAME_DESCR_EN','PROPERTY_NAME_H1','PROPERTY_NAME_H1_EN'
                        ]);
                    if ($arFieldsBrand = $res->Fetch())
                    {
                        $BRAND_NAME_TITLE=false;
                        $BRAND_NAME_DESCR=false;
                        $BRAND_NAME_H1=false;

                        if (LANGUAGE_ID=='en')
                        {
                            if ($arFieldsBrand['PROPERTY_NAME_TITLE_EN_VALUE'])
                            {
                                $BRAND_NAME_TITLE=$arFieldsBrand['PROPERTY_NAME_TITLE_EN_VALUE'];
                            } else
                            {
                                $BRAND_NAME_TITLE=$arFieldsBrand['NAME'];
                            }

                            if ($arFieldsBrand['PROPERTY_NAME_DESCR_EN_VALUE'])
                            {
                                $BRAND_NAME_DESCR=$arFieldsBrand['PROPERTY_NAME_DESCR_EN_VALUE'];
                            } else
                            {
                                $PROPERTY_NAME_DESCR=$arFieldsBrand['NAME'];
                            }

                            if ($arFieldsBrand['PROPERTY_NAME_H1_EN_VALUE'])
                            {
                                $BRAND_NAME_H1=$arFieldsBrand['PROPERTY_NAME_H1_EN_VALUE'];
                            } else
                            {
                                $BRAND_NAME_H1=$arFieldsBrand['NAME'];
                            }

                            $catalogText=$arFieldsBrand['PROPERTY_DETAIL_TEXT_EN_VALUE']['TEXT'];
                            if ($arFieldsBrand['PROPERTY_DETAIL_TEXT_EN_VALUE']['TYPE']=='TEXT')
                            {
                                $catalogText='<p>'.str_replace("\n","<br>",$catalogText).'</p>';
                            }
                        } else
                        {
                            if ($arFieldsBrand['PROPERTY_NAME_TITLE_VALUE'])
                            {
                                $BRAND_NAME_TITLE=$arFieldsBrand['PROPERTY_NAME_TITLE_VALUE'];
                            } else
                            {
                                $BRAND_NAME_TITLE=$arFieldsBrand['NAME'];
                            }

                            if ($arFieldsBrand['PROPERTY_NAME_DESCR_VALUE'])
                            {
                                $BRAND_NAME_DESCR=$arFieldsBrand['PROPERTY_NAME_DESCR_VALUE'];
                            } else
                            {
                                $BRAND_NAME_DESCR=$arFieldsBrand['NAME'];
                            }

                            if ($arFieldsBrand['PROPERTY_NAME_H1_VALUE'])
                            {
                                $BRAND_NAME_H1=$arFieldsBrand['PROPERTY_NAME_H1_VALUE'];
                            } else
                            {
                                $BRAND_NAME_H1=$arFieldsBrand['NAME'];
                            }

                            $catalogText=$arFieldsBrand['PROPERTY_DETAIL_TEXT_VALUE']['TEXT'];
                            if ($arFieldsBrand['PROPERTY_DETAIL_TEXT_VALUE']['TYPE']=='TEXT')
                            {
                                $catalogText='<p>'.str_replace("\n","<br>",$catalogText).'</p>';
                            }
                        }

                        $catalogImg=CFile::GetFileArray($arFieldsBrand['PREVIEW_PICTURE']);
                        $catalogImg=$catalogImg["SRC"];

                        $brandID=$arFieldsBrand["ID"];

                        $APPLICATION->SetTitle(trim($SECTION_NAME_H1.' '.$BRAND_NAME_H1));

                        if ($SECTION_NAME_H1)
                        {
                            $BRAND_NAME_TITLE=$BRAND_NAME_H1;
                            $BRAND_NAME_DESCR=$BRAND_NAME_H1;
                        }

                        if (LANGUAGE_ID=='en')
                        {
                            $APPLICATION->SetPageProperty('title', trim($SECTION_NAME_TITLE.' '.$BRAND_NAME_TITLE).' – shop online on NOBconcept');
                            $APPLICATION->SetPageProperty('description', trim($SECTION_NAME_DESCR.' '.$BRAND_NAME_DESCR).' by young Russian designers online on NOBconcept. ✈ Delivery over all Russia. ☎ +7 (495) 784-04-02');
                        } else
                        {
                            $APPLICATION->SetPageProperty('title', trim($SECTION_NAME_TITLE.' '.$BRAND_NAME_TITLE).' – купить в интернет-магазине NOBconcept');
                            $APPLICATION->SetPageProperty('description', trim($SECTION_NAME_DESCR.' '.$BRAND_NAME_DESCR).' от молодых российских дизайнеров в интернет-магазине NOBconcept. ✈ Доставка по всей России. ☎ +7 (495) 784-04-02');
                        }

                        $isTitleSetted=true;
                    }
                }

                if ($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_152'][0]
                    && count($GLOBALS[$arParams["FILTER_NAME"]]['=PROPERTY_152'])==1
                )
                {
                    $h1=str_replace(['Каталог','Catalog'],'',$APPLICATION->GetTitle());
                    $title=str_replace(['Каталог','Catalog'],'',$APPLICATION->GetPageProperty('title'));
                    $descr=str_replace(['Каталог','Catalog'],'',$APPLICATION->GetPageProperty('description'));
                    if (LANGUAGE_ID=='en')
                    {
                        $APPLICATION->SetTitle('New arrivals '.$h1);
                        $APPLICATION->SetPageProperty('title','New arrivals '.$title.' – shop online on NOBconcept');
                        $APPLICATION->SetPageProperty('description','New arrivals '.$descr.' by young Russian designers online on NOBconcept. ✈ Delivery over all Russia. ☎ +7 (495) 784-04-02');
                    } else
                    {
                        $APPLICATION->SetTitle('Новинки '.$h1);
                        $APPLICATION->SetPageProperty('title','Новинки '.$title.' – купить в интернет-магазине NOBconcept');
                        $APPLICATION->SetPageProperty('description','Новинки '.$descr.' от молодых российских дизайнеров в интернет-магазине NOBconcept. ✈ Доставка по всей России. ☎ +7 (495) 784-04-02');
                    }

                    $isTitleSetted=true;
                }

                if (!$isTitleSetted)
                {
                    if ($arSection['NAME'])
                    {
                        if (LANGUAGE_ID=='en')
                        {
                            $APPLICATION->SetPageProperty('title',$SECTION_NAME_TITLE.' – shop online on NOBconcept');
                            $APPLICATION->SetPageProperty('description',$SECTION_NAME_DESCR.' by young Russian designers online on NOBconcept. ✈ Delivery over all Russia. ☎ +7 (495) 784-04-02');
                        } else
                        {
                            $APPLICATION->SetPageProperty('title',$SECTION_NAME_TITLE.' – купить в интернет-магазине NOBconcept');
                            $APPLICATION->SetPageProperty('description',$SECTION_NAME_DESCR.' от молодых российских дизайнеров в интернет-магазине NOBconcept. ✈ Доставка по всей России. ☎ +7 (495) 784-04-02');
                        }
                    }
                }
                ?>
            </div>

            <div class="block-catalog__products">
    			<?

     			if ($_GET['sort_by']=='price')
                {
     				$arParams["ELEMENT_SORT_FIELD2"] = 'catalog_PRICE_1';
     			} else
     			if ($_GET['sort_by']=='new')
                {
     				$arParams["ELEMENT_SORT_FIELD2"] = 'PROPERTY_DATA_POYAVLENIYA_TOVARA';
     			}

     			if ($_GET['sort_order']=='desc')
                {
     				$arParams["ELEMENT_SORT_ORDER2"] = 'desc';
     			} else
     			if ($_GET['sort_order']=='asc')
                {
     				$arParams["ELEMENT_SORT_ORDER2"] = 'asc';
     			}

     			if ($_GET['showmore']=='Y')
                {
                    $APPLICATION->RestartBuffer();
                }

                $intSectionID = $APPLICATION->IncludeComponent(
                    "ameton:catalog.section",
                    "main",
                    array(
                        'SITE_ID'   => 's1',
                        'IS_SEARCH' => $_GET['q']?'Y':'N',
                        'IS_SHOW_MORE' => $_GET['showmore'],
                        'CURRENCY' => $arParams['CURRENCY'],
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                        "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                        "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "SET_TITLE" => 'N',
                        "SET_BROWSER_TITLE" => 'N',
                        "SET_META_KEYWORDS" => 'N',
                        "SET_META_DESCRIPTION" => 'N',
                        "MESSAGE_404" => $arParams["~MESSAGE_404"],
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "FILE_404" => $arParams["FILE_404"],
                        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                        "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                        "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                        "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),
                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "SHOW_ALL_WO_SECTION" => $isAllCatalog?"Y":"N",


                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                        'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                        'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                        'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                        'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                        'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                        'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        "ADD_SECTIONS_CHAIN" => "N",
                        'ADD_TO_BASKET_ACTION' => $basketAction,
                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                        'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                        'USE_COMPARE_LIST' => 'Y',
                        'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                        'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                        'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                    ),
                    $component
                );

                if ($_GET['showmore']=='Y')
                {
                    die();
                }
                if (IS_AJAX)
                {
                    ?>
                    <script>
                    lazyloadProccess();
                    </script>
                    <?
                }

                if ($catalogText!='')
                {
                    ?>
                    <div class="CatalogText" style="padding-top:50px">
                        <?
                        if ($catalogImg)
                        {
                            ?>
                            <div style="max-width:300px;">
                                <img src="<?=$catalogImg?>" alt="" style="max-width:100%"/>
                            </div>
                            <?
                        }
                        echo $catalogText;
                        ?>
                    </div>
                    <?
                }
                ?>
            	</div>
            </div>

        </div>
    </div>
    <?
} else
{
    CHTTP::SetStatus("404 Not Found");
    @define("ERROR_404","Y");

    Bitrix\Iblock\Component\Tools::process404(
        'Ошибка 404 — страница не найдена'
        ,true
        ,true
        ,true
    );
}