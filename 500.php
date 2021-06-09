<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("500 Internal Server Error");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("500 Internal Server Error"); 

use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/pages.php');
?>

<section class="block block-error" id="error">

  <!-- <div class="block-error__image block-error__image_left"></div>
  <div class="block-error__image block-error__image_right"></div> -->

  <div class="block__inner">
    <header class="block-error__header header">
      <div class="block-error__code">500</div>
      <h1 class="header__title">
        <?=Loc::getMessage('PAGE_ERROR_500')?>
      </h1>
      <a href="<?=(LANGUAGE_ID == 'ru' ? '/' : '/' . LANGUAGE_ID . '/')?>" class="button" title="<?=Loc::getMessage('PAGE_ERROR_GO_HOME_TITLE')?>"><?=Loc::getMessage('PAGE_ERROR_GO_HOME')?></a>
    </header>
  </div>
</section>
<!-- \block-error -->

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>