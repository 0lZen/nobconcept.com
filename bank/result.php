<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\SystemException;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\PaySystem;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);
define("DisableEventsCheck", true);


global $APPLICATION;
?>
    <div class="block block-contacts" id="contacts">

        <div class="block-contacts__square"></div>

        <div class="block__inner">
            <?
            if (CModule::IncludeModule("sale"))
            {
                $context = Application::getInstance()->getContext();
                $request = $context->getRequest();

                $item = PaySystem\Manager::searchByRequest($request);

                if ($item !== false)
                {

                    $service = new PaySystem\Service($item);
                    if ($service instanceof PaySystem\Service)
                    {
                        $result = $service->processRequest($request);
                        // echo "<pre>";
                        // print_r($result);

                    }
                }
                else
                {
                    $debugInfo = implode("\n", $request->toArray());
                    PaySystem\Logger::addDebugInfo('Pay system not found. Request: '.$debugInfo);
                }
            }
            ?>
            <br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
    </div>
<?
// $APPLICATION->FinalActions();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>