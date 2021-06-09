<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/pages.php');
?>
<!-- Modals -->
<?/*<div class="modal modal_form" id="catalog-filter">
    <div class="modal__wrapper">
        <div class="modal__outer">
            <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

            <div class="catalog-filter__header">Фильтр</div>

            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "catalog_categories",
                Array(
                    "ROOT_MENU_TYPE" => "left",
                    "MAX_LEVEL" => "1"
                )
            );?>

            <div class="block-catalog__filter">
                <? $filter['clothing'] = (isset($_GET['clothing']) && is_string($_GET['clothing']) ? explode(',', $_GET['clothing']) : array()); if (count($filter['clothing']) === 1 && $filter['clothing'][0] == '') $filter['clothing'] = array(); ?>
                <div class="filter-category filter-category_opened i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Одежда</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_long" data-key="clothing">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('trousers', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Брюки</div>
                                <div class="filter-checkbox__additional">(32)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jeans', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Джинсы</div>
                                <div class="filter-checkbox__additional">(24)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('vests', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Жилеты</div>
                                <div class="filter-checkbox__additional">(4)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сardigans', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Кардиганы</div>
                                <div class="filter-checkbox__additional">(44)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('suits', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Костюмы</div>
                                <div class="filter-checkbox__additional">(75)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jackets', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Куртки</div>
                                <div class="filter-checkbox__additional">(36)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пальто и плащи</div>
                                <div class="filter-checkbox__additional">(6)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('coats', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пиджаки</div>
                                <div class="filter-checkbox__additional">(13)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('polo', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Поло</div>
                                <div class="filter-checkbox__additional">(50)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shirts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Рубашки</div>
                                <div class="filter-checkbox__additional">(63)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('sweaters', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Свитеры</div>
                                <div class="filter-checkbox__additional">(22)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('smokings', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Смокинги</div>
                                <div class="filter-checkbox__additional">(9)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('t-shirts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Футболки</div>
                                <div class="filter-checkbox__additional">(87)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shorts', $filter['clothing']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Шорты</div>
                                <div class="filter-checkbox__additional">(12)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['footwear'] = (isset($_GET['footwear']) && is_string($_GET['footwear']) ? explode(',', trim($_GET['footwear'])) : array()); if (count($filter['footwear']) === 1 && $filter['footwear'][0] == '') $filter['footwear'] = array(); ?>
                <div class="filter-category <?=(count($filter['footwear']) ? 'filter-category_opened' : '')?> i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Обувь</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_long" data-key="footwear">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('trousers', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Брюки</div>
                                <div class="filter-checkbox__additional">(32)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jeans', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Джинсы</div>
                                <div class="filter-checkbox__additional">(24)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('vests', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Жилеты</div>
                                <div class="filter-checkbox__additional">(4)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сardigans', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Кардиганы</div>
                                <div class="filter-checkbox__additional">(44)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('suits', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Костюмы</div>
                                <div class="filter-checkbox__additional">(75)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jackets', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Куртки</div>
                                <div class="filter-checkbox__additional">(36)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пальто и плащи</div>
                                <div class="filter-checkbox__additional">(6)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('coats', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пиджаки</div>
                                <div class="filter-checkbox__additional">(13)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('polo', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Поло</div>
                                <div class="filter-checkbox__additional">(50)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shirts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Рубашки</div>
                                <div class="filter-checkbox__additional">(63)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('sweaters', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Свитеры</div>
                                <div class="filter-checkbox__additional">(22)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('smokings', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Смокинги</div>
                                <div class="filter-checkbox__additional">(9)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('t-shirts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Футболки</div>
                                <div class="filter-checkbox__additional">(87)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shorts', $filter['footwear']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Шорты</div>
                                <div class="filter-checkbox__additional">(12)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['bags'] = (isset($_GET['bags']) && is_string($_GET['bags']) ? explode(',', $_GET['bags']) : array()); if (count($filter['bags']) === 1 && $filter['bags'][0] == '') $filter['bags'] = array(); ?>
                <div class="filter-category <?=(count($filter['bags']) ? 'filter-category_opened' : '')?> i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Сумки</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_long" data-key="bags">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('trousers', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Брюки</div>
                                <div class="filter-checkbox__additional">(32)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jeans', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Джинсы</div>
                                <div class="filter-checkbox__additional">(24)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('vests', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Жилеты</div>
                                <div class="filter-checkbox__additional">(4)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сardigans', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Кардиганы</div>
                                <div class="filter-checkbox__additional">(44)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('suits', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Костюмы</div>
                                <div class="filter-checkbox__additional">(75)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jackets', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Куртки</div>
                                <div class="filter-checkbox__additional">(36)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пальто и плащи</div>
                                <div class="filter-checkbox__additional">(6)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('coats', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пиджаки</div>
                                <div class="filter-checkbox__additional">(13)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('polo', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Поло</div>
                                <div class="filter-checkbox__additional">(50)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shirts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Рубашки</div>
                                <div class="filter-checkbox__additional">(63)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('sweaters', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Свитеры</div>
                                <div class="filter-checkbox__additional">(22)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('smokings', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Смокинги</div>
                                <div class="filter-checkbox__additional">(9)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('t-shirts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Футболки</div>
                                <div class="filter-checkbox__additional">(87)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shorts', $filter['bags']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Шорты</div>
                                <div class="filter-checkbox__additional">(12)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['accessories'] = (isset($_GET['accessories']) && is_string($_GET['accessories']) ? explode(',', $_GET['accessories']) : array()); if (count($filter['accessories']) === 1 && $filter['accessories'][0] == '') $filter['accessories'] = array(); ?>
                <div class="filter-category <?=(count($filter['accessories']) ? 'filter-category_opened' : '')?> i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Аксессуары</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_long" data-key="accessories">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('trousers', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="trousers">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Брюки</div>
                                <div class="filter-checkbox__additional">(32)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jeans', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="jeans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Джинсы</div>
                                <div class="filter-checkbox__additional">(24)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('vests', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="vests">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Жилеты</div>
                                <div class="filter-checkbox__additional">(4)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сardigans', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="сardigans">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Кардиганы</div>
                                <div class="filter-checkbox__additional">(44)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('suits', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="suits">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Костюмы</div>
                                <div class="filter-checkbox__additional">(75)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('jackets', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="jackets">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Куртки</div>
                                <div class="filter-checkbox__additional">(36)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('сoats-and-raincoats', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="сoats-and-raincoats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пальто и плащи</div>
                                <div class="filter-checkbox__additional">(6)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('coats', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="coats">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Пиджаки</div>
                                <div class="filter-checkbox__additional">(13)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('polo', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="polo">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Поло</div>
                                <div class="filter-checkbox__additional">(50)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shirts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Рубашки</div>
                                <div class="filter-checkbox__additional">(63)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('sweaters', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="sweaters">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Свитеры</div>
                                <div class="filter-checkbox__additional">(22)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('smokings', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="smokings">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Смокинги</div>
                                <div class="filter-checkbox__additional">(9)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('t-shirts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="t-shirts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Футболки</div>
                                <div class="filter-checkbox__additional">(87)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('shorts', $filter['accessories']) ? 'filter-checkbox_active' : '')?>" data-value="shorts">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Шорты</div>
                                <div class="filter-checkbox__additional">(12)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['size'] = (isset($_GET['size']) && is_string($_GET['size']) ? explode(',', $_GET['size']) : array()); if (count($filter['size']) === 1 && $filter['size'][0] == '') $filter['size'] = array(); ?>
                <div class="filter-category filter-category_opened i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Размер</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_columns-3" data-key="size">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('40', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="40">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">40</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('42', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="42">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">42</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('46', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="46">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">46</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('40', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="48">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">48</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('50', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="50">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">50</div>
                            </div>

                            <div class="filter-checkbox <?=(in_array('52', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="52">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">52</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('54', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="54">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">54</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('56', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="56">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">56</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('58', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="58">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">58</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('60', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="60">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">60</div>
                            </div>

                            <div class="filter-checkbox <?=(in_array('62', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="62">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">62</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('64', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="64">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">64</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('66', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="66">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">66</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('68', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="68">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">68</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('70', $filter['size']) ? 'filter-checkbox_active' : '')?>" data-value="70">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">70</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['color'] = (isset($_GET['color']) && is_string($_GET['color']) ? explode(',', $_GET['color']) : array()); if (count($filter['color']) === 1 && $filter['color'][0] == '') $filter['color'] = array(); ?>
                <div class="filter-category filter-category_opened i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Цвет</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_inline filter-group_color" data-key="color">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('white', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="white">
                                <div class="filter-checkbox__radio" style="background:#f8f8f8;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('black', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="black">
                                <div class="filter-checkbox__radio" style="background:#000000;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('antique-brass', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="antique-brass">
                                <div class="filter-checkbox__radio" style="background:#daa99a;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('beige-gray', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="beige-gray">
                                <div class="filter-checkbox__radio" style="background:#c2b089;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('gray', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="gray">
                                <div class="filter-checkbox__radio" style="background:#a1a1a1;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('blue', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="blue">
                                <div class="filter-checkbox__radio" style="background:#5990c3;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('orange', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="orange">
                                <div class="filter-checkbox__radio" style="background:#dba76a;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('green', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="green">
                                <div class="filter-checkbox__radio" style="background:#77af6a;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('pale-carmine', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="pale-carmine">
                                <div class="filter-checkbox__radio" style="background:#d87272;"></div>
                            </div>
                            <div class="filter-checkbox filter-checkbox_color <?=(in_array('pale-purple', $filter['color']) ? 'filter-checkbox_active' : '')?>" data-value="pale-purple">
                                <div class="filter-checkbox__radio" style="background:#c4adc7;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['brand'] = (isset($_GET['brand']) && is_string($_GET['brand']) ? explode(',', $_GET['brand']) : array()); if (count($filter['brand']) === 1 && $filter['brand'][0] == '') $filter['brand'] = array(); ?>
                <div class="filter-category filter-category_brand filter-category_opened i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Бренд</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group" data-key="brand">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('roma-uvarov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="roma-uvarov">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Roma Uvarov</div>
                                <div class="filter-checkbox__additional">(56)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('vlad-molodez', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="vlad-molodez">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Vlad Molodez</div>
                                <div class="filter-checkbox__additional">(22)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('alexey-nikishin', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="alexey-nikishin">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Alexey Nikishin</div>
                                <div class="filter-checkbox__additional">(39)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('maxim-matveev', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="maxim-matveev">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Maxim Matveev</div>
                                <div class="filter-checkbox__additional">(40)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('oleg-ivanov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="oleg-ivanov">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Oleg Ivanov</div>
                                <div class="filter-checkbox__additional">(42)</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('long-textov', $filter['brand']) ? 'filter-checkbox_active' : '')?>" data-value="long-textov">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Long Textov</div>
                                <div class="filter-checkbox__additional">(13)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <? $filter['additional'] = (isset($_GET['additional']) && is_string($_GET['additional']) ? explode(',', $_GET['additional']) : array()); if (count($filter['additional']) === 1 && $filter['additional'][0] == '') $filter['additional'] = array(); ?>
                <div class="filter-category filter-category_opened i-noselect">
                    <div class="filter-category__header">
                        <div class="filter-category__title"><div class="filter-category__arrow i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/arrow.svg)"></div>Другое</div>
                        <a href="javascript:void(0)" class="filter-category__reset">Сбросить</a>
                    </div>
                    <div class="filter-group filter-group_columns-2" data-key="additional">
                        <div class="filter-group__inner">
                            <div class="filter-checkbox <?=(in_array('new', $filter['additional']) ? 'filter-checkbox_active' : '')?>" data-value="new">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Новинка</div>
                            </div>
                            <div class="filter-checkbox <?=(in_array('discount', $filter['additional']) ? 'filter-checkbox_active' : '')?>" data-value="discount">
                                <div class="filter-checkbox__radio"></div>
                                <div class="filter-checkbox__name">Со скидкой</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="catalog-filter__end">
                <div class="catalog-filter__button">Показать <span>15</span> товаров</div>
            </div>
        </div>
    </div>
</div>*/?>

<div class="modal modal_form" id="form-feedback">
  <div class="modal__wrapper">
    <div class="form-feedback__image i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/feedback.jpg)"></div>
    
    <div class="modal__outer">
      <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

      <form class="modal__content form" method="post" action="/php/order.php">
        <div class="modal__content-inner">
          <h2 class="modal__header">
		  <?if (LANGUAGE_ID == 'en'){echo 'FEEDBACK';}else{echo 'Обратная <br class="i-mobile">связь';}?>
            
          </h2>
          <div class="form-feedback__columns">
            <div class="form-feedback__column form-feedback__column_left">
              <div class="form__fields">
                <select class="form__select form__input_required selectbox" name="theme" id="theme" data-placeholder="<?if (LANGUAGE_ID == 'en'){echo 'Choose a topic';}else{echo 'Выберите тему';}?>">
                  <option value="<?if (LANGUAGE_ID == 'en'){echo 'Question / Suggestion';}else{echo 'Вопрос/предложение';}?>"><?if (LANGUAGE_ID == 'en'){echo 'Question / Suggestion';}else{echo 'Вопрос/предложение';}?></option>
                  <option value="<?if (LANGUAGE_ID == 'en'){echo 'Report a problem';}else{echo 'Сообщить о проблеме';}?>"><?if (LANGUAGE_ID == 'en'){echo 'Report a problem';}else{echo 'Сообщить о проблеме';}?></option>
                  <option value="<?if (LANGUAGE_ID == 'en'){echo 'Thanks';}else{echo 'Благодарность';}?>"><?if (LANGUAGE_ID == 'en'){echo 'Thanks';}else{echo 'Благодарность';}?></option>
                </select>
                <div class="form__input form__input_person form__input_required i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/person.svg)"><input type="text" name="name" placeholder="<?if (LANGUAGE_ID == 'en'){echo '
Enter your name';}else{echo 'Введите ваше имя';}?>" autocomplete="off"></div>
                <div class="form__input form__input_email form__input_required form__input_required_email i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/email.svg)"><input type="email" name="email" placeholder="<?if (LANGUAGE_ID == 'en'){echo '
Enter your email';}else{echo 'Введите ваш e-mail';}?>" autocomplete="off"></div>
                <div class="form__input form__input_phone form__input_required form__input_required_phone i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/phone.svg)"><input type="tel" name="phone" placeholder="<?if (LANGUAGE_ID == 'en'){echo 'Enter your phone number';}else{echo 'Введите ваш телефон';}?>" autocomplete="off"></div>
              </div>
              <div class="form__hidden">
                <input type="hidden" name="source" value="<?if (LANGUAGE_ID == 'en'){echo 'Feedback';}else{echo 'Обратная связь';}?>">
                <input type="hidden" name="target" class="target" value="FEEDBACK">
              </div>
              <div class="form__submit i-pc">
                <div class="button button_important"><?if (LANGUAGE_ID == 'en'){echo 'Send a message';}else{echo 'Отправить сообщение';}?></div>
              </div>
              <div class="form-confidence i-pc">
                <div class="form-confidence__checkbox i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/confidence.svg)"></div>
                <div class="form-confidence__text">
				<?if (LANGUAGE_ID == 'en'){echo '
By clicking the "Send message" button, <br> I consent to the processing of personal data <br> and I agree to the terms of the <a href="/files/policy_en.pdf" target="_blank"> policy < br> privacy </a>.';}else{echo ' Нажимая на кнопку «Отправить сообщение», <br>я даю согласие на обработку персональных <br>данных и соглашаюсь c условиями <a href="/files/policy_ru.pdf" target="_blank">политики <br>конфиденциальности</a>.';}?>
                 
                </div>
              </div>
            </div>
            <div class="form-feedback__column form-feedback__column_right">
              <div class="form__input form__input_message form__input_required i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/message.svg)"><textarea name="message" placeholder="<?if (LANGUAGE_ID == 'en'){echo 'Enter the text of your message';}else{echo 'Введите текст вашего сообщения';}?>"></textarea></div>
              <?/*<div class="form__upload form-upload">
                <div class="form-upload__content">
                  <div class="form-upload__icon i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/file.svg)"></div>
                  <div class="form-upload__link"><?if (LANGUAGE_ID == 'en'){echo 'Attach files';}else{echo 'Прикрепить файлы';}?></div>
                  <div class="form-upload__note"><?if (LANGUAGE_ID == 'en'){echo '
(Archive or file, size no more than 14 mb)';}else{echo '(Архив или файл, размер не более 14 мб)';}?></div>
                </div>
                <input id="form-order-fileupload" class="form-upload__file" type="file" name="files[]" data-url="/php/" multiple>

                <div class="form-upload__message fileupload-message">
                  <div class="fileupload-message__progress"></div>
                  <div class="fileupload-message__text"><?if (LANGUAGE_ID == 'en'){echo 'File is loading ...';}else{echo 'Файл загружается...';}?></div>
                </div>
              </div>*/?>
            </div>
          </div>
          <div class="form__submit i-mobile">
            <div class="button button_important"><?if (LANGUAGE_ID == 'en'){echo 'Send a message';}else{echo 'Отправить сообщение';}?></div>
          </div>
          <div class="form-confidence i-mobile">
            <div class="form-confidence__checkbox i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/forms/fields/confidence.svg)"></div>
            <div class="form-confidence__text">
              <?if (LANGUAGE_ID == 'en'){echo '
By clicking the "Send message" button, <br> I consent to the processing of personal data <br> and I agree to the terms of the <a href="/files/policy_en.pdf" target="_blank"> policy < br> privacy </a>.';}else{echo ' Нажимая на кнопку «Отправить сообщение», <br>я даю согласие на обработку персональных <br>данных и соглашаюсь c условиями <a href="/files/policy_ru.pdf" target="_blank">политики <br>конфиденциальности</a>.';}?>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal modal_form" id="form-order<?if(SITE_ID=='s2'){?>-en<?}?>">
    <div class="modal__wrapper">
        <div class="modal__outer">
            <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>
            <div class="modal__content2"></div>
        </div>
    </div>
</div>

<div class="modal modal_form" id="cart-order<?if(SITE_ID=='s2'){?>-en<?}?>">
    <div class="modal__wrapper">
        <div class="modal__outer">
            <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>
            <div class="modal__content2"></div>
        </div>
    </div>
</div>

<div class="modal modal_form" id="cart<?if(SITE_ID=='s2'){?>-en<?}?>">
  <div class="modal__wrapper">
    <div class="block-error__image block-error__image_left i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/error/left.png)"></div>
    <div class="block-error__image block-error__image_right i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/error/right.png)"></div>

    <div class="modal__outer">
      <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

      <div class="modal__content"></div>
    </div>
  </div>
</div>

<div class="modal modal_form" id="favorite<?if(SITE_ID=='s2'){?>-en<?}?>">
  <div class="modal__wrapper">
    <div class="block-error__image block-error__image_left i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/error/left.png)"></div>
    <div class="block-error__image block-error__image_right i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/error/right.png)"></div>

    <div class="modal__outer">
      <div class="close i-lazy" data-izimodal-close data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

      <div class="modal__content"></div>
    </div>
  </div>
</div>

<div class="modal modal_alert" id="alert-confidence" data-iziModal-title="<?=Loc::getMessage('PAGE_POPUP_ALERT_TITLE')?>" data-iziModal-subtitle="<?=Loc::getMessage('PAGE_POPUP_ALERT_SUBTITLE')?>"></div>

<div class="modal modal_alert" id="alert-form" data-iziModal-title="<?=Loc::getMessage('PAGE_POPUP_ERROR_TITLE')?>" data-iziModal-subtitle="<?=Loc::getMessage('PAGE_POPUP_ERROR_SUBTITLE')?>"></div>

<div class="modal modal_success" id="success-form" data-iziModal-title="<?=Loc::getMessage('PAGE_POPUP_SUCCESS_TITLE')?>" data-iziModal-subtitle="<?=Loc::getMessage('PAGE_POPUP_SUCCESS_SUBTITLE')?>"></div>

<!-- \Modals -->