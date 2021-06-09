<?define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();

$results = array(
	'suggestions' => array(
		array(
			'value' => 'Футболки женские',
			'data' => '/catalog/futbolki_jenskie/',
		),
		array(
			'value' => 'Футболки мужские',
			'data' => '/catalog/futbolki_mujskie/',
		),
		array(
			'value' => 'Футболки детские',
			'data' => '/catalog/futbolki_detskie/',
		),
		array(
			'value' => 'Футболки с принтом',
			'data' => '/catalog/futbolki_s_printom/',
		),
		array(
			'value' => 'Футболки со скидкой',
			'data' => '/catalog/futbolki_so_skidkoi/',
		),
		array(
			'value' => 'Футболки-новинки',
			'data' => '/catalog/futbolki_novinki/',
		),
	)
);

// Нужно фильтровать товары по GET-параметру query
// Выводить результаты для автокомплита в таком формате, как в примере выше

echo json_encode($results);
?>