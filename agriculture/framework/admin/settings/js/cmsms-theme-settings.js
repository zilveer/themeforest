/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Scripts
 * Created by CMSMasters
 * 
 */


/* Upload Field Type Script */
(function ($) { 
	$.fn.cmsmsMediaUploader = function (parameters) { 
		var defaults = { 
				frameId : 'cmsms-media-frame', 
				frameClass : 'media-frame cmsms-media-frame', 
				frameTitle : 'Choose images', 
				frameButton : 'Choose', 
				optionName : '', 
				optionID : '', 
				deleteText : 'Delete', 
				multiple : false 
			}, 
			uploadButton = this, 
			methods = {};
		
		
		methods = { 
			init : function () { 
				methods.options = $.extend({}, defaults, parameters);
				
				
				methods.el = uploadButton;
				
				
				methods.vars = {};
				
				
				methods.vars.frame = undefined;
				
				
				methods.setUploaderVars();
				methods.attachEvents();
			}, 
			setUploaderVars : function () { 
				methods.vars.id = methods.options.frameId;
				methods.vars.className = methods.options.frameClass;
				methods.vars.title = methods.options.frameTitle;
				methods.vars.button = methods.options.frameButton;
				methods.vars.optionName = methods.options.optionName;
				methods.vars.optionID = methods.options.optionID;
				methods.vars.deleteText = methods.options.deleteText;
				methods.vars.multiple = methods.options.multiple;
			}, 
			buildUploader : function () { 
				methods.vars.frame = wp.media.frames.cmsms_media_frame = wp.media( { 
					id : methods.vars.id, 
					className : methods.vars.className, 
					frame : 'select', 
					multiple : methods.vars.multiple, 
					library : { 
						type : 'image' 
					}, 
					title : methods.vars.title, 
					button : { 
						text : methods.vars.button 
					} 
				} );
			}, 
			openUploader : function () { 
				methods.vars.frame.open();
			}, 
			startUploader : function () { 
				if (methods.vars.frame) {
					methods.openUploader();
				} else {
					methods.buildUploader();
				}
			}, 
			attachEvents : function () { 
				methods.startUploader();
				
				
				methods.vars.frame.on('open', function () {
					if (!methods.options.multiple) {
						var selection = methods.vars.frame.state().get('selection'), 
							ids = methods.el.parent().find('> input[type="hidden"]').val().split(',');
						
						
						ids.forEach(function (id) { 
							var attachment = wp.media.attachment(id);
							
							
							attachment.fetch();
							
							
							selection.add(attachment ? [attachment] : []);
						} );
					}
				} );
				
				
				methods.vars.frame.on('select', function () { 
					var media_attachments = methods.vars.frame.state().get('selection'), 
						media_attachment = media_attachments.first();
					
					
					if (methods.options.multiple) {
						for (var i = 0, ilength = media_attachments.length; i < ilength; i += 1) {
							if (media_attachments.toJSON()[i].id !== '' && media_attachments.toJSON()[i].sizes !== undefined) {
								methods.el.closest('div').find('> ul').append('<li>' + 
									'<div>' + 
										'<img src="' + ((media_attachments.toJSON()[i].sizes.thumbnail) ? media_attachments.toJSON()[i].sizes.thumbnail.url : media_attachments.toJSON()[i].sizes.full.url) + '" alt="" class="icon_list_image" />' + 
										'<input type="hidden" name="' + methods.vars.optionName + '[' + methods.vars.optionID + '_-_' + (Number($('.icon_management > ul > li').length) + 1) + ']" value="' + media_attachments.toJSON()[i].id + '" />' + 
									'</div>' + 
									'<a href="#" class="icon_del" title="' + methods.vars.deleteText + '">' + methods.vars.deleteText + '</a> ' + 
								'</li>');
							}
						}
						
						
						$('#heading_icons_number').val($('.icon_management > ul > li').length);
					} else {
						methods.el.parent().find('> input[type="hidden"]').val(media_attachment.toJSON().id);
						
						
						methods.el.parent().find('> img.custom_preview_image').attr( { 
							src : ((media_attachment.toJSON().sizes.medium) ? media_attachment.toJSON().sizes.medium.url : ((media_attachment.toJSON().sizes.thumbnail) ? media_attachment.toJSON().sizes.thumbnail.url : media_attachment.toJSON().sizes.full.url)) 
						} );
					}
				} );
				
				
				methods.openUploader();
			} 
		};
		
		
		methods.init();
	}
} )(jQuery);



(function ($) { 
	$('.custom_clear_image_button').click(function () {
		var stdImage = $(this).parent().siblings('.custom_std_image').text(), 
			defaultImage = $(this).parent().siblings('.custom_default_image').text();
		
		
		$(this).parent().siblings('.custom_upload_image').val((defaultImage !== stdImage) ? defaultImage : '');
		$(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		
		
		return false;
	} );
} )(jQuery);



(function ($) { 
	$('.custom_remove_image_button').click(function () {
		var stdImage = jQuery(this).parent().siblings('.custom_std_image').text();
		
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', stdImage);
		
		return false;
	} );
} )(jQuery);



(function ($) { 
	$('.icon_management').on('click', '.icon_del', function () { 
		var del_icon_number = Number($('#heading_icons_number').val()) - 1;
		
		
		$('#heading_icons_number').val(del_icon_number);
		
		
		$(this).parent().remove();
		
		
		var li_input = undefined, 
			li_input_val = '';
		
		
		for (var n = 1; n <= del_icon_number; n += 1) {
			li_input = $('.icon_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
			
			
			li_input_val = li_input.attr('name').split('_-_');
			
			
			$('.icon_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
				name :  li_input_val[0] + '_-_' + n + ']' 
			} );
		}
		
		
		return false;
	} );
} )(jQuery);



/* Social Field Type Script */
(function ($) { 
	$.fn.cmsmsSocialUploader = function (parameters) { 
		var defaults = { 
				frameId : 'cmsms-media-frame', 
				frameClass : 'media-frame cmsms-media-frame', 
				frameTitle : 'Choose images', 
				frameButton : 'Choose', 
				optionName : '', 
				optionID : '' 
			}, 
			uploadButton = this, 
			methods = {};
		
		
		methods = { 
			init : function () { 
				methods.options = $.extend({}, defaults, parameters);
				
				
				methods.el = uploadButton;
				
				
				methods.vars = {};
				
				
				methods.vars.frame = undefined;
				
				
				methods.setUploaderVars();
				methods.attachEvents();
			}, 
			setUploaderVars : function () { 
				methods.vars.id = methods.options.frameId;
				methods.vars.className = methods.options.frameClass;
				methods.vars.title = methods.options.frameTitle;
				methods.vars.button = methods.options.frameButton;
				methods.vars.optionName = methods.options.optionName;
				methods.vars.optionID = methods.options.optionID;
			}, 
			buildUploader : function () { 
				methods.vars.frame = wp.media.frames.cmsms_media_frame = wp.media( { 
					id : methods.vars.id, 
					className : methods.vars.className, 
					frame : 'select', 
					multiple : false, 
					library : { 
						type : 'image' 
					}, 
					title : methods.vars.title, 
					button : { 
						text : methods.vars.button 
					} 
				} );
			}, 
			openUploader : function () { 
				methods.vars.frame.open();
			}, 
			startUploader : function () { 
				if (methods.vars.frame) {
					methods.openUploader();
				} else {
					methods.buildUploader();
				}
			}, 
			attachEvents : function () { 
				methods.startUploader();
				
				
				methods.vars.frame.on('open', function () {
					var selection = methods.vars.frame.state().get('selection'), 
						ids = methods.el.parent().find('> .icon_upload_image').val().split(',');
					
					
					ids.forEach(function (id) { 
						var attachment = wp.media.attachment(id);
						
						
						attachment.fetch();
						
						
						selection.add(attachment ? [attachment] : []);
					} );
				} );
				
				
				methods.vars.frame.on('select', function () { 
					var media_attachments = methods.vars.frame.state().get('selection'), 
						media_attachment = media_attachments.first();
					
					
					methods.el.parent().find('> .icon_upload_image').val(media_attachment.toJSON().id);
					
					
					methods.el.parent().find('> img.icon_preview_image').attr( { 
						src : ((media_attachment.toJSON().sizes.thumbnail) ? media_attachment.toJSON().sizes.thumbnail.url : media_attachment.toJSON().sizes.full.url) 
					} ).show();
					
					
					methods.el.parent().find('> .icon_upload_link').show();
					
					
					methods.el.parent().find('.icon_clear_image_button').parent().show();
					
					
					methods.el.parent().find('#new_icon_target').prop('checked', false);
					
					
					$('#new_icon_color').wpColorPicker();
					
					
					$('#new_icon_color').trigger('change');
				} );
				
				
				methods.openUploader();
			} 
		};
		
		
		methods.init();
	}
	
	
	
	$('.icon_clear_image_button').click(function () {
		$(this).parent().siblings('.icon_upload_image').val('');
		
		
		$(this).parent().siblings('.icon_preview_image').attr( { 
			src : '' 
		} ).hide();
		
		
		$(this).parent().siblings('.icon_upload_link').val('').hide();
		
		
		$(this).parent().hide();
		
		
		return false;
	} );
	
	
	
	$('.icon_management').on('click', '.icon_del', function () { 
		var del_icon_number = Number($('#custom_icons_number').val()) - 1;
		
		
		$('#custom_icons_number').val(del_icon_number);
		
		
		$(this).parent().remove();
		
		
		var li_input = undefined, 
			li_input_val = '';
		
		
		for (var n = 1; n <= del_icon_number; n += 1) {
			li_input = $('.icon_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]');
			
			
			li_input_val = li_input.attr('name').split('_-_');
			
			
			$('.icon_management ul li:eq(' + (n - 1) + ')').find('input[type="hidden"]').attr( { 
				name :  li_input_val[0] + '_-_' + n + ']' 
			} );
		}
		
		
		return false;
	} );
	
	
	
	$('.icon_management').on('click', '.icon_edit', function () { 
		var edit_icon_val = $(this).parent().find('input[type="hidden"]').val().split('|'), 
			edit_icon_src = $(this).parent().find('img').attr('src');
			edit_icon_id = $(this).parent().find('input[type="hidden"]').attr('id');
		
		
		$('#add_icon').hide();
		
		
		$('#edit_icon').attr( { 
			'data-id' : edit_icon_id 
		} ).show();
		
		
		$('.icon_upload_image').val(edit_icon_val[0]);
		
		
		$('.icon_preview_image').attr( { 
			src : edit_icon_src 
		} ).show();
		
		$('#new_icon_color').val(edit_icon_val[1]);
		
		$('#new_icon_link').val(edit_icon_val[2]);
		
		$('.icon_upload_link').find('input[type="checkbox"]').prop('checked', ((edit_icon_val[3] == 'true') ? true : false));
		
		
		$('.icon_upload_link').show();
		$('.icon_clear_image_button').parent().show();
		
		
		$('#new_icon_color').wpColorPicker();
		
		
		$('#new_icon_color').trigger('change');
		
		
		return false;
	} );
	
	
	
	$('#edit_icon').click(function () { 
		var edit_icon_data_id = $(this).attr('data-id');
		
		
		if ($('#new_icon_name').val() !== '') {
			$('input#' + edit_icon_data_id).val($('#new_icon_name').val() + '|' + $('#new_icon_color').val() + '|' + $('#new_icon_link').val() + '|' + (($('#new_icon_target').is(':checked')) ? 'true' : 'false'));
			
			
			$('input#' + edit_icon_data_id).parent().find('img').attr( { 
				src : $('#new_icon_name').parent().find('.icon_preview_image').attr('src') 
			} );
			
			
			$('#new_icon_name').val('');
			
			$('#new_icon_color').val('#000000');
			
			$('#new_icon_link').val('');
			
			$('#new_icon_target').prop('checked', false);
			
			
			$('.icon_preview_image').attr( { 
				src : '' 
			} ).hide();
			
			
			$('.icon_clear_image_button').parent().hide();
			$('.icon_upload_link').hide();
			
			
			$('#add_icon').show();
			
			
			$('#edit_icon').hide();
		}
		
		
		return false;
	} );
	
	
	
	$('.icon_management > ul').sortable( { 
		items : '> li', 
		placeholder : 'ui-sortable-highlight', 
		update : function () { 
			var numb = 1;
			
			
			$(this).find('> li > div > input').each(function () { 
				$(this).attr('id', $(this).attr('id').slice(0, -1) + numb);
				
				
				$(this).attr('name', $(this).attr('name').slice(0, -2) + numb + ']');
				
				
				numb += 1;
			} );
		} 
	} ); 
} )(jQuery);



/* Field Error Highlight Script */
jQuery(function () {
	var error_msg = jQuery('#message p[class="setting-error-message"]');
	
	if (error_msg.length != 0) {
		var error_setting = error_msg.attr('title');
		
		jQuery('label[for="' + error_setting + '"]').addClass('error');
		jQuery('input[id="' + error_setting + '"]').attr('style', 'border-color:red');
	}
} );

