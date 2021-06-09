<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!IS_AJAX):?>
    </main>

    <footer class="block block-footer block_dark">
        <div class="block-footer__top">
            <div class="block__inner">
                <div class="block-footer__logo-wrapper">
                    <a href="<?=SITE_DIR?>" class="logo-link" title="<?=GetMessage("BACK_ON_MAIN")?>">
                        <img data-src="<?=SITE_TEMPLATE_PATH?>/assets/css/images/logo.svg" alt="NOBCONCEPT" class="logo i-lazy">
                    </a>
                    <div class="block-footer__logo-sub">
                        <?//=GetMessage("RIGHTS")?>
                        &copy; <?=date('Y');?>. Все права защищены.
                    </div>
                </div>

                <div class="block-footer__divider"></div>

                <div class="block-footer__main">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "footer",
                        Array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MAX_LEVEL" => "1",
                        )
                    );?>

                    <div class="block-footer__additional footer-additional i-noselect">
                        <div class="footer-additional__item">
                            <a href="mailto:info@nobconcept.com?subject=<?=str_replace('+','%20',urlencode(GetMessage("ERROR_MESSAGE")))?>" class="footer-additional__link" title="<?=GetMessage("FOUND_ERROR")?>" target="_blank"><?=GetMessage("FOUND_ERROR")?></a>
                        </div>
                        <div class="footer-additional__item">
                            <a href="/files/policy_<?=LANGUAGE_ID?>.pdf" class="footer-additional__link" title="<?=GetMessage("POLICY")?>" target="_blank"><?=GetMessage("POLICY")?></a>
                        </div>
                        <div class="footer-additional__item footer-additional__item_last i-pc">
                            <a href="/files/payment_<?=LANGUAGE_ID?>.pdf" class="footer-additional__link" title="<?=GetMessage("PAYMENT")?>" target="_blank"><?=GetMessage("PAYMENT")?></a>
                        </div>
                        <div class="footer-additional__item footer-additional__item_last i-mobile">
                            <a href="/files/payment_<?=LANGUAGE_ID?>.pdf" class="footer-additional__link" title="<?=GetMessage("PAYMENT_MOBILE")?>" target="_blank"><?=GetMessage("PAYMENT_MOBILE")?></a>
                        </div>
                        <div class="footer-additional__item i-mobile">
                            <?//=GetMessage("RIGHTS")?>
                            &copy; <?=date('Y');?>. Все права защищены.
                        </div>
                    </div>
                </div>

                <div class="block-footer__contacts contacts i-noselect">
                    <a href="tel:<?=str_replace(array("(", ")", "-", " "), "", $APPLICATION->GetDirProperty("phone"))?>" class="phone tel" target="_blank" title="<?=GetMessage("CALL")?>"><?$APPLICATION->ShowProperty("phone")?></a>
                    <div class="i-clear"></div>
                    <a href="#form-feedback" class="button i-modal" data-source="<?=GetMessage("FEEDBACK")?>"><?=GetMessage("FEEDBACK")?></a>
                </div>

                <div class="block-footer__payments footer-payments">
                    <div class="footer-payment footer-payment_visa i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/payments/visa.png)"></div><!--
                    --><div class="footer-payment footer-payment_mir i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/payments/mir.png)"></div><!--
                    --><div class="footer-payment footer-payment_mastercard i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/payments/mastercard.png)"></div><!--
                    --><div class="footer-payment footer-payment_alfabank i-lazy" data-bg="url(<?=SITE_TEMPLATE_PATH?>/assets/css/images/payments/alfabank.png)"></div>
                </div>
            </div>
        </div>
        <div class="block-footer__copyright footer-copyright">
            <div class="block__inner">
                <div class="footer-copyright__text">
                    <?=GetMessage("COPYRIGHT")?>
                </div>
            </div>
        </div>
    </footer>
</div>

<?
$APPLICATION->IncludeFile("includes/vcard.php", array(), array("SHOW_BORDER" => false));
$APPLICATION->IncludeFile("includes/popups.php", array(), array("SHOW_BORDER" => false));
?>

<div class="i-check-mobile"></div>
<div class="i-loader"></div>

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/select/css/jquery.custom-select.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/modal/css/iziModal.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/slick/slick.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/noty/noty.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/noty/themes/nob.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/fancybox/jquery.fancybox.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/lightgallery/lightgallery.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/lightgallery/lg-transitions.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/lightgallery/lg-fb-comment-box.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/main-product.min.css?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/css/main-product.min.css")?>"> <!--вынесла из условия при косяках удалить-->
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/main.min.css?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/css/main.min.css")?>">
<?
if ($APPLICATION->GetCurDir() === SITE_DIR)
{
    ?>
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/main-index.min.css?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/css/main-index.min.css")?>">
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/mobile-index.min.css?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/css/mobile-index.min.css")?>" media="only screen and (max-width:736px)">
    <?
} else
?>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/main-catalog.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/mobile.min.css?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/css/mobile.min.css")?>" media="only screen and (max-width:736px)">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/mobile-product.min.css" media="only screen and (max-width:736px)">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/assets/css/mobile-catalog.min.css" media="only screen and (max-width:736px)">

<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/jquery/jquery-3.3.1.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/cookie/jquery.cookie.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/mobile-detect/mobile-detect.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/lazyload/lazyload.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/tippyjs/tippy.all.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/modal/js/iziModal.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/slick/slick.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/lightgallery/lightgallery-all.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/select/js/jquery.custom-select.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/noty/noty.min.js"></script>
<?
if (mb_strpos($APPLICATION->GetCurDir(), SITE_DIR.'news/',0,'UTF-8') === 0)
{
    ?>
    <script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/waterfall/responsive_waterfall.min.js"></script>
    <?
}
?>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/autocomplete/jquery.autocomplete.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/ytplayer/jquery.mb.YTPlayer.min.js"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/main.js?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/js/main.js")?>"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/addit.js?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/js/addit.js")?>"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/cart.js?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/js/cart.js")?>"></script>
<script defer src="<?=SITE_TEMPLATE_PATH?>/assets/js/favorites.js?v=<?=filemtime($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/assets/js/favorites.js")?>"></script>
<script async src="<?=SITE_TEMPLATE_PATH?>/assets/js/vendors/phone-format/PhoneFormat.js"></script>

<?
if (mb_strpos($APPLICATION->GetCurDir(), SITE_DIR.'contacts/',0,'UTF-8') === 0)
{
    $mapLang='ru';
    if (LANGUAGE_ID=='en')
    {
        $mapLang='en_US';
    }
    ?>
    <script data-skip-moving="true" src="https://api-maps.yandex.ru/2.1/?apikey=<?=YMAPS_APIKEY_TEXT?>&lang=<?=$mapLang?>"></script>
    <?
}
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154564147-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154564147-1');
</script>


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '765036141067199');
  fbq('track', 'PageView');
  fbq('track', 'Lead');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=765036141067199&ev=PageView&noscript=1" alt='' /></noscript>
<!-- End Facebook Pixel Code -->
<div class="ui-spinner" id="js-spinner-common"><span class="ui-spinner__svg"></span></div>
<script>
var siteDir='<?=SITE_DIR?>';
</script>

<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css" rel="stylesheet" property='stylesheet' type="text/css"/>
</body>
</html>
<?
endif;