(function($)
{
	"use strict";

	$.ZnMedia = function (){
		this.html5video = $.ZnMedia.html5video;
		this.image_gallery = $.ZnMedia.image_gallery;
		this.media_field_upload = $.ZnMedia.media_field_upload;
		this.media_field_import = $.ZnMedia.media_field_import;
		this.add_behaviour();
	};

	$.ZnMedia.prototype =
	{
		// BIND THE SAVE, CLOSE
		add_behaviour : function(){

			var znmedia = this;

			// Open Wordpress Media manager modal
			$('body').on( 'click', '.zn-add-media-trigger', function(){

				var clicked_target = $(this),
					media_data = clicked_target.data(),

					// Needed for returned data
					option_container = clicked_target.closest('.zn_option_content'),
					value_holder = option_container.find('.zn-media-value-container:eq(0)'),
					preview_holder = option_container.find('.zn-media-preview-holder:eq(0)'),

					// Get the requested wp.media object based on the media data
					file_frame = znmedia[media_data.media_type].init( media_data, value_holder );

				// Detach the wp.media modal from DOM on close
				file_frame.on( 'close', function() {
					file_frame.detach();
				});

				// Open the wp.media object
				file_frame.open();

				// Bind the select, update, insert actions
				file_frame.on( 'select update insert', function(e) {

					var selection = file_frame.state().get('selection');

					// In case we have multiple items
					if(typeof e !== 'undefined') {selection = e; }

					// Get the data needed for previewing the selection and saving
					var frame_data = znmedia[media_data.media_type].get_data( selection );

					// Add the values that needs to be saved if they are returned
					if( frame_data.values.length ) {
						value_holder.val( frame_data.values );
					}

					// Set the preview holder HTML
					if( typeof frame_data.preview_html !== 'undefined' && frame_data.preview_html.length > 0 && preview_holder.length > 0 ){
						preview_holder.html( frame_data.preview_html );
						preview_holder.removeClass('zn-media-preview-holder-empty');
					}
					else if ( preview_holder.length > 0 ){
						preview_holder.html('Nothing selected...');
						preview_holder.addClass('zn-media-preview-holder-empty');
					}

				});
			});
		}
	};

	$.ZnMedia.image_gallery = {

		init : function( media_data, value_holder ){
			this.media_data = media_data;
			this.saved_values = value_holder.val();

			return this.get_media();
		},

		/**
		 *	This function will build the wp.media object for video option type
		 *
		 *	@returns : object
		*/
		get_media : function(){
			var	std = this.get_saved_values( this.saved_values, this.media_data );

			// Prepare the default arguments for wp.media
			var args = {
				frame: this.media_data.frame,
				state: this.media_data.state,
				library: { type: 'image' },
				button:  { text: this.media_data.insert_title },
				className: this.media_data['class'],
				selection: std
			};

			// Create the frame
			return wp.media( args );
		},

		get_saved_values : function(){

			if(typeof this.saved_values == 'undefined') return;

			var id_array = this.saved_values.split(','),
				args = {orderby: "post__in", order: "ASC", type: "image", perPage: -1, post__in:id_array},
				attachments = wp.media.query( args ),
				selection = new wp.media.model.Selection( attachments.models,
				{
					props:    attachments.props.toJSON(),
					multiple: true
				});

			// Change the state to the edit gallery if we have images
			if( id_array.length && !isNaN( parseInt( id_array[0],10 ) ) ){
				this.media_data.state = 'gallery-edit';
			}
			return selection;
		},

		/**
		 *	This function will build the data that will be saved on the option as well as the preview HTML that will be displayed
		 *
		 *	@returns : object
		*/
		get_data : function( selection ){

			var preview_html = '',
				preview_img = '',
				media_object = this,
				values = selection.map( function( attachment ){
				attachment = attachment.toJSON();

				if( media_object.media_data.value_type == 'id' ) {
					preview_img = typeof attachment.sizes['thumbnail'] != 'undefined' ? attachment.sizes['thumbnail'].url : attachment.url ;
					preview_html += "<span class='zn-media-gallery-preview-image'><img src='"+preview_img+"' /></span>";

					return attachment['id']; // Return the image id
				}
			});

			return {
				values : values,
				preview_html : preview_html
			};
		},
	};

	/**
	 *
	 * This object is in charge for setting and getting all video related option data
	 *
	*/
	$.ZnMedia.html5video = {

		init : function( media_data, value_holder ){
			this.media_data = media_data;
			this.saved_values = value_holder.val();

			return this.get_media();
		},

		/**
		 *	This function will build the wp.media object for video option type
		 *
		 *	@returns : object
		*/
		get_media : function(){

			var	saved_values = jQuery.parseJSON( this.saved_values ),
				metadata = {
					id : '238',
					src : '',
					poster : '',
					loop : false,
					autoplay : false,
					preload : 'metadata',
					content : ''
				};

			// Combine defaults with the saved values
			$.extend( metadata, saved_values );

			// Prepare the default arguments for wp.media
			var args = {
				title:   this.media_data.title,
				library: { type: this.media_data.type },
				button:  { text: this.media_data.insert_title },
				className: this.media_data['class'],
				state : this.media_data.state,
				frame : this.media_data.frame,
				// only for tests
				metadata : metadata
			};

			// Create the frame
			return wp.media( args );

		},

		/**
		 *	This function will build the data that will be saved on the option as well as the preview HTML that will be displayed
		 *
		 *	@returns : object
		*/
		get_data : function( selection ){
			//console.log( selection );
			var preview_html = '',
				mp4 = selection.mp4,
				ogv = selection.ogv,
				webm = selection.webm;

			// Check to see if we have data to show
			if ( mp4 || ogv || webm ) {
				preview_html += "<video controls>";

				// Add the mp4 string if the user selected an mp4
				if ( mp4 ){
					preview_html += "<source src=\""+mp4+"\" type=\"video/mp4\">";
				}

				if ( ogv ){
					preview_html += "<source src=\""+ogv+"\" type=\"video/ogg\">";
				}

				if ( webm ){
					preview_html += "<source src=\""+webm+"\" type=\"video/webm\">";
				}

				preview_html += "</video>";
			}

			return {
				values : JSON.stringify( selection ),
				preview_html : preview_html
			};

		}
	};

	$.ZnMedia.media_field_upload = {
		init : function( media_data, value_holder ){
			this.media_data = media_data;
			this.saved_values = value_holder.val();

			return this.get_media();
		},


		/**
		 *	This function will build the wp.media object for video option type
		 *
		 *	@returns : object
		*/
		get_media : function(){

			// Prepare the default arguments for wp.media
			var args = {
				title:   this.media_data.title,
				library: { type: this.media_data.type },
				button:  { text: this.media_data.insert_title },
				className: this.media_data['class'],
				state : this.media_data.state,
				frame : this.media_data.frame
			};

			// Create the frame
			return wp.media( args );

		},

		/**
		 *	This function will build the data that will be saved on the option as well as the preview HTML that will be displayed
		 *
		 *	@returns : object
		*/
		get_data : function( selection ){

			var media_object = this,
				values = selection.map( function( attachment ){
					attachment = attachment.toJSON();
					//console.log( attachment );
					if( media_object.media_data.value_type == 'id' ) {
						return attachment['id']; // Return the image id
					}
					else if ( media_object.media_data.value_type == 'url' ){
						return attachment['url']; // Return the image id
					}
				});

			return {
				values : values
			};
		}
	};

	/**
	 * @kos
	 * @TODO: TO BE IMPLEMENTED
	 *
	 *
	 * @type {{init: Function, get_media: Function, get_data: Function}}
	 */
	$.ZnMedia.media_field_import =
	{
		init : function( media_data, value_holder ){
			this.media_data = media_data;
			this.saved_values = value_holder.val();

			return this.get_media();
		},
		/**
		 *	This function will build the wp.media object for video option type
		 *
		 *	@returns : object
		 */
		get_media : function(){

			// Prepare the default arguments for wp.media
			var args = {
				title:   this.media_data.title,
				library: { type: this.media_data.type },
				button:  { text: this.media_data.insert_title },
				className: this.media_data['class'],
				state : this.media_data.state,
				frame : this.media_data.frame
			};

			// Create the frame
			return wp.media( args );

		},
		/**
		 *	This function is used to display the popup window that will allow users to select the export archive and
		 *	then import the theme options
		 *
		 *	@returns : object
		*/
		get_data : function( selection ){
			var media_object = this,
				values = selection.map( function( attachment ){
					attachment = attachment.toJSON();
					if ( media_object.media_data.value_type == 'url' ){
						var message_container = $('.zn_theme_options_import_msg_container');
						if(message_container && attachment['url'])
						{
							var btn = message_container.next('#zn_theme_import_button');

							btn.addClass('zn-button--loading');

							$.ajax({
								url: ajaxurl,
								type: 'POST',
								cache: false,
								async: true,
								data : {
									data: {
										'url': attachment['url']
									},
									action: 'zn_theme_options_import',
									zn_ajax_nonce: ZnAjax.security
								}
							}).done(function(response){
								btn.removeClass('zn-button--loading');
								setTimeout(function(){
									message_container.append(
										'<div class="alert alert-success">'+response.data+'</div>'
									).show();
								}, 3000);
							}).fail(function(a,b){
								btn.removeClass('zn-button--loading');
								setTimeout(function(){
									message_container.append(
										'<div class="alert alert-danger">Something went wrong... please try again in a few moments</div>'
									).show();
								}, 3000);
								console.error('Error: ',b);
							});
						}
					}
				});

			return {
				values : values
			};
		}
	};

	$(document).ready(function(){
		new $.ZnMedia();
	});

})(jQuery);
