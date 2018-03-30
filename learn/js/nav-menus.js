var learn = learn || {};
(function ($) {
	'use strict';

	$(function () {
		$( 'body').append( '<div id="modal" class="modal fade"></div>' );
		$( '#menu-to-edit li.menu-item' ).each(function () {
			$(this).find('.item-title').append('<span class="lp-mega-menu">' + learn.megamenu + '</span>');
		});

		// Open product single modal
		$( '#menu-to-edit li.menu-item' ).on( 'click', '.lp-mega-menu', function( e ) {
			e.preventDefault();
			var $modal = $( '#modal' );

			var menuId = $( this).parents( 'li.menu-item' ).find( '.menu-item-data-db-id' ).val(),
				menuTitle =  $( this).parents( 'li.menu-item' ).find( '.menu-item-title' ).html();

			$modal.show().addClass( 'in').html( '<span class="loading"> <i class="fa fa-spinner"></i></span>' ),

			$.ajax( {
				dataType: 'json',
				method: 'post',
				url: ajaxurl,
				data: {
					action: 'learn_mega_fields',
					lpnonce: learn.nonce,
					menu_id: menuId,

				},
				success: function( response ) {
					$modal.html(
						'<div class="item-detail">' +
						'<div class="modal-dialog">' +
						'<div class="modal-content">' +
						'<div class="modal-header">' +
						'<h3>' + menuTitle + '</h3>' +
						'<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i><span class="sr-only"></span></button>' +
						'</div>' +
						'<div class="modal-body"></div>' +
						'<div class="modal-footer"><a href="#" id="modal-save-menu-header" class="button button-primary menu-save">' + learn.savemenu + '</a><span class="refresh" style="display: none"> <i class="fa fa-refresh"></i></span></div>' +
						'</div>' +
						'</div>' +
						'</div>');

					$( '#modal').find( '.modal-body' ).html( response.data );
					$( '#modal').find( '.modal-body').fadeIn().addClass( 'in' );

					var modalHeight = $modal.find('.modal-content').height(),
						winHeight = $(window).height(),
						topModal = ( winHeight - modalHeight) / 2;

					$modal.find('.modal-content').css( { 'margin-top': topModal } );
					$('body').addClass( 'modal-open' );

					// Close portfolio modal
					$modal.on( 'click', 'button.close', function( e ) {
						e.preventDefault();

						$modal.fadeOut( 500, function() {
							$('body').removeClass( 'modal-open' );
							$modal.removeClass( 'in' );
							$modal.html( '' );
						} );
					} );

					if( $( '#edit-item-mega-menu' ).is(':checked') ) {
						$modal.find( '.field-of-mega-menu' ).show();
						$modal.find( '.field-not-mega-menu' ).hide();
					} else {
						$modal.find( '.field-of-mega-menu' ).hide();
						$modal.find( '.field-not-mega-menu' ).show();
					}

					$modal.on( 'click', '#edit-item-mega-menu', function( ) {
						if( $(this).is(':checked') ) {
							$modal.find( '.field-of-mega-menu' ).show();
							$modal.find( '.field-not-mega-menu' ).hide();
						} else {
							$modal.find( '.field-of-mega-menu' ).hide();
							$modal.find( '.field-not-mega-menu' ).show();
						}
					}).trigger( 'click' );

					$modal.on( 'click', '#modal-save-menu-header', function( e ) {
						e.preventDefault();

						var megaMenu = 0,
							hideText = 0,
							megaWidth = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-width' ).val(),
							megaColumn = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-column' ).val(),
							megaContent = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-content' ).val(),
							bgImage = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-bg_image' ).val(),
							bgHPosition = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-bg_h_position' ).val(),
							bgVPosition = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-bg_v_position' ).val(),
							bgRepeat = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-bg_repeat' ).val(),
							bgSize = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-bg_size' ).val(),
							menuId = $( this).parents( '.modal-content').find( '#edit-item-mega-menu-id' ).val();

						if( $( this).parents( '.modal-content').find( '#edit-item-mega-menu').is(':checked') ) {
							megaMenu = 1
						}

						if( $( this).parents( '.modal-content').find( '#edit-item-mega-menu-hide_text' ).is(':checked') ) {
							hideText = 1;
						}

						$( this).addClass( 'disabled' );
						$( this).next( '.refresh').show();
						$.ajax( {
							dataType: 'json',
							method: 'post',
							url: ajaxurl,
							data: {
								action: 'learn_mega_menu',
								lpnonce: learn.nonce,
								menu_id: menuId,
								hide_text: hideText,
								mega_menu: megaMenu,
								mega_menu_width: megaWidth,
								column: megaColumn,
								content: megaContent,
								bg_image: bgImage,
								bg_h_position: bgHPosition,
								bg_v_position: bgVPosition,
								bg_repeat: bgRepeat,
								bg_size: bgSize
							},
							success: function( data ) {
								$( '#modal-save-menu-header' ).removeClass( 'disabled' );
								$( '#modal-save-menu-header').next( '.refresh').hide();
							}
						} );
					} );

					/** Field image */
					var file;

					$('#upload-image').on('click', function (e) {
						e.preventDefault();

						var $input = $(this).next('input'),
							$parent = $(this).parent(),
							$remove = $(this).parent().find( '#remove-image'),
							$this = $(this);

						if (typeof file != 'undefined') {
							file.close();
						}

						file = wp.media();

						//callback for selected image
						file.on('select', function () {
							var attachments = file.state().get('selection').toJSON();
							var image = attachments[0].url;
							$input.val(image);
							$parent.css({ 'background-image': 'url(' + image + ')' });
							$remove.show();
							$this.hide();
						});

						// Open modal
						file.open();
					});

					$('#remove-image').on('click', function (e) {
						e.preventDefault();

						var $input = $(this).prev('input'),
							$parent = $(this).parent(),
							$upload = $(this).parent().find( '#upload-image'),
							$this = $(this);

						$input.val( '' );
						$parent.removeAttr( 'style' );
						$upload.show();
						$this.hide();
					});
				}
			} );

		} );

		/** Field Icon */
		$('body').on('click', '.pick-icon', function (e) {
			e.preventDefault();

			$(this).next('.icons-block').slideToggle();
		});

		$('.icon-selector').on('click', 'i', function (e) {
			e.preventDefault();
			var $el = $(this),
				icon = $el.data('icon');

			$el.closest('.icons-block').next('input').val(icon).siblings('.pick-icon').children('i').attr('class', icon);
			$el.addClass('selected').siblings('.selected').removeClass('selected');
		});

		$('.search-icon').on('keyup', function () {
			var search = $(this).val(),
				$icons = $(this).siblings('.icon-selector').children();

			if (!search) {
				$icons.show();
				return;
			}

			$icons.hide().filter(function () {
				return $(this).data('icon').indexOf(search) >= 0;
			}).show();
		});
	} );
})(jQuery);