jQuery(window).load(function() { // makes sure the whole site is loaded
	jQuery("#loader-status").fadeOut(); // will first fade out the loading animation
		jQuery("#loader").delay(300).fadeOut("slow"); // will fade out the white DIV that covers the website.
});

jQuery(document).ready(function($){

    var etTheme = {
        init: function() {
            this.fragmentsRefresh();
        },

        fragmentsRefresh: function() {
            // **********************************************************************//
            // ! Update cart fragments
            // **********************************************************************//
            $.ajax( {
                url: myAjax.ajaxurl,
                type: 'POST',
                data: { action: 'et_refreshed_fragments' },
                success: function( data ) {
                    if ( data && data.fragments ) {
                        $.each( data.fragments, function( key, value ) {
                            $( "." + key ).replaceWith( value );
                        });
                    }
                }
            } );
        },

    };
    
    $( document.body ).on( 'updated_wc_div', function() {
        etTheme.fragmentsRefresh();
    } );

    // Variations images changes

    jQuery('form.variations_form').on( 'found_variation', function( event, variation ) {
        var $variation_form = jQuery(this);
        var $product        = jQuery(this).closest( '.product' );
        var $product_img    = $product.find( 'div.images img:eq(0)' );
        var $product_link   = $product.find( 'div.images a.zoom:eq(0)' );

        var o_src           = $product_img.attr('data-o_src');
        var o_title         = $product_img.attr('data-o_title');
        var o_href          = $product_link.attr('data-o_href');

        var variation_image = variation.image_src;
        var variation_link = variation.image_link;
        var variation_title = variation.image_title;

        console.log(variation_image);

        if(variation_link != '') {
        	jQuery('a.main-zoom-image').attr('href', variation_link);
        }
        if(variation_image != '') {
        	jQuery('a.main-zoom-image img').attr('src', variation_image);
        }

    })
    // Reset product image
    .on( 'reset_image', function( event ) {

        var $product        = jQuery(this).closest( '.product' );
        var $product_img    = $product.find( 'div.images img:eq(0)' );
        var $product_link   = $product.find( 'div.images a.zoom:eq(0)' );

        var o_src           = $product_img.attr('data-o_src');
        var o_href          = $product_link.attr('data-o_href');

        jQuery('a.main-zoom-image').attr('href', o_href);
        jQuery('a.main-zoom-image img').attr('src', o_src);



    } );



    /* Mobile navigation
    -------------------------------------------------------------- */

    var navList = jQuery('#main-nav > ul, div.menu > ul').clone();
    var etOpener = '<span class="open-child">(open)</span>';
    navList.removeClass('menu').addClass('et-mobile-menu');

    navList.before('<span class="et-menu-title">' + menuTitle + '</span>');


	navList.find('li:has(ul)',this).each(function() {
		jQuery(this).prepend(etOpener);
	})

    navList.find('.open-child').toggle(function(){
        jQuery(this).parent().addClass('over').find('>ul').slideDown(200);
    },function(){
        jQuery(this).parent().removeClass('over').find('>ul').slideUp(200);
    });



    jQuery('#main-nav, div.menu').after(navList).after('<span class="et-menu-title">' + menuTitle + '</span>');

    jQuery('.et-menu-title').toggle(function(){
        jQuery(this).next().slideDown(200);
    },function(){
        jQuery(this).next().slideUp(200);
    });

    /* Superfish menu
    -------------------------------------------------------------- */
    jQuery('#main-nav > ul, .menu > ul').superfish({
        hoverClass: 'over',
        shadow: false,
        delay: 0,
        speed: 0
    });

    /* Hover intent
    -------------------------------------------------------------- */
    jQuery('body').on('mouseenter', '#top-cart',
        function () {
            jQuery(this).find(".cart-popup").stop().slideDown(100);
        }
    );
    jQuery('body').on('mouseleave', '#top-cart',
        function () {
            jQuery(this).find(".cart-popup").stop().slideUp(100);
        }
    );

    /* Tabs
    -------------------------------------------------------------- */


	var $tabsNav    = jQuery('.tabs-nav'),
		$tabsNavLis = $tabsNav.children('li'),
		$tabContent = jQuery('.tab-content');

	$tabsNav.each(function() {
		var $this = jQuery(this);

		$this.next().children('.tab-content').stop(true,true).hide()
											 .first().show();

		$this.children('li').first().addClass('active').stop(true,true).show();
	});

	$tabsNavLis.on('click', function(e) {
		var $this = jQuery(this);

		$this.siblings().removeClass('active').end()
			 .addClass('active');

		$this.parent().next().children('.tab-content').stop(true,true).hide()
													  .siblings( $this.find('a').attr('href') ).fadeIn();

		e.preventDefault();
	});
    /* Accordion
    -------------------------------------------------------------- */
	var $container = jQuery('.acc-container'),
		$trigger   = jQuery('.acc-trigger');

	$container.hide();
	$trigger.first().addClass('active').next().show();

	var fullWidth = $container.outerWidth(true);
	$trigger.css('width', fullWidth);
	$container.css('width', fullWidth);

	$trigger.on('click', function(e) {
		if( jQuery(this).next().is(':hidden') ) {
			$trigger.removeClass('active').next().slideUp(300);
			jQuery(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();
	});

	// Resize
	jQuery(window).on('resize', function() {
		fullWidth = $container.outerWidth(true)
		$trigger.css('width', $trigger.parent().width() );
		$container.css('width', $container.parent().width() );
	});


    /* Checkout
    -------------------------------------------------------------- */
    jQuery("a#checkout-next").click(function(){
        jQuery("#shopping-cart-form").fadeIn();
        var checkoutWidth = jQuery("#shopping-cart").width() + 30;
        jQuery("#checkout-bar-in").animate({width:'+=50%'});
        jQuery("#checkout-slider").animate({marginLeft:'-=' + checkoutWidth}, 800, function() {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
		});
		return false;
    });

    jQuery("a#checkout-back,a.checkout-back").click(function(){
        jQuery("#shopping-cart-form").fadeOut();
        var checkoutWidth = jQuery("#shopping-cart").width() + 30;
        jQuery("#checkout-bar-in").animate({width:'-=50%'});
        jQuery("#checkout-slider").animate({marginLeft:'+=' + checkoutWidth}, 800, function() {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
		});
		return false;
    });

    /* Listswitcher
    -------------------------------------------------------------- */
    var activeClass = 'active_switcher';
    var gridClass = 'products_grid';
    var listClass = 'products_list';
    jQuery('.switchToList').click(function(){
        if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid'){
            switchToList();
        }
    });
    jQuery('.switchToGrid').click(function(){
        if(!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list'){
            switchToGrid();
        }
    });

    function switchToList(){
        jQuery('.switchToList').addClass(activeClass);
        jQuery('.switchToGrid').removeClass(activeClass);
        jQuery('#products-grid').fadeOut(300,function(){
            jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
            jQuery.cookie('products_page', 'list');
        });
    }

    function switchToGrid(){
        jQuery('.switchToGrid').addClass(activeClass);
        jQuery('.switchToList').removeClass(activeClass);
        jQuery('#products-grid').fadeOut(300,function(){
            jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
            jQuery.cookie('products_page', 'grid');
        });
    }

    /* "Top" button
    -------------------------------------------------------------- */

    var scroll_timer;
    var displayed = false;
    var $message = jQuery('#back-to-top');
    var $window = jQuery(window);
    var top = jQuery(document.body).children(0).position().top;

    $window.scroll(function () {
        window.clearTimeout(scroll_timer);
        scroll_timer = window.setTimeout(function () {
        if($window.scrollTop() <= top)
        {
            displayed = false;
            $message.fadeOut(500);
        }
        else if(displayed == false)
        {
            displayed = true;
            $message.stop(true, true).fadeIn(500).click(function () { $message.fadeOut(500); });
        }
        }, 400);
    });

    jQuery('#top-link').click(function(e) {
            jQuery('html, body').animate({scrollTop:0}, 'slow');
            return false;
    });

    /* Accordion Navigation
    -------------------------------------------------------------- */
    jQuery(function(){
        if(!nav_accordion){
            jQuery('.categories-group .wpsc_category_title .btn-show ').hide();
        }else{
            jQuery('.block.cats').addClass('acc_enabled');
            jQuery('.categories-group').each(function(){
                jQuery(this).has('.wpsc_top_level_categories').addClass('has-subnav');
                jQuery(this).has('.current-cat').addClass('current-parent opened');
            });


            var nav_section = jQuery('.categories-group .wpsc_top_level_categories');
            var nav_toggle_element = jQuery('.categories-group .wpsc_category_title .btn-show ');
            var nav_speed = 150;


            nav_toggle_element.click(function(){
                if(jQuery(this).parent().parent().hasClass('opened')){
                    hideActiveSection();
                }else{
                    showNext(jQuery(this));
                }
            });

            if(jQuery('.categories-group.opened').length > 0) {
                //jQuery('.categories-group.has-subnav').addClass('opened');
            }else{
                // If doesnt exitst opened point
                jQuery('.categories-group.has-subnav:first').addClass('opened').find('ul').show();
            }

            function showNext(element) {
                hideActiveSection();
                element.parent().parent().addClass('opened');
                element.parent().next().show(nav_speed);
            }

            function hideActiveSection(){
                jQuery('.categories-group.opened').removeClass('opened').find('.wpsc_top_level_categories').hide(nav_speed);
            }
        }
    });
    /* ethemeContactForm
    -------------------------------------------------------------- */
    var ethemeContactForm = jQuery('#ethemeContactForm');

    var spinner = jQuery('.contactSpinner');

    jQuery('.required-field').focus(function(){
        jQuery(this).removeClass('validation-failed');
    });

    ethemeContactForm.find('button.button').click(function(e){
        jQuery('#contactsMsgs').html('');
        e.preventDefault();
        spinner.show();

        var errmsg;
        errmsg = '';

        ethemeContactForm.find('.required-field').each(function(){
            if(jQuery(this).val() == '') {
                    errmsg = isRequired;
                    jQuery(this).addClass('validation-failed');
                }
        });

        ethemeContactForm.find('.email').each(function(){
            var check = /[A-Z0-9_%+-]+@[A-Z0-9_%+-]+.[A-Z]{2,4}/igm;
            if(jQuery(this).val() == '' || !check.test(jQuery(this).val())) {
                    errmsg = 'Please, enter a valid e-mail address!'
                    jQuery(this).addClass('validation-failed');
                }
        });

        if(errmsg){
            jQuery('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
            spinner.hide();
        }else{

            url = ethemeContactForm.attr('action');

            data = ethemeContactForm.serialize();
            data += '&contactSubmit=true';

            jQuery.ajax({
                url: url,
                method: 'GET',
                data: data,
                error: function() {
                    jQuery('#contactsMsgs').html('<p class="error">' + someerrmsg + '</p>');
                    spinner.hide();
                },
                success : function(){
                    jQuery('#contactsMsgs').html('<p class="success">' + succmsg + '</p>');
                    spinner.hide();
                    ethemeContactForm.find("input[type=text], textarea").val("");
                }
            });

        }
    });

    /* Isotope */

    $portfolio = jQuery('.portfolio');



	jQuery(window).smartresize(function(){
		$portfolio.isotope({
			itemSelector: '.portfolio-item'
		});
	});

	jQuery('.portfolio-filters a').click(function(){
		var selector = jQuery(this).attr('data-filter');
		jQuery('.portfolio-filters a').removeClass('selected');
		if(!jQuery(this).hasClass('selected')) {
			jQuery(this).addClass('selected');
		}
		$portfolio.isotope({ filter: selector });
		return false;
	});

	setTimeout(function(){
		jQuery('.portfolio').addClass('with-transition');
		jQuery('.portfolio-item').addClass('with-transition');
	},500);

    setTimeout(function(){
        jQuery(window).resize();
    },500);

	// Ajax add to cart
    jQuery('.qty.text[max]').change(function(){
        if(parseInt(jQuery(this).val())>jQuery(this).attr('max')) {
            jQuery(this).val(jQuery(this).attr('max'));
        }
    });
	jQuery('.etheme-simple-product').live('click', function() {
		// AJAX add to cart request
		var $thisbutton = jQuery(this);

		if ($thisbutton.is('.etheme-simple-product, .product_type_downloadable, .product_type_virtual')) {

			showPopup();

            jQuery('#top-cart').addClass('updating');

            popupOverlay = jQuery('.etheme-popup-overlay');

            popupWindow = jQuery('.etheme-popup');

			formAction = jQuery('#simple-product-form').attr('action');

			var data = {
                quantity: jQuery('input[name=quantity]').val(),
                'add-to-cart': jQuery('input[name=add-to-cart]').val()
			};

			// Trigger event
			jQuery('body').trigger('adding_to_cart');

			// Ajax action
            jQuery.ajax({
                url: formAction,
                data: data,
                method: 'POST',
                timeout: 10000,
                dataType: 'text',
                success: function(data) {
                    jQuery('#top-cart').html(jQuery(data).find('#top-cart').html());
                    productImageSrc = jQuery('.main-image img').attr('src');
                    productImage = '<img width="72" src="'+productImageSrc+'" />';
                    productName = jQuery('.product-shop > h1').text();
                    cartHref = jQuery('#top-cart > a').attr('href');
                    popupHtml = productImage + '<em>'+productName+'</em> ' + successfullyAdded2;
                    popupWindow.find('.etheme-popup-content').css('backgroundImage','none').html(popupHtml);
                    jQuery('.cont-shop').one('click',function(){
                        hidePopup(popupOverlay,popupWindow);
                    });
                },
                error: function(data) {
                    popupWindow.find('.etheme-popup-content').css('backgroundImage','none').text('Something wrong');
                }
            });

			return false;

		} else {
			return true;
		}

	});


    /* List "add to cart" (add-to-cart.js edit) */

	// Ajax add to cart
	jQuery(document).on( 'click', '.etheme_add_to_cart_button', function() {

		// AJAX add to cart request
		var $thisbutton = jQuery(this);

		if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual')) {

			if (!$thisbutton.attr('data-product_id')) return true;

			$thisbutton.removeClass('added');
			$thisbutton.addClass('loading');

			var data = {
				action: 		'woocommerce_add_to_cart',
				product_id: 	$thisbutton.attr('data-product_id'),
				quantity:       $thisbutton.attr('data-quantity'),
				security: 		woocommerce_params.add_to_cart_nonce
			};

			// Trigger event
			jQuery('body').trigger( 'adding_to_cart', [ $thisbutton, data ] );

			// Ajax action
			jQuery.post( woocommerce_params.ajax_url, data, function( response ) {

				if ( ! response )
					return;

				var this_page = window.location.toString();

				this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

				if ( response.error && response.product_url ) {
					window.location = response.product_url;
					return;
				}

				// Redirect to cart option
				if ( woocommerce_params.cart_redirect_after_add == 'yes' ) {

					window.location = woocommerce_params.cart_url;
					return;

				} else {

					$thisbutton.removeClass('loading');

					fragments = response.fragments;
					cart_hash = response.cart_hash;

					// Block fragments class
					if ( fragments ) {
						jQuery.each(fragments, function(key, value) {
							jQuery(key).addClass('updating');
						});
					}

					// Block widgets and fragments
					jQuery('.shop_table.cart, .updating, .cart_totals').fadeTo('400', '0.6').block({message: null, overlayCSS: {background: 'transparent url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6 } } );

					// Changes button classes
					if ( $thisbutton.parent().find('.added_to_cart').size() == 0 )
						$thisbutton.addClass('added').after( ' <a href="' + woocommerce_params.cart_url + '" class="added_to_cart" title="' + woocommerce_params.i18n_view_cart + '">' + woocommerce_params.i18n_view_cart + '</a>' );

					// Replace fragments
					if ( fragments ) {
						jQuery.each(fragments, function(key, value) {
							jQuery(key).replaceWith(value);
						});
					}

					// Unblock
					jQuery('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();


                    jQuery.ajax( {
                        url: woocommerce_params.ajax_url,
                        type: 'POST',
                        data: { action: 'et_refreshed_fragments' },
                        success: function( data ) {
                            if ( data && data.fragments ) {
                                jQuery.each( data.fragments, function( key, value ) {
                                    jQuery( "." + key ).replaceWith( value );
                                });
                            }
                        }
                    } );

					// Cart page elements
					jQuery('.shop_table.cart').load( this_page + ' .shop_table.cart:eq(0) > *', function() {

						jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass('buttons_added').append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');

						jQuery('.shop_table.cart').stop(true).css('opacity', '1').unblock();

						jQuery('body').trigger('cart_page_refreshed');
					});

					jQuery('.cart_totals').load( this_page + ' .cart_totals:eq(0) > *', function() {
						$('.cart_totals').stop(true).css('opacity', '1').unblock();
					});

					// Trigger event so themes can refresh other areas
					jQuery('body').trigger( 'added_to_cart', [ fragments, cart_hash ] );
				}
			});

			return false;

		} else {
			return true;
		}

	});

    /* ethemeCommentForm
    -------------------------------------------------------------- */
    var ethemeCommentForm = jQuery('#commentform');


    ethemeCommentForm.find('#submit').click(function(e){
        jQuery('#commentsMsgs').html('');
        var errmsg;
        errmsg = '';

        ethemeCommentForm.find('.required-field').each(function(){
            if(jQuery(this).val() == '') {
                errmsg = isRequired;
                jQuery(this).addClass('validation-failed');;
            }
        });

        if(errmsg){
            e.preventDefault();
            jQuery('#commentsMsgs').html('<p class="error">' + errmsg + '</p>');
        }
    });

    jQuery('.hideableHover').bind("mouseenter", function() {
        hideImage(this);
    })
    jQuery('.hideableHover').bind("mouseleave", function() {
        showImage(this);
    })

}); // End Ready

/* Product Hover
-------------------------------------------------------------- */
function hideImage(img){
    //Opera fix
    if(jQuery.browser.opera){
        var block = jQuery(img).parent().parent().parent();
        block.height(block.height());
    }
    jQuery(img).animate({
        'opacity' : 0
    },150);
}

function showImage(img){
    jQuery(img).animate({
        'opacity' : 1
    },150);
}

function showPopup(){
    html = '<div class="etheme-popup-overlay"></div><div class="etheme-popup"><div class="etheme-popup-content"></div></div>'
    jQuery('body').prepend(html);
    popupOverlay = jQuery('.etheme-popup-overlay');
    popupWindow = jQuery('.etheme-popup');
    popupOverlay.one('click',function(){
        hidePopup(popupOverlay,popupWindow);
    });
}
function hidePopup(popupOverlay,popupWindow){
    popupOverlay.fadeOut(400);
    popupWindow.fadeOut(400).html('');
}
