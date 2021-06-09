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