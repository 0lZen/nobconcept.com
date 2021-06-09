<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Nobconcept, каталог, коллекции, коллекция, авангардные, актуальное, летом, сезонные, скидки, Roma, Uvarov, новые, ботинки, летние, образы, офис, офиса, Милана, Милан");
$APPLICATION->SetTitle("Новости | NOBCONCEPT");
CModule::IncludeModule('iblock');
?>

<div class="block block-news" id="news">

	<div class="block-news__square"></div>

	<div class="block__inner">
		<header class="block-news__header header">
			<h2 class="header__title">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file", 
						"PATH" => "/includes/" . LANGUAGE_ID . "news_header_title.php", 
						"EDIT_TEMPLATE" => ""
					)
				);?>
			</h2>
		</header>

		<div class="block-news__filter">
			<?
	    $years = array();

	    $arSelect = Array("DATE_ACTIVE_FROM");
	    $arFilter = Array("IBLOCK_ID" => IBLOCK_ID__NEWS, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
	    $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM" => "DESC"), $arFilter, false, Array("nPageSize" => 500), $arSelect);
	    while ($ob = $res->GetNextElement())
	    {
	      $arFields = $ob->GetFields();
	      if ($arFields["DATE_ACTIVE_FROM"])
	      {
	        $current_year = ConvertDateTime($arFields["DATE_ACTIVE_FROM"], "YYYY");
	        if (!in_array($current_year, $years))
	        {
	          $years[] = $current_year;
	        }
	      }
	    }
			?>
			<select class="selectbox years" data-placeholder="Выберите год" data-modifier="custom-select_year">
        <?php 
        $filter_year = 0;
        if (isset($_GET['year']) && $_GET['year'])
        {
          $filter_year = intval($_GET['year']);
        }

        foreach($years as $year_key => $year) { 
          if ($filter_year == 0 && $year_key == 0)
          {
            $filter_year = $year;
          }
          ?>
          <option value="<?=$year?>" <?=($year_key == 0 && !(isset($_GET['year']) && $_GET['year']) ? 'selected="selected"' : (isset($_GET['year']) && $_GET['year'] && $_GET['year'] ==  $year ? 'selected="selected"' : ''))?>><?=$year?></option>
        <?php } ?>
			</select>
		</div>

    <?php
    global $arrFilter; //переменная фильтра
    $firstMonth = '01.01.' . $filter_year; //начало года
    $lastMonth = '31.12.' . $filter_year; //конец года
   
    $arrFilter = array(
      "LOGIC" => "AND",
      array(">=DATE_ACTIVE_FROM" => ConvertTimeStamp(strtotime($firstMonth), "FULL")),
      array("<=DATE_ACTIVE_FROM" => ConvertTimeStamp(strtotime($lastMonth), "FULL")),
    );
      
    $APPLICATION->IncludeComponent("bitrix:news.list", "news_list", Array(
      "ACTIVE_DATE_FORMAT" => "d.m.Y",  // Формат показа даты
      "ADD_SECTIONS_CHAIN" => "N",  // Включать раздел в цепочку навигации
      "AJAX_MODE" => "N", // Включить режим AJAX
      "AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
      "AJAX_OPTION_HISTORY" => "N", // Включить эмуляцию навигации браузера
      "AJAX_OPTION_JUMP" => "N",  // Включить прокрутку к началу компонента
      "AJAX_OPTION_STYLE" => "Y", // Включить подгрузку стилей
      "CACHE_FILTER" => "N",  // Кешировать при установленном фильтре
      "CACHE_GROUPS" => "Y",  // Учитывать права доступа
      "CACHE_TIME" => "36000000", // Время кеширования (сек.)
      "CACHE_TYPE" => "A",  // Тип кеширования
      "CHECK_DATES" => "Y", // Показывать только активные на данный момент элементы
      "DETAIL_URL" => "", // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
      "DISPLAY_BOTTOM_PAGER" => "Y",  // Выводить под списком
      "DISPLAY_DATE" => "N",  // Выводить дату элемента
      "DISPLAY_NAME" => "Y",  // Выводить название элемента
      "DISPLAY_PICTURE" => "N", // Выводить изображение для анонса
      "DISPLAY_PREVIEW_TEXT" => "N",  // Выводить текст анонса
      "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
      "FIELD_CODE" => array(  // Поля
        0 => "CODE",
        1 => "NAME",
        2 => "ACTIVE_FROM",
      ),
      "FILTER_NAME" => "arrFilter",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",  // Скрывать ссылку, если нет детального описания
      "IBLOCK_ID" => IBLOCK_ID__NEWS,  // Код информационного блока
      "IBLOCK_TYPE" => "complexes", // Тип информационного блока (используется только для проверки)
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N", // Включать инфоблок в цепочку навигации
      "INCLUDE_SUBSECTIONS" => "Y", // Показывать элементы подразделов раздела
      "MESSAGE_404" => "",  // Сообщение для показа (по умолчанию из компонента)
      "NEWS_COUNT" => "10", // Количество новостей на странице
      "PAGER_BASE_LINK_ENABLE" => "N",  // Включить обработку ссылок
      "PAGER_DESC_NUMBERING" => "N",  // Использовать обратную навигацию
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", // Время кеширования страниц для обратной навигации
      "PAGER_SHOW_ALL" => "N",  // Показывать ссылку "Все"
      "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
      "PAGER_TEMPLATE" => "main_visual", // Шаблон постраничной навигации
      "PAGER_TITLE" => "Все новости", // Название категорий
      "PARENT_SECTION" => "", // ID раздела
      "PARENT_SECTION_CODE" => "",  // Код раздела
      "PREVIEW_TRUNCATE_LEN" => "", // Максимальная длина анонса для вывода (только для типа текст)
      "PROPERTY_CODE" => array( // Свойства
        0 => "CATEGORY",
      ),
      "SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
      "SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
      "SET_META_DESCRIPTION" => "N",  // Устанавливать описание страницы
      "SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
      "SET_STATUS_404" => "N",  // Устанавливать статус 404
      "SET_TITLE" => "N", // Устанавливать заголовок страницы
      "SHOW_404" => "N",  // Показ специальной страницы
      "SORT_BY1" => "ACTIVE_FROM",  // Поле для первой сортировки новостей
      "SORT_BY2" => "SORT", // Поле для второй сортировки новостей
      "SORT_ORDER1" => "DESC", // Направление для первой сортировки новостей
      "SORT_ORDER2" => "ASC", // Направление для второй сортировки новостей
      "STRICT_SECTION_CHECK" => "N",  // Строгая проверка раздела для показа списка
      ),
      false
    );?>
	</div>
</div>
<!-- \Catalog -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>