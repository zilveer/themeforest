/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * File Uploader jQuery Plugin
 * Created by CMSMasters
 * 
 */


(function ($) { 
	$.fn.cmsmsMediaUploader = function (parameters) { 
		var defaults = { 
				frameId : 		'cmsms-media-select-frame', 
				frameClasses : 	'media-frame cmsms-media-select-frame', 
				frameType : 	'select', 
				multiple : 		false, 
				state : 		false, 
				editing : 		false, 
				library : 		'image', 
				frameTitle : 	cmsms_admin_uploader.choose, 
				frameButton : 	cmsms_admin_uploader.insert 
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
				methods.vars.className = methods.options.frameClasses;
				methods.vars.frameType = methods.options.frameType;
				methods.vars.multiple = methods.options.multiple;
				methods.vars.state = methods.options.state;
				methods.vars.editing = methods.options.editing;
				methods.vars.library = methods.options.library;
				methods.vars.title = methods.options.frameTitle;
				methods.vars.button = methods.options.frameButton;
				
				
				methods.vars.selectedLine = '';
				
				methods.vars.selectedImg = '';
				
				methods.vars.selectedList = '';
				
				methods.vars.selectedTitle = '';
				
				methods.vars.selectedCaption = '';
				
				methods.vars.selectedAlign = '';
				
				methods.vars.selectedLink = '';
				
				
				methods.vars.frameObjGallery = {};
				
				
				methods.parent = methods.el.parents('.cmsms_upload_parent');
			}, 
			buildUploader : function () { 
				var defaultPostId = wp.media.gallery.defaults.id, 
					contArr = methods.parent.find('input[type="hidden"], input[type="text"]').val().split(','), 
					content = '[gallery ids="', 
					shortcode, 
					attachments, 
					selection = false;
				
				
				if (methods.vars.editing) {
					contArr.forEach(function (contArrItem) { 
						var valArray = contArrItem.split('|');
						
						
						content += valArray[0] + ',';
					} );
					
					
					content = content.slice(0, -1) + '"]';
					
					
					shortcode = wp.shortcode.next('gallery', content);
					
					
					if (_.isUndefined(shortcode.shortcode.get('id')) && !_.isUndefined(defaultPostId)) {
						shortcode.shortcode.set('id', defaultPostId);
					}
					
					
					attachments = wp.media.gallery.attachments(shortcode.shortcode);
					
					
					selection = new wp.media.model.Selection(attachments.models, { 
						props : 	attachments.props.toJSON(), 
						multiple : 	true 
					} );
					
					
					selection.gallery = attachments.gallery;
					
					
					selection.more().done(function () { 
						selection.props.set( { 
							query : 	false 
						} );
						
						selection.unmirror();
						
						selection.props.unset('orderby');
					} );
				}
				
				
				methods.vars.frameObj = { 
					id : 			methods.vars.id, 
					className : 	methods.vars.className, 
					frame : 		methods.vars.frameType, 
					multiple : 		methods.vars.multiple, 
					library : { 
						type : methods.vars.library 
					}, 
					title : 		methods.vars.title, 
					button : { 
						text : methods.vars.button 
					} 
				};
				
				
				if (methods.vars.state) {
					methods.vars.frameObjGallery = { 
						state:     		methods.vars.state,
						editing : 		methods.vars.editing, 
						selection : 	selection 
					};
				}
				
				
				$.extend(methods.vars.frameObj, methods.vars.frameObjGallery);
				
				
				methods.vars.frame = wp.media.frames = wp.media(methods.vars.frameObj);
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
				
				
				if (methods.vars.state !== 'gallery-library' || methods.vars.state !== 'gallery-edit') {
					methods.vars.frame.on('open', function () { 
						var selection = methods.vars.frame.state().get('selection'), 
							ids = methods.parent.find('input[type="hidden"], input[type="text"]').val().split(',');
						
						
						ids.forEach(function (id) { 
							var imgID = id.split('|'), 
								attachment = wp.media.attachment(imgID[0]);
							
							
							attachment.fetch();
							
							
							selection.add(attachment ? [attachment] : []);
						} );
					} );
				}
				
				
				methods.vars.frame.on('insert', function () { 
					$.when.apply($, methods.vars.frame.state().get('selection').map(function (attachment) { 
						var imgData = attachment.toJSON(), 
							sizeData = methods.vars.frame.state().display(attachment).toJSON();
						
						
						if (methods.vars.multiple) {
							if (imgData.id !== '' && imgData.sizes !== undefined) {
								methods.vars.selectedLine += imgData.id + '|' + ((imgData.sizes.thumbnail) ? imgData.sizes.thumbnail.url : imgData.url) + ',';
								
								
								methods.vars.selectedList += '<li class="cmsms_gallery_item">' + 
									'<img src="' + ((imgData.sizes.thumbnail) ? imgData.sizes.thumbnail.url : imgData.url) + '" alt="" data-id="' + imgData.id + '" />' + 
									'<a href="#" class="cmsms_gallery_cancel admin-icon-remove" title="' + cmsms_admin_uploader.remove + '"></a>' + 
								'</li>';
							}
						} else {
							methods.vars.selectedLine = imgData.id + '|' + imgData.sizes[sizeData.size].url + '|' + sizeData.size;
							
							
							methods.vars.selectedImg = imgData.sizes[sizeData.size].url;
							
							
							methods.vars.selectedTitle = imgData.title;
							
							methods.vars.selectedCaption = imgData.caption;
							
							
							methods.vars.selectedAlign = sizeData.align;
							
							
							if (sizeData.link === 'file') {
								methods.vars.selectedLink = imgData.url;
							} else if (sizeData.link === 'post') {
								methods.vars.selectedLink = imgData.link;
							} else if (sizeData.link === 'custom' && typeof sizeData.linkUrl !== 'undefined') {
								methods.vars.selectedLink = sizeData.linkUrl;
							}
						}
					}, this)).done(function () { 
						if (methods.vars.multiple) {
							methods.parent.find('input[type="hidden"], input[type="text"]').val(methods.vars.selectedLine.slice(0, -1)).trigger('change');
							
							
							methods.parent.find('ul').empty().append(methods.vars.selectedList);
						} else {
							var lightboxID = methods.parent.parents('.cmsmsBoxOut').data('id'), 
								fieldsCont = methods.parent.parents('.cmsmsBoxContInMid'), 
								fieldsClasses = methods.parent.find('input.cmsms_upload_button').data('classes');
							
							
							methods.parent.find('input[type="hidden"], input[type="text"]').val(methods.vars.selectedLine).trigger('change');
							
							
							methods.parent.find('img.cmsms_preview_image').attr( { 
								src : methods.vars.selectedImg 
							} ).parent().css('display', 'block');
							
							
							if (fieldsCont.find('#name_' + lightboxID).val() === '') {
								fieldsCont.find('#name_' + lightboxID).val(methods.vars.selectedTitle);
							}
							
							
							if (fieldsCont.find('#title_' + lightboxID).val() === '') {
								fieldsCont.find('#title_' + lightboxID).val(methods.vars.selectedTitle);
							}
							
							
							if (fieldsClasses.indexOf('cmsms-frame-no-caption') === -1 && fieldsCont.find('#caption_' + lightboxID).val() === '') {
								fieldsCont.find('#caption_' + lightboxID).val(methods.vars.selectedCaption);
							}
							
							
							if (fieldsClasses.indexOf('cmsms-frame-no-align') === -1) {
								if (fieldsCont.find('input[name="align_' + lightboxID + '"]:checked').val() !== methods.vars.selectedAlign) {
									fieldsCont.find('input[name="align_' + lightboxID + '"]:checked').prop('checked', false);
									
									
									fieldsCont.find('input[name="align_' + lightboxID + '"][value="' + methods.vars.selectedAlign + '"]').prop('checked', true);
								}
							}
							
							
							if (fieldsClasses.indexOf('cmsms-frame-no-link') === -1) {
								fieldsCont.find('#link_' + lightboxID).val(methods.vars.selectedLink).trigger('change');
							}
						}
					} );
				} );
				
				
				methods.vars.frame.on('update', function (selection) {
					var gal_list = selection.toJSON(), 
						gal_line = '', 
						gal_html = '';
					
					
					gal_list.forEach(function (gal_item) { 
						if ( 
							gal_item.id !== '' && 
							gal_item.sizes !== undefined 
						) {
							gal_line += gal_item.id + '|' + ((gal_item.sizes.thumbnail) ? gal_item.sizes.thumbnail.url : gal_item.url) + ',';
							
							
							gal_html += '<li class="cmsms_gallery_item">' + 
								'<img src="' + ((gal_item.sizes.thumbnail) ? gal_item.sizes.thumbnail.url : gal_item.url) + '" alt="" data-id="' + gal_item.id + '" />' + 
								'<a href="#" class="cmsms_gallery_cancel admin-icon-remove" title="' + cmsms_admin_uploader.remove + '"></a>' + 
							'</li>';
						}
					} );
					
					
					gal_line = gal_line.slice(0, -1);
					
					
					methods.parent.find('input[type="hidden"], input[type="text"]').val(gal_line);
					
					
					methods.parent.find('ul').empty();
					
					
					methods.parent.find('ul').append(gal_html);
					
					
					if (methods.el.data('state') !== 'gallery-edit') {
						methods.el.data( { 
							state : 	'gallery-edit', 
							editing : 	true 
						} ).val(cmsms_admin_uploader.edit_gallery);
					}
				} );
				
				
				methods.vars.frame.on('select', function () { 
					var media_atts = methods.vars.frame.state().get('selection'), 
						media_attachments = media_atts.toJSON(), 
						media_attachment = media_atts.first().toJSON(), 
						selected_line = '', 
						selected_list = '';
					
					
					if (methods.vars.multiple) {
						media_attachments.forEach(function (selection) { 
							if (selection.id !== '' && selection.sizes !== undefined) {
								selected_line += selection.id + '|' + ((selection.sizes.thumbnail) ? selection.sizes.thumbnail.url : selection.url) + ',';
								
								
								selected_list += '<li class="cmsms_gallery_item">' + 
									'<img src="' + ((selection.sizes.thumbnail) ? selection.sizes.thumbnail.url : selection.url) + '" alt="" data-id="' + selection.id + '" />' + 
									'<a href="#" class="cmsms_gallery_cancel admin-icon-remove" title="' + cmsms_admin_uploader.remove + '"></a>' + 
								'</li>';
							}
						} );
						
						
						methods.parent.find('input[type="hidden"], input[type="text"]').val(selected_line.slice(0, -1)).trigger('change');
						
						
						methods.parent.find('ul').empty().append(selected_list);
					} else {
						methods.parent.find('input[type="hidden"], input[type="text"]').val(media_attachment.id + '|' + ((media_attachment.sizes !== undefined && media_attachment.sizes.medium) ? media_attachment.sizes.medium.url : media_attachment.url)).trigger('change');
						
						
						methods.parent.find('img.cmsms_preview_image').attr( { 
							src : ((media_attachment.sizes !== undefined && media_attachment.sizes.medium) ? media_attachment.sizes.medium.url : media_attachment.url) 
						} ).parent().css('display', 'block');
					}
				} );
				
				
				methods.openUploader();
			} 
		};
		
		
		methods.init();
	}
	
	
	$('body').on('click', '.cmsms_upload_button, .cmsms_preview_image', function (e) { 
		e.preventDefault();
		
		
		var uploadButton = ($(this).is('img')) ? $(this).parents('.cmsms_upload_parent').find('.cmsms_upload_button') : $(this), 
			cmsmsTitle = uploadButton.data('title'), 
			cmsmsButton = uploadButton.data('button'), 
			cmsmsID = uploadButton.data('id'), 
			cmsmsLibrary = uploadButton.data('library'), 
			cmsmsType = uploadButton.data('type'), 
			cmsmsMultiple = uploadButton.data('multiple'), 
			cmsmsState = uploadButton.data('state'), 
			cmsmsEditing = uploadButton.data('editing'), 
			cmsmsSelection = uploadButton.data('selection'), 
			cmsmsClasses = uploadButton.data('classes');
		
		
		$(e.target).cmsmsMediaUploader( { 
			frameId : 		cmsmsID, 
			frameClasses : 	cmsmsClasses, 
			frameType : 	cmsmsType, 
			multiple : 		cmsmsMultiple, 
			state : 		cmsmsState, 
			editing : 		cmsmsEditing, 
			selection : 	cmsmsSelection, 
			library : 		cmsmsLibrary, 
			frameTitle : 	cmsmsTitle, 
			frameButton : 	cmsmsButton 
		} );
	} );
} )(jQuery);

