var lazyLoad_1 = false;
var lazyLoad_2 = false;
var lazyLoad_iframes = false;
var lazyload_initial_device = false;

function put_hidden(dd){
    $('#fid-comment').val(dd);
    //alert(dd);
}

var lazyloadProccess = function(){
  if (isMobile())
  {
    lazyLoad_1 = new LazyLoad({
      elements_selector: '.i-lazy:not([data-src-mobile]):not([data-bg-mobile])',
      data_src: 'src',
      data_bg: 'bg',
      threshold: 900
    });

    lazyLoad_2 = new LazyLoad({
      elements_selector: '.i-lazy[data-src-mobile]:not(.has-webp),.i-lazy[data-bg-mobile]',
      data_src: 'src-mobile',
      data_srcset: 'srcset-mobile',
      data_bg: 'bg-mobile',
      threshold: 900
    });
  }
  else
  {
    if (isMid())
    {
      lazyLoad_1 = new LazyLoad({
        elements_selector: '.i-lazy:not([data-src-mid])',
        data_src: 'src',
        data_bg: 'bg',
        threshold: 500
      });

      lazyLoad_2 = new LazyLoad({
        elements_selector: '.i-lazy[data-src-mid]',
        data_src: 'src-mid',
        data_bg: 'bg-mid',
        threshold: 500
      });
    }
    else
    {
      lazyLoad_1 = new LazyLoad({
        elements_selector: '.i-lazy',
        data_src: 'src',
        data_bg: 'bg',
        threshold: 500
      });
    }
  }
};

var updateLazyload = function(parent){
  lazyLoad_1.update();

  if (lazyLoad_2)
  {
    lazyLoad_2.update();
  }
};

/*var Nav = {
  map: false,
  getMap: function(){
    var _this = this;

    return _this.map;
  },
  pos: false,
  getPos: function(){
    var _this = this;

    return _this.pos;
  },
  loadMap: function(map_block, center_point, marker_point, marker_html){
    var _this = this;
    var map_block = (map_block ? map_block : document.getElementById('maps'));
    var center_point = (center_point ? center_point : {lat: 36.5005621, lng: (isMobile() ? -4.936935 : -4.943738)});
    var marker_point = _this.pos = (marker_point ? marker_point : {lat: 36.5005621, lng: -4.936935});
    var marker_html = (marker_html ? marker_html : '<div class="ql-editor" style="color: #444; font-family: Roboto, Arial, Helvetica, sans-serif; font-size: 16px; line-height: 140%; font-weight: 300;">\u003cp class=\"ql-align-center\"\u003e<strong>Oasis Business Center,</strong> \u003c/p\u003e\u003cp class=\"ql-align-center\"\u003eCtra N- 340, Km. 176, 29600\u003c/p\u003e\u003cp class=\"ql-align-center\"\u003eMarbella, Málaga, Spain\u003c/p\u003e</div>');

    if (typeof google == 'undefined')
    {
      return;
    }

    var opts = {
      center: center_point,
      zoom: 16,
      maxZoom: 20,
      minZoom: 0,
      mapTypeId: 'roadmap',
    };

    var opts = {
      center: center_point,
      zoom: 14,
      styles: [
      {
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#f5f5f5"
          }
        ]
      },
      {
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#616161"
          }
        ]
      },
      {
        "elementType": "labels.text.stroke",
        "stylers": [
          {
            "color": "#f5f5f5"
          }
        ]
      },
      {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#bdbdbd"
          }
        ]
      },
      {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#eeeeee"
          }
        ]
      },
      {
        "featureType": "poi",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#757575"
          }
        ]
      },
      {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#e5e5e5"
          }
        ]
      },
      {
        "featureType": "poi.park",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#9e9e9e"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#ffffff"
          }
        ]
      },
      {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#757575"
          }
        ]
      },
      {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#dadada"
          }
        ]
      },
      {
        "featureType": "road.highway",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#616161"
          }
        ]
      },
      {
        "featureType": "road.local",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#9e9e9e"
          }
        ]
      },
      {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#e5e5e5"
          }
        ]
      },
      {
        "featureType": "transit.station",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#eeeeee"
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#c9c9c9"
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
          {
            "color": "#9e9e9e"
          }
        ]
      }
    ],
      maxZoom: 20,
      minZoom: 0,
      mapTypeId: 'roadmap',
    };

    opts.clickableIcons = false;
    opts.disableDoubleClickZoom = false;
    opts.draggable = true;
    opts.keyboardShortcuts = false;
    opts.scrollwheel = false;

    var setControlOptions = function(key, enabled, position, style, mapTypeIds){
      opts[key + 'Control'] = enabled;
      opts[key + 'ControlOptions'] = {
        position: google.maps.ControlPosition[position],
        style: google.maps.MapTypeControlStyle[style],
        mapTypeIds: mapTypeIds
      };
    };

    setControlOptions('fullscreen',false,'RIGHT_CENTER','',null);
    setControlOptions('mapType',false,'DEFAULT','DEFAULT',["roadmap","satellite","terrain"]);
    setControlOptions('rotate',false,'RIGHT_CENTER','',null);
    setControlOptions('scale',false,'','',null);
    setControlOptions('streetView',false,'DEFAULT','',null);
    setControlOptions('zoom',true,'RIGHT_CENTER','',null);

    var map = _this.map = new google.maps.Map(map_block, opts);

    (function(){
      var markerOptions = {
        map: map,
        position: marker_point
      };

      markerOptions.icon = {
        url: SITE_TEMPLATE_PATH + '/assets/css/images/marker.svg',
        scaledSize: new google.maps.Size(
          33,
          40),
        size: new google.maps.Size(
          33,
          40),
        anchor: new google.maps.Point(
          16,
          20)
      };
      markerOptions.options = {
        optimized: true,
      };

      var marker = new google.maps.Marker(markerOptions);
    })();
  },
  mapNavigate: function(lat, lng){
    // If it's an iPhone..
    if ((navigator.platform.indexOf("iPhone") !== -1) || (navigator.platform.indexOf("iPod") !== -1))
    {
      function iOSversion(){
        if (/iP(hone|od|ad)/.test(navigator.platform))
        {
          // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
          var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
          return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
        }
      }
      var ver = iOSversion() || [0];

      if (ver[0] >= 6)
      {
        protocol = 'maps://';
      }
      else
      {
        protocol = 'http://';
      }

      window.location = protocol + 'maps.apple.com/maps?daddr=' + lat + ',' + lng + '&amp;ll=';
    }
    else
    {
      window.open('http://maps.google.com?daddr=' + lat + ',' + lng + '&amp;ll=');
    }
  }
};*/

$(document).ready(function(){

    if (window.location.href.indexOf("catalog/product") > -1) {
        var elems_comp = $('div[id^="comp"]');
        $(elems_comp).removeAttr('id');
        //console.log(elems_comp);
    }

$(document).on('change','.js-order-form-delivery',function(){
    var curFormContainer=$(this).closest('.modal__outer');

    var curPriceObj=curFormContainer.find('.js-order-form-total-price');
    var curPrice=parseInt($(this).children('option:selected').data('val'));
    /*if (curPrice=="")
    {
        curPrice=0;
    } else
    {
        curPrice=parseInt(curPrice);
    }*/
    var curBasketPrice=parseFloat(curPriceObj.data('base-summ'));
    var fullPrice=curPrice+curBasketPrice;
    $('.js-order-form-total-price').html(formatPrice(fullPrice)+' <span class="i-currency">₽</span>');

    var curPriceObjCurrency=curFormContainer.find('.js-order-form-total-price-cur');
    if (curPriceObjCurrency.length)
    {
        var currency=curPriceObjCurrency.data('cur');
        var curPriceCurrency=parseFloat($(this).children('option:selected').data('val-cur'));

        var curBasketPrice=parseFloat(curPriceObjCurrency.data('base-summ'));
        var fullPrice=curPriceCurrency+curBasketPrice;
        if (currency=='EUR')
        {
            $('.js-order-form-total-price-cur').html(formatPrice(fullPrice)+' €');
        } else
        if (currency=='USD')
        {
            $('.js-order-form-total-price-cur').html('$'+formatPrice(fullPrice));
        }
    }

})

  /* Lazyloading */
  lazyLoad_1 = false;
  lazyLoad_2 = false;
  lazyload_initial_device = isMobile()?-1:1;

  lazyloadProccess();

  $(window).resize(function(e){
    var svp = false;
    var lazyload_current_device = isMobile()?-1:1;

    if (lazyload_initial_device != lazyload_current_device)
    {
      if (lazyload_current_device == -1 && screen.width <= 736)
      {
        svp = document.getElementById('site-viewport');
        svp.setAttribute('content','width=320');
      }
      else
      {
        svp = document.getElementById('site-viewport');
        svp.setAttribute('content','width=1200');
      }

      $('.i-lazy').removeAttr('data-was-processed');
      lazyload_initial_device = lazyload_current_device;

      setTimeout(function(){
        lazyloadProccess();
      }, 500);
    }
  });
  /* Lazyloading */

  /* Save position */
  var last_position = 0;
  /* \Save position */

  /* Noty */
  Noty.setMaxVisible(5);
  /* \Noty */

  /* Detect Tablets for forms */
  var md = new MobileDetect(window.navigator.userAgent);
  if (md.tablet())
  {
    $('html').addClass('i-tablet');
  }
  else
  {
    $('html').addClass('i-not-tablet');
  }

  if (isMobile())
  {
    $('html').addClass('i-cellphone');
  }
  else
  {
    $('html').addClass('i-not-cellphone');
  }

  if (!md.tablet() && !isMobile())
  {
    $('html').addClass('i-desktop');
  }
  else
  {
    $('html').addClass('i-not-desktop');
  }
  /* \Detect Tablets for forms */

  /* Scroll */
  $(document).on('click', '.i-scroll', function(e){
    e.preventDefault();

    var correct_top = -(parseInt($('body').css('font-size'), 0) * 4.5);

    $('html, body').animate({
      scrollTop: $($(this).attr('href')).offset().top + correct_top
    }, 1000);
  });

  /*Custom*/
  $(document).ready(function() {
      $(document).on( "click", ".filter-category__reset", function() {
          var container = $(this).closest('.filter-category');
          container.find('.filter-checkbox_active').each(function(){
            $(this).trigger('click');
          });
      });
  });

  var scroll_top_zone = $(window).height() - 200;

  var scrollProccessing = function(){
    if ($(window).scrollTop() > scroll_top_zone)
    {
      $('.scroll-top').addClass('scroll-top_zone');
    }
    else
    {
      $('.scroll-top').removeClass('scroll-top_zone');
    }

    if ($('.block-footer').length > 0)
    {
      if (($(window).scrollTop() + $(window).height()) > ($('.block-footer:last').offset().top + (isMobile() ? 0 : parseInt($('body').css('font-size'), 0) * 0.3)))
      {
        $('.scroll-top').addClass('scroll-top_bottom');
      }
      else
      {
        $('.scroll-top').removeClass('scroll-top_bottom');
      }
    }
  };

  scrollProccessing();

  $(window).scroll(function(){
    scrollProccessing();
  });

  $(document).on('click', '.scroll-top', function(e){
    if ($(this).hasClass('scroll-top_zone'))
    {
      $('html, body').animate({
        scrollTop: 0
      }, 1000);
    }
    else
    {
      if ($(this).hasClass('scroll-top_back'))
      {
        goBack();
      }
    }
  });
  /* \Scroll */

  $('.slides-menu__item').on('click', function(e){
    e.preventDefault();

    var slick = $($(this).parents('.slides-menu').attr('data-slick'));

    slick.slick('slickGoTo', $(this).index());

    //$(slick).find('.slick-active').focus();
  });

  /* Sliders */
  $('.slides').each(function(index){

    var slick = $(this);
    var paginator = $($(this).data('slick-paginator')) || false;
    var buttons = $($(this).data('slick-buttons')) || false;
    var circle_progress = $($(this).data('slick-circle-progress')) || false;
    var autoplay = $(this).data('slick-autoplay') || false;
    var autoplaySpeed = $(this).data('slick-autoplayspeed') || 3000;
    var arrows = $(this).data('slick-arrows') || false;
    var dots = $(this).data('slick-dots') || false;
    var fade = $(this).data('slick-fade') || false;
    var infinite = $(this).data('slick-infinite') || false;
    var slidesToShow = $(this).data('slick-slidestoshow') || 1;
    var slidesToScroll = $(this).data('slick-slidestoscroll') || 1;
    var adaptiveHeight = $(this).data('slick-adaptive-height') || false;
    var variableWidth = $(this).data('slick-variable-width') || false;
    var touchThreshold = $(this).data('slick-touch-threshold') || 5;
    var asNavFor = $(this).data('slick-nav-for') || null;
    var vertical = $(this).data('slick-vertical') || false;
    var verticalSwiping = $(this).data('slick-vertical-swiping') || false;
    var menu = $(this).data('slick-menu') || false;
    var controls = $(this).data('slick-controls') || false;
    var disableOnMobile = $(this).data('slick-disable-on-mobile') || false;
    var disableOnPC = $(this).data('slick-disable-on-pc') || false;
    var swipe = (typeof $(this).data('slick-swipe') != 'undefined' ?  $(this).data('slick-swipe') : true);
    var pauseOnFocus = (typeof $(this).data('slick-pause-on-focus') != 'undefined' ?  $(this).data('slick-pause-on-focus') : true);
    var mousewheel = (typeof $(this).data('slick-mousewheel') != 'undefined' ?  $(this).data('slick-mousewheel') : false);

    var checkControlsActivity = function(){
      if (!infinite)
      {
        if ($(slick).find('.slick-active:first').prev().length < 1)
        {
          $(controls).find('.slides-controls__item_left').addClass('slides-controls__item_ia');
        }
        else
        {
          $(controls).find('.slides-controls__item_left').removeClass('slides-controls__item_ia');
        }

        if ($(slick).find('.slick-active:last').next().length < 1)
        {
          $(controls).find('.slides-controls__item_right').addClass('slides-controls__item_ia');
        }
        else
        {
          $(controls).find('.slides-controls__item_right').removeClass('slides-controls__item_ia');
        }
      }
    };

    if (!(isMobile() && disableOnMobile) && !(!isMobile() && disableOnPC))
    {
      if (typeof $(this).data('slick-mobile-fade') !== 'undefined')
      {
        fade = $(this).data('slick-mobile-fade');
      }

      if (typeof $(this).data('slick-mobile-slidestoshow') != "undefined" && isMobile())
      {
        slidesToShow = $(this).data('slick-mobile-slidestoshow');
      }
      if ($(this).data('slick-mobile-slidestoscroll') && isMobile())
      {
        slidesToScroll = $(this).data('slick-mobile-slidestoscroll');
      }
console.log({
        infinite: infinite,
        slidesToShow: slidesToShow,
        slidesToScroll: slidesToScroll,
        arrows: arrows,
        dots: dots,
        fade: fade,
        autoplay: autoplay,
        autoplaySpeed: autoplaySpeed,
        adaptiveHeight: adaptiveHeight,
        variableWidth: variableWidth,
        touchThreshold: touchThreshold,
        vertical: vertical,
        verticalSwiping: verticalSwiping,
        asNavFor: asNavFor,
        swipe: swipe,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        waitForAnimate: false
      })
      slick.slick({
        infinite: infinite,
        slidesToShow: slidesToShow,
        slidesToScroll: slidesToScroll,
        arrows: arrows,
        dots: dots,
        fade: fade,
        autoplay: autoplay,
        autoplaySpeed: autoplaySpeed,
        adaptiveHeight: adaptiveHeight,
        variableWidth: variableWidth,
        touchThreshold: touchThreshold,
        vertical: vertical,
        verticalSwiping: verticalSwiping,
        asNavFor: asNavFor,
        swipe: swipe,
        pauseOnFocus: false,
        pauseOnHover: false,
        pauseOnDotsHover: false,
        waitForAnimate: false
      });

      if (mousewheel && !isMobile())
      {
        slick.mousewheel(function(e){
          e.preventDefault();

          if (e.deltaY < 0)
          {
            $(this).slick('slickNext');
          }
          else
          {
            $(this).slick('slickPrev');
          }
        });
      }

      checkControlsActivity();

      slick.on('afterChange', function(event, slick, currentSlide){
        updateLazyload();
        checkControlsActivity();
      });

      slick.on('beforeChange', function(event, slick, currentSlide, nextSlide){
        //console.log(currentSlide);
        if (paginator && nextSlide)
        {
          $(paginator).find('.paginator__current').text((nextSlide + 1));
        }
        else if (paginator && !nextSlide)
        {
          $(paginator).find('.paginator__current').text('1');
        }

        if (menu)
        {
          $(menu).find('.slides-menu__item_active').removeClass('slides-menu__item_active');
          $(menu).find('.slides-menu__item').eq(nextSlide).addClass('slides-menu__item_active');

          $(menu).find('.slides-menu__item_active').removeClass('slides-menu__item_prev');
          $(menu).find('.slides-menu__item_active').prevAll('.slides-menu__item').addClass('slides-menu__item_prev');
          $(menu).find('.slides-menu__item_active').nextAll('.slides-menu__item').removeClass('slides-menu__item_prev');
        }

        if (buttons && buttons.length > 0)
        {
          var buttons_elements = $(buttons).find('.header-buttons__item');

          $(buttons_elements).removeClass('header-buttons__item_active');
          $(buttons_elements).eq(nextSlide).addClass('header-buttons__item_active');

          if (circle_progress)
          {
            $(buttons_elements).circleProgress('value', 0.0);

            $(buttons).find('.header-buttons__item_active').circleProgress('animation', {
              duration: (autoplaySpeed + 300)
            });

            $(buttons).find('.header-buttons__item_active').circleProgress('value', 1.0);
          }
        }
      });

      if (buttons && buttons.length > 0)
      {
        var buttons_elements = $(buttons).find('.header-buttons__item');

        $(buttons_elements).eq(0).addClass('header-buttons__item_active');

        if (circle_progress)
        {
          var circle_progress_size = $(buttons).find('.header-buttons__item').width();

          $(buttons_elements).each(function(index){
            $(this).circleProgress({
              value: 0.0,
              size: circle_progress_size,
              thickness: 2,
              fill: {
                color: 'rgba(0,0,0,.2)'
              },
              emptyFill: 'rgba(0,0,0,.0)',
              animation: {
                duration: (autoplaySpeed + 300)
              }
            });
          });

          try {
            $(buttons).find('.header-buttons__item_active').circleProgress('value', 1.0);
          } catch (e) {
            //console.log('First slide');
          }
        }

        $(buttons_elements).on('click', function(e){
          var current = this;
          slick.slick('slickGoTo', $(current).index());
        });
      }
    }
  });

  $('.slides-controls__item').on('click', function(e){
    var slick = $($(this).attr('data-slick'));
    var controls = $(this).parents('.slides-controls');

    if ($(this).hasClass('slides-controls__item_left') || $(this).hasClass('slides-controls__item_top'))
    {
      slick.slick('slickPrev');
    }
    else if ($(this).hasClass('slides-controls__item_right') || $(this).hasClass('slides-controls__item_bottom'))
    {
      slick.slick('slickNext');
    }

    if (slick.slick('slickCurrentSlide') && Number.isInteger(slick.slick('slickCurrentSlide')))
    {
      $(controls).find('.paginator__current').text(slick.slick('slickCurrentSlide') + 1);
    }
    else
    {
      $(controls).find('.paginator__current').text('1');
    }
  });


  /* \Sliders */

  /* Selectbox */
  /* Plugin was modified */
  var initializeSelectbox = function(selectbox_class){
    $(selectbox_class).each(function(index){
      var current = this;
      $(this).customSelect({
        placeholder: ($(current).attr('data-placeholder') ? $(current).attr('data-placeholder') : false),
        transition: 100,
        includeValue: false,
        modifier: ($(current).attr('data-modifier') ? $(current).attr('data-modifier') : false),
        topspace: $('#navigation_header').height() + ($('#bx-panel').hasClass('bx-panel-fixed') ? $('#bx-panel').height() : 0),
        hideCallback: function(){
          if ($(current).attr('data-modifier') && $(current).attr('data-modifier') == 'custom-select_year')
          {
            var year = $('.years option:selected').val();

            if (year != news_filter_year)
            {
              insertParam('year', year);
            }
          }

          if ($(current).attr('data-modifier') && $(current).attr('data-modifier') == 'custom-select_languages')
          {
            var language_link = $('.languages option:selected').attr('data-link');
            var language_code = $('.languages option:selected').val().toLowerCase();

            //console.log(language_code);
            if (LANGUAGE_ID != language_code)
            {
              document.location.href = language_link;
            }
          }
        },
        showCallback: function(){
          if ($(current).attr('data-modifier') && $(current).attr('data-modifier') == 'custom-select_years')
          {
            news_filter_year = $('.years option:selected').val();
          }
        }
      });
    });

    if (location.hash.indexOf('#size_')!=-1)
    {
        var sizehash=location.hash.substr(6);
        $('.block-product__size-wrapper .custom-select__option').each(function(){
            if ($(this).html()==sizehash) $(this).click();
        })
    }
  };
  /* \Selectbox */

  /* Modals */
  $('.modal').each(function(index) {
    var current = $(this);

    if ($(this).hasClass('modal_video'))
    {
        //console.log('test7');
      $(this).iziModal({
        width: (isMobile() ? 300 : (parseInt($('body').css('font-size'), 0) * 57)),
        overlayColor: 'rgba(48, 48, 48, .7)',
        iframe: true,
        iframeHeight: (isMobile() ? 300 : (parseInt($('body').css('font-size'), 0) * 32)),
        iframeURL: $(this).attr('data-video'),
        onOpening: function(modal){
          updateLazyload(current);
        }
      });
    }
    if ($(this).hasClass('modal_map'))
    {
        //console.log('test6');
      $(this).iziModal({
        width: (isMobile() ? 300 : 930),
        overlayColor: 'rgba(48, 48, 48, .7)',
        iframe: true,
        iframeHeight: (isMobile() ? 300 : 600),
        iframeURL: $(this).attr('data-map'),
        onOpening: function(modal){
          updateLazyload(current);
        }
      });
    }
    else if ($(this).hasClass('modal_alert'))
    {
        //console.log('test5');
      $(this).iziModal({
        overlayColor: 'rgba(48, 48, 48, .7)',
        icon: 'icon-power_settings_new',
        headerColor: '#BD5B5B',
        width: (isMobile() ? 300 : 600),
        timeout: ($(current).attr('id') == 'alert-form' ? 10000 : 3000),
        timeoutProgressbar: true,
        transitionIn: '',
        transitionOut: '',
        transitionInOverlay: '',
        transitionOutOverlay: '',
        top: 0,
        pauseOnHover: true
      });
    }
    else if ($(this).hasClass('modal_success'))
    {
        //console.log('test4');
      $(this).iziModal({
        overlayColor: 'rgba(48, 48, 48, .7)',
        headerColor: '#00bce4',
        width: (isMobile() ? 300 : 600),
        timeout: 10000,
        timeoutProgressbar: true,
        transitionIn: '',
        transitionOut: '',
        transitionInOverlay: '',
        transitionOutOverlay: '',
        loop: true,
        pauseOnHover: true
      });
    }
    else if ($(this).hasClass('modal_ajax'))
    {
        //console.log('test3');
      $(this).iziModal({
        width: (isMobile() ? 320 : 600),
        overlayColor: 'rgba(48, 48, 48, .7)',

        onOpening: function(modal) {
          showWaitOverlay();
          $(current).find('.modal__content').addClass('modal__content_hidden').html('');

          $.get($(current).attr('data-ajax'), function(data) {
            $(current).find('.modal__content').html(data);

            // Show loaded content
            setTimeout(function(){
              $(current).find('.modal__content').removeClass('modal__content_hidden');
            }, 500);

            closeWaitOverlay();
          });

          // Load lazy images inside modal
          updateLazyload(current);

          if ($(current).hasClass('modal_form') || $(current).attr('id') == 'confidence')
          {
            $('#confidence').iziModal('setZindex', 9999);

            if ($(current).attr('id') == 'confidence' || $(current).hasClass('modal_map'))
            {
              $('.modal_map').each(function(index){
                $(this).iziModal('setZindex', 99999);
              });
            }
            else
            {
              $('.modal_map').each(function(index){
                $(this).iziModal('setZindex', 99999);
              });
            }
          }
          else
          {
            $('#confidence').iziModal('setZindex', 999);
          }
        }
      });
    }
    else
    {
      $(this).iziModal({
        bodyOverflow: true,
        focusInput: (isMobile() || md.tablet() ? false : true),
        width: (isMobile() ? 320 : ($(this).hasClass('modal_image') ? (parseInt($('body').css('font-size'), 0) * 57) : (parseInt($('body').css('font-size'), 0) * 35))),
        overlayColor: 'rgba(48, 48, 48, .7)',
        loop: true,
        onOpening: function(modal) {
          // Load lazy images inside modal
          updateLazyload(current);

          $('.form__input_error').removeClass('form__input_error');
          $('.form__input input').val('');

          if ($(current).hasClass('modal_form') || $(current).attr('id') == 'confidence')
          {
            $('#confidence').iziModal('setZindex', 9999);

            if ($(current).attr('id') == 'confidence' || $(current).hasClass('modal_map'))
            {
              $('.modal_map').each(function(index){
                $(this).iziModal('setZindex', 99999);
              });
            }
            else
            {
              $('.modal_map').each(function(index){
                $(this).iziModal('setZindex', 99999);
              });
            }

            if ($(current).attr('id') == 'favorite')
            {
              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

              $.get('/ajax/wishlist.php', function(data) {
                $(current).find('.modal__content').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content').removeClass('modal__content_hidden');
                }, 500);

                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
              });
            }
			
			  if ($(current).attr('id') == 'favorite-en')
            {
              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

              $.get('/en/ajax/wishlist.php', function(data) {
                $(current).find('.modal__content').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content').removeClass('modal__content_hidden');
                }, 500);

                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
              });
            }

            if ($(current).attr('id') == 'cart')
            {
              //showWaitOverlay();
              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

              $.get('/ajax/cart.php?view=Y', function(data) {
                $(current).find('.modal__content').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content').removeClass('modal__content_hidden');
                }, 500);

                //closeWaitOverlay();
                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
              });
            }
			 if ($(current).attr('id') == 'cart-en')
            {
              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

              $.get('/en/ajax/cart.php?view=Y', function(data) {
                $(current).find('.modal__content').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content').removeClass('modal__content_hidden');
                }, 500);

                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
              });
            }


            if ($(current).attr('id') == 'form-order')
            {

              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

                var fast_id = 0;
                if($("#fast-order").data('prod') == 'offer'){
                    fast_id = $('.select_size :selected').val();
                    if(fast_id === undefined){
                        fast_id = $('.block-product-colors__item').data('defsize');
                    }else{
                        if(fast_id === 'not'){
                            fast_id = $('.block-product-colors__item').data('defsize');
                        }
                    }
                }else{
                    fast_id = $("#fast-order").data('prod');
                    //console.log(fast_id);
                }

                showWaitOverlay();
                  $(current).find('.modal__content2').addClass('modal__content_hidden').html('');

                  $.get('/ajax/order_1click.php?id='+fast_id, function(data) {
                    $(current).find('.modal__content2').html(data);

                    // Show loaded content
                    setTimeout(function(){
                      $(current).find('.modal__content2').removeClass('modal__content_hidden');
                    }, 500);

                    closeWaitOverlay();

                    // Load lazy images inside modal
                    updateLazyload(current);
                    initializeSelectbox('#form-order .selectbox');
                  });
            }


            if ($(current).attr('id') == 'form-order-en')
            {

              showWaitOverlay();
              $(current).find('.modal__content').addClass('modal__content_hidden').html('');

                var fast_id = 0;
                if($("#fast-order").data('prod') == 'offer'){
                    fast_id = $('.select_size :selected').val();
                    if(fast_id === undefined){
                        fast_id = $('.block-product-colors__item').data('defsize');
                    }else{
                        if(fast_id === 'not'){
                            fast_id = $('.block-product-colors__item').data('defsize');
                        }
                    }
                }else{
                    fast_id = $("#fast-order").data('prod');
                    //console.log(fast_id);
                }

                showWaitOverlay();
                  $(current).find('.modal__content2').addClass('modal__content_hidden').html('');


                  $.get('/en/ajax/order_1click.php?id='+fast_id, function(data) {
                    $(current).find('.modal__content2').html(data);

                    // Show loaded content
                    setTimeout(function(){
                      $(current).find('.modal__content2').removeClass('modal__content_hidden');
                    }, 500);

                    closeWaitOverlay();

                    // Load lazy images inside modal
                    updateLazyload(current);
                    initializeSelectbox('#form-order-en .selectbox');
                  });
            }

            if ($(current).attr('id') == 'cart-order')
            {
              showWaitOverlay();
              $(current).find('.modal__content2').addClass('modal__content_hidden').html('');

              $.get('/ajax/order.php', function(data) {
                $(current).find('.modal__content2').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content2').removeClass('modal__content_hidden');
                }, 500);

                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
                initializeSelectbox('#cart-order .selectbox');
              });
            }
			 if ($(current).attr('id') == 'cart-order-en')
            {
              showWaitOverlay();
              $(current).find('.modal__content2').addClass('modal__content_hidden').html('');

              $.get('/en/ajax/order.php', function(data) {
                $(current).find('.modal__content2').html(data);

                // Show loaded content
                setTimeout(function(){
                  $(current).find('.modal__content2').removeClass('modal__content_hidden');
                }, 500);

                closeWaitOverlay();

                // Load lazy images inside modal
                updateLazyload(current);
                initializeSelectbox('#cart-order-en .selectbox');
              });
            }
          }
          else
          {
            $('#confidence').iziModal('setZindex', 999);
              //console.log('test');
          }

          if (isMobile() || md.tablet())
          {
            last_position = $(window).scrollTop();
            $('html').addClass('l-site_menu_disabled');
            $('html').addClass('l-site_form');

            setTimeout(function(){
              $('html').removeClass('l-site_menu_disabled');
            }, 150);
          }
        },
        onOpened: function() {
          if (isMobile() || md.tablet())
          {
            $('html').removeClass('l-site_menu_disabled');
          }
        },
        onClosing: function() {
          if (isMobile() || md.tablet())
          {
            $('html').addClass('l-site_menu_disabled');
            $([document.documentElement, document.body]).animate({
              scrollTop: last_position
            }, 5);
          }
        },
        onClosed: function() {
          if (isMobile() || md.tablet())
          {
            setTimeout(function(){
              $('html').removeClass('l-site_form');
              $('html').removeClass('l-site_menu_disabled');
            }, 5);
          }
        },
        transitionIn: '',
        transitionOut: '',
        transitionInOverlay: '',
        transitionOutOverlay: ''
      });
    }
  });

  $(document).on('click', '.i-modal', function(event) {
      event.preventDefault();

      if($(this).attr('id') == 'fast-order'){
          if($("#fast-order").data('prod') == 'offer'){
              fast_id = $('.select_size :selected').val();
              if(fast_id === 'not'){
                  $('.custom-select_size .custom-select__option--value').css('border-color', 'red');
                  return false;
              }else{
                  $('.custom-select_size .custom-select__option--value').css('border-color', '#e5e5e5');
              }
          }
      }

    if ($(this).attr('data-source'))
    {
      $($(this).attr('href')).find('[name="source"]').val($(this).attr('data-source'));
    }
    $($(this).attr('href')).iziModal('open');
  });
  /* \Modals */

  /* Forms */
  var news_filter_year = false;

  initializeSelectbox('.selectbox');

  $(document).on('click', '.form-confidence__checkbox', function(e){
    $('#alert-confidence').iziModal('open');
  });

  $(document).on('focus', '.form__input input', function(e){
    $(this).parents('.form__input').addClass('form__input_focus');
  });

  $(document).on('blur', '.form__input input', function(e){
    $(this).parents('.form__input').removeClass('form__input_focus');
  });

  /* Filters & Masks */
  /* Phone */
  var country_codes = {"BD": "880", "BE": "32", "BF": "226", "BG": "359", "BA": "387", "BB": "+1-246", "WF": "681", "BL": "590", "BM": "+1-441", "BN": "673", "BO": "591", "BH": "973", "BI": "257", "BJ": "229", "BT": "975", "JM": "+1-876", "BV": "", "BW": "267", "WS": "685", "BQ": "599", "BR": "55", "BS": "+1-242", "JE": "+44-1534", "BY": "375", "BZ": "501", "RU": "7", "RW": "250", "RS": "381", "TL": "670", "RE": "262", "TM": "993", "TJ": "992", "RO": "40", "TK": "690", "GW": "245", "GU": "+1-671", "GT": "502", "GS": "", "GR": "30", "GQ": "240", "GP": "590", "JP": "81", "GY": "592", "GG": "+44-1481", "GF": "594", "GE": "995", "GD": "+1-473", "GB": "44", "GA": "241", "SV": "503", "GN": "224", "GM": "220", "GL": "299", "GI": "350", "GH": "233", "OM": "968", "TN": "216", "JO": "962", "HR": "385", "HT": "509", "HU": "36", "HK": "852", "HN": "504", "HM": " ", "VE": "58", "PR": "+1-787 and 1-939", "PS": "970", "PW": "680", "PT": "351", "SJ": "47", "PY": "595", "IQ": "964", "PA": "507", "PF": "689", "PG": "675", "PE": "51", "PK": "92", "PH": "63", "PN": "870", "PL": "48", "PM": "508", "ZM": "260", "EH": "212", "EE": "372", "EG": "20", "ZA": "27", "EC": "593", "IT": "39", "VN": "84", "SB": "677", "ET": "251", "SO": "252", "ZW": "263", "SA": "966", "ES": "34", "ER": "291", "ME": "382", "MD": "373", "MG": "261", "MF": "590", "MA": "212", "MC": "377", "UZ": "998", "MM": "95", "ML": "223", "MO": "853", "MN": "976", "MH": "692", "MK": "389", "MU": "230", "MT": "356", "MW": "265", "MV": "960", "MQ": "596", "MP": "+1-670", "MS": "+1-664", "MR": "222", "IM": "+44-1624", "UG": "256", "TZ": "255", "MY": "60", "MX": "52", "IL": "972", "FR": "33", "IO": "246", "SH": "290", "FI": "358", "FJ": "679", "FK": "500", "FM": "691", "FO": "298", "NI": "505", "NL": "31", "NO": "47", "NA": "264", "VU": "678", "NC": "687", "NE": "227", "NF": "672", "NG": "234", "NZ": "64", "NP": "977", "NR": "674", "NU": "683", "CK": "682", "XK": "", "CI": "225", "CH": "41", "CO": "57", "CN": "86", "CM": "237", "CL": "56", "CC": "61", "CA": "1", "CG": "242", "CF": "236", "CD": "243", "CZ": "420", "CY": "357", "CX": "61", "CR": "506", "CW": "599", "CV": "238", "CU": "53", "SZ": "268", "SY": "963", "SX": "599", "KG": "996", "KE": "254", "SS": "211", "SR": "597", "KI": "686", "KH": "855", "KN": "+1-869", "KM": "269", "ST": "239", "SK": "421", "KR": "82", "SI": "386", "KP": "850", "KW": "965", "SN": "221", "SM": "378", "SL": "232", "SC": "248", "KZ": "7", "KY": "+1-345", "SG": "65", "SE": "46", "SD": "249", "DO": "+1-809 and 1-829", "DM": "+1-767", "DJ": "253", "DK": "45", "VG": "+1-284", "DE": "49", "YE": "967", "DZ": "213", "US": "1", "UY": "598", "YT": "262", "UM": "1", "LB": "961", "LC": "+1-758", "LA": "856", "TV": "688", "TW": "886", "TT": "+1-868", "TR": "90", "LK": "94", "LI": "423", "LV": "371", "TO": "676", "LT": "370", "LU": "352", "LR": "231", "LS": "266", "TH": "66", "TF": "", "TG": "228", "TD": "235", "TC": "+1-649", "LY": "218", "VA": "379", "VC": "+1-784", "AE": "971", "AD": "376", "AG": "+1-268", "AF": "93", "AI": "+1-264", "VI": "+1-340", "IS": "354", "IR": "98", "AM": "374", "AL": "355", "AO": "244", "AQ": "", "AS": "+1-684", "AR": "54", "AU": "61", "AT": "43", "AW": "297", "IN": "91", "AX": "+358-18", "AZ": "994", "IE": "353", "ID": "62", "UA": "380", "QA": "974", "MZ": "258"}

  $(document).on('keydown', '.form__input_required_phone input', function(event){
      // Allow: backspace, delete, tab, escape, enter and .
      if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
           // Allow: Ctrl+A
          (event.keyCode == 65 && event.ctrlKey === true) ||
           // Allow: home, end, left, right
          (event.keyCode >= 35 && event.keyCode <= 39)) {
               // let it happen, don't do anything
               return;
      }
      // Ensure that it is a number and stop the keypress
      if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
          event.preventDefault();
      }
  });

  $(document).on('keyup', '.form__input_required_phone input', function(event){
      if ($(this).val().charAt(0) != '+')
      {
          $(this).val('+' + $(this).val());
      }

      if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
           // Allow: Ctrl+A
          (event.keyCode == 65 && event.ctrlKey === true) ||
           // Allow: home, end, left, right
          (event.keyCode >= 35 && event.keyCode <= 39)) {
               // let it happen, don't do anything
               return;
      }

      var temp_phone = $(this);

      $.each(country_codes, function(key, value){
          if ($(temp_phone).val().indexOf('+' + value) === 0 && value)
          {
              $(temp_phone).val(formatInternational(key, $(temp_phone).val()));
          }
      });
  });
  /* \Phone */
  /* \Filters & Masks */

  /* Validation & Proccessing */
  $(document).on('click', '.form__submit .button', function(e){
    $(this).parents('form').submit();
  });

  $(document).on('submit', '.form', function(event){
    //event.preventDefault();
    if (!$(this).hasClass('wait'))
    {
        $(this).addClass('wait');

        var form_data = $(this).serialize();
        var form_current = $(this);
        var form_target = 'ORDER';

        if (!validateForm(form_current))
        {
          $(this).removeClass('wait');
          return false;
          //$('.i-loader').show();
        } else
        {
            $('.i-loader').show();
            if ($(this).attr('action')=='/php/order.php')
            {
                $.ajax({
                    type: 'POST',
                    url: '/php/order.php',
                    data: form_data,
                    success: function(response) {

                        $('.i-loader').hide();

                        if (response == 'sended')
                        {
                            // Sending target to Yandex Metrika
                            try {
                                window[('yaCounter' + yandex_metrika_key)].reachGoal(form_target);
                            } catch(e) { }

                            $('#success-form .iziModal-header-title').html('Спасибо!');
                            $('#success-form .iziModal-header-subtitle').html('Ваше сообщение успешно отправлено');
                            $('#success-form').iziModal('open');

                            // Close and clear all forms
                            form_current.each(function(index){
                                $(this).find('.form__input input').val('');
                            });

                            $('.modal_form').each(function(index){
                                $(this).iziModal('close');
                            });
                        }
                        else
                        {
                            $('#alert-form .iziModal-header-title').html('Ошибка');
                            $('#alert-form .iziModal-header-subtitle').html(response);
                            $('#alert-form').iziModal('open');
                        }
                    }
                });
                return false;
            } else
            {

                //$('#fid-comment').val($('.form__select :selected').val());
                $(this).find('input[name="COMMENT"]').val($(this).find('.form__select').val());
                //console.log($('.form__select :selected').val());
                //console.log($(this).find('.form__select').val());

            }
            //return false;
        }
    }

  });
  /* \Validation & Proccessing */

  /* \Forms */

  /* Scroll Animation */
  /*if (!md.tablet() && !isMobile())
  {
    AOS.init();
  }
  else
  {
    $('[data-aos]').removeAttr('data-aos');
  }*/
  /* \Scroll Animation */

  /* Blocks */

  /* Brands Mobile */
  $(document).on('click', '.menu-menu__item_brands', function(e){
    e.preventDefault();

    $('#menu-brands').addClass('block-menu_brands_active');
  });

  $(document).on('click', '.block-menu__close', function(e){
    $('#menu-brands').removeClass('block-menu_brands_active');
  });
  /* \Brands Mobile */

  /* Search */
  $(document).on('click', '.additional-item-search', function(e){
    e.preventDefault();

    if (!$('.additional-search-form').hasClass('additional-search-form_active'))
    {
      $('.additional-search-form').addClass('additional-search-form_active');
      $('.block-navigation').addClass('block-navigation_search');
      $('.additional-search-form__input').focus();

      // Focus after 100ms to avoid browser security issues
      setTimeout(function() {
        $('.additional-search-form__input').focus();
      }, 100);
    }
    else
    {
      // Move to Search Page
      document.location.href = (LANGUAGE_ID == 'ru' ? '/' : '/' + LANGUAGE_ID + '/') + 'catalog/?q=' + encodeURIComponent($('.additional-search-form__input').val());
    }
  });

  $(document).on('blur', '.additional-search-form__input', function(e){
    // If focusout then check focus status after 500ms again
    setTimeout(function() {
      if (!$('.additional-search-form__input').is(':focus'))
      {
        $('.additional-search-form').removeClass('additional-search-form_active');
        $('.block-navigation').removeClass('block-navigation_search');
      }
    }, 500);
  });
/*
  var updateAutocompletePosition = function(){
    $('.autocomplete-suggestions').css('top', ($('.additional-search-form__input').offset().top + $('.additional-search-form__input').height() + 3) + 'px');
    $('.autocomplete-suggestions').css('left', ($('.additional-search-form__input').offset().left) + 'px');
  };

  $('.additional-search-form__input').autocomplete({
    serviceUrl: '/catalog/autocomplete/',
    forceFixPosition: true,
    onSelect: function(suggestion){
      document.location.href = '/catalog/?q=' + suggestion.value;
    },
    beforeRender: function(){
      setTimeout(function(){
        $('.autocomplete-suggestions').css('left', ($('.additional-search-form__input').offset().left) + 'px');
      }, 100);
    }
  });*/
/*
  $(window).on('scroll resize', function(e){
    updateAutocompletePosition();
  });*/
  /* \Search */

  /* Index */
  if (!isMobile())
  {
    // Add Video Background script only for PCs and Tablets
    $('body').append('<script src="' + SITE_TEMPLATE_PATH + '/assets/js/vendors/video-bg/jquery.vide.min.js"></script>');

    // Manually starting video in 1000ms to avoid Safari bug
    setTimeout(function(){
      if (!isMobile() && $('.block-header-video__inner video').length > 0)
      {
        $('.block-header-video__inner video')[0].play();
        //console.log('Video Play');
      }
    }, 1000);
  }
  /* \Index */

  /* Catalog */
  $(document).on('click', '.filter-category__title', function(e){
    if ($(this).parents('.filter-category').hasClass('filter-category_opened'))
    {
      $(this).parents('.filter-category').removeClass('filter-category_opened');
    }
    else
    {
      $(this).parents('.filter-category').addClass('filter-category_opened');
    }
  });

  var result_filter_url = document.location.search;

  $(document).on('click', '.filter-checkbox', function(e){
    var key_data = '';
    var i = 0;

    if ($(this).hasClass('filter-checkbox_active'))
    {
      $(this).removeClass('filter-checkbox_active');
        var id = $(this).attr('data-value');
        var target = $('#'+id);
        //console.log(target);
        //if(!target.is(":checked")){
            target.trigger('click');
        //}
    }
    else
    {
      $(this).addClass('filter-checkbox_active');

      var id = $(this).attr('data-value');
      var target = $('#'+id);
      //console.log(target);
      //if(!target.is(":checked")){
          target.trigger('click');
      //}
    }

    /*if ($(this).parents('.filter-group').find('.filter-checkbox_active').length)
    {
      $(this).parents('.filter-group').find('.filter-checkbox_active').each(function(index){
        key_data += (i != 0 ? ',' : '') + $(this).attr('data-value');
        i++;
      });
    }*/
/*
    if (isMobile())
    {
      result_filter_url = insertParam($(this).parents('.filter-group').attr('data-key'), key_data, true, result_filter_url);
    }
    else
    {
      insertParam($(this).parents('.filter-group').attr('data-key'), key_data);
    }*/
  });
/*
    $(".catalog-filter__header.selectbox").change(function() {
        var id = $(this).val();
        var target = $(this).parent().find('.controller_checkbox[data-id="'+id+'"]');
        if(!target.is(":checked")){
            target.trigger('click');
        }
    });

    $(".catalog-filter__column").on( "click", ".filter-variant", function() {
        var id = $(this).data('val');
        var target = $(this).closest('.catalog-filter__column').find('.controller_checkbox[data-id="'+id+'"]');
        if(target.is(":checked")){
            target.trigger('click');
        }
    });
*/

  /*$(document).on('click', '.catalog-filter__button', function(e){
    document.location.search = result_filter_url;
  });

  $(document).on('click', '.filter-category__reset', function(e){
    $(this).parents('.filter-category').find('.filter-checkbox_active').removeClass('filter-checkbox_active');
    insertParam($(this).parents('.filter-category').find('.filter-group').attr('data-key'), '');
  });*/

    $(document).on('click', '.block-catalog__more', function(e){
        /*$('.preloader').addClass('preloader_active');


        // Example
        setTimeout(function(){
          //$('.block-catalog__items').append(product_1 + product_2 + product_3);

          // Update LazyLoad after adding new items
          updateLazyload();

          // Hide preloader
          $('.preloader').removeClass('preloader_active');
        }, 1500);*/
        showWaitOverlay();
        $.ajax
        ({
            url: $('.paginator__control_right').attr('href')+'&showmore=Y',
            type: "get",
            cache: false,
            success: function(html)
            {
                var ar=html.split('<!--pager-->');
                $('#js-catalog-items').append(ar[0]);
                $('#js-catalog-pager').html(ar[1]);
                updateLazyload();
                closeWaitOverlay();

            },
        	error:  function(xhr, ajaxOptions, thrownError){
        		closeWaitOverlay();
        	}
        });
    });

  $(document).on('click', '.catalog-top__item_sort', function(e){
    if ($(this).hasClass('catalog-top__item_sort_active'))
    {
      $(this).removeClass('catalog-top__item_sort_active');
    }
    else
    {
      $(this).addClass('catalog-top__item_sort_active');
    }
  });

  $(document).click(function(event){
    $target = $(event.target);
    if (!$target.closest('.catalog-top__item_sort').length && $('.catalog-top__item_sort').is(':visible'))
    {
      $('.catalog-top__item_sort_active').removeClass('catalog-top__item_sort_active');
    }
  });

  var total_filters_num = 0;

  if ($('.block-catalog').length)
  {
    $('#catalog-filter .filter-group').each(function(index){
      if ($(this).find('.filter-checkbox_active').length)
      {
        total_filters_num++;
      }
    });

    $('.catalog-top__filter-num span').text(total_filters_num);

    if (total_filters_num > 0)
    {
      $('.catalog-top__filter-num').addClass('catalog-top__filter-num_active');
    }
  }
  /* \Catalog */

  /* Product */
  




  $(document).on('click', '.block-product-colors__item', function(e){
    $('.block-product-selectded-color').text($(this).data('label'));
  });

  $(document).on('click', '.info-pages__item', function(e){
    var current = this;

    if (!$(this).hasClass('info-pages__item_active'))
    {
      $('.info-pages__item_active').removeClass('info-pages__item_active');
      $(current).addClass('info-pages__item_active');

      setTimeout(function(){
        $(window).scrollTop($('.info-pages__item_active').offset().top - 80);
      }, 150);
    }
  });



  $(document).on('click', '.cart-end__side .button', function(e){
    e.preventDefault();

    if ($('#cart-en').length)
    {
        $('#cart-en').iziModal('close');
        $('#cart-order-en').iziModal('open');
    } else
    {
        $('#cart').iziModal('close');
        $('#cart-order').iziModal('open');
    }

  });
$(document).on('click', '.cart-end__side_en .button', function(e){
    e.preventDefault();

    $('#cart-en').iziModal('close');
    $('#cart-order-en').iziModal('open');
  });
  /*var gallery = false;

  var initPhotoSwipeFromDOM = function(gallerySelector) {

      // parse slide data (url, title, size ...) from DOM elements
      // (children of gallerySelector)
      var parseThumbnailElements = function(el) {
          var thumbElements = el.childNodes,
              numNodes = thumbElements.length,
              items = [],
              figureEl,
              linkEl,
              size,
              item;

          for(var i = 0; i < numNodes; i++) {

              figureEl = thumbElements[i]; // <figure> element

              // include only element nodes
              if(figureEl.nodeType !== 1 || $(figureEl).hasClass('nob20-detail-video')) {
                  continue;
              }

              linkEl = figureEl.children[0]; // <a> element

              size = linkEl.getAttribute('data-size').split('x');

              // create slide object
              item = {
                  src: linkEl.getAttribute('href'),
                  w: parseInt(size[0], 10),
                  h: parseInt(size[1], 10)
              };



              if(figureEl.children.length > 1) {
                  // <figcaption> content
                  item.title = figureEl.children[1].innerHTML;
              }

              if(linkEl.children.length > 0) {
                  // <img> thumbnail element, retrieving thumbnail url
                  item.msrc = linkEl.children[0].getAttribute('src');
              }

              item.el = figureEl; // save link to element for getThumbBoundsFn
              items.push(item);
          }

          return items;
      };

      // find nearest parent element
      var closest = function closest(el, fn) {
          return el && ( fn(el) ? el : closest(el.parentNode, fn) );
      };

      // triggers when user clicks on thumbnail
      var onThumbnailsClick = function(e) {
          e = e || window.event;
          e.preventDefault ? e.preventDefault() : e.returnValue = false;

          var eTarget = e.target || e.srcElement;

          // find root element of slide
          var clickedListItem = closest(eTarget, function(el) {
              return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
          });

          if(!clickedListItem) {
              return;
          }

          // find index of clicked item by looping through all child nodes
          // alternatively, you may define index via data- attribute
          var clickedGallery = clickedListItem.parentNode,
              childNodes = clickedListItem.parentNode.childNodes,
              numChildNodes = childNodes.length,
              nodeIndex = 0,
              index;

          for (var i = 0; i < numChildNodes; i++) {
              if(childNodes[i].nodeType !== 1) {
                  continue;
              }

              if(childNodes[i] === clickedListItem) {
                  index = nodeIndex;
                  break;
              }
              nodeIndex++;
          }



          if(index >= 0) {
              // open PhotoSwipe if valid index found
              openPhotoSwipe( index, clickedGallery );
          }
          return false;
      };

      // parse picture index and gallery index from URL (#&pid=1&gid=2)
      var photoswipeParseHash = function() {
          var hash = window.location.hash.substring(1),
          params = {};

          if(hash.length < 5) {
              return params;
          }

          var vars = hash.split('&');
          for (var i = 0; i < vars.length; i++) {
              if(!vars[i]) {
                  continue;
              }
              var pair = vars[i].split('=');
              if(pair.length < 2) {
                  continue;
              }
              params[pair[0]] = pair[1];
          }

          if(params.gid) {
              params.gid = parseInt(params.gid, 10);
          }

          return params;
      };

      var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
          var pswpElement = document.querySelectorAll('.pswp')[0],
              options,
              items;

          items = parseThumbnailElements(galleryElement);

          // define options (if needed)
          options = {

              // define gallery index (for URL)
              galleryUID: galleryElement.getAttribute('data-pswp-uid'),

              getThumbBoundsFn: function(index) {
                  // See Options -> getThumbBoundsFn section of documentation for more info
                  var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                      pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                      rect = thumbnail.getBoundingClientRect();

                  return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
              }

          };

          // PhotoSwipe opened from URL
          if(fromURL) {
              if(options.galleryPIDs) {
                  // parse real index when custom PIDs are used
                  // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                  for(var j = 0; j < items.length; j++) {
                      if(items[j].pid == index) {
                          options.index = j;
                          break;
                      }
                  }
              } else {
                  // in URL indexes start from 1
                  options.index = parseInt(index, 10) - 1;
              }
          } else {
              options.index = parseInt(index, 10);
          }

          // exit if index not found
          if( isNaN(options.index) ) {
              return;
          }

          if(disableAnimation) {
              options.showAnimationDuration = 0;
          }

          // Pass data to PhotoSwipe and initialize it
          gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
          gallery.init();

          if ($('.pswp__thumbnails').length)
          {
            $('.pswp__thumbnails').remove();
          }

          var _thumbnails = '<div class="pswp__thumbnails">';

          for(var i = 0, l = items.length; i < l; i++) {
            _thumbnails += '<div class="pswp__thumbnail" style="background-image:url(\'' + items[i]['src'] + '\');"></div>';
          }

          _thumbnails += '</div>';

          $('.pswp__scroll-wrap').append(_thumbnails);
      };

      // loop through all gallery elements and bind events
      var galleryElements = document.querySelectorAll( gallerySelector );

      for(var i = 0, l = galleryElements.length; i < l; i++) {
          galleryElements[i].setAttribute('data-pswp-uid', i+1);
          galleryElements[i].onclick = onThumbnailsClick;
      }

      // Parse URL and open gallery if it contains #&pid=3&gid=1
      var hashData = photoswipeParseHash();
      if(hashData.pid && hashData.gid) {
          openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
      }

      $('.block-product-colors__item').eq(hashData.gid - 1).click();
  };

  // execute above function
  initPhotoSwipeFromDOM('.gallery');

  $(document).on('click', '.pswp__thumbnail', function(e){
    var current = this;

    gallery.goTo($(current).index());
  });*/
  /* \Product */

  /* News */
  if ($('.wf-container').length && !isMobile())
  {
    var waterfall = new Waterfall({
      containerSelector: '.wf-container',
      boxSelector: '.wf-box',
      minBoxWidth: 360
    });
  }
  /* \News */

  /* Menu */
  var menuScroll = function(){
    if ($(window).scrollTop() > 20)
    {
      $('.block-navigation').addClass('block-navigation_scroll');
      $('.block-navigation').removeClass('block-navigation_stable');
    }
    else
    {
      $('.block-navigation').removeClass('block-navigation_scroll');
      $('.block-navigation').addClass('block-navigation_stable');
    }
  };

  menuScroll();

  $('.navigation-menu__item', '#navigation_header').on('mouseover click', function(e){
    e.preventDefault();

    var current_index = $(this).index();
    var current_page = $('.subnavigation-menu__page', '#subnavigation').eq(current_index);

    $('.subnavigation-menu__page', '#subnavigation').removeClass('subnavigation-menu__page_active');
    $('.navigation-menu__item', '#navigation_header').removeClass('navigation-menu__item_active');

    if ($(current_page).find('.subnavigation-menu__item-wrapper').length || $(current_page).find('.subnavigation-banner').length)
    {
      $(this).addClass('navigation-menu__item_active');
      $(current_page).addClass('subnavigation-menu__page_active');
      $('html').addClass('l-site_menu');
    }
    else
    {
      $('html').removeClass('l-site_menu');
      if (e.type !== 'mouseover')
      {
        document.location.href = $(this).attr('href');
      }
    }
  });

  $(document).on('mouseleave', '#subnavigation', function(e){
    $('html').removeClass('l-site_menu');
    $('.navigation-menu__item', '#navigation_header').removeClass('navigation-menu__item_active');
  });

  $(document).on('click', '.menu-button', function(e){
    $('html').addClass('l-site_menu');
  });

  $(document).on('click', '.block-menu__close', function(e){
    $('html').removeClass('l-site_menu');
  });
  /* \Menu */

  $(window).on('scroll', function(e){
    /* Menu */
    if (!$('.l-page').hasClass('l-page_menu'))
    {
      menuScroll();
    }
    /* \Menu */
  });
  /* Maps */
  /* Navs */
  //Nav.loadMap(false, {lat: 55.765319, lng: 37.631633}, {lat: 55.765319, lng: 37.631633});
  /* \Navs */
  /* \Maps */

  /* Admin only */
  var updateNavigationToBXPanel = function(){
    if ($('#bx-panel').hasClass('bx-panel-fixed'))
    {
      $('#navigation_header').css('top', $('#bx-panel').height() + 'px');
      $('#subnavigation').css('top', ($('#bx-panel').height() + parseInt($('body').css('font-size'), 0) * 3.85) + 'px');
      $('main .block:first').css('margin-top', $('#bx-panel').height() + 'px');
      $('#noty_layout__topRight').css('top', ($('#bx-panel').height() + parseInt($('body').css('font-size'), 0) * 4.85) + 'px');
    }
    else
    {
      if ($(window).scrollTop() >= $('#bx-panel').height())
      {
        $('#navigation_header').css('top', 0);
        $('#subnavigation').css('top', (parseInt($('body').css('font-size'), 0) * 3.85) + 'px');
        $('#noty_layout__topRight').css('top', (parseInt($('body').css('font-size'), 0) * 4.85) + 'px');
      }
      else
      {
        $('#navigation_header').css('top', ($('#bx-panel').height() - $(window).scrollTop()) + 'px');
        $('#subnavigation').css('top', ($('#bx-panel').height() - $(window).scrollTop() + (parseInt($('body').css('font-size'), 0) * 3.85)) + 'px');
        $('#noty_layout__topRight').css('top', ($('#bx-panel').height() - $(window).scrollTop() + (parseInt($('body').css('font-size'), 0) * 4.85)) + 'px');
      }

      $('main .block:first').css('margin-top', 0);
    }

    setTimeout(function(){
      updateNavigationToBXPanel();
    }, 20);
  };

  if ($('#bx-panel').length)
  {
    updateNavigationToBXPanel();
  }
  /* \Admin only */

  /* \Blocks */

  window.onload = function () { $('.preloader').removeClass('preloader_active'); }

  setTimeout(function(){
    $('.preloader').removeClass('preloader_active');
  }, 2000);
});

function isMobile()
{
  return ($('.i-check-mobile').css('display') == 'block');
}

function isMid()
{
  return ($('.i-check-mid').css('display') == 'block');
}

function isIE()
{
  var ua = window.navigator.userAgent;

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  return false;
}

function isMSEdge()
{
  return typeof CSS !== 'undefined' && CSS.supports("(-ms-ime-align:auto)");
}

function numberFormat(number, decimals, dec_point, thousands_sep)
{
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

var tippy_params_fields = {
  arrow: true,
  interactive: true,
  placement: 'left',
  size: 'small',
  distance: (isMobile() ? 0 : 10),
  interactiveBorder: 0,
  interactiveDebounce: 0
};

function validateForm(form)
{
  var fields_valid = true;

    if ($(form).find('.form__select') && $(form).find('.form__select').hasClass('form__input_required'))
    {
        if (!$(form).find('.form__select').val())
        {
            $(form).find('.custom-select').addClass('form__input_error');
        }
        else
        {
            $(form).find('.custom-select').removeClass('form__input_error');
        }
    }

    if ($(form).find('.form__select').length > 0)
    {
        $(form).find('.form__select').each(function(){
            $(this).removeClass('form__input_error');

            if (!$(this).val())
            {
                $(this).addClass('form__input_error');

                fields_valid = false;
            }
        });
    }

  if ($(form).find('.form__select').length > 0)
  {
    $(form).find('.form__select').each(function(){
      $(this).removeClass('form__input_error');

      if (!$(this).val())
      {
        $(this).addClass('form__input_error');

        fields_valid = false;
      }
    });
  }

  $(form).find('.form__input').each(function(){
    var current_field = $(this).find('input,textarea');

    $(current_field).parents('.form__input').removeClass('form__input_error');

    if ($(current_field)[0]._tippy)
    {
      $(current_field)[0]._tippy.destroy();
    }

    if ($(current_field).val().length < 1)
    {
      if ($(current_field).parents('.form__input').hasClass('form__input_required'))
      {
        $(current_field).attr('title', (LANGUAGE_ID == 'ru' ? 'Заполните данное поле!' : 'Fill in this field!'));
        $(current_field).parents('.form__input').addClass('form__input_error');
        if ($(current_field)[0]._tippy)
        {
          $(current_field)[0]._tippy.enable();
        }
        else
        {
          tippy($(current_field)[0], tippy_params_fields);
        }

        setTimeout(function(){
          $(current_field)[0]._tippy.show();
        }, 300);

        fields_valid = false;
      }
    }
    else
    {
      if ($(current_field).parents('.form__input').hasClass('form__input_required_email') && !validateEmail($(current_field)))
      {
        $(current_field).attr('title', (LANGUAGE_ID == 'ru' ? 'Введите корректный email!' : 'Enter a valid email!'));
        $(current_field).parents('.form__input').addClass('form__input_error');
        if ($(current_field)[0]._tippy)
        {
          $(current_field)[0]._tippy.enable();
        }
        else
        {
          tippy($(current_field)[0], tippy_params_fields);
        }

        $(current_field)[0]._tippy.show();

        fields_valid = false;
      }

      if ($(current_field).parents('.form__input').hasClass('form__input_required_phone') && !validatePhone($(current_field)))
      {
        $(current_field).attr('title', (LANGUAGE_ID == 'ru' ? 'Введите корректный телефон!' : 'Please enter a valid phone!'));
        $(current_field).parents('.form__input').addClass('form__input_error');
        if ($(current_field)[0]._tippy)
        {
          $(current_field)[0]._tippy.enable();
        }
        else
        {
          tippy($(current_field)[0], tippy_params_fields);
        }

        $(current_field)[0]._tippy.show();

        fields_valid = false;
      }
    }
  });

  return fields_valid;
}

function validateEmail(email_field)
{
  var email_pattern = /^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/;
  return email_pattern.test($(email_field).val());
}

function validatePhone(phone_field)
{
  if ($(phone_field).val().length < 6)
  {
    return false;
  }

  return true;
}

function formatMoney(n, c, d, t)
{
  var c = isNaN(c = Math.abs(c)) ? 0 : c,
    d = d == undefined ? "" : d,
    t = t == undefined ? " " : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;

  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function goBack()
{
  if (document.referrer.indexOf('//' + document.location.hostname) !== -1)
  {
    history.back();
  }
  else if ($('.breadcrumbs').length > 0)
  {
    document.location.href = $('.breadcrumbs__item_link').last().find('.breadcrumbs__link').attr('href');
  }
}

function insertParam(key, value, save, url)
{
    var _url = (url ? url : document.location.search);
    key = encodeURI(key); value = encodeURI(value);

    var kvp = _url.substr(1).split('&');

    var i=kvp.length; var x; while(i--)
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    if (save)
    {
      return kvp.join('&');
    }
    else
    {
      document.location.search = kvp.join('&');
    }
}


function formatPrice(num){
    var dec=10;
    var numSTR=num.toString().replace('.',',');
    var s = 0;
    var str = '';
    for( var i=numSTR.length-1; i>=0; i-- )
    {
        s++;
        str = numSTR.charAt(i) + str;
        if(numSTR.charAt(i)==',') s=0;
        if( s > 0 && !(s % 3))
        {
            str  = "&nbsp;" + str;
        }
    }
    if (str.indexOf('&nbsp;')==0)
    {
        str=str.substr(6,str.length-6);
    }
    return str;
}
