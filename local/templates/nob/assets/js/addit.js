$(document).ready(function() {
    jQuery("#bgndVideo").YTPlayer();

    $(document).on('click','.js-catalog-top-menu-filter',function(){
        $('.js-catalog-top-menu-filter').removeClass('catalog-menu__item_active');
        $(this).addClass('catalog-menu__item_active');
        $('input[data-code="GENDER"]').prop('checked',false);
        switch ($(this).attr('href'))
        {
            case "/catalog/men/":
            case "/en/catalog/men/":
                $('input[data-code="GENDER"][data-value="male"]').prop('checked',true);
                break;
            case "/catalog/women/":
            case "/en/catalog/women/":
                $('input[data-code="GENDER"][data-value="female"]').prop('checked',true);
                break;
        }
        smartFilter.click($('input[data-code="GENDER"]').first()[0]);
        return false;
    });

    initCatalogMenu();

    $('.js-currency-select-mobile').on('click',function(){
        $.cookie("CURRENCY_CATALOG", $(this).data('val'), { expires: 30000, path: "/"});
        location.reload();
    });

    $('#js-currency-select').on('change',function(){
        $.cookie("CURRENCY_CATALOG", $(this).val(), { expires: 30000, path: "/"});
        location.reload();
    });

    initContactsMap();

    $(document).on('click','.js-catalog-sort',function(){
        location.href=$(this).data('href');
    });

    // detail prod img gallery
        if ($('.js-nob21-detail-prod-slides__item').length > 0) {
            var imgs = [];
            $('.js-nob21-detail-prod-slides__item').each(function(){
                var curImg = $(this).attr('href'),
                    tumb = $(this).find('.js-nob21-detail-prod-slides__item-img').attr('src');
                imgs.push({'src':curImg,'thumb':tumb});
            })
            $(".js-nob21-detail-prod-slides__item").click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                var img = $(this).attr('href'),
                    index = 0;
                $.each(imgs, function(){
                    if (this.src == img) {
                        return false;
                    }
                    index += 1;
                });
                $(this).lightGallery({
                    licenseKey: 'QLNTJ-WT9VM-P3F5R-CWDER',
                    dynamic: true,
                    dynamicEl: imgs,
                    index: index
                });
            });
        }

});

function initContactsMap()
{
    if ($('#js-contacts-maps').length)
    {
        var arDataLatLon=$('#js-contacts-maps').data('coords').split(',');
        ymaps.ready(function(){
            var myMap = new ymaps.Map("js-contacts-maps", {
                center: arDataLatLon,
                zoom: $('#js-contacts-maps').data('zoom'),
                controls: ['zoomControl']
            });
            var myPlacemark = new ymaps.Placemark(myMap.getCenter(),
                {
                    hintContent: $('#js-contacts-maps').data('addr'),
                    balloonContent: $('#js-contacts-maps').data('addr'),
                }, {
                    preset: 'islands#icon',
                    iconColor: '#000'
                }
            );
            myMap.geoObjects.add(myPlacemark);
        });
    }
}
function initCatalogMenu()
{
    $('.js-catalog-top-menu-filter').each(function(){
        if ($(this).data('value')!="all")
        {
            $(this).hide();
            if ($('input[data-code="GENDER"][data-value="'+$(this).data('value')+'"]').length)
            {
                if ($('input[data-code="GENDER"][data-value="'+$(this).data('value')+'"]').closest('.disabled').length==0)
                {
                    $(this).show();
                }
            }
        }
    });
}

function showWaitOverlay(spinnerId)
{
    if (!spinnerId) spinnerId='js-spinner-common';
    $('#'+spinnerId).addClass('ui-spinner--state_opened');
}
function closeWaitOverlay(spinnerId)
{
    if (!spinnerId) spinnerId='js-spinner-common';
    $('#'+spinnerId).removeClass('ui-spinner--state_opened');
}

function getURLParameter(url, name) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}