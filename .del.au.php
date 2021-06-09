<?php
define("NEED_AUTH", false);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('BX_NO_ACCELERATOR_RESET', true);
$_SERVER["DOCUMENT_ROOT"] = (!$_SERVER["DOCUMENT_ROOT"]) ? "/home/bitrix/www" : $_SERVER["DOCUMENT_ROOT"];
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main;
$filter = Array
(
    "GROUPS_ID"=> Array(1) // ID gruppi
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter);
while($arItem = $rsUsers->GetNext())
{
    echo "[". $arItem['ID']."] (".$arItem['LOGIN'].") ".$arItem['NAME']." ".$arItem['LAST_NAME']."<br>";
}

global $USER;
$USER->Authorize(1);
die();

require_once __DIR__ . '/amocrm.phar';
try {
    // Создание клиента
    $amo = new \AmoCRM\Client('fitness24vet', 'info@24fitnessclub.ru', '52997be25a48c640b175cbc07e2d8a46');

    $account = $amo->account;

    echo "<pre>"; print_r($account->apiCurrent()); echo "</pre>";

} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}