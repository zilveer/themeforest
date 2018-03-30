
/*------------------------------------------------------------------------
 Media Manager Plugin
 Copyright: Rascals Themes
 www: http://rascals.eu
------------------------------------------------------------------------*/

;(function($) {

jQuery.fn.MediaManager = function( options ) {
		
	return this.each( function( i ) {		  
		var  
			container = $( this ).parent(),	  
			mm = $( '.mm-wrap', container ),
			settings = {},
			message_error = $( '.msg.msg-error', container ),
			target_input = $( this ),
			explorer = $( '#mm-explorer-box' ),
			edit_box = $( '#mm-editor-box' ),
			main_edit_box = edit_box.parent(),
			results = $( '.mm-wrap', explorer ),
			ids = [],
			item_id = null,
			selected_ids = [],
			saved_ids = [],
			ajax_timeout,
			timeout = 500,
			numberposts = 30,
			pagenum,
			s;
				

		/* Init
        ------------------------------------------------------------------------*/
		 
		/* Get media manager settings */
		settings['post_id'] = $( '.mm-settings', container ).data( 'post-id' );
		settings['mm_id'] = $( '.mm-settings', container ).data( 'mm-id' );
		settings['mm_type'] = $( '.mm-settings', container ).data( 'mm-type' );
		settings['mm_admin_path'] = $( '.mm-settings', container ).data( 'mm-admin-path' );

		/* Convert saved array */
		var 
			saved_metadata = target_input.val();

		if ( saved_metadata != '' ) {
			_sortable();
			saved_ids = saved_metadata.split( '|' );
		}
		
		
		/* Buttons
        ------------------------------------------------------------------------*/
		
		/* Select Media */
		var _select_media = function( event ) {
			
			/* Detecting ctrl (windows) / meta (mac) key. */
			// if ( event.ctrlKey || event.metaKey ) {
			// 	if ( $( this ).hasClass('mm-selected') )
			// 		$( this ).removeClass( 'mm-selected' );
			// 	else						  
			// 		$( this ).addClass( 'mm-selected' );
			// } else {
			// 	$( '.mm-item', container ).removeClass( 'mm-selected' );
			// 	$( this ).addClass( 'mm-selected' );
			// }
			var 
				id = $( this ).attr( 'id' );

			if ( $( this ).hasClass('mm-selected') ) {
				$( this ).removeClass( 'mm-selected' );
				selected_ids.splice( $.inArray( id, selected_ids ), 1 );
			} else {
				$( this ).addClass( 'mm-selected' );
				selected_ids.push( id );
			}

			/* Show or hide Delete button */
			if ( $( '.mm-item.mm-selected', container ).length > 0 )
				$( '.mm-delete-button', container ).css( 'display', 'inline-block' );
			else
				$( '.mm-delete-button', container ).hide();

			event.preventDefault();
		}

		$( '.mm-item', container ).on( 'click', _select_media );

		/* Select all */
		$( '.mm-select-all', container ).on( 'click', function() {
			selected_ids = [];

			if ( $( '.mm-item.mm-selected', container ).length > 0 ) {
				$( '.mm-item', container ).removeClass( 'mm-selected' );
				$( '.mm-delete-button', container ).hide();
			} else {
				$( '.mm-item', container ).addClass( 'mm-selected' );
				if ( $( '.mm-item.mm-selected', container ).length > 0 )
					$( '.mm-delete-button', container ).css( 'display', 'inline-block' );
				
				$( '.mm-item', container ).each( function() {
					id = $( this ).attr( 'id' );
					selected_ids.push( id );
				});
			}

			event.preventDefault();
		});

		/* Edit Media */
		var _edit_item = function( event ) {
			item_id = $( this ).parent().attr( 'id' );
		    _edit_media_box();
			event.preventDefault();
		}
		$( '.mm-edit-button', mm ).on( 'click', _edit_item );

		/* Load Next */
		var _load_next = function( event ) {
			_media_explorer();
			event.preventDefault();
		}
		
		/* Remove Media */
		$( '.mm-delete-button', container ).on( 'click', _remove_media );
		
		/* Add Media */
		$( '.mm-explorer-button', container ).on( 'click', function( event ) {
			_explorer_box();
			event.preventDefault();
		});

		// Add Custom Audio
		$( '.mm-custom-audio', container ).on( 'click', function( event ) {	

			// Add custom audio 
			var 
				metadata_string,
				admin_path = settings['mm_admin_path'];
				id = null;

			
			id = _unique_id();

			mm.append( '<div class="mm-item mm-audio" id="'+ id +'"><div class="mm-item-preview"><img src="'+ admin_path +'/assets/images/metabox/audio.png" class="mm-audio-icon" /><div class="mm-filename"><div>Custom Title</div></div></div><span class="mm-edit-button"><i class="fa fa-gear"></i></span></div>' );

			/* Add new ID to array */
			ids.push( id );

			/* Join Arrays */		
			saved_ids = saved_ids.concat( ids );
			metadata_string = saved_ids.join( '|' );
		
			target_input.val( metadata_string );
			_sortable();
			_update_media();

			$( '.mm-new-item', mm ).fadeIn(800).removeClass( 'mm-new-item' );
			$( '.mm-ajax', container ).hide();
			$( '.mm-edit-button', mm ).on( 'click', _edit_item );
			$( '.mm-item', container ).off( 'click', _select_media );
			$( '.mm-item', container ).on( 'click', _select_media );
			
			event.preventDefault();
		});
		
		/* Select All Media */
		$( '#mm-select' ).on( 'click', function( event ) {
			var $checkbox = $( this );
			ids = [];
			$( '.mm-item', results ).each( function( e ) {
				var id = $( this ).attr( 'id' );
				if ( $checkbox.is( ':checked' ) ) {
					$( this ).addClass( 'mm-selected' );
					ids.push( id );
				} else {
					$( this ).removeClass( 'mm-selected' );
					ids.splice( $.inArray( id, ids ), 1 );
				}
			});
		
		});
		
		
		/* Ajax Actions
		------------------------------------------------------------------------*/
		

		/* --- Media Explorer --- */
		function _media_explorer() {

 			$( '.mm-load-next', explorer ).off( 'click', _load_next );

			var data = {
				action: 'mm_actions',
				mm_action: 'media_explorer',
				page_num: pagenum,
				numberposts: numberposts,
				ids: saved_ids,
				s: s,
				type : settings['mm_type']
			};
					
			$( '#mm-explorer-loader' ).show();
			
			$.ajax( {
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {

					if ( response == 'end pages' ) {
						$( '#mm-explorer-loader' ).hide();
						// $( '.mm-load-next', explorer ).hide();
						return;
					}

					results.append( response );
					$( '#mm-explorer-loader' ).hide();
					pagenum ++;
					_get_images_ids( response );
					$( '.mm-load-next', explorer ).on( 'click', _load_next );
					response = '';
					return;

				}
			});
		}


		/* --- Add Media --- */
		function _add_media() {

			var data = {
				action: 'mm_actions',
				mm_action: 'add_media',
				items: ids,
				type: settings['mm_type']
			};
					
			$( '.mm-ajax', container ).css( 'display', 'inline-block' );
			
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {
					mm.append( response );

					/* Menage Arrays */
					var metadata_string;

					/* Join Arrays */
					if ( saved_ids.length > 0 ) {
						saved_ids = saved_ids.concat( ids );
						metadata_string = saved_ids.join( '|' );
					} else {
						/* If saved array is empty */
						metadata_string = ids.join( '|' );
					}
					target_input.val( metadata_string );
					_sortable();
					_update_media();
					$( '.mm-new-item', mm ).fadeIn( 800 ).removeClass( 'mm-new-item' );
					$( '.mm-ajax', container ).hide();
					$( '.mm-edit-button', mm ).on( 'click', _edit_item );
					$( '.mm-item', container ).off( 'click', _select_media );
					$( '.mm-item', container ).on( 'click', _select_media );
				}
			});
		}


		/* --- Remove Media --- */
		function _remove_media( event ) {
			
			var 
				selected_items = $( '.mm-item.mm-selected', container );

            message_error.hide();
			
			var data = {
				action: 'mm_actions',
				mm_action: 'remove_media',
				selected_ids: selected_ids,
				settings: settings
			};
			$( '.mm-ajax', container ).css( 'display', 'inline-block' );
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {
					if (response == 'success' ) {
						selected_items.removeAttr( 'id' );
						_sortable();
						_update_media();

						selected_items.fadeOut( 400, function(){
							$(this).remove();
							$( '.mm-delete-button', container ).hide();
						});
					} else {
						$( '.mm-ajax', container).hide();
						message_error.show();
					}

					return false;
				}
			});
			event.preventDefault();
		}


		/* --- Update Media --- */
		function _update_media() {
            message_error.hide();
			
			var data = {
				action: 'mm_actions',
				mm_action: 'update_media',
				ids: target_input.val(),
				settings: settings
			};
			
			$( '.mm-ajax', container ).css( 'display', 'inline-block' );
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {
					if (response != 'success' ) {
						message_error.show();
					}
					$( '.mm-ajax', container ).hide();
					if ( mm.children().length == 0 ) 
						$( '.msg-dotted', container ).slideDown( 400 );
					else 
						$( '.msg-dotted', container ).slideUp( 400 );
					return false;
				}
			});
			return false;
		}


		/* Editor */

		/* --- Media Manger Editor --- */
		function _mm_editor() {
			
			if ( item_id.indexOf( 'custom_id' ) != -1 ) 
				custom = true;
			else 
				custom = false;

			var data = {
				action: 'mm_editor',
				item_id: item_id,
				settings: settings,
				custom: custom
			};

			$( '#mm-editor-loader' ).show();
			
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {
					$( '#mm-editor-content', edit_box ).append( response );
					
					$( '.mm-group', edit_box ).each( function() {
						var 
							group = $( this ).val(),
							group = 'mm-group-'+group;
						$( '.' + group, edit_box ).show();
					});
													 
					$( '.mm-group', edit_box ).change( function() {						 
						var group = $( this ).val(),
						main_group = $( this ).data( 'main-group' ),
						group = 'mm-group-'+group;
						$( '.' + main_group, edit_box ).hide();
						$( '.' + group, edit_box ).fadeIn( 600 );

					});

					$( '#mm-editor-content', edit_box ).fadeIn( 600 );
					$( '#mm-editor-loader' ).hide();
				}
			});
		}


		/* --- Media Manger Editor --- */
		function _mm_editor_save() {

			var item_fields = {};

			$( '#mm-editor-content input, #mm-editor-content textarea, #mm-editor-content select', edit_box ).each( function( i ){
				var name = $( this ).attr( 'name' );
				if ( $( this ).val() != '' )
			        item_fields[name] = $( this ).val();
			});
			

			/* --- Helpers --- */
			
			/* Iframe */
			if ( item_fields.image_type == 'lightbox_soundcloud' || item_fields.image_type == 'lightbox_video' ) {
				var iframe_content = '';

				if ( item_fields.image_type == 'lightbox_soundcloud' )
					iframe_content = item_fields.lightbox_soundcloud;
				if ( item_fields.image_type == 'lightbox_video' ) 
					iframe_content = item_fields.lightbox_video;
				
				/* Get iframe attributes */
				var 
					iframe_content = $( iframe_content ),
					iframe = $( iframe_content ).filter( 'iframe' ),
					src = iframe.attr( 'src' ),
					width = iframe.attr( 'width' ),
					height = iframe.attr( 'height' );
					iframe_code = src + '|' + width + "|" + height;
					item_fields[ 'iframe_code' ] = iframe_code;
			} 

			var data = {
				action : 'mm_editor_save',
				fields : item_fields,
				item_id : item_id,
				settings : settings
			};
					
			$( '#mm-editor-loader' ).show();
			
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {

					/* Update title */
					if ( settings['mm_type'] == 'audio' && response != 'success' && response != 'error' ) {

						/* Get mm item by ID */
						$( '#'+item_id, mm ).find( '.mm-filename div' ).text( response );
					}
					$( '#mm-editor-loader' ).hide();
				}
			});
		}
		
		
		/* Boxes
        ------------------------------------------------------------------------*/
		
		/* Edit media BOX */
		function _edit_media_box() {
			$( '#mm-editor-box' ).dialog( {
				title: 'Edit Media',
				modal: false,
				width: 600,
				height: 'auto',
				dialogClass: 'ui-custom ui-custom-dialog',
				buttons: [
					{
						text: 'Update Item',
						'class': 'ui-button-update-item',
						click: function() {
							_mm_editor_save();
							
						}
					},
					{
						text: 'Cancel',
						'class': 'ui-button-cancel',
						click: function() {
							$( this ).dialog( 'close' );
						}
					}
				],
				open: function( event, ui ) {

					/* Buttons icons */
					$(event.target).parent().find( '.ui-button-cancel span' ).prepend( '<i class="fa icon fa-times"></i>' );
					$(event.target).parent().find( '.ui-button-update-item span' ).prepend( '<i class="fa icon fa-refresh"></i>' );

					/* Add helper class to overlay layer */
					$( '.ui-widget-overlay' ).addClass( 'ui-custom-overlay' );

					/* Resizable */
					/* Mobile Resizable */
					var init_width = $( window ).width(),
						init_height = $( window ).height();

					if ( init_width <= 768 ) {
						$( event.target ).parent().css( 'max-width', '90%' );
						$( event.target ).dialog( 'option', 'position', 'center' );
						$( event.target ).dialog( 'option', 'height', 'auto' );
					} else {
						$( event.target ).dialog( 'option', 'height', init_height-100 );
					}
					$( '.ui-widget-overlay' ).css( 'height', init_height );
					
					$( window ).resize( function() {

						var windowWidth = $( window ).width();

						if ( windowWidth <= 768 ) {
							$( event.target ).parent().css( 'max-width', '90%' );
						} else {
							$( event.target ).parent().css( 'max-width', '600px' );
							$( '.ui-widget-overlay' ).css( 'height', init_height );
						}
    					$( event.target ).dialog( 'option', 'position', 'center' );
					});


					/* --- */

					/* Add loader to */
					$( event.target ).parent().find( '.ui-dialog-buttonpane' ).append( $( '#mm-editor-loader' ) );
					
					_mm_editor();
				},
				close: function() {
				   $( '#mm-editor-loader' ).appendTo(edit_box);
				   $( '#mm-editor-content', edit_box).children().remove();
				   $( '#mm-editor-content', edit_box).hide();
				  
				}
			});
		}
		

	    /* Explorer BOX */
		function _explorer_box() {
			explorer.dialog( {
				title: 'Media Manager',
				modal: false,
				width: 600,
				height: 'auto',
				dialogClass :'ui-custom ui-custom-dialog',
				buttons: [
					{
						text: 'Add Selected Items',
						'class': 'ui-button-add-items',
						click: function() {
							if ( ids.length > 0 ) {
							    _add_media();
							    $(this).dialog( 'close' );
							}
							
						}
					},
					{
						text: 'Cancel',
						'class': 'ui-button-cancel',
						click: function() {
							$( this ).dialog( 'close' );
						}
					}
				],
				open: function ( event, ui ) {

	        		/* Buttons icons */
					$(event.target).parent().find( '.ui-button-cancel span' ).prepend( '<i class="fa icon fa-times"></i>' );
					$(event.target).parent().find( '.ui-button-add-items span' ).prepend( '<i class="fa icon fa-plus"></i>' );

					/* Add helper class to overlay layer */
					$( '.ui-widget-overlay' ).addClass( 'ui-custom-overlay' );

					/* Resizable */
					/* Mobile Resizable */
					var init_width = $( window ).width(),
						init_height = $( window ).height();

					if ( init_width <= 768 ) {
						$( event.target ).parent().css( 'max-width', '90%' );
					} else {
						$( event.target ).dialog( 'option', 'width', init_width-20 );
						$( event.target ).dialog( 'option', 'height', init_height-20 );
						$( event.target ).parent().css( 'position', 'fixed' );
					}
					$( event.target ).dialog( 'option', 'position', 'center' );

					$( window ).resize( function() {

						var windowWidth = $( window ).width(),
							windowHeight = $( window ).height();

						if ( windowWidth <= 768 ) {
							$( event.target ).parent().css( 'max-width', '90%' );
							$( event.target ).parent().css( 'position', 'absolute' );
						} else {
							$( event.target ).dialog( 'option', 'width', windowWidth-20 );
							$( event.target ).dialog( 'option', 'height', windowHeight-20 );
							$( event.target ).parent().css( 'position', 'fixed' );
							$( event.target ).parent().css( 'max-width', '100%' );
						}
    					$( event.target ).dialog( 'option', 'position', 'center' );

					});

					$( event.target ).parent().css( 'top', '10px' );
					/* -------- */

					/* Add loader to */
					$( event.target ).parent().find( '.ui-dialog-buttonpane' ).append( $( '#mm-explorer-loader' ) );

					s = '';
					ids.length = 0;
					pagenum = 1;
					_search();
					_media_explorer();
	    		},
	    		close: function () {
	    			results.html( '' );
					$( '#mm-search' ).val( '' );
					$( '#mm-select' ).attr( 'checked', false);
					$( '.mm-load-next', explorer ).off( 'click', _load_next );
	    		}

			});
		}


		/* Small helpers
       	------------------------------------------------------------------------*/
		 
		/* Unique ID */
		function _unique_id() {
			var 
				$nr = Math.floor( Math.random()*400 ) + Math.round( Math.random()*400 ),
			id = 'custom_id_';

			$nr = $nr.toString();
			id = id+$nr; 

			// Check if ID already exists
			if ( $( '#'+id).length > 0 ) 
				return _unique_id();
			else 
				return id;
		}

		/* Sortable */
		function _sortable() {

			/* Clear temp array */
			ids = [];
			if ( target_input.val() == '' ) saved_ids = [];

			mm.sortable({
				handle: $( '.mm-item', mm ),
				update: function( event, ui ) {
					_update_ids();
					_update_media();
				}
			});
			_update_ids();
		}

		/* Update ids */
		function _update_ids() {
			saved_ids = mm.sortable( 'toArray' );
			saved_ids = $.grep(saved_ids, function(n, i){
  				return (n !== "" && n != null);
			});
			var metadata_string = saved_ids.join( '|' );
			target_input.val(metadata_string);
		}
		 
		/* Scroll Box */
		function _scroll_box(e){
			var elem = $( e.currentTarget );
			if ( elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()-3 ) {
				if (ajax_timeout !== undefined) 
					clearTimeout( ajax_timeout );
				//ul_wrap.unbind( 'scroll', _scroll_box );
				ajax_timeout = setTimeout( _media_explorer, timeout );

				return false;
			}
		}
		
	    /* Search */
		function _search() {
		    $( '#mm-search' ).keyup( function() {													
				if ( ajax_timeout !== undefined ) 
               		clearTimeout(ajax_timeout);									
				s = $(this).val();
				if (s === undefined) 
					return;
				results.html( '' );
				pagenum = 1;
                ajax_timeout = setTimeout( _media_explorer, timeout );
	        });
		}
		
		/* Get images ID */
		function _get_images_ids( response ) {
			
			if ( $( '.mm-item', results ).length > 0 ) {
				$( '.mm-item', results ).off( 'click' );
				$( '.mm-item', results ).on( 'click', function() {
					var id = $( this ).attr( 'id' );
					if ( $( this ).is( '.mm-selected' ) ) {
						$( this ).removeClass( 'mm-selected' );
						ids.splice($.inArray( id, ids ), 1);
					} else {
						$( this ).addClass( 'mm-selected' );
						ids.push( id );
					}
					return false;
				});
			}	
		}
		
		
	});
}

})(jQuery);