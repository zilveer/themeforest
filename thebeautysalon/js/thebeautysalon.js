jQuery( document ).ready( function() {

	// Uniform

	jQuery("select, input:not([type='submit']), button, textarea").not('.comment-form-rating select, .woocommerce-billing-fields select, .woocommerce-shipping-fields select').uniform();

	// Hover Links

	jQuery( '.hoverlink' ).mouseenter( function() {
		jQuery(this).find( 'img' ).stop().animate({ opacity: '0.4' })
	})

	jQuery( '.hoverlink' ).mouseleave( function() {
		jQuery(this).find( 'img' ).stop().animate({ opacity: '1' })
	})

	// Product List
	if( jQuery('.product-list').length > 0 ){
		jQuery( '.product-list').product_list();
	}


	// Tiles
	if( jQuery('.tiles').length > 0 ){
		jQuery( '.tiles').tiles();
	}

	// submit buttons

	jQuery.each( jQuery( 'input[type="submit"]' ), function() {
		parent = jQuery(this).parent( 'p' )
		if( parent.length > 0 && parent.find( '.read-more-arrow' ).length == 0 ) {
			jQuery(this).after( '<span class="read-more-arrow"></span>' );
		}
	})

	// Gallery Arrangement and Filtering

	jQuery( '.gallery-filter-link' ).click( function() {
		gallery_filter = jQuery( this ).parents( '.gallery-filter' );
		gallery_filter.find( '.gallery-filter-link' ).removeClass( 'current' )
		jQuery( this ).addClass( 'current' )
		cat_id = jQuery( this ).attr( 'data-filter' )

		var gallery = gallery_filter.next().find('.gallery')
		gallery.isotope({ filter:  cat_id });
		return false;
	})

	jQuery('.gallery').imagesLoaded( function() {
		jQuery( '.gallery .loader' ).fadeOut( function() {
			jQuery( '.gallery .inner' ).show();

			jQuery( '.gallery' ).isotope({
				itemSelector : '.gallery-item',
				layoutMode: 'fitRows',
			});
		})
	})

	// Header Navigation

	menu_width = jQuery( '#site-header .navigation-menu' ).width();
	manu_position();

	jQuery( '#site-header .navigation-select select' ).on( 'change', function() {
		var url = jQuery( this ).val();
		window.location = url;
	})

	var children;
	jQuery.each( jQuery( '#site-header .navigation-menu > div > ul > li' ), function() {
		children = jQuery(this).find('ul');
		if( children.length > 0 ) {
			children.before( '<span class="triangle-down"></span>' )
		}
	})

	var parents;
	jQuery.each( jQuery( '#site-header .navigation-menu > div > ul > li' ).filter( '.current_page_item, .current_page_parent, .current_page_ancestor, .current-menu-item, .current-menu-parent, .current-menu-ancestor' ), function() {
			jQuery(this).append('<span class="triangle-up"></span>')
	})


	// Image Sliders

	if( jQuery( jQuery('.imageslider').length > 0 )) {
		jQuery.each( jQuery('.imageslider'), function( i ) {
			jQuery(this).attr( 'id', 'imageslider-' + i )

			animation = jQuery(this).attr('data-animation')
			direction = jQuery(this).attr('data-direction')
			slideshowSpeed = jQuery(this).attr('data-slideshow_speed')
			animationSpeed = jQuery(this).attr('data-animation_speed')
			pauseOnHover = jQuery(this).attr('data-pause_on_hover')
			smoothHeight = jQuery(this).attr('data-smooth_height')

			controlNav = true,
			control = jQuery(this).attr('data-controls');
			if( control == 'no' ) {
				controlNav = false;
			}

			pauseOnHover = true;
			if( pauseOnHover == 'no' ) {
				pauseOnHover = false;
			}

			smoothHeight = false;
			if( smoothHeight == 'yes' ) {
				smoothHeight = true;
			}




			if ( jQuery('.imageslider').length - 1 == i ) {
			jQuery( '#imageslider-' + i ).flexslider({
				animation: animation,
				direction : direction,
				slideshowSpeed: slideshowSpeed,
				animationSpeed : animationSpeed,
				pauseOnHover: pauseOnHover,
				controlNav: controlNav,
				directionNav: false,
				smoothHeight: smoothHeight,
				start: function() {
					jQuery( '.tab' ).hide()
					jQuery( '.tabs .tab:first' ).show();
				}
			});
			}
			else {
			jQuery( '#imageslider-' + i ).flexslider({
				animation: animation,
				direction : direction,
				slideshowSpeed: slideshowSpeed,
				animationSpeed : animationSpeed,
				pauseOnHover: pauseOnHover,
				controlNav: controlNav,
				directionNav: false,
				smoothHeight: smoothHeight,
			});
			}

		})


	}



	// Toggle

	jQuery( '.toggle-title' ).click( function() {
		var toggle = jQuery( this ).parent()
		var animation = toggle.attr('data-animation');
		var animation_speed = toggle.attr( 'data-animation_speed' );

		if( animation == 'slide' ) {
			jQuery(this).next().slideToggle( animation_speed, function(){
				if( toggle.hasClass( 'open' ) ) {
					toggle.removeClass( 'open' ).addClass( 'closed' )
				}
				else {
					toggle.addClass( 'open' ).removeClass( 'closed' )
				}

			} )
		}
		else {
			jQuery(this).next().toggle()
			if( toggle.hasClass( 'open' ) ) {
				toggle.removeClass( 'open' ).addClass( 'closed' )
			}
			else {
				toggle.addClass( 'open' ).removeClass( 'closed' )
			}

		}
	})

	// Tabs


	jQuery( '.tabs nav li' ).click( function() {
		var id = jQuery( this ).attr( 'data-tab' );
		jQuery( this ).parent().find( 'li' ).removeClass( 'current' );
		jQuery( this ).addClass( 'current' );

		jQuery( this ).parents( '.tabs:first' ).find( '.tab' ).hide();
		jQuery( this ).parents( '.tabs:first' ).find( '.tab[data-tab="' + id + '"]' ).show();

	})

	table_arrangements();
	table_state();

})



jQuery(window).smartresize( function(){


	// Gallery Arrangement

	jQuery( '.gallery' ).isotope({
		itemSelector : '.gallery-item',
		layoutMode: 'fitRows',
	});

	// Header Navigation
	manu_position();

	// Tables

	table_state()

});

function table_state() {
	if( jQuery(window).width() < 440 ) {
		collapse_tables();
	}
	else {
		expand_tables();
	}
}

function table_arrangements() {
	jQuery('.content table').addClass('fullTable');
	create_collapsed_tables();
}

function expand_tables() {
	jQuery('.collapsedTable').hide();
	jQuery('.fullTable').show();
}

function collapse_tables() {
	jQuery('.collapsedTable').show();
	jQuery('.fullTable').hide();
}

function create_collapsed_tables() {
	jQuery.each( jQuery('.fullTable'), function() {

		table = jQuery(this);

			new_table = {};
			row = 0;
			jQuery.each( table.find('tr'), function() {
				column = 0;
				jQuery.each( jQuery(this).children(), function() {
					if( new_table[column] === null || typeof new_table[column] === 'undefined' || new_table[column] === ''  ) {
					new_table[column] = {};

					}
					new_table[column][row] = jQuery(this);
					column++;
				})
				row++;
			})

			new_table_element = '<table class="collapsedTable">';
			jQuery.each( new_table, function() {
				jQuery.each( this, function() {
					new_table_element += '<tr><'+this[0].nodeName+'>' + this[0].innerHTML + '</'+this[0].nodeName+'></tr>';
				})
			})
			new_table_element += '</table>';

			new_table_element = jQuery( new_table_element );
			table.after(new_table_element)
	})
}


function manu_position() {
	menu = jQuery( '#site-header .navigation-menu' );
	collapse_at = menu.attr( 'data-collapse' );

	var logo = jQuery( '#site-header .site-logo' );
	var header = jQuery( '#site-header' );


		if( jQuery(window).width() < collapse_at ) {
			menu.hide();
			jQuery( '#site-header .navigation-select' ).show();
		}
		else {
			menu.show();
			jQuery( '#site-header .navigation-select' ).hide();
		}



}
