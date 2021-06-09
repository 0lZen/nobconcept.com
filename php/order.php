<?php
// Check if it is Ajax
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
{ 
	die('Error: Request error [1]');
}

// Emails From and To
$my_email = 'NOBCONCEPT <info@nobconcept.com>';
$my_email_to = 'info@nobconcept.com';
#$my_email_to = 'serg@ameton.ru';

// Data from Form
$form = array();

/* Fields */
$form['name'] = (isset($_POST['name']) && $_POST['name'] ? trim($_POST['name']) : false);
$form['phone'] = (isset($_POST['phone']) ? trim($_POST['phone']) : false);
$form['email'] = (isset($_POST['email']) ? trim($_POST['email']) : false);
$form['message'] = (isset($_POST['message']) ? trim($_POST['message']) : false);
$form['fileurl'] = (isset($_POST['fileurl']) ? trim($_POST['fileurl']) : false);

$form['source'] = (isset($_POST['source']) ? trim($_POST['source']) : false);

/*if (strpos($form['name'], '@') !== false)
{
	$form['email'] = $form['name'];
	$form['name'] = false;
}*/

/* \Fields */

/* UTM */
$utm_data = (isset($_POST['utm_data']) && is_array($_POST['utm_data']) ? $_POST['utm_data'] : array());
$utm_data_string = 'UTM-метки: ' . "\n";

foreach ($utm_data as $utm_data_key => $utm_data_value) {
	$utm_key_name = '';

	switch ($utm_data_key) {
		case 'utm_source':
			$utm_key_name = 'Рекламная система (utm_source): '.$utm_data_value."\n";
			break;

		case 'utm_medium':
			$utm_key_name = 'Тип трафика (utm_medium): '.$utm_data_value."\n";
			break;

		case 'utm_campaign':
			$utm_key_name = 'Рекламная кампания (utm_campaign): '.$utm_data_value."\n";
			break;

		case 'utm_content':
			$utm_key_name = 'Содержание (utm_content): '.$utm_data_value."\n";
			break;

		case 'utm_term':
			$utm_key_name = 'Ключевое слово (utm_term): '.$utm_data_value."\n";
			break;
	}

	$utm_data_string .= $utm_key_name;
}
/* \UTM */

/* Advert Data */
$ad_data = (isset($_POST['ad_data']) && is_array($_POST['ad_data']) ? $_POST['ad_data'] : array());
$ad_data_string = 'Параметры рекламных систем: ' . "\n";

foreach ($ad_data as $ad_data_key => $ad_data_value) {
	$ad_key_name = '';

	switch ($ad_data_key) {
		case 'ad_source_type':
			$ad_key_name = 'Тип площадки: '.$ad_data_value."\n";
			break;

		case 'ad_placement':
			$ad_key_name = 'Площадка: '.$ad_data_value."\n";
			break;

		case 'ad_position':
			$ad_key_name = 'Позиция: '.$ad_data_value."\n";
			break;

		case 'ad_keyword':
			$ad_key_name = 'Ключевое слово: '.$ad_data_value."\n";
			break;

		case 'ad_matchtype':
			$ad_key_name = 'Соответствие поисковой фразе: '.$ad_data_value."\n";
			break;

		case 'ad_position_type':
			$ad_key_name = 'Размещение: '.$ad_data_value."\n";
			break;

		case 'ad_creative':
			$ad_key_name = 'Уникальный идентификатор объявления: '.$ad_data_value."\n";
			break;

		case 'ad_device':
			$ad_key_name = 'Устройство: '.$ad_data_value."\n";
			break;

		case 'ad_devicemodel':
			$ad_key_name = 'Марка и модель устройства: '.$ad_data_value."\n";
			break;

		case 'ad_target':
			$ad_key_name = 'Категория размещения объявления: '.$ad_data_value."\n";
			break;
	}

	$ad_data_string .= $ad_key_name;
}
/* \Advert Data */

/* Referral Data */
$ref_data = (isset($_POST['ref_data']) && is_array($_POST['ref_data']) ? $_POST['ref_data'] : array());
$ref_data_string = 'Реф. хвосты: ' . "\n";

foreach ($ref_data as $ref_data_key => $ref_data_value) {
	$ref_data_string .= $ref_data_value . "\n";
}
/* \Referral Data */

// Message Headers
$headers       = 'From: ' . $my_email . "\r\n" .
		             'Content-type: text/plain; charset=utf-8' . "\r\n" .
		             'X-Mailer: PHP/' . phpversion();

// Subject and Message for reply
$autoreply_subject = 'Заявка на сайте «NOBCONCEPT»';
$autoreply_message = 'Спасибо за заявку! Мы свяжемся с вами' . "\n\n" .
				             'С уважением, команда «NOBCONCEPT».';

// Subject and Message for Managers
$manager_subject   = '[NOBCONCEPT.Сайт] Поступила новая заявка от ' . ($form['name'] ? $form['name'] : 'неизвестного человека');
$manager_message   = 'Поступила новая заявка: ' . "\n\n" .
				     'Имя клиента: ' .     ($form['name'] ? $form['name'] : '---') . "\n" .
				     'Телефон клиента: ' . ($form['phone'] ? $form['phone'] : '---') . "\n" .
				     'Email клиента: ' . ($form['email'] ? $form['email'] : '---') . "\n" .
				     'Реквизиты/объём/размеры заказа (поле): ' . ($form['message'] ? $form['message'] : '---') . "\n" .
				     'Реквизиты/объём/размеры заказа (файл): ' . ($form['fileurl'] ? $form['fileurl'] : '---') . "\n" .
				     'Кнопка: ' . ($form['source'] ? $form['source'] : '---') . "\n" .
				      $utm_data_string . "\n" .
				      $ad_data_string . "\n" .
				      $ref_data_string . "\n" .
				     'IP клиента: ' . $_SERVER['REMOTE_ADDR'] . "\n\n";

// Sending Emails
if (isset($manager_message))
{
		$result_sending = false;

		// Sending Email to Manager
		if (mail($my_email_to, $manager_subject, $manager_message, $headers))
		{
		    echo 'sended';
			$result_sending = true;
		} else
        {
            ?>Не удалось отправить сообщение, попробуйте позже.<?
        }

		// Sending Email to Client
		//if (isset($form['email']) && filter_var($form['email'], FILTER_VALIDATE_EMAIL))
		//{
		//	mail($form['email'], $autoreply_subject, $autoreply_message, $headers);
		//}

		//if ($result_sending)
		//{
			// Well done!

				
		//}
		//else
		//{
			// Problem :(
			//echo 'problems / 1';
		//}
}
else
{
	// Problem :(
	echo 'problems / 2';
}