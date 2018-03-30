(function($) {

	"use strict";


	$(document).ready(function() {


		mk_megamenu.menu_item_mouseup();
		mk_megamenu.megamenu_status_update();

		mk_megamenu.update_megamenu_fields();

		$( '.remove-mk-megamenu-background' ).manage_thumbnail_display();
		$( '.mk-megamenu-background-image' ).css( 'display', 'block' );
		$( ".mk-megamenu-background-image[src='']" ).css( 'display', 'none' );

		mk_media_frame_setup();

	});


	var mk_megamenu = {

		menu_item_mouseup: function() {
			$( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
				if( ! $( event.target ).is( 'a' )) {
					setTimeout( mk_megamenu.update_megamenu_fields, 300 );
				}
			});
		},

		megamenu_status_update: function() {

			$( document ).on( 'click', '.edit-menu-item-mk-megamenu-check', function() {
				var parent_li_item = $( this ).parents( '.menu-item:eq( 0 )' );

				if( $( this ).is( ':checked' ) ) {
					parent_li_item.addClass( 'mk-megamenu' );
				} else 	{
					parent_li_item.removeClass( 'mk-megamenu' );
				}
				mk_megamenu.update_megamenu_fields();
			});
		},

		update_megamenu_fields: function() {
			var menu_li_items = $( '.menu-item');

			menu_li_items.each( function( i ) 	{

				var megamenu_status = $( '.edit-menu-item-mk-megamenu-check', this );

				if( ! $( this ).is( '.menu-item-depth-0' ) ) {
					var check_against = menu_li_items.filter( ':eq(' + (i-1) + ')' );


					if( check_against.is( '.mk-megamenu' ) ) {

						megamenu_status.attr( 'checked', 'checked' );
						$( this ).addClass( 'mk-megamenu' );
					} else {
						megamenu_status.attr( 'checked', '' );
						$( this ).removeClass( 'mk-megamenu' );
					}
				} else {
					if( megamenu_status.attr( 'checked' ) ) {
						$( this ).addClass( 'mk-megamenu' );
					}
				}
			});
		}

	}


	$.fn.manage_thumbnail_display = function( variables ) {
		var button_id;

		return this.click( function( e ){
			e.preventDefault();

			button_id = this.id.replace( 'mk-media-remove-', '' );
			$( '#edit-menu-item-megamenu-background-'+button_id ).val( '' );
			$( '#mk-media-img-'+button_id ).attr( 'src', '' ).css( 'display', 'none' );
		});
	}

	function mk_media_frame_setup() {
		var MkMediaFrame;
		var item_id;

		$( document.body ).on( 'click.mkOpenMediaManager', '.mk-open-media', function(e){

			e.preventDefault();

			item_id = this.id.replace('mk-media-upload-', '');

			if ( MkMediaFrame ) {
				MkMediaFrame.open();
				return;
			}

			MkMediaFrame = wp.media.frames.MkMediaFrame = wp.media({

				className: 'media-frame mk-media-frame',
				frame: 'select',
				multiple: false,
				library: {
					type: 'image'
				}
			});

			MkMediaFrame.on('select', function(){

				var media_attachment = MkMediaFrame.state().get('selection').first().toJSON();

				$( '#edit-menu-item-megamenu-background-'+item_id ).val( media_attachment.url );
				$( '#mk-media-img-'+item_id ).attr( 'src', media_attachment.url ).css( 'display', 'block' );

			});

			MkMediaFrame.open();
		});

	}

	
	function mk_menus_icon_selector() {
		jQuery('.mk-visual-selector').find('a').each(function() {
			default_value = jQuery(this).siblings('input').val();
			if(jQuery(this).attr('rel')==default_value){
					jQuery(this).addClass('current');
				}
				jQuery(this).click(function(){

					jQuery(this).siblings('input').val(jQuery(this).attr('rel'));
					jQuery(this).parent('.mk-visual-selector').find('.current').removeClass('current');
					jQuery(this).addClass('current');
					return false;
				})
		});
	}
	mk_menus_icon_selector();

	function mk_use_icon() {

		jQuery('.mk-add-icon-btn').on('click', function() {

			this_el_id = "#edit-menu-item-menu-icon-" + jQuery(this).attr('data-id');
			icon_el_id = "#mk-view-icon-" + jQuery(this).attr('data-id');
			//console.log(this_el_id);

			jQuery('.mk-icon-use-this').on('click', function() {
				icon_value = jQuery('#mk-icon-value-holder').val();
				if(icon_value == '') {
					jQuery(icon_el_id).attr("class", "");
					jQuery(this_el_id).val("");
				} else {
					jQuery(icon_el_id).attr("class", icon_value);
					jQuery(this_el_id).val(icon_value);
				}
				
				window.parent.tb_remove();
				return false;
			});
		});

		jQuery('.mk-remove-icon').on('click', function() {
			jQuery(this).siblings('input').val('');
			jQuery(this).siblings('i').attr('class', '');
			return false;

		});

	}
	mk_use_icon();

})(jQuery);


