window.magnificPopupGalleryOptions = {
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1]
    },
    removalDelay: 300,
    fixedBgPos: true,
    fixedContentPos: false,
    mainClass: 'mfp-fade'

};

window.counterFunction = function() {
    var counter = jQuery(this).find('.w-counter-number'),
        count = parseInt(counter.text(), 10),
        prefix = '',
        suffix = '',
        number = 0;

    if (jQuery(this).data('count')) {
        count = parseInt(jQuery(this).data('count'), 10);
    }
    if (jQuery(this).data('prefix')) {
        prefix = jQuery(this).data('prefix');
    }
    if (jQuery(this).data('suffix')) {
        suffix = jQuery(this).data('suffix');
    }

    var	step = count/25,
        handler = setInterval(function() {
            number += step;
            if (Math.ceil(number) > count) {
                number = count;
            }
            counter.text(prefix+Math.ceil(number)+suffix);
            if (number >= count) {
                counter.text(prefix+count+suffix);
                window.clearInterval(handler);
            }
        }, 120);


};

window.counterOptions = {offset:'85%', triggerOnce: true};

jQuery(document).ready(function(){

	"use strict";

	if (jQuery.magnificPopup)
	{
		jQuery('a[ref=magnificPopup][class!=direct-link]').magnificPopup({
			type: 'image',
            removalDelay: 300,
            fixedBgPos: true,
            fixedContentPos: false,
            mainClass: 'mfp-fade'
		});

        jQuery('.w-gallery-tnails').each(function() {
            jQuery(this).magnificPopup(window.magnificPopupGalleryOptions);
        });

        if ( ! window.disable_wc_lightbox) {
            jQuery('.product .images').magnificPopup({
                type: 'image',
                delegate: 'a',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1]
                },
                removalDelay: 300,
                fixedBgPos: true,
                fixedContentPos: false,
                mainClass: 'mfp-fade'

            });
        }
	}

    if (jQuery().isotope){
        var portfolioContainer = jQuery('.w-portfolio.type_sortable .w-portfolio-list');
        if (portfolioContainer) {
            portfolioContainer.imagesLoaded(function(){
                portfolioContainer.isotope({
                    itemSelector : '.w-portfolio-item',
                    layoutMode : 'fitRows'
                });
            });

            var portfolioFilterTO = false;

            jQuery('.w-filter-item').each(function() {
                var item = jQuery(this),
                    link = item.find('.w-filter-link');
                link.click(function(){
                    if ( ! item.hasClass('active')) {
                        jQuery('.w-filter-item').removeClass('active');
                        item.addClass('active');
                        var selector = jQuery(this).attr('data-filter');
                        portfolioContainer.isotope({ filter: selector });

                        // Fire window resize event on complete
                        window.clearTimeout(portfolioFilterTO);
                        portfolioFilterTO = window.setTimeout(function(){
                            jQuery(window).resize();
                        }, 500);

                        return false;
                    }

                });
            });
            jQuery('.w-portfolio-item-meta-tags a').each(function() {

                jQuery(this).click(function(){
                    var selector = jQuery(this).attr('data-filter'),
                        topFilterLink = jQuery('a[class="w-filters-item-link"][data-filter="'+selector+'"]'),
                        topFilter = topFilterLink.parent('.w-filters-item');
                    if ( ! topFilter.hasClass('active')) {
                        jQuery('.w-filters-item').removeClass('active');
                        topFilter.addClass('active');
                        portfolioContainer.isotope({ filter: selector });

                        // Fire window resize event on complete
                        window.clearTimeout(portfolioFilterTO);
                        portfolioFilterTO = window.setTimeout(function(){
                            jQuery(window).resize();
                        }, 500);

                        return false;
                    }

                });
            });



        }

        var postsContainer = jQuery('.w-blog.type_masonry .w-blog-list');

        if (postsContainer.length) {
            postsContainer.imagesLoaded(function(){
                postsContainer.isotope({
                    itemSelector : '.w-blog-entry',
                    layoutMode : 'masonry'
                });
            });

            var postsResizeTimer;

            jQuery(window).resize(function(){
                window.clearTimeout(postsResizeTimer);
                postsResizeTimer = window.setTimeout(function(){
                    postsContainer.isotope('reLayout');

                }, 50);

            });
        }

    }

	jQuery('.contact_form').each(function(){

		jQuery(this).submit(function(){
			var form = jQuery(this),
				name, email, phone, message,
				nameField = form.find('input[name=name]'),
				emailField = form.find('input[name=email]'),
				phoneField = form.find('input[name=phone]'),
				messageField = form.find('textarea[name=message]'),
                button = form.find('.g-btn'),
				errors = 0;

            button.addClass('loading');
            jQuery('.w-form-field-success').html('');

			if (nameField.length) {
				name = nameField.val();

				if (name === '' && nameField.data('required') === 1){
                    if ( ! jQuery('#name_row').hasClass('check_wrong')) {
                        jQuery('#name_row').addClass('check_wrong');
                    }
                    jQuery('#name_state').html(window.nameFieldError);

                    errors++;
				} else {
                    if (jQuery('#name_row').hasClass('check_wrong')) {
                        jQuery('#name_row').removeClass('check_wrong');
                    }
                    jQuery('#name_state').html('');
                }
			}

			if (emailField.length) {
				email = emailField.val();

				if (email === '' && emailField.data('required') === 1){
                    if ( ! jQuery('#email_row').hasClass('check_wrong')) {
                        jQuery('#email_row').addClass('check_wrong');
                    }
                    jQuery('#email_state').html(window.emailFieldError);
                    errors++;
				} else {
                    if (jQuery('#email_row').hasClass('check_wrong')) {
                        jQuery('#email_row').removeClass('check_wrong');
                    }
                    jQuery('#email_state').html('');
                }
			}

			if (phoneField.length) {
				phone = phoneField.val();

				if (phone === '' && phoneField.data('required') === 1){
                    if ( ! jQuery('#phone_row').hasClass('check_wrong')) {
                        jQuery('#phone_row').addClass('check_wrong');
                    }
                    jQuery('#phone_state').html(window.phoneFieldError);
                    errors++;
				} else {
                    if (jQuery('#phone_row').hasClass('check_wrong')) {
                        jQuery('#phone_row').removeClass('check_wrong');
                    }
                    jQuery('#phone_state').html('');
                }
			}

			if (messageField.length) {
				message = messageField.val();

				if (message === '' && messageField.data('required') === 1){
                    if ( ! jQuery('#message_row').hasClass('check_wrong')) {
                        jQuery('#message_row').addClass('check_wrong');
                    }
                    jQuery('#message_state').html(window.messageFieldError);
                    errors++;
				} else {
                    if (jQuery('#message_row').hasClass('check_wrong')) {
                        jQuery('#message_row').removeClass('check_wrong');
                    }
                    jQuery('#message_state').html('');
                }
			}

			if (errors === 0){
				jQuery.ajax({
					type: 'POST',
					url: window.ajaxURL,
					dataType: 'json',
					data: {
						action: 'sendContact',
						name: name,
						email: email,
						phone: phone,
						message: message
					},
					success: function(data){
						if (data.success){
							jQuery('.w-form-field-success').html(window.messageFormSuccess);

							if (nameField.length) {
								nameField.val('');
							}
							if (emailField.length) {
								emailField.val('');
							}
							if (phoneField.length) {
								phoneField.val('');
							}
							if (messageField.length) {
                                messageField.val('');
							}

						}

                        button.removeClass('loading');
					},
					error: function(){
					}
				});
			} else {
                button.removeClass('loading');
            }

			return false;
		});

	});



    jQuery('.no-touch .l-section.parallax_ver').each(function(){
        jQuery(this).find('.l-section-img').parallax('50%', '0.3');
    });

	jQuery(window).load(function(){

		jQuery('.no-touch .l-section.parallax_hor').each(function(){
			jQuery(this).horparallax();
		});
	});

    jQuery(".w-gallery.type_slider .slides").each(function() {
        var slider = jQuery(this),
            arrows = slider.attr('data-arrows'),
            autoPlay = slider.attr('data-autoPlay'),
            autoPlaySpeed = slider.attr('data-autoPlaySpeed');
        if (autoPlay == 1) {
            autoPlay = true;
        } else {
            autoPlay = false;
        }
        if (arrows == 1) {
            arrows = true;
        } else {
            arrows = false;
        }
        slider.slick({
            arrows: arrows,
            dots: true,
            infinite: true,
            speed: 300,
            cssEase: 'linear',
            autoplay: autoPlay,
            autoplaySpeed: 3000
        });
    });

    jQuery(".w-clients-list").each(function() {
        var clients = jQuery(this),
            autoPlay = clients.attr('data-autoPlay'),
            autoPlaySpeed = clients.attr('data-autoPlaySpeed'),
            arrows = clients.attr('data-arrows'),
            infinite = false;
        if (autoPlay == 1) {
            autoPlay = infinite = true;
        } else {
            autoPlay = infinite = false;
        }
        if (arrows == 1) {
            arrows = true;
        } else {
            arrows = false;
        }
        clients.slick({
            arrows: arrows,
            infinite: infinite,
            autoplay: autoPlay,
            autoplaySpeed: autoPlaySpeed,
            accessibility: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 300,
            cssEase: 'ease',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: arrows,
                        infinite: infinite,
                        autoplay: autoPlay,
                        autoplaySpeed: autoPlaySpeed                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: arrows,
                        infinite: infinite,
                        autoplay: autoPlay,
                        autoplaySpeed: autoPlaySpeed                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: arrows,
                        infinite: infinite,
                        autoplay: autoPlay,
                        autoplaySpeed: autoPlaySpeed                    }
                }
            ]
        });
    });

    function update_cart_widget(event){
        if(typeof event != 'undefined')
        {
            var cart = jQuery('.w-cart'),
                notification = jQuery('.w-cart-notification'),
                productName = notification.find('.product-name'),
                quantity = cart.find('.w-cart-quantity'),
                quantity_val = parseInt(quantity.html(), 10);

            if ( ! cart.hasClass('has_items')) {
                cart.addClass('has_items');
            }

            quantity_val++;
            quantity.html(quantity_val);

            notification.css({display: 'block', opacity: 0});

            productName.html(addedProduct);
            notification.animate({opacity: 1}, 300, function(){
                window.setTimeout(function(){
                    notification.animate({opacity: 0},300, function(){
                        notification.css({display: 'none'});
                    });
                }, 3000);
            });


        }
    }

    var addedProduct = 'Product';

    jQuery('.add_to_cart_button').click(function(){
        var productContainer = jQuery(this).parents('.product').eq(0);
        addedProduct = productContainer.find('h3').text();console.log(1);
    });

    jQuery('body').bind('added_to_cart', update_cart_widget);
});

// Fixing hovers for devices with both mouse and touch screen
jQuery.isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
jQuery('html').toggleClass('no-touch',  ! jQuery.isMobile);
