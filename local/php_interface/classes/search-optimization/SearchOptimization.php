<?php
class SearchOptimization {
	public static function isBot()
	{
		if (!empty($_SERVER['HTTP_USER_AGENT'])) 
		{
		    $options = array(
		        'YandexBot', 'YandexAccessibilityBot', 'YandexMobileBot','YandexDirectDyn',
		        'YandexScreenshotBot', 'YandexImages', 'YandexVideo', 'YandexVideoParser',
		        'YandexMedia', 'YandexBlogs', 'YandexFavicons', 'YandexWebmaster',
		        'YandexPagechecker', 'YandexImageResizer','YandexAdNet', 'YandexDirect',
		        'YaDirectFetcher', 'YandexCalendar', 'YandexSitelinks', 'YandexMetrika',
		        'YandexNews', 'YandexNewslinks', 'YandexCatalog', 'YandexAntivirus',
		        'YandexMarket', 'YandexVertis', 'YandexForDomain', 'YandexSpravBot',
		        'YandexSearchShop', 'YandexMedianaBot', 'YandexOntoDB', 'YandexOntoDBAPI',
		        'Googlebot', 'Googlebot-Image', 'Mediapartners-Google', 'AdsBot-Google',
		        'Mail.RU_Bot', 'bingbot', 'Accoona', 'ia_archiver', 'Ask Jeeves', 
		        'OmniExplorer_Bot', 'W3C_Validator', 'WebAlta', 'YahooFeedSeeker', 'Yahoo!',
		        'Ezooms', '', 'Tourlentabot', 'MJ12bot', 'AhrefsBot', 'SearchBot', 'SiteStatus', 
		        'Nigma.ru', 'Baiduspider', 'Statsbot', 'SISTRIX', 'AcoonBot', 'findlinks', 
		        'proximic', 'OpenindexSpider','statdom.ru', 'Exabot', 'Spider', 'SeznamBot', 
		        'oBot', 'C-T bot', 'Updownerbot', 'Snoopy', 'heritrix', 'Yeti',
		        'DomainVader', 'DCPbot', 'PaperLiBot'
		    );

		    foreach ($options as $row) 
		    {
	        if (stripos($_SERVER['HTTP_USER_AGENT'], $row) !== false) 
	        {
	        	return true;
	        }
		    }
		}

		return false;
	}
}
?>