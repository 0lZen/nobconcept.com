$(document).ready(function() {

    var cartSkuID=$('#product .i-add-to-cart').first().data('product-id');
    if (cartSkuID!='offer')
    {
        if (basketStat.ITEMS[cartSkuID])
        {
            if (siteDir=='/en/')
            {
                var inCart='In the cart';
            } else
            {
                var inCart='В корзине';
            }
            $('.i-add-to-cart').addClass('i-add-to-cart_active').text(inCart);
        }
    }

    // сброс состояния кнопки "В корзину" при смене размера
    $(document).on('change', '.select_size', function(){
        if (siteDir=='/en/')
        {
            var toCart='Add to cart';
            var inCart='In the cart';
        } else
        {
            var toCart='В корзину';
            var inCart='В корзине';
        }

        var skuID = parseInt($(this).val());
        $('#product .js-favorite-add-remove').attr('data-product-id',skuID).data('product-id',skuID);
        if (Favorites_checkIn(skuID))
        {
            $('#product .js-favorite-add-remove').addClass("_added i-add-to-favorite_active");
        } else
        {
            $('#product .js-favorite-add-remove').removeClass("_added i-add-to-favorite_active");
        }

        $('#product .i-add-to-cart').attr('data-product-id',skuID).data('product-id',skuID);

        if (basketStat.ITEMS[skuID])
        {
            $('#product .i-add-to-cart').addClass('i-add-to-cart_active').text(inCart);
        } else
        {
            $('#product .i-add-to-cart').removeClass('i-add-to-cart_active').text(toCart);
        }
    });

    // удаление строки корзины
    $(document).on('click', '.js-cart-delete', function(e){
        var curRowID=$(this).data('id');
        showWaitOverlay();
        $.ajax
        ({
            url: siteDir+"ajax/cart.php",
            data: {id:curRowID, action:'delete'},
            type: "POST",
            dataType: 'json',
            cache: false,
            success: function(result)
            {
                if (result.success=='Y')
                {
                    $('.js-cart-total-cnt').html(result.cnt);
                    $('.js-cart-content').html(result.html);

                    basketStat=result.basketStat;

                    var cartSkuID=$('#product .i-add-to-cart').first().data('product-id');
                    if (cartSkuID==result.skuID)
                    {
                        if (siteDir=='/en/')
                        {
                            var toCart='Add to cart';
                            var inCart='In the cart';
                        } else
                        {
                            var toCart='В корзину';
                            var inCart='В корзине';
                        }

                        if (basketStat.ITEMS[cartSkuID])
                        {
                            $('.i-add-to-cart').addClass('i-add-to-cart_active').text(inCart);
                        } else
                        {
                            $('.i-add-to-cart').removeClass('i-add-to-cart_active').text(toCart);
                        }
                    }
                }
                closeWaitOverlay();

                if (result.error!='')
                {
                    alert(result.error);
                }


            },
        	error:  function(xhr, ajaxOptions, thrownError){
                closeWaitOverlay();
        		//alert(xhr.status+" "+thrownError);
        	}
        });
    });

    // добавление в корзину
    $(document).on('click', '.i-add-to-cart', function(e){
        e.preventDefault();

        var curBtn=$(this);

        if (curBtn.hasClass('i-add-to-cart_active'))
        {
            $('#favorite').iziModal('close');
            $('.additional-item-cart').click();
        } else
        {
            var curProductID=curBtn.data('product-id');
            var skuID = 0;
            if (curProductID == 'offer')
            {
                skuID = $('.select_size :selected').val();
                if (typeof skuID == "undefined")
                {
                    skuID = $('.block-product-colors__item').data('defsize');
                } else
                {
                    if (skuID === 'not')
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
                skuID = curProductID;
            }

            showWaitOverlay();
            $.ajax
            ({
                url: siteDir+"ajax/cart.php",
                data: {skuID:skuID, action:'add_update'},
                type: "POST",
                dataType: 'json',
                cache: false,
                success: function(result)
                {
                    closeWaitOverlay();

                    if (result.success=='Y')
                    {
                        $('.js-cart-total-cnt').html(result.cnt);

                        updateLazyload();

                        $('.additional-item-cart').addClass('has');
                        $('.additional-item-cart').addClass('moved');
                        setTimeout(function(){
                            $('.additional-item-cart').removeClass('moved');
                        }, 700);

                        if (siteDir=='/en/')
                        {
                            var inCart='In the cart';
                        } else
                        {
                            var inCart='В корзине';
                        }

                        $('.i-add-to-cart[data-product-id="'+skuID+'"]').addClass('i-add-to-cart_active');
                        $('.i-add-to-cart[data-product-id="'+skuID+'"]').text(inCart);

                        var success_message = curBtn.data('text-success');
                        product_cart_noty = new Noty({
                            type: 'info',
                            theme: 'nob',
                            timeout: 2500,
                            text: '<div class="noty__icons"><a href="#cart" class="navigation-additional__item additional-item additional-item-cart i-modal" style="background-image:url(' + SITE_TEMPLATE_PATH + '/assets/css/images/icons/cart.svg)" title="Корзина">&nbsp;</a></div> ' + success_message
                        });
                        $('.i-add-to-cart[data-product-id="'+skuID+'"]').text(curBtn.data('text-remove'));

                        product_cart_noty.show();

                        basketStat=result.basketStat;
                    }

                    if (result.error!='')
                    {
                        alert(result.error);
                    }
                },
            	error:  function(xhr, ajaxOptions, thrownError){
                    closeWaitOverlay();
            		//alert(xhr.status+" "+thrownError);
            	}
            });
        }

        return false;
    });

    // изменение количества
    $(document).on('keyup change blur', '.js-cart-quantity-input', function(){
        var curMaxQ=parseInt($(this).data('max'));
        var newQ=parseInt(this.value.replace(/[\D]+/, ''));
        if (newQ > curMaxQ)
        {
            newQ=curMaxQ;
        }
        this.value = newQ;
    });

    $(document).on('blur', '.js-cart-quantity-input', function(){
        var curRowID=$(this).data('row-id');
        var curQ=$(this).val();
        var curOldQ=$(this).data('old-value');

        if (curOldQ!=curQ)
        {
            showWaitOverlay();
            $.ajax
            ({
                url: siteDir+"ajax/cart.php",
                data: {rowID:curRowID, q:curQ, action:'add_update'},
                type: "POST",
                dataType: 'json',
                cache: false,
                success: function(result)
                {
                    if (result.success=='Y')
                    {
                        $('.js-cart-total-cnt').html(result.cnt);
                        $('.js-cart-content').html(result.html);

                        updateLazyload();
                        basketStat=result.basketStat;
                    }

                    closeWaitOverlay();

                    if (result.error!='')
                    {
                        alert(result.error);
                    }
                },
            	error:  function(xhr, ajaxOptions, thrownError){
                    closeWaitOverlay();
            		//alert(xhr.status+" "+thrownError);
            	}
            });
        }
    });

    $(document).on('click', '.js-cart-quantity-dec', function(){
        var curRowInput=$(this).closest('.js-quantity').find('.js-cart-quantity-input');
        var curRowID=curRowInput.data('row-id');
        var curQ=parseInt(curRowInput.val());

        if (curQ>1)
        {
            curQ--;
            showWaitOverlay();
            $.ajax
            ({
                url: siteDir+"ajax/cart.php",
                data: {rowID:curRowID, q:curQ, action:'add_update'},
                type: "POST",
                dataType: 'json',
                cache: false,
                success: function(result)
                {
                    if (result.success=='Y')
                    {
                        $('.js-cart-total-cnt').html(result.cnt);
                        $('.js-cart-content').html(result.html);

                        updateLazyload();
                        basketStat=result.basketStat;
                    }

                    closeWaitOverlay();

                    if (result.error!='')
                    {
                        alert(result.error);
                    }
                },
            	error:  function(xhr, ajaxOptions, thrownError){
                    closeWaitOverlay();
            		//alert(xhr.status+" "+thrownError);
            	}
            });
        }
    });

    $(document).on('click', '.js-cart-quantity-inc', function(){
        var curRowInput=$(this).closest('.js-quantity').find('.js-cart-quantity-input');
        var curRowID=curRowInput.data('row-id');
        var curQ=parseInt(curRowInput.val());
        var curMaxQ=parseInt(curRowInput.data('max'));

        if (curQ<curMaxQ)
        {
            curQ++;
            showWaitOverlay();
            $.ajax
            ({
                url: siteDir+"ajax/cart.php",
                data: {rowID:curRowID, q:curQ, action:'add_update'},
                type: "POST",
                dataType: 'json',
                cache: false,
                success: function(result)
                {
                    if (result.success=='Y')
                    {
                        $('.js-cart-total-cnt').html(result.cnt);
                        $('.js-cart-content').html(result.html);

                        updateLazyload();
                        basketStat=result.basketStat;
                    }

                    closeWaitOverlay();

                    if (result.error!='')
                    {
                        alert(result.error);
                    }
                },
            	error:  function(xhr, ajaxOptions, thrownError){
                    closeWaitOverlay();
            		//alert(xhr.status+" "+thrownError);
            	}
            });
        }
    });

    // Применение купона
    $(document).on('click', '.js-basket-coupon-apply', function(){

        showWaitOverlay();
        $.ajax({
            url: siteDir+"ajax/cart.php",
            data: {
                coupon: $.trim($('.js-basket-coupon').val()),
                action:'coupon'
            },
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(result) {

                if (result.success=='Y')
                {
                    $('.js-cart-content').html(result.html);
                    basketStat=result.basketStat;
                }
                closeWaitOverlay();

                if (result.error!='')
                {
                    alert(result.error);
                }
            },
        	error:  function(xhr, ajaxOptions, thrownError){
        		closeWaitOverlay();
            	//alert(xhr.status+" "+thrownError);
        	}
        });

    });

    // Очистка корзины
    $(document).on('click', '.i-clear-cart', function(e){
        showWaitOverlay();
        $.ajax({
            url: siteDir+"ajax/cart.php",
            data: {action:'clear'},
            type: 'POST',
            dataType: 'json',
            cache: false,
            success: function(result) {
                if (result.success=='Y')
                {
                    $('.js-cart-total-cnt').html(0);
                    $('.js-cart-content').html(result.html);

                    basketStat=result.basketStat;

                    if (siteDir=='/en/')
                    {
                        var toCart='Add to cart';
                    } else
                    {
                        var toCart='В корзину';
                    }

                    $('.i-add-to-cart').removeClass('i-add-to-cart_active').text(toCart);
                }

                closeWaitOverlay();

                if (result.error!='')
                {
                    alert(result.error);
                }
            },
        	error:  function(xhr, ajaxOptions, thrownError){
        		closeWaitOverlay();
            	//alert(xhr.status+" "+thrownError);
        	}
        });
    });

    $(document).on('change','.js-order-form-delivery',function(){
        var curFormContainer=$(this).closest('.modal__outer');

        var curPriceObj=curFormContainer.find('.js-order-form-total-price');
        var curPrice=parseInt($(this).children('option:selected').data('val'));
        var needAddress=$(this).children('option:selected').data('need-address');

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

        if (needAddress=='N')
        {
            $('.js-order-form-group-address').hide();
        } else
        {
            $('.js-order-form-group-address').show();
        }

        initDadataAddress();

    });

    //оформление заказа
    $(document).on('click','.custom-select.form__input_error',function(){
        $(this).removeClass('form__input_error');
    });

    $(document).on('focus','.js-order-form-field',function(){
        if ($(this)[0]._tippy)
        {
            $(this)[0]._tippy.destroy();
        }
        $(this).attr('title', '').closest('.js-order-form-field-container').removeClass('form__input_error');
    });

    $(document).on('submit','.js-order-form',function(){
        var curForm=$(this);

        var curSubmitBtn=curForm.find('[type="submit"]');
        curSubmitBtn.prop('disabled',true);

        curForm.find('.js-order-form-field-container').removeClass('form__input_error');
        curForm.find('.js-order-form-select').next().removeClass('form__input_error');

        $('.js-order-form-field').attr('title', '');

        if (curForm.data('type')=="fast")
        {
            var url=siteDir+"ajax/order_1click.php";
        } else
        {
            var url=siteDir+"ajax/order.php";
        }

        showWaitOverlay();
        $.ajax
        ({
            url: url,
            data: curForm.serialize(),
            dataType: 'json',
            type: "POST",
            cache: false,
            success: function(res)
            {
                if (res.success=="Y")
                {
                    if (typeof fbq != "undefined")
                    {
                        fbq('track', 'Purchase', {value: res.order_price, currency: 'RUB'});
                    }

                    location.href=res.redirect_url;
                } else
                {
                    $.each(res.errors,function(code,val){
                        var curItem=curForm.find('.js-order-form-field[name="'+code+'"]');
                        if (curItem.length)
                        {
                            curItem.closest('.js-order-form-field-container').addClass('form__input_error');

                            curItem.attr('title', val);

                            if (curItem[0]._tippy)
                            {
                                curItem[0]._tippy.destroy();
                            }

                            tippy(curItem[0], tippy_params_fields);

                            setTimeout(function(){
                                curItem[0]._tippy.show();
                            }, 300);
                        } else
                        {
                            curItem=curForm.find('.js-order-form-select[name="'+code+'"]');
                            if (curItem.length)
                            {
                                curItem.next().addClass('form__input_error');
                            }
                        }
                    });

                    if (res.error_text!="") alert(res.error_text);

                    curSubmitBtn.prop('disabled',false);
                }
                closeWaitOverlay();

            },
        	error:  function(xhr, ajaxOptions, thrownError){
        		closeWaitOverlay();
                curSubmitBtn.prop('disabled',false);
                //alert(xhr.status+" "+thrownError);
                //alert('Произошла ошибка, попробуйте позже');
        	}
        });

        return false;
    });
});

function dadata_join(arr /*, separator */) {
    var separator = arguments.length > 1 ? arguments[1] : ", ";
    return arr.filter(function(n){return n}).join(separator);
}

function makeAddressString(address){
    return dadata_join([
        dadata_join([address.region_type, address.region], " "),
        dadata_join([address.area_type, address.area], " "),
        (address.city !== address.region && dadata_join([address.city_type, address.city], " ") || ""),
        dadata_join([address.settlement_type, address.settlement], " "),
        dadata_join([address.street_type, address.street], " "),
        dadata_join([address.house_type, address.house,address.block_type, address.block], " "),
        dadata_join([address.flat_type, address.flat], " "),
    ]);
}

function dadata_formatResult(value, currentValue, suggestion) {
    var addressValue = makeAddressString(suggestion.data);
    suggestion.value = addressValue;
    return addressValue;
}

function dadata_formatSelected(suggestion){
    var addressValue = makeAddressString(suggestion.data);
    return addressValue;
}

function initDadataAddress()
{
    var obj=$('#fid-nobadr');

    if (obj.length)
    {
        var dadataType=$('.js-order-form-delivery').children('option:selected').data('dadata-type');

        $('#fid-nobadr-full').val('N');
        $('#fid-nobadr').val('');
        $('#fid-nobzp').val('');
        $('#fid-nobcntry').val('');
        $('#fid-nobrgion').val('');
        $('#fid-nobarea').val('');
        $('#fid-nobcty').val('');
        $('#fid-nobsettlement').val('');
        $('#fid-nobstrt').val('');
        $('#fid-nobhse').val('');
        $('#fid-nobblock').val('');

        if (dadataType=='')
        {
            obj.suggestions().disable();
        } else
        {
            if (typeof $('#fid-nobadr').suggestions() == 'undefined')
            {
                obj.suggestions({
                    token: "38dd69252af8115439dcc6c41e07b51743281593",
                    type: "ADDRESS",
                    addon: "spinner",
                    constraints: {
                        label: "",
                    },
                    formatResult: dadata_formatResult,
                    formatSelected: dadata_formatSelected,
                    onInvalidateSelection: function(suggestions) {
                        $('#fid-nobadr-full').val('N');
                    },
                    /*onSuggestionsFetch: function(suggestions) {
                        var suggestionsChecked=[];
                        $.each(suggestions,function(key,suggestion){
                            var isOk=true;
                            if (suggestion.data.house != null && suggestion.data.qc_geo>0)
                            {
                                var isOk=false;
                            }
                            if (isOk)
                            {
                                suggestionsChecked.push(suggestion);
                            }
                        });
                        suggestions=suggestionsChecked;
                        return suggestions;
                    },*/
                    onSelect: function(suggestion) {

                        if (suggestion.data.house != null)
                        {
                            console.log(suggestion.data);
                            $('#fid-nobadr-full').val('Y');
                            $('#fid-nobzp').val(suggestion.data.postal_code);
                            $('#fid-nobcntry').val(suggestion.data.country);
                            $('#fid-nobrgion').val(suggestion.data.region_with_type);
                            $('#fid-nobarea').val(suggestion.data.area_with_type);
                            $('#fid-nobcty').val(suggestion.data.city_with_type);
                            $('#fid-nobsettlement').val(suggestion.data.settlement_with_type);
                            //$('#fid-nobstrt').val(suggestion.data.street_with_type);
                            $('#fid-nobstrt').val(suggestion.data.street);
                            //$('#fid-nobhse').val(suggestion.data.house_type_full+' '+suggestion.data.house);
                            $('#fid-nobhse').val(suggestion.data.house);
                            if (suggestion.data.block)
                            {
                                $('#fid-nobblock').val(suggestion.data.block_type_full+' '+suggestion.data.block);
                            } else
                            {
                                $('#fid-nobblock').val('');
                            }
                        } else
                        {
                            $('#fid-nobadr-full').val('N');
                        }
                    }
                });
            } else
            {
                obj.suggestions().enable();
            }

            if (dadataType=='MSK')
            {
                obj.suggestions().setOptions({
                    constraints: [
                    // Москва
                    {
                        locations: { region: 'Москва' },
                    },
                    // Московская область
                    {
                        locations: { kladr_id: '50' },
                    }
                ]
                });
            } else
            {
                obj.suggestions().setOptions({
                    constraints: {
                        label: "",
                    }
                });
            }
        }

    }
}