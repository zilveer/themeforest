(function($) {
    'use strict';

    $(document).ready(function () {
        qodefInitQuantityButtons();
        qodefInitSelect2();
    });

    function qodefInitQuantityButtons() {

        $(document).on( 'click', '.qodef-quantity-minus, .qodef-quantity-plus', function(e) {    
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.qodef-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('qodef-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(1);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    function qodefInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length ||  $('#calc_shipping_country').length ) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country').select2();

        }

        if($('table.variations').length > 0) {
            $('table.variations').find('td.value').each(function() {
                $(this).find('select').select2({
                    minimumResultsForSearch: -1
                }).on("select2-opening", function() { $(this).trigger('focusin'); });
            });
        }
    }

})(jQuery);