var product_favorite_noty = false;

function Favorites_Add(sku_id)
{
    var arFav=Favorites_getArr();
    arFav.push(sku_id);
    $.cookie("favorites", JSON.stringify(arFav), { expires: 30000, path: "/"});
    $('.js-favorite-header-state').addClass('_active');
}

function Favorites_Del(sku_id)
{
    var arFav=Favorites_getArr();
    var arFavNew=[];
    for (var i=0; i<arFav.length; i++)
    {
        if (arFav[i] != sku_id)
        {
            arFavNew.push(arFav[i]);
        }
    }
    $.cookie("favorites", JSON.stringify(arFavNew), { expires: 30000, path: "/"});
    if (arFavNew.length==0)
    {
        $('.js-favorite-header-state').removeClass('_active');
    }
}

function Favorites_checkIn(sku_id)
{
    if ($.inArray(sku_id,Favorites_getArr())==-1)
    {
        return false;
    } else
    {
        return true;
    }
}

function Favorites_getArr()
{
    var favCookie=$.cookie("favorites");
    if (favCookie)
    {
        var arFav=JSON.parse(favCookie);
    } else
    {
        var arFav=[];
    }

    return arFav;
}

$(document).ready(function() {

    var favoriteSkuID=$('#product .js-favorite-add-remove').first().data('product-id');
    if (favoriteSkuID!='offer')
    {
        if (Favorites_checkIn(favoriteSkuID))
        {
            $('#product .js-favorite-add-remove').addClass("_added i-add-to-favorite_active");
        } else
        {
            $('#product .js-favorite-add-remove').removeClass("_added i-add-to-favorite_active");
        }
    }

    $(document).on('click', '.js-favorite-add-remove', function(e){
        e.preventDefault();

        var success_message = $(this).data('text-success');
        var fail_message = $(this).data('text-fail');

        /*if (!product_favorite_noty && !$(this).hasClass('_added'))
        {
            product_favorite_noty = new Noty({
                type: 'info',
                theme: 'nob',
                timeout: 1500,
                text: '<div class="noty__icons"><a href="#favorite" class="navigation-additional__item additional-item additional-item-favorite i-modal" style="background-image:url(' + SITE_TEMPLATE_PATH + '/assets/css/images/icons/favorite.svg)" title="Избранное">&nbsp;</a></div>' + success_message
            });
        }*/

        var sku_id = 0;
        if ($(this).data('product-id') == 'offer')
        {
            sku_id = $('.select_size :selected').val();
            if (typeof sku_id == "undefined")
            {
                sku_id = $('.block-product-colors__item').data('defsize');
            } else
            {
                if (sku_id === 'not')
                {
                    $('.custom-select_size .custom-select__option--value').css('border-color', 'red');
                    return false;
                } else
                {
                    $('.custom-select_size .custom-select__option--value').css('border-color', '#e5e5e5');
                }
            }
        } else
        {
            sku_id = $(this).data('product-id');
        }

        if (sku_id)
        {
            sku_id=parseInt(sku_id);
            var action = "";

            if (Favorites_checkIn(sku_id) || $(this).hasClass('_from_list'))
            {
                action = 'remove';
                Favorites_Del(sku_id)
            } else
            {
                action = 'add';
                Favorites_Add(sku_id);
            }

            var btns=$('.js-favorite-add-remove[data-product-id="'+sku_id+'"]');

            if (action == 'remove')
            {
                btns.removeClass('_added');
                btns.removeClass('i-add-to-favorite_active');
                $('.additional-item-favorite').addClass('moved');
                $('.additional-item-favorite').removeClass('attention');

                if ($(this).hasClass('cart-scheme__control_favorite') || $(this).hasClass('_from_list'))
                {
                    $(this).text($(this).data('add-text'));
                    $(this).attr('title', $(this).data('add-text'));
                }

                // Remove from favorites logic here
                setTimeout(function(){
                    $('.additional-item-favorite').removeClass('moved');
                }, 700);


                product_favorite_noty = new Noty({
                    type: 'info',
                    theme: 'nob',
                    timeout: 1500,
                    text: '<div class="noty__icons"><a href="#favorite" class="navigation-additional__item additional-item additional-item-favorite i-modal" style="background-image:url(' + SITE_TEMPLATE_PATH + '/assets/css/images/icons/favorite.svg)" title="Избранное">&nbsp;</a></div>' + fail_message
                });
                product_favorite_noty.show();


                product_favorite_noty = false;

                if ($(this).hasClass('_from_list'))
                {
                    if ($(this).closest('.favorite-scheme').find('.favorite-scheme__row').length==2)
                    {
                        $('#favorite').iziModal('close');
                    } else
                    {
                        $(this).closest('.favorite-scheme__row').remove();
                    }
                }
            } else
            {
                btns.addClass('_added');
                btns.addClass('i-add-to-favorite_active');
                $('.additional-item-favorite').addClass('has');
                $('.additional-item-favorite').addClass('attention');
                $('.additional-item-favorite').removeClass('moved');

                if ($(this).hasClass('cart-scheme__control_favorite') || $(this).hasClass('favorite-scheme__control_favorite'))
                {
                    $(this).text($(this).data('remove-text'));
                    $(this).attr('title', $(this).data('remove-text'));
                }

                // Add to favorites logic here

                setTimeout(function(){
                    $('.additional-item-favorite').removeClass('attention');
                }, 2100);


                product_favorite_noty = new Noty({
                    type: 'info',
                    theme: 'nob',
                    timeout: 1500,
                    text: '<div class="noty__icons"><a href="#favorite" class="navigation-additional__item additional-item additional-item-favorite i-modal" style="background-image:url(' + SITE_TEMPLATE_PATH + '/assets/css/images/icons/favorite.svg)" title="Избранное">&nbsp;</a></div>' + success_message
                });
                product_favorite_noty.show();

            }


        }
    });
});