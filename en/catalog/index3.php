<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("Каталог | NOBCONCEPT");
?>

<div class="block block-catalog" id="catalog">
	<div class="block__inner">
		<header class="block-catalog__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file", 
						"PATH" => "/includes/" . LANGUAGE_ID . "catalog_header_title.php", 
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>
		</header>

		<div class="block-catalog__top i-pc">
      <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "catalog_categories",
        Array(
          "ROOT_MENU_TYPE" => "left", 
          "MAX_LEVEL" => "1"
         )
      );?>

      <div class="block-catalog__sort catalog-sort i-noselect">
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'asc' : 'desc')))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="new" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'new' ? 'возрастанию' : 'убыванию')?>">По новизне<span class="catalog-sort__direction">&nbsp;</span></a>
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => (UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'asc' : 'desc')))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_active' : '')?> <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'catalog-sort__item_asc' : 'catalog-sort__item_desc')?>" data-value="price" title="Сортировать по <?=(UrlManipulation::getParam('sort_order') === 'desc' && UrlManipulation::getParam('sort_by') === 'price' ? 'возрастанию' : 'убыванию')?>">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      </div>
		</div>

		<div class="block-catalog__top catalog-top i-mobile i-noselect">
      <a href="#catalog-filter" class="catalog-top__item catalog-top__item_filter i-modal">Фильтр<span class="catalog-top__filter-num"> (<span>0</span>)</span></a>
      <div class="catalog-top__item catalog-top__item_sort">Сортировка
      <div class="block-catalog__sort catalog-sort i-noselect">
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => 'desc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' && UrlManipulation::getParam('sort_order') === 'desc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_desc" data-value="price" title="Сортировать по убыванию">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'price', 'sort_order' => 'asc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'price' && UrlManipulation::getParam('sort_order') === 'asc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_asc" data-value="price" title="Сортировать по возрастанию">По цене<span class="catalog-sort__direction">&nbsp;</span></a>
      	<!-- <a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => 'desc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' && UrlManipulation::getParam('sort_order') === 'desc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_desc" data-value="new" title="Сортировать по убыванию">По новизне<span class="catalog-sort__direction">&nbsp;</span></a> -->
      	<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>?<?=UrlManipulation::setParams(array('sort_by' => 'new', 'sort_order' => 'asc'))?>" class="catalog-sort__item <?=(UrlManipulation::getParam('sort_by') === 'new' && UrlManipulation::getParam('sort_order') === 'asc' ? 'catalog-sort__item_active' : '')?> catalog-sort__item_asc" data-value="new" title="Сортировать по возрастанию">По новизне<!-- <span class="catalog-sort__direction">&nbsp;</span> --></a>
      </div>
      </div>
		</div>

		<div class="block-catalog__main">
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
			<div class="block-catalog__products">
				<div class="block-catalog__items">
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/1_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/1_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">12 950 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/1/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/2_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/2_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">8 950 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/2/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/3_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/3_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">5 000 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/3/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/4_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/4_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">11 200 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/4/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/5_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/5_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">4 900 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/5/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/6_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/6_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">6 600 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/6/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/7_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/7_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">12 000 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/7/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/8_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/8_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">9 900 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/8/" class="product__link" title="Roma Uvarov | Хлопковая футболка">"Roma Uvarov | Хлопковая футболка</a>
					</div>
					<div class="product">
						<div class="product__images">
							<div class="product__image product__image_main i-lazy" data-bg="url('/upload/fish/catalog/9_1.jpg')"></div>
							<div class="product__image product__image_second i-lazy" data-bg="url('/upload/fish/catalog/9_2.jpg')"></div>
						</div>
						<div class="product__content">
							<h3 class="product__brand">Roma Uvarov</h3>
							<h4 class="product__title">Хлопковая футболка</h4>
							<div class="product__price">7 400 <span class="i-currency">₽</span></div>
						</div>
						<a href="/catalog/product/9/" class="product__link" title="Roma Uvarov | Хлопковая футболка">Roma Uvarov | Хлопковая футболка</a>
					</div>
				</div>
				<div class="block-catalog__bottom">
					<a href="javascript:void(0);" class="block-catalog__more">Показать еще товары</a>
					<div class="block-catalog__paginator paginator i-noselect">
						<span class="paginator__control paginator__control_left paginator__control_ia arrow"></span>
						<span class="paginator__control paginator__control_page paginator__control_page-current" title="Страница №1">1</span>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №2">2</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №3">3</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №4">4</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №5">5</a>
						<span class="paginator__control paginator__control_dots">...</span>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_page" title="Страница №83">83</a>
						<a href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>" class="paginator__control paginator__control_right arrow" title="Следующая страница"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>