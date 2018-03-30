(function($){

	$(document).ready(function(){
		$(".woocommerce").on("change", "input.qty", function() {
			$(this.form).find("button[data-quantity]").attr("data-quantity", this.value);
		});
	});

	woocommerce_events_handlers = function () {
		// tell woocommerce if this is a cart page or not
		if ( $('body').hasClass('woocommerce-cart') ) {
			wc_add_to_cart_params.is_cart = 1;
		} else {
			wc_add_to_cart_params.is_cart = 0;
		}

		// needed for the floating ajax cart
		$('body').trigger('added_to_cart');

		// when the user lands on single product page we need to replicate the woocommerce rating-star script
		if ( $('body').hasClass('woocommerce') && $( '#rating' ).length && $('#rating').is(':visible') ) {
			$( '#rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );

			$( 'body' )
				.on( 'click', '#respond p.stars a', function() {
					var $star   	= $( this ),
						$rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
						$container 	= $( this ).closest( '.stars' );

					$rating.val( $star.text() );
					$star.siblings( 'a' ).removeClass( 'active' );
					$star.addClass( 'active' );
					$container.addClass( 'selected' );

					return false;
				})
				.on( 'click', '#respond #submit', function() {
					var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
						rating  = $rating.val();

					if ( $rating.size() > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
						window.alert( wc_single_product_params.i18n_required_rating_text );

						return false;
					}
				});
		}

		$('.payment_methods input.input-radio').on('click', function() {
            if ( $(".payment_methods input.input-radio").length > 1 ) {
                var b = $("div.payment_box." + $(this).attr("ID"));
                $(this).is(":checked") && !b.is(":visible") && ($("div.payment_box").filter(":visible").slideUp(250),
                $(this).is(":checked") && $("div.payment_box." + $(this).attr("ID")).slideDown(250))
            } else {
                $("div.payment_box").show();
            }
            $(this).data("order_button_text") ? $("#place_order").val($(this).data("order_button_text")) : $("#place_order").val($("#place_order").data("value"))
        });

		/**
		 * While passing through pages with ajax we replace DOM elements
		 * this also means that we lose all the events binded to those elements
		 * woocommerce envents will need to be triggered again so we do that below
		 */

		/**
		 * First for products variations
		 */
		setTimeout(function() {
			var variations_form = jQuery( '.variations_form' );
			// wc_add_to_cart_variation_params is required to continue, ensure the object exists

			if ( typeof wc_add_to_cart_variation_params === 'undefined' &&  variations_form.length > 0 )
				return false;

			jQuery(document).find( '.variations_form' ).each( function() {
				jQuery( this ).wc_variation_form().find('.variations select:eq(0)').change();
			});
		}, 500);

	}

})(jQuery);

