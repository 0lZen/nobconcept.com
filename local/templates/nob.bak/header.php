<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!IS_AJAX):

if (mb_strpos($APPLICATION->GetCurDir(), '/catalog/',0,'UTF-8')!==false || mb_strpos($APPLICATION->GetCurDir(), '/sale/',0,'UTF-8')!==false)
{
    $isCatalog='Y';
} else
{
    $isCatalog='N';
}

if (CModule::IncludeModule('sale'))
{
    global $basketStat;
    $basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
    $basketStat = getBasketStat($basket);
}

?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>" prefix="og: http://ogp.me/ns#
                        fb: http://ogp.me/ns/fb#" class="l-site">
<head>
  <meta charset="UTF-8">
  <?
    $APPLICATION->ShowMeta("robots", false, true);
    $APPLICATION->ShowMeta("keywords", false, true);
    $APPLICATION->ShowMeta("description", false, true);
    $APPLICATION->ShowLink("canonical", null, true);
    $APPLICATION->ShowCSS(true, true);
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
  ?>
  <title><?$APPLICATION->ShowTitle()?></title>
  <?//$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/mobile.min.css")?>
  <meta id="site-viewport" name="viewport" content="width=320">
  <meta name="format-detection" content="telephone=no">
  <meta name="google-site-verification" content="R_9QFVg6zvUXGISB125p8Pbr6jzRC4qvnrCkaISiJj8" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="194x194" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/favicon-194x194.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/site.webmanifest?v=1">
  <link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/safari-pinned-tab.svg" color="#0e0e0e">
  <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicons/favicon.ico">
  <meta name="msapplication-TileColor" content="#0e0e0e">
  <meta name="msapplication-TileImage" content="<?=SITE_TEMPLATE_PATH?>/images/favicons/mstile-144x144.png">
  <meta name="msapplication-config" content="<?=SITE_TEMPLATE_PATH?>/images/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?$APPLICATION->ShowTitle()?>">

  <?php if ($_SERVER['HTTP_USER_AGENT'] === "TelegramBot (like TwitterBot)" || stristr($_SERVER['HTTP_USER_AGENT'], 'WhatsApp')) { ?>
    <meta name="twitter:image" content="//<?=$_SERVER['SERVER_NAME']?><?=SITE_TEMPLATE_PATH?>/images/og-image-mini.jpg">
  <?php } else { ?>
    <meta name="twitter:image" content="//<?=$_SERVER['SERVER_NAME']?><?=SITE_TEMPLATE_PATH?>/images/og-image-twitter.jpg">
  <?php } ?>

  <meta name="twitter:image:width" content="880">
  <meta name="twitter:image:height" content="440">
  <meta name="twitter:alt" content="<?$APPLICATION->ShowTitle()?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?$APPLICATION->ShowTitle()?>">
  <meta property="og:title" content="<?$APPLICATION->ShowTitle()?>">
  <?/*<meta property="og:description" content="<?=$APPLICATION->GetDirProperty('description')?>">*/?>
  <meta property="og:description" content="<?$APPLICATION->ShowTitle()?>">
  <meta property="og:url" content="//<?=$_SERVER['SERVER_NAME']?>">
  <meta property="og:image" content="//<?=$_SERVER['SERVER_NAME']?><?=SITE_TEMPLATE_PATH?>/images/og-image.jpg">
  <meta property="og:image" content="//<?=$_SERVER['SERVER_NAME']?><?=SITE_TEMPLATE_PATH?>/images/og-image-mini.jpg">

  <meta name="title" content="<?$APPLICATION->ShowTitle()?>">
  <?/*<meta name="description" content="<?=$APPLICATION->GetDirProperty('description')?>">*/?>
  <meta name="description" content="<?$APPLICATION->ShowTitle()?>">
  <meta name="keywords" content="<?=$APPLICATION->GetDirProperty('keywords')?>">
  <link rel="image_src" href="//<?=$_SERVER['SERVER_NAME']?><?=SITE_TEMPLATE_PATH?>/images/og-image.jpg">

  <link rel="canonical" href="//<?=$_SERVER['SERVER_NAME']?><?=$APPLICATION->GetCurPage()?>">
  <base href="<?='//' . $_SERVER['SERVER_NAME']?>">

  <script>if(screen.width > 736){var svp = document.getElementById('site-viewport');svp.setAttribute('content','width=1200');}; var LANGUAGE_ID = '<?=LANGUAGE_ID?>'; var SITE_TEMPLATE_PATH = '<?=SITE_TEMPLATE_PATH?>';</script>
    <?
    if(mb_strpos($APPLICATION->GetCurDir(), 'catalog',0,'UTF-8')!==false || mb_strpos($APPLICATION->GetCurDir(), 'pre-order',0,'UTF-8')!==false || mb_strpos($APPLICATION->GetCurDir(), 'sale',0,'UTF-8')!==false){
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/first-catalog.min.css");
    }
    ?>
  <style>
      .filter-checkbox__radio input{
          display: none;
      }
    <?include('assets/css/normalize.min.css')?>
    <?include('assets/css/first.min.css')?>
    <?include('assets/js/vendors/ytplayer/css/jquery.mb.YTPlayer.min.css')?>
    <?if ($USER->IsAdmin()) {?>
      <?include('assets/css/first-admin.min.css')?>
    <?}?>
    <?if (ERROR_404 === "Y") {?>
      <?include('assets/css/first-error.min.css')?>
    <?}?>
    <?if ($APPLICATION->GetCurDir() !== (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/')) {?>
      <?include('assets/css/first-common.min.css')?>
    <?}?>
    <?if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/')) {?>
      <?include('assets/css/first-index.min.css')?>
    <?} elseif ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'ui/' || mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/',0,'UTF-8') === 0) {?>
      <?include('assets/css/first-catalog.min.css')?>
      <?if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/product/',0,'UTF-8') === 0) {?>
        <?include('assets/css/first-product.min.css')?>
      <?}?>
    <?} elseif (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'shop/',0,'UTF-8') === 0) {?>
      <?include('assets/css/first-shop.min.css')?>
    <?} elseif (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'news/',0,'UTF-8') === 0) {?>
      <?if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'news/') {?>
        <?include('assets/css/first-news.min.css')?>
      <?} else {?>
        <?include('assets/css/first-article.min.css')?>
      <?}?>
    <?} elseif (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'contacts/',0,'UTF-8') === 0) {?>
      <?include('assets/css/first-contacts.min.css')?>
    <?}?>.i-check-mobile{display:none;}
    @media only screen and (max-width: 736px){
        <?
        include('assets/css/mobile-first.min.css');
        if (ERROR_404 === "Y")
        {
            include('assets/css/mobile-first-error.min.css');
        }

        if ($APPLICATION->GetCurDir() !== (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/'))
        {
            include('assets/css/mobile-first-common.min.css');
        }

        if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/'))
        {

            include('assets/css/mobile-first-index.min.css');
        } else
        if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'ui/' || mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/',0,'UTF-8') === 0)
        {

            include('assets/css/mobile-first-catalog.min.css');

            if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'catalog/product/',0,'UTF-8') === 0)
            {
                include('assets/css/mobile-first-product.min.css');
            }
        } else
        if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'sale/product/',0,'UTF-8') === 0)
        {

            include('assets/css/mobile-first-product.min.css');

        } else
        if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'pre-order/product/',0,'UTF-8') === 0)
        {

            include('assets/css/mobile-first-product.min.css');

        } else
        if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'sale/' || mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'pre-order/',0,'UTF-8') === 0)
        {

            include('assets/css/mobile-first-catalog.min.css');
            include('assets/css/first-catalog.min.css');

        } else
        if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'shop/',0,'UTF-8') === 0)
        {

            include('assets/css/mobile-first-shop.min.css');
        } else
        if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'news/',0,'UTF-8') === 0)
        {
            if ($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'news/')
            {
                include('assets/css/mobile-first-news.min.css');
            } else
            {
                include('assets/css/mobile-first-article.min.css');
            }
        } else
        if (mb_strpos($APPLICATION->GetCurDir(), (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'contacts/',0,'UTF-8') === 0)
        {
            include('assets/css/mobile-first-contacts.min.css');
        }
        ?>
        .i-check-mobile{display:block!important;}.i-check-mobile_i{display:inline!important;}.i-check-mobile_ib{display:inline-block!important;}
    }
    <?include('assets/css/additional.css')?>
  </style>

    <meta name="yandex-verification" content="b73bb18c602b31b9" />
    <meta name="google-site-verification" content="OhpcfGtXfWBN2wr73LidGfxYflMzY3n99ygozZL7Dx0" />

    <!-- Yandex.Metrika counter -->
    <script>
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(56719843, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
       });
    </script>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JK7LMCNZ7Z"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-JK7LMCNZ7Z');
    </script>

    <script>
        var basketStat = <?=json_encode($basketStat)?>;
    </script>
</head>
<body itemscope itemtype="http://schema.org/WebSite" class="l-page <?=(ERROR_404 === "Y" ? "l-page_common l-page_screen" : "")?>">
    <noscript><div><img src="https://mc.yandex.ru/watch/56719843" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <?$APPLICATION->ShowPanel();?>

  <?#if (!SearchOptimization::isBot()) {?>
  <div class="preloader preloader_active1">
    <div class="preloader__content">
      <div class="preloader__rolling"></div>
      <div class="preloader__text"><?=GetMessage("LOADING")?></div>
    </div>
  </div>
  <?#}?>

  <div class="wrapper">
		<nav class="block block-navigation
		<?=(($APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') ||
            $APPLICATION->GetCurDir() === (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'ui/')
        && ERROR_404 !== "Y" ? 'block-navigation_index' : '')?>" id="navigation_header">
		  <div class="block__inner">
        <div class="menu-button i-mobile"></div>

		    <div class="block-navigation__logo-wrapper">
          <a href="<?=(LANGUAGE_ID != 'ru' ? '/' . LANGUAGE_ID . '/' : '/')?>" class="logo-link" title="<?=GetMessage("BACK_ON_MAIN")?>">
            <img alt="NOBCONCEPT" class="logo" src="<?=SITE_TEMPLATE_PATH?>/assets/css/images/logo_dark.svg">
          </a>
        </div>

        <?$APPLICATION->IncludeComponent(
          "bitrix:menu",
          "header",
          Array(
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "1",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "3600"
           )
        );?>

        <div class="block-navigation__icons">

            <?
            if ($_SESSION['enable_currency']=='Y')
            {
                $arMoneyType = ['RUB','EUR','USD'];
                ?>
                <select class="selectbox" data-modifier="custom-select_moneys" style="display: none;" id="js-currency-select">
                    <?
                    foreach ($arMoneyType as $key => $arMoney)
                    {
                        $selected='';
                        if ($_SESSION['CURRENCY_CURRENT'])
                        {
                            if ($_SESSION['CURRENCY_CURRENT']==$arMoney)
                            {
                                $selected=' selected="selected"';
                            }
                        } else
                        if ($key==0)
                        {
                            $selected=' selected="selected"';
                        }
                        ?>
                        <option class="" data-link="<?=$arMoney?>" <?=$selected?> title="<?=$arMoney;?>"><?=$arMoney;?></option>
                        <?
                    }
                    ?>
                </select>
                <?
            }
            ?>
          <?$APPLICATION->IncludeComponent(
             "bitrix:main.site.selector",
             "header",
             Array(
                "IS_CATALOG" => $isCatalog,
                "SITE_LIST" => array(),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600"
             ),
          false
          );?>

          <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "additional",
            Array(
              "ROOT_MENU_TYPE" => "additional",
              "MAX_LEVEL" => "1",
              "CACHE_TYPE" => "N"
             )
          );?>
        </div>
		  </div>
		</nav>
    <nav class="block block-subnavigation i-pc" id="subnavigation">
      <div class="block__inner">
        <?$APPLICATION->IncludeComponent(
          "bitrix:menu",
          "subheader",
          Array(
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "2",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "3600"
           )
        );?>
      </div>
    </nav>
    <nav class="block block-menu i-mobile" id="menu">
      <div class="block__inner">
        <!-- <div class="block-menu__pic i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/mobile/menu/pic.png)"></div> -->
        <div class="block-menu__close i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

        <div class="block-menu__top">
          <div class="block-menu__logo-wrapper">
            <a href="<?=(LANGUAGE_ID != 'ru' ? '/' . LANGUAGE_ID . '/' : '/')?>" class="logo-link" title="<?=GetMessage("BACK_ON_MAIN")?>">
              <img alt="NOBCONCEPT" class="logo i-lazy loaded" src="<?=SITE_TEMPLATE_PATH?>/assets/css/images/logo_dark.svg">
            </a>
          </div>
            <div class="block-menu__bottom">

              <?$APPLICATION->IncludeComponent(
                 "bitrix:main.site.selector",
                 "menu_mobile",
                 Array(
                    "IS_CATALOG" => $isCatalog,
                    "SITE_LIST" => array(),
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600"
                 ),
              false
              );?>

                <?
                if ($_SESSION['enable_currency']=='Y')
                {
                    ?>
                    <div class="menu-moneys">
                        <?
                        foreach ($arMoneyType as $key => $arMoney)
                        {
                            $selected='';
                            if ($_SESSION['CURRENCY_CURRENT'])
                            {
                                if ($_SESSION['CURRENCY_CURRENT']==$arMoney)
                                {
                                    $selected='menu-moneys__item_active';
                                }
                            } else
                            if ($key==0)
                            {
                                $selected='menu-moneys__item_active';
                            }
                            ?>
                            <a class="menu-moneys__item js-currency-select-mobile <?=$selected?>" data-val="<?=$arMoney;?>" href="javascript:void(0)"><?=$arMoney;?></a>
                            <?
                        }
                        ?>
                    </div>
                    <?
                }
                ?>

            </div>


          <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "menu_mobile",
            Array(
              "ROOT_MENU_TYPE" => "top",
              "MAX_LEVEL" => "1",
              "CACHE_TYPE" => "A",
             "CACHE_TIME" => "3600"
             )
          );?>
        </div>


      </div>
    </nav>

    <nav class="block block-menu block-menu_brands i-mobile" id="menu-brands">
      <div class="block__inner">
        <!-- <div class="block-menu__pic i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/mobile/menu/pic.png)"></div> -->
        <div class="block-menu__close i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/icons/close.svg)"></div>

        <div class="block-menu__top">
          <div class="block-menu__logo-wrapper">
            <a href="<?=(LANGUAGE_ID != 'ru' ? '/' . LANGUAGE_ID . '/' : '/')?>" class="logo-link" title="<?=GetMessage("BACK_ON_MAIN")?>">
              <img alt="NOBCONCEPT" class="logo i-lazy loaded" src="<?=SITE_TEMPLATE_PATH?>/assets/css/images/logo_dark.svg">
            </a>
          </div>

          <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "menu_mobile",
            Array(
                "BRANDS" => 'Y',
                "ROOT_MENU_TYPE" => "brands",
                "MAX_LEVEL" => "1",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "3600"
             )
          );?>
        </div>
      </div>
    </nav>

		<!-- #workarea -->
		<main>

      <?if (($APPLICATION->GetCurDir() !== (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') && $APPLICATION->GetCurDir() !== (LANGUAGE_ID === 'ru' ? '/' : '/' . LANGUAGE_ID . '/') . 'ui/') && ERROR_404 !== "Y") {?>
        <div class="block block-common-top" id="common-top">
          <div class="block__inner">
            <?
            $APPLICATION->IncludeComponent(
            	"bitrix:breadcrumb", 
            	"common", 
            	array(
            		"START_FROM" => "0",
            		"PATH" => "",
            		"SITE_ID" => SITE_ID,
            		"COMPONENT_TEMPLATE" => "common"
            	),
            	false
            );?>
          </div>
        </div>
      <?}
endif;
