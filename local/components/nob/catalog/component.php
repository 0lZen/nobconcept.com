<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @global CMain $APPLICATION */
if (isset($arParams["USE_FILTER"]) && $arParams["USE_FILTER"]=="Y")
{
	$arParams["FILTER_NAME"] = trim($arParams["FILTER_NAME"]);
	if ($arParams["FILTER_NAME"] === '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
		$arParams["FILTER_NAME"] = "arrFilter";
}
else
	$arParams["FILTER_NAME"] = "";

//default gifts
if(empty($arParams['USE_GIFTS_SECTION']))
{
	$arParams['USE_GIFTS_SECTION'] = 'Y';
}
if(empty($arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'] = 3;
}
if(empty($arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'] = 4;
}
if(empty($arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT']))
{
	$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'] = 4;
}

$arParams['ACTION_VARIABLE'] = (isset($arParams['ACTION_VARIABLE']) ? trim($arParams['ACTION_VARIABLE']) : 'action');
if ($arParams["ACTION_VARIABLE"] == '' || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
	$arParams["ACTION_VARIABLE"] = "action";

$smartBase = ($arParams["SEF_URL_TEMPLATES"]["section"]? $arParams["SEF_URL_TEMPLATES"]["section"]: "#SECTION_ID#/");
$arDefaultUrlTemplates404 = array(
	"sections" => "",
	"section" => "#SECTION_ID#/",
	"element" => "#SECTION_ID#/#ELEMENT_ID#/",
	"compare" => "compare.php?action=COMPARE",
	"smart_filter" => $smartBase."filter/#SMART_FILTER_PATH#/apply/"
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"SECTION_ID",
	"SECTION_CODE",
	"ELEMENT_ID",
	"ELEMENT_CODE",
	"action",
);

if($arParams["SEF_MODE"] == "Y")
{
	$arVariables = array();

	$engine = new CComponentEngine($this);
	if (\Bitrix\Main\Loader::includeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->addGreedyPart("#SMART_FILTER_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

    if(!$arVariables['SECTION_ID'])
    {
        $page = $APPLICATION->GetCurPage();
        $s = explode("/",$page);

        if ($s[2]=='catalog')
        {
            if ($s[3])
            {
                $arVariables['SECTION_ID'] = $s[3];
            }
        } else
        if ($s[2])
        {
            $arVariables['SECTION_ID'] = $s[2];
        }
    }

	//echo "11<pre>"; print_r($componentPage); echo "</pre>";
	//echo "22<pre>"; print_r($arParams); echo "</pre>";
    //echo "33<pre>"; print_r($arVariables); echo "</pre>";
    //echo "44<pre>"; print_r($arUrlTemplates); echo "</pre>";

    /*if($arVariables['SECTION_ID'] == "women-men"){
        $arVariables['SECTION_ID'] = array("men", "women");
        $componentPage = "sections";
    }

    if($arVariables['SECTION_ID'] == "jinsi-bryuki"){
        $arVariables['SECTIONS'] = array(29, 33);
        $componentPage = "section_duo";
    }*/

    if ($arVariables['SECTION_ID'] == "zhenskoe")
    {
        if (SITE_ID=='s2')
        {
            header("Location: https://nobconcept.com/en/catalog/women/");
        } else
        {
            header("Location: https://nobconcept.com/catalog/women/");
        }
    }
    if ($arVariables['SECTION_ID'] == "muzhskoe")
    {
        if (SITE_ID=='s2')
        {
            header("Location: https://nobconcept.com/en/catalog/men/");
        } else
        {
            header("Location: https://nobconcept.com/catalog/men/");
        }

    }



    if (SITE_ID=='s2')
    {
        if ($arVariables['SECTION_ID'] == "women")
        {
            $arVariables['SECTIONS']=[];
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>90);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
            while($ar_result = $db_list->Fetch())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
            $componentPage = "section_duo";
        } else
        if ($arVariables['SECTION_ID'] == "men")
        {
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>79);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
            while($ar_result = $db_list->Fetch())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
            $componentPage = "section_duo";
        }
    } else
    {
        if ($arVariables['SECTION_ID'] == "women")
        {
            $arVariables['SECTIONS']=[];
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>3);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
            while($ar_result = $db_list->Fetch())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
            #$arVariables['SECTIONS'] = array(5,24,30,31,33,34,37,40,41,42,45,46);
            $componentPage = "section_duo";
        } else
        if ($arVariables['SECTION_ID'] == "men")
        {
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>1);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
            while($ar_result = $db_list->Fetch())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
            #$arVariables['SECTIONS'] = array(2,22,23,25,26,27,29,38,39);
            $componentPage = "section_duo";
        }
    }








//2,22,23,25,26,27,28,29,
    /*if($arVariables['SECTION_ID'] == "vsya-odezhda"){
        $arVariables['SECTIONS'] = array(2,22,23,25,26,27,29,5,24,30,31,33,34);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "verhnyaya"){
        $arVariables['SECTIONS'] = array(5, 23);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "tolstovki-hudi"){
        $arVariables['SECTIONS'] = array(26,34);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "sweater-jamper"){
        $arVariables['SECTIONS'] = array(5, 23);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "rubashki"){
        $arVariables['SECTIONS'] = array(30, 27);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "futbolki"){
        $arVariables['SECTIONS'] = array(2, 31);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "shorti"){
        $arVariables['SECTIONS'] = array(5, 23);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "verhnyaya"){
        $arVariables['SECTIONS'] = array(5, 23);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "verhnyaya"){
        $arVariables['SECTIONS'] = array(5, 23);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "sumki"){
        $arVariables['SECTIONS'] = array(35);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "aksessuary"){
        $arVariables['SECTIONS'] = array(36);
        $componentPage = "section_duo";
    }

    if($arVariables['SECTION_ID'] == "pidjaki-kostyumi"){
        $arVariables['SECTIONS'] = array(38,40);
        $componentPage = "section_duo";
    }*/

	if ($componentPage === "smart_filter")
		$componentPage = "section";

	if (!$componentPage && isset($_REQUEST["q"]))
    {
        /*if (SITE_ID=='s2')
        {
            $arVariables['SECTIONS']=[];
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y');
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, false);
            while($ar_result = $db_list->GetNext())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
        } else
        {
            $arVariables['SECTIONS']=[];
            $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y');
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
            while($ar_result = $db_list->GetNext())
            {
                $arVariables['SECTIONS'][]=$ar_result['ID'];
            }
        }*/
        #$arVariables['SECTIONS'] = array(2,22,23,25,26,27,29,38,39, 5,24,30,31,33,34,37,40,41,42,45,46);
        $componentPage = "section_duo";
    }
		//$componentPage = "search";

	$b404 = false;
	if(!$componentPage)
	{

		$componentPage = "sections";
		$b404 = true;
	}

	if($componentPage == "section")
	{
		if (isset($arVariables["SECTION_ID"]))
			$b404 |= (intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]);
		else
			$b404 |= !isset($arVariables["SECTION_CODE"]);
	}



	if($b404 && CModule::IncludeModule('iblock'))
	{
		$folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
		if ($folder404 != "/")
			$folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
		if (mb_substr($folder404, -1,null,'UTF-8') == "/")
			$folder404 .= "index.php";

		if ($folder404 != $APPLICATION->GetCurPage(true))
		{
			\Bitrix\Iblock\Component\Tools::process404(
				""
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SHOW_404"] === "Y")
				,$arParams["FILE_404"]
			);
		}
	}



	CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}
else
{
	$arVariables = array();

	$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
	CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

	$componentPage = "";

	$arCompareCommands = array(
		"COMPARE",
		"DELETE_FEATURE",
		"ADD_FEATURE",
		"DELETE_FROM_COMPARE_RESULT",
		"ADD_TO_COMPARE_RESULT",
		"COMPARE_BUY",
		"COMPARE_ADD2BASKET"
	);

	if(isset($arVariables["action"]) && in_array($arVariables["action"], $arCompareCommands))
		$componentPage = "compare";
	elseif(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
		$componentPage = "element";
	elseif(isset($arVariables["ELEMENT_CODE"]) && $arVariables["ELEMENT_CODE"]!='')
		$componentPage = "element";
	elseif(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
		$componentPage = "section";
	elseif(isset($arVariables["SECTION_CODE"]) && $arVariables["SECTION_CODE"]!='')
		$componentPage = "section";
	elseif(isset($_REQUEST["q"]))
		$componentPage = "search";
	else
		$componentPage = "sections";

	$currentPage = htmlspecialcharsbx($APPLICATION->GetCurPage())."?";
	$arResult = array(
		"FOLDER" => "",
		"URL_TEMPLATES" => array(
			"section" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#",
			"element" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",
			"compare" => $currentPage."action=COMPARE",
		),
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases
	);
}

$this->IncludeComponentTemplate($componentPage);
