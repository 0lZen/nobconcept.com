<?
/**
 * Project class
 */
class Project
{
	
	public static function parseSlides($html, $sliders, $slidersMobile)
	{
		$result = '';

		$result = preg_replace_callback(
			"/#SLIDER_([\d]+)#/is".BX_UTF_PCRE_MODIFIER,
			function($matches) use ($sliders, $slidersMobile) {
				ob_start();
				echo Project::addSlider($matches[1], $sliders[$matches[1]], $slidersMobile[$matches[1]]);
				$retrunStr = @ob_get_contents();
				ob_get_clean();
				return $retrunStr;
			}, $html);

		return $result;
	}

	public static function addSlider($sliderId, $slides, $slidesMobile)
	{
		$result = "";

		$result .= "<div class=\"block-article__slides-wrapper i-font-default\">";
			$result .= "<div class=\"block-article__slides-square\"></div>";
			$result .= "<div class=\"block-article__slides slides\" id=\"slides_" . $sliderId . "\" data-slick-slidestoshow=\"1\" data-slick-slidestoscroll=\"1\" data-slick-infinite=\"true\" data-slick-variable-width=\"false\" data-slick-touch-threshold=\"20\" data-slick-fade=\"true\" data-slick-adaptive-height=\"true\" data-slick-controls=\"#slides_" . $sliderId . "_controls\" data-slick-paginator=\"#slides_" . $sliderId . "_paginator\">";

				if (is_array($slides) && count($slides))
				{
					foreach ($slides as $key => $slide)
					{
						$image_pc = ImageBx::ResizeImageGet($slide, array('width' => 2085, 'height' => 1027));
						$image_mobile = ImageBx::ResizeImageGet($slidesMobile[$key], array('width' => 580, 'height' => 560));
						$result .= "<div class=\"slides__item block-article__slide\"><img alt=\"Image\" class=\"block-article__image i-lazy\" data-src=\"" . $image_pc['src'] . "\" data-src-mobile=\"" . $image_mobile['src'] . "\"></div>";
					}
				}

			$result .= "</div>";

			if (is_array($slides) && count($slides) > 1)
			{
				$result .= "<div class=\"block-article__controls slides-controls slides-controls_block i-noselect\" id=\"slides_" . $sliderId . "_controls\" data-slick=\"#slides_" . $sliderId . "\">";
					$result .= "<div class=\"slides-controls__item slides-controls__item_left arrow\" data-slick=\"#slides_" . $sliderId . "\"></div>";
					$result .= "<div class=\"slides-controls__paginator paginator\" id=\"slides_" . $sliderId . "_paginator\" data-slick=\"#slides_" . $sliderId . "\"><span class=\"paginator__current\">1</span>/<span class=\"paginator__total\">" . count($slides) . "</span></div>";
					$result .= "<div class=\"slides-controls__item slides-controls__item_right arrow\" data-slick=\"#slides_" . $sliderId . "\"></div>";
				$result .= "</div>";
			}

		$result .= "</div>";

		return $result;
	}
}
?>