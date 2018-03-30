/*
* usefull infos: 
* http://wordpress.org/support/topic/new-media-manager-closeunload-event?replies=2
* http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
* http://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
* file wp-includes/js/media-view.js as reference
* https://gist.github.com/4476771 - custom filter
* tuts+ backbone.js lessons: https://tutsplus.com/course/connected-to-the-backbone/
* remove/change sidebar links: http://sumtips.com/2012/12/add-remove-tab-wordpress-3-5-media-upload-page.html
*
* https://gist.github.com/thomasgriffin/4953041 <-- own attach vies- not tried yet
*/



(function($)
{
	"use strict";
	$.AviaElementBehavior = $.AviaElementBehavior || {};
	
	
	$.AviaElementBehavior.wp_media = $.AviaElementBehavior.wp_media || [];

	$.AviaElementBehavior.wp_media_advanced =  function()
	{
		var $body = $("body"), file_frame = [], media = wp.media, 
		
		//fetch preExisting selection of galleries. change the gallery state based on wheter we got a selection or not to "Edit gallery" or "AAdd gallery"
		fetch_selection = function(ids, options)
		{
			if(typeof ids == 'undefined') return; //<--happens on multi_image insert for modal group
		
			var id_array = ids.split(','),
				args = {orderby: "post__in", order: "ASC", type: "image", perPage: -1, post__in:id_array},
				attachments = wp.media.query( args ),
				selection = new wp.media.model.Selection( attachments.models, 
			    {
			        props:    attachments.props.toJSON(),
			        multiple: true
			    });
			    
			    
		    if(options.state == 'gallery-library' && id_array.length &&  !isNaN(parseInt(id_array[0],10)))
		    {
		    	options.state = 'gallery-edit';
		    }
		    return selection;
		};
		
		
		// re route click events on preview images to the "upload button"
		$body.on('click', '.avia-builder-prev-img-container a, .avia-builder-prev-img>img', function( event )
		{
			event.preventDefault();
			
			var clicked  = $(this), 
				newClick = clicked.parents('.avia-form-element-container:eq(0)').find('.button:eq(0)').trigger('click');
		});
		
		
		// delete functionality
		$body.on('click', '.avia-element-image .avia-delete-image', function( event )
		{
			event.preventDefault();
			
			var clicked  = $(this).addClass('avia-hidden'), 
				parent 	 = clicked.parents('.avia-form-element-container:eq(0)'),
				img 	 = parent.find('.avia-builder-prev-img').html(""),
				hidden   = parent.find('input[type=hidden]').val('').trigger('change');
		});
		
		//delete functionallity gallery
		$body.on('click', '.avia-delete-gallery-button', function( event )
		{
			event.preventDefault();
			
			var clicked  = $(this), 
				parent 	 = clicked.parents('.avia-form-element-container:eq(0)'),
				img 	 = parent.find('.avia-builder-prev-img-container').html(""),
				hidden   = parent.find('input[type=hidden]').val('').trigger('change');
		});
		
		
		
		
		
		
		
		// click event upload button
		$body.on('click', '.aviabuilder-image-upload', function( event )
		{	
			event.preventDefault();
						
			var clicked = $(this), 
				options = clicked.data(),
				parent 	= clicked.parents('.avia-form-element-container:last'),
 				target 	= parent.find('#'+options.target),
 				fakeImg = target.next('input'),
 				hidde_attachment_id = parent.find('.hidden-attachment-id'),
 				hidde_attachment_size = parent.find('.hidden-attachment-size'),
 				preview = parent.find('.avia-builder-prev-img-container'),
 				template = parent.find(".avia-tmpl-modal-element").html(),
 				modal_group = parent.find('.avia-modal-group'),
 				del_btn	= parent.find('.avia-delete-image'),
 				prefill = fetch_selection(target.val(), options),
 				frame_key = _.random(0, 999999999999999999);
				//set vars so we know that an editor is open
				$.AviaElementBehavior.wp_media.unshift(this);
				
				// If the media frame already exists, reopen it.
				if ( file_frame[frame_key] ) 
				{
					file_frame[frame_key].open();
					return;
				}
				
				
				// Create the media frame.
				file_frame[frame_key]  = wp.media(
				{
					frame:   options.frame,
					state:	 options.state,
					library: { type: 'image' },
					button:  { text: options.button },
					className: options['class'],
					selection: prefill
				});
				
				/*
				media.view.Attachment.AviaSidebar = media.view.Settings.AttachmentDisplay.extend(
				{
					className: 'attachment-display-settings',
					template:  media.template('avia-choose-size')
				});
				*/
				
				// add the single insert state
				file_frame[frame_key].states.add([
					// Main states.
					new media.controller.Library({
						id:         'avia_insert_single',
						title: clicked.data( 'title' ),
						priority:   20,
						toolbar:    'select',
						filterable: 'uploaded',
						library:    media.query( file_frame[frame_key].options.library ),
						multiple:   false,
						editable:   true,
						displayUserSettings: false, 
						displaySettings: true,
						allowLocalEdits: true
						// AttachmentView: media.view.Attachment.Library
					}),
					
					new media.controller.Library({
						id:         'avia_insert_multi',
						title: clicked.data( 'title' ),
						priority:   20,
						toolbar:    'select',
						filterable: 'uploaded',
						library:    media.query( file_frame[frame_key].options.library ),
						multiple:   'add',
						editable:   true,
						displayUserSettings: false, 
						displaySettings: false,
						allowLocalEdits: true
						// AttachmentView: media.view.Attachment.Library
					}),
					
					new media.controller.Library({
						id:         'avia_insert_video',
						title: clicked.data( 'title' ),
						priority:   20,
						toolbar:    'select',
						filterable: 'uploaded',
						library:    media.query( {type: "video", orderby: "date", query: true} ),
						multiple:   false,
						editable:   true,
						displayUserSettings: false, 
						displaySettings: true,
						allowLocalEdits: true
						// AttachmentView: media.view.Attachment.Library
					})
					
				]);
	
				// When an image is selected, run a callback. 
				// Bind to various events since single insert and multiple trigger on different events and work with different data
			    file_frame[frame_key].on( 'select update insert', function(e) 
			    {
			    	var selection, state = file_frame[frame_key].state();
	 				
	 				// multiple items
	 				if(typeof e !== 'undefined')
	 				{
	 					selection = e;
	 				}
	 				// single item
	 				else 
	 				{
	 					selection = state.get('selection');
	 				}
	 				
	 				var values , display, element, preview_html= "", preview_img, final_template = $('<div></div>');
	 					
					values = selection.map( function( attachment ) 
					{
						element = attachment.toJSON();
						
						if(options.fetch == 'url')
						{
							display = state.display( attachment ).toJSON();
							
							if(typeof element.sizes == 'undefined') //video insert
							{
								preview_img = element.url;
								preview_html = "";
							}
							else // image insert
							{
								preview_img = element.sizes[display.size].url;
								preview_html += "<span class='avia-builder-prev-img'><img src='"+preview_img+"' /></span>";
								del_btn.removeClass('avia-hidden');
								
								//insert id for alt and title tag
								if(hidde_attachment_id.length)
								{
									hidde_attachment_id.val(element.id);
								}
								
								if(hidde_attachment_size.length)
								{
									hidde_attachment_size.val(display.size);
								}
							}
							
							return preview_img;
						}
						else if(options.fetch == 'id')
						{
							preview_img = typeof element.sizes['thumbnail'] != 'undefined'  ? element.sizes['thumbnail'].url : element.url ;
							preview_html += "<span class='avia-builder-prev-img'><img src='"+preview_img+"' /></span>";
							
							if(fakeImg.length)
							{
								fakeImg.val('<img src="'+preview_img+'" />');
							}

							return element[options.fetch];
						}
						else if(options.fetch == 'template')
						{
							var new_template = $(template),
								values		 = {id: element.id, img_fakeArg:""};
							
							
							
							//check if a thumbnail image exists and insert it
							if(element.sizes && element.sizes.thumbnail)
							{
								values.img_fakeArg = element.sizes.thumbnail.url;
							}
							else
							{
								values.img_fakeArg = element.url;
							}
							
							values.img_fakeArg = '<img src="'+values.img_fakeArg +'" title="" alt="" />';
							
							var htmlVal 	 = $.avia_builder.update_builder_html(new_template, values, true),
								saveTo 		 = new_template.find($.avia_builder.datastorage + ":eq(0)");
					
							saveTo[0].innerHTML = htmlVal.output;
							
							final_template.append(new_template);
						}
						
					});
					
									
					
					if(target.length)
						target.val( values.join(',') ).trigger('change');	
					
					if(preview.length)
						preview.html(preview_html);
						
					if(modal_group.length)
					{
						modal_group.append(final_template.html());
					}
						
			    });
			    
			    //on modal close remove the item from the global array so that the avia-lightbox accepts keyboard events again
			    file_frame[frame_key].on( 'close', function() 
			    {
			    	_.defer( function(){ $.AviaElementBehavior.wp_media.shift(); });
			    });
			
			    // Finally, open the modal
			    file_frame[frame_key].open();
		});
	}	

	
})(jQuery);	 




















































/*
options:
library:   {type: 'audio, image'} 				//describes which media types are allowed 
multiple:   false, // false, 'add', 'reset'		//how to handle multiple items
frame:     'select', //post, select				//predefined windows, only post and select available, select is the default that lets you create your own windows
state:     'gallery-library', //based on the ids
file_frame.on( 'select update', function() 
displaySettings: true, <- adds attachment
displayUserSettings: false, <- disables left sidebar
filterable: 'uploaded', //dropdown filter: all, uploaded

// Create gallery
			file_frame = wp.media.frames.file_frame = wp.media(
			{
				frame:     'post',
				state:     'gallery-edit',
				title:     wp.media.view.l10n.editGalleryTitle,
				editing:   true,
				selection: selection,
				title: clicked.data( 'title' ),
				button: { text: clicked.data( 'button' ) },
				multiple: false  // Set to true to allow multiple files to be selected
			
			});


*/

