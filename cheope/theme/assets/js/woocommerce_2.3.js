/**
 * Created with JetBrains PhpStorm.
 * User: Your Inspiration
 * Date: 19/01/15
 * Time: 12.41
 * To change this template use File | Settings | File Templates.
 */

jQuery( document ).ready( function( $ ) {


    // Quantity buttons
    var fn_add_quantity_button = function () {
        $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

        // Target quantity inputs on product pages
        $( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
            var min = parseFloat( $( this ).attr( 'min' ) );

            if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
                $( this ).val( min );
            }
        });
    }

    fn_add_quantity_button();

    $(document).on( 'wc-composite-ui-updated qv_loader_stop cart_page_refreshed wc_fragments_refreshed applied_coupon update_shipping_method removed_coupon updated_wc_div', function(){
        fn_add_quantity_button()
    });

    // fix woocommerce composite products plugin
    $( document ).on( 'wc-composite-component-loaded', fn_add_quantity_button );

    $( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal	= parseFloat( $qty.val() ),
            max			= parseFloat( $qty.attr( 'max' ) ),
            min			= parseFloat( $qty.attr( 'min' ) ),
            step		= $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );
    });

    $(document).on('slide_change.yit', function(e, data){

        if (data.step == 3) {
            $('#multistep_step3 select').select2();
        }

    });

});