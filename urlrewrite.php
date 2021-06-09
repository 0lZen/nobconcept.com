<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/catalog/autocomplete/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/catalog/autocomplete/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/feeds/facebook.xml#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/feeds/facebook.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/en/pre-order/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/en/pre-order/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/en/catalog/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/en/catalog/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/pre-order/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/pre-order/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/en/sale/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/en/sale/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/sale/#',
    'RULE' => '',
    'ID' => 'nob:catalog',
    'PATH' => '/sale/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
