<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
    <?foreach($arResult["HIDDEN"] as $arItem):?>
        <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
    <?endforeach;
    //prices
    foreach($arResult["ITEMS"] as $key=>$arItem)
    {


        $key = $arItem["ENCODED_ID"];
        if(isset($arItem["PRICE"])):
            if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                continue;
            ?>

            <?/*<div class="bx_filter_parameters_box active">
                    <span class="bx_filter_container_modef"></span>
                    <div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>
                    <div class="bx_filter_block">
                        <div class="bx_filter_parameters_box_container">
                            <div class="bx_filter_parameters_box_container_block">
                                <div class="bx_filter_input_container">
                                    <input
                                        class="min-price"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                            <div class="bx_filter_parameters_box_container_block">
                                <div class="bx_filter_input_container">
                                    <input
                                        class="max-price"
                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                            <div style="clear: both;"></div>

                            <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
                                <?
                                $price1 = $arItem["VALUES"]["MIN"]["VALUE"];
                                $price2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/4);
                                $price3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/2);
                                $price4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])*3)/4);
                                $price5 = $arItem["VALUES"]["MAX"]["VALUE"];
                                ?>
                                <div class="bx_ui_slider_part p1"><span><?=$price1?></span></div>
                                <div class="bx_ui_slider_part p2"><span><?=$price2?></span></div>
                                <div class="bx_ui_slider_part p3"><span><?=$price3?></span></div>
                                <div class="bx_ui_slider_part p4"><span><?=$price4?></span></div>
                                <div class="bx_ui_slider_part p5"><span><?=$price5?></span></div>

                                <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                <div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
                                    <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                    <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                </div>
                            </div>
                            <div style="opacity: 0;height: 1px;"></div>
                        </div>
                    </div>
                </div>*/?>
            <?
            $precision = 2;
            if (Bitrix\Main\Loader::includeModule("currency"))
            {
                $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                $precision = $res['DECIMALS'];
            }
            $arJsParams = array(
                "leftSlider" => 'left_slider_'.$key,
                "rightSlider" => 'right_slider_'.$key,
                "tracker" => "drag_tracker_".$key,
                "trackerWrap" => "drag_track_".$key,
                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                "precision" => $precision,
                "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                "colorAvailableActive" => 'colorAvailableActive_'.$key,
                "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
            );
            ?>
            <script type="text/javascript">
                BX.ready(function(){
                    window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                });
            </script>
        <?endif;
    }

    //not prices
    foreach($arResult["ITEMS"] as $key=>$arItem)
    {

        if(
            empty($arItem["VALUES"])
            || isset($arItem["PRICE"])
        )
            continue;

        if (
            $arItem["DISPLAY_TYPE"] == "A"
            && (
                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
            )
        )
            continue;
        ?>


        <div class="filter-category i-noselect <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>filter-category_opened<?endif?> categori_id_<?=$arItem['ID'];?>"
        <?if($arItem['ID'] == 58 || $arItem['ID'] == 106){?>style="border: 0; margin-top: -.35em; padding: 0;" <?}?>
        >
            <div class="filter-category__header">
                <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(/local/templates/nob/assets/css/images/icons/arrow.svg)" data-was-processed="true" style="background-image: url(&quot;/local/templates/nob/assets/css/images/icons/arrow.svg&quot;);"></div>
                <?if(LANGUAGE_ID =='en'){


                    switch ($arItem["NAME"]) {
                        case 'Одежда':
                            echo "Clothes";
                            break;
                        case 'Размер':
                            echo "Size";
                            break;
                        case 'Цвет':
                            echo "Color";
                            break;
                        case 'Бренд':
                            echo "Brand";
                            break;
                    }
                }else{ echo $arItem["NAME"];}?>

                </div>
                <a href="javascript:void(0)" class="filter-category__reset"><?echo GetMessage("CT_BCSF_DEL_FILTER")?></a>
            </div>




            <?/*<div class="bx_filter_parameters_box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>">
                <span class="bx_filter_container_modef"></span>
                <div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>
                <div class="bx_filter_block">
                    <div class="bx_filter_parameters_box_container">*/?>

            <?
            $arCur = current($arItem["VALUES"]);

            if($arItem['CODE']=='TSVETT'){
                $arItem['DISPLAY_TYPE'] = 'G';
            }

            switch ($arItem["DISPLAY_TYPE"])
            {
            case "A"://NUMBERS_WITH_SLIDER
                ?>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="min-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div class="bx_filter_parameters_box_container_block">
                    <div class="bx_filter_input_container">
                        <input
                                class="max-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                </div>
                <div style="clear: both;"></div>

                <div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
                    <?
                    $value1 = $arItem["VALUES"]["MIN"]["VALUE"];
                    $value2 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/4);
                    $value3 = $arItem["VALUES"]["MIN"]["VALUE"] + round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])/2);
                    $value4 = $arItem["VALUES"]["MIN"]["VALUE"] + round((($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"])*3)/4);
                    $value5 = $arItem["VALUES"]["MAX"]["VALUE"];
                    ?>
                    <div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
                    <div class="bx_ui_slider_part p2"><span><?=$value2?></span></div>
                    <div class="bx_ui_slider_part p3"><span><?=$value3?></span></div>
                    <div class="bx_ui_slider_part p4"><span><?=$value4?></span></div>
                    <div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>

                    <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                    <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                    <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                    <div class="bx_ui_slider_range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
                        <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                        <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                    </div>
                </div>
            <?
            $arJsParams = array(
                "leftSlider" => 'left_slider_'.$key,
                "rightSlider" => 'right_slider_'.$key,
                "tracker" => "drag_tracker_".$key,
                "trackerWrap" => "drag_track_".$key,
                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                "precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
                "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                "colorAvailableActive" => 'colorAvailableActive_'.$key,
                "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
            );
            ?>
                <script type="text/javascript">
                    BX.ready(function(){
                        window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                    });
                </script>
            <?
            break;
            case "B"://NUMBERS
            ?>
                <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
                        <input
                                class="min-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div></div>
                <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
                        <input
                                class="max-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div></div>
            <?
            break;
            case "G"://CHECKBOXES_WITH_PICTURES
            ?>

                <div class="filter-group filter-group_inline filter-group_color">
                    <div class="filter-group__inner">
                        <?foreach ($arItem["VALUES"] as $val => $ar):?>

                            <? $bgImageItem = false; ?>

                            <?if($ar['VALUE']=='Синий' || $ar['VALUE']=='Blue'):
                                $ar['VALUE']='0000FF';
                            elseif($ar['VALUE']=='Желтый' || $ar['VALUE']=='Yellow'):
                                $ar['VALUE']='fdff00';
                            elseif($ar['VALUE']=='Черный' || $ar['VALUE']=='Black'):
                                $ar['VALUE']='000000';
                            elseif($ar['VALUE']=='Красный' || $ar['VALUE']=='Red'):
                                $ar['VALUE']='ff0000';
                            elseif($ar['VALUE']=='Белый' || $ar['VALUE']=='White'):
                                $ar['VALUE']='eaeaea';
                            elseif($ar['VALUE']=='Зелёный' || $ar['VALUE']=='Green'):
                                $ar['VALUE']='15ff00';
                            elseif($ar['VALUE']=='Голубой' || $ar['VALUE']=='Light blue'):
                                $ar['VALUE']='00ffdf';
                            elseif($ar['VALUE']=='Бордовый' || $ar['VALUE']=='Vinous'):
                                $ar['VALUE']='800000';
                            elseif($ar['VALUE']=='Розовый' || $ar['VALUE']=='Pink'):
                                $ar['VALUE']='ff7bb0';
                            elseif($ar['VALUE']=='Серый' || $ar['VALUE']=='Gray'):
                                $ar['VALUE']='8d8d8d';
                            elseif($ar['VALUE']=='Бежевый' || $ar['VALUE']=='Beige'):
                                $ar['VALUE']='e0e094';
                            elseif($ar['VALUE']=='Мультиколор' || $ar['VALUE']=='Multicolor'):
                                $ar['VALUE']='c6f2ff';
                                $bgImageItem = '/upload/images/img-multicolor.png';
                            elseif($ar['VALUE']=='Оранжевый' || $ar['VALUE']=='Orange'):
                                $ar['VALUE']='ffa500';
                            elseif($ar['VALUE']=='Сиреневый' || $ar['VALUE']=='Lilac'):
                                $ar['VALUE']='c8a2c8';
                            elseif($ar['VALUE']=='Фиолетовый' || $ar['VALUE']=='Violet'):
                                $ar['VALUE']='8b00ff';
                            elseif($ar['VALUE']=='Хаки' || $ar['VALUE']=='Khaki'):
                                $ar['VALUE']='806b2a';
                            elseif($ar['VALUE']=='Коричневый' || $ar['VALUE']=='Brown'):
                                $ar['VALUE']='964b00';
                            elseif($ar['VALUE']=='Бирюзовый' || $ar['VALUE']=='Turquoise'):
                                $ar['VALUE']='30d5c8';

                            endif;?>


                            <input
                                    style="display: none"
                                    type="checkbox"
                                    name="<?=$ar["CONTROL_NAME"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<?=$ar["HTML_VALUE"]?>"
                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                            <?
                            $class = "";
                            if ($ar["CHECKED"])
                                $class.= " active";
                            if ($ar["DISABLED"])
                                $class.= " disabled";
                            ?>
                            <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter-checkbox filter-checkbox_color <? echo $ar["DISABLED"] ? 'disabled': '' ?> <?if($ar['CHECKED']): echo 'filter-checkbox_active'; endif;?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">

                                <span class="filter-checkbox__radio" style="<? if ($bgImageItem) { ?>background-image: url(<?=$bgImageItem;?>); background-size: cover; <? } else { ?>background:#<?=$ar['VALUE']?>;<? } ?>"></span>


                                <?/*<span class="bx_filter_param_btn bx_color_sl">
                                        <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                        <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                        <?endif?>
                                    </span>*/?>


                            </label>
                        <?endforeach?>
                    </div>
                </div>
            <?
            break;
            case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
            ?>
            <?foreach ($arItem["VALUES"] as $val => $ar):?>
            <input
                    style="display: none"
                    type="checkbox"
                    name="<?=$ar["CONTROL_NAME"]?>"
                    id="<?=$ar["CONTROL_ID"]?>"
                    value="<?=$ar["HTML_VALUE"]?>"
                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
            />
                <?
                $class = "";
                if ($ar["CHECKED"])
                    $class.= " active";
                if ($ar["DISABLED"])
                    $class.= " disabled";
                ?>
                <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
                                    <span class="bx_filter_param_btn bx_color_sl">
                                        <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                            <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                        <?endif?>
                                    </span>
                    <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                            ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                        endif;?></span>
                </label>
            <?endforeach?>
            <?
            break;
            case "P"://DROPDOWN
            $checkedItemExist = false;
            ?>
                <div class="bx_filter_select_container">
                    <div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                        <div class="bx_filter_select_text" data-role="currentOption">
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar)
                            {
                                if ($ar["CHECKED"])
                                {
                                    echo $ar["VALUE"];
                                    $checkedItemExist = true;
                                }
                            }
                            if (!$checkedItemExist)
                            {
                                echo GetMessage("CT_BCSF_FILTER_ALL");
                            }
                            ?>
                        </div>
                        <div class="bx_filter_select_arrow"></div>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <?foreach ($arItem["VALUES"] as $val => $ar):?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                        <?endforeach?>
                        <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
                            <ul>
                                <li>
                                    <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                        <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                    </label>
                                </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class.= " selected";
                                    if ($ar["DISABLED"])
                                        $class.= " disabled";
                                    ?>
                                    <li>
                                        <label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
                                    </li>
                                <?endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?
            break;
            case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
            ?>
                <div class="bx_filter_select_container">
                    <div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                        <div class="bx_filter_select_text" data-role="currentOption">
                            <?
                            $checkedItemExist = false;
                            foreach ($arItem["VALUES"] as $val => $ar):
                                if ($ar["CHECKED"])
                                {
                                    ?>
                                    <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                    <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                <?endif?>
                                    <span class="bx_filter_param_text">
                                                    <?=$ar["VALUE"]?>
                                                </span>
                                    <?
                                    $checkedItemExist = true;
                                }
                            endforeach;
                            if (!$checkedItemExist)
                            {
                                ?><span class="bx_filter_btn_color_icon all"></span> <?
                                echo GetMessage("CT_BCSF_FILTER_ALL");
                            }
                            ?>
                        </div>
                        <div class="bx_filter_select_arrow"></div>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <?foreach ($arItem["VALUES"] as $val => $ar):?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<?=$ar["HTML_VALUE_ALT"]?>"
                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                        <?endforeach?>
                        <div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none">
                            <ul>
                                <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                    <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                        <span class="bx_filter_btn_color_icon all"></span>
                                        <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                    </label>
                                </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class.= " selected";
                                    if ($ar["DISABLED"])
                                        $class.= " disabled";
                                    ?>
                                    <li>
                                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
                                            <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
                                            <span class="bx_filter_param_text">
                                                        <?=$ar["VALUE"]?>
                                                    </span>
                                        </label>
                                    </li>
                                <?endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?
            break;
            case "K"://RADIO_BUTTONS
            ?>
                <label class="bx_filter_param_label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
                                <span class="bx_filter_input_checkbox">
                                    <input
                                            type="radio"
                                            value=""
                                            name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                            id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                            onclick="smartFilter.click(this)"
                                    />
                                    <span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                </span>
                </label>
                <?foreach($arItem["VALUES"] as $val => $ar):?>
                <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
                                    <span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
                                        <input
                                                type="radio"
                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                            onclick="smartFilter.click(this)"
                                        />
                                        <span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                            endif;?></span>
                                    </span>
                </label>
            <?endforeach;?>
            <?
            break;
            case "U"://CALENDAR
            ?>
                <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                        <?$APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            '',
                            array(
                                'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                'SHOW_INPUT' => 'Y',
                                'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                'SHOW_TIME' => 'N',
                                'HIDE_TIMEBAR' => 'Y',
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                    </div></div>
                <div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
                        <?$APPLICATION->IncludeComponent(
                            'bitrix:main.calendar',
                            '',
                            array(
                                'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                'SHOW_INPUT' => 'Y',
                                'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                'SHOW_TIME' => 'N',
                                'HIDE_TIMEBAR' => 'Y',
                            ),
                            null,
                            array('HIDE_ICONS' => 'Y')
                        );?>
                    </div></div>
            <?
            break;
            default://CHECKBOXES
            ?>

                <div class="filter-group <?if($arItem['CODE']!='BREND') echo ($arItem['CODE']=='RAZMER') ? 'filter-group_columns-3' : 'filter-group_long';?>">
                    <div class="filter-group__inner">
                        <?foreach($arItem["VALUES"] as $val => $ar):
                            //echo "<pre>"; print_r($ar); echo "</pre>";
                            ?>
                            <div class="filter-checkbox <?if($ar['CHECKED']): echo 'filter-checkbox_active'; endif;?>" data-value="<? echo $ar["CONTROL_ID"] ?>">

                                <div data-role="label_<?=$ar["CONTROL_ID"]?>" class="filter-checkbox__radio <? echo $ar["DISABLED"] ? 'disabled': '' ?>">

                                    <input class = "filter_checkbox"
                                           type="checkbox"
                                           data-value="<?=$ar["URL_ID"]?>"
                                           data-code="<?=$arItem["CODE"]?>"
                                           value="<? echo $ar["HTML_VALUE"] ?>"
                                           name="<? echo $ar["CONTROL_NAME"] ?>"
                                           id="<? echo $ar["CONTROL_ID"] ?>"
                                           <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                           onclick="smartFilter.click(this)"
                                    />
                                    <?/*<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?>*/?>
                                    <?
                                    /*if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                        ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                    endif;*/?>
                                </div>

                                <div class="filter-checkbox__name <? echo $ar["DISABLED"] ? 'disabled': '' ?>"  title="<?echo $ar["VALUE"];?>">
                                <?echo $ar["VALUE"];?>
                                </div>
                               <!-- <span style="color: #969696;font-size: .6em;margin: 0 0 0 .33em">(</span><div data-role="count_<?//=$ar["CONTROL_ID"]?>" style="margin: 0" class="filter-checkbox__additional"><?//=$ar["ELEMENT_COUNT"]?></div><span style="color: #969696;font-size: .6em;">)</span>-->

                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            <?
            }
            ?>

            <?/*
                    </div>
                    <div class="clb"></div>
                </div>
            </div>*/?>

        </div>

        <?
    }

    ?>
    <div class="clb"></div>
    <div class="bx_filter_button_box active" style="display:none;">
        <div class="bx_filter_block">
            <div class="bx_filter_parameters_box_container">
                <input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
                <input class="bx_filter_search_reset" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

                <div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) {?> style="display: none;"<?}else{?> style="display: inline-block;"<?}?>>
                    <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                    <span class="arrow"></span>
                    <a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                </div>
            </div>
        </div>
    </div>
</form>
<div style="clear: both;"></div>