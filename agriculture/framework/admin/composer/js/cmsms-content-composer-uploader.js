/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Visual Content Composer Media Uploder Scripts
 * Changed by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	(function ($) { 
		var workflows = {}, 
			wpActiveEditor;
		
		
		function send_to_theme_editor(h) {
			var ed, 
				mce = typeof(tinymce) != 'undefined', 
				qt = typeof(QTags) != 'undefined';
			
			
			if (!wpActiveEditor) {
				if (mce && tinymce.activeEditor) {
					ed = tinymce.activeEditor;
					
					wpActiveEditor = ed.id;
				} else if (!qt) {
					return false;
				}
			} else if (mce) {
				if (tinymce.activeEditor && (tinymce.activeEditor.id == 'mce_fullscreen' || tinymce.activeEditor.id == 'wp_mce_fullscreen')) {
					ed = tinymce.activeEditor;
				} else {
					ed = tinymce.get(wpActiveEditor);
				}
			}
			
			
			if (ed && !ed.isHidden()) {
				if (tinymce.isIE && ed.windowManager.insertimagebookmark) {
					ed.selection.moveToBookmark(ed.windowManager.insertimagebookmark);
				}
				
				
				if (h.indexOf('[caption') !== -1) {
					if (ed.wpSetImgCaption) {
						h = ed.wpSetImgCaption(h);
					}
				} else if (h.indexOf('[gallery') !== -1) {
					if (ed.plugins.wpgallery) {
						h = ed.plugins.wpgallery._do_gallery(h);
					}
				} else if (h.indexOf('[embed') === 0) {
					if (ed.plugins.wordpress) {
						h = ed.plugins.wordpress._setEmbed(h);
					}
				}
				
				
				ed.execCommand('mceInsertContent', false, h);
			} else if (qt) {
				QTags.insertContent(h);
			} else {
				document.getElementById(wpActiveEditor).value += h;
			}
		}
		
		
		wp.media.theme = { 
			insert : function (h) { 
				var mce = typeof(tinymce) != 'undefined', 
					qt = typeof(QTags) != 'undefined', 
					wpActiveEditor = window.wpActiveEditor, 
					ed;
				
				
				if (window.send_to_theme_editor) {
					return window.send_to_theme_editor.apply(this, arguments);
				}
				
				
				if (!wpActiveEditor) {
					if (mce && tinymce.activeEditor) {
						ed = tinymce.activeEditor;
						
						wpActiveEditor = window.wpActiveEditor = ed.id;
					} else if (!qt) {
						return false;
					}
				} else if (mce) {
					if (tinymce.activeEditor && (tinymce.activeEditor.id == 'mce_fullscreen' || tinymce.activeEditor.id == 'wp_mce_fullscreen')) {
						ed = tinymce.activeEditor;
					} else {
						ed = tinymce.get(wpActiveEditor);
					}
				}
				
				
				if (ed && !ed.isHidden()) {
					if (tinymce.isIE && ed.windowManager.insertimagebookmark) {
						ed.selection.moveToBookmark(ed.windowManager.insertimagebookmark);
					}
					
					
					if (h.indexOf('[caption') !== -1) {
						if (ed.wpSetImgCaption) {
							h = ed.wpSetImgCaption(h);
						}
					} else if (h.indexOf('[gallery') !== -1) {
						if (ed.plugins.wpgallery) {
							h = ed.plugins.wpgallery._do_gallery(h);
						}
					} else if (h.indexOf('[embed') === 0) {
						if (ed.plugins.wordpress) {
							h = ed.plugins.wordpress._setEmbed(h);
						}
					}
					
					
					ed.execCommand('mceInsertContent', false, h);
				} else if ( qt ) {
					QTags.insertContent(h);
				} else {
					document.getElementById(wpActiveEditor).value += h;
				}
			}, 
			add : function (id, options) { 
				var workflow = this.get(id);
				
				
				if (workflow) {
					return workflow;
				}
				
				
				workflow = workflows[id] = wp.media(_.defaults(options || {}, { 
					frame : 'post', 
					state : 'insert', 
					title : wp.media.view.l10n.addMedia, 
					multiple : true 
				} ));
				
				
				workflow.on('insert', function (selection) { 
					var state = workflow.state();
					
					
					selection = selection || state.get('selection');
					
					
					if (!selection) {
						return;
					}
					
					
					$.when.apply($, selection.map(function (attachment) { 
						var display = state.display( attachment ).toJSON();
						
						
						return this.send.attachment(display, attachment.toJSON());
					}, this)).done(function () { 
						wp.media.theme.insert(_.toArray(arguments).join("\n\n"));
					} );
				}, this);
				
				
				workflow.state('gallery-edit').on('update', function (selection) { 
					this.insert(wp.media.gallery.shortcode(selection).string());
				}, this);
				
				
				workflow.state('embed').on('select', function () { 
					var state = workflow.state(), 
						type = state.get('type'), 
						embed = state.props.toJSON();
					
					
					embed.url = embed.url || '';
					
					
					if ('link' === type) {
						_.defaults(embed, { 
							title : embed.url, 
							linkUrl : embed.url 
						} );
						
						
						this.send.link(embed).done(function (resp) { 
							wp.media.theme.insert(resp);
						} );
					} else if ('image' === type) {
						_.defaults(embed, { 
							title : embed.url, 
							linkUrl : '', 
							align : 'none', 
							link : 'none' 
						} );
						
						
						if ('none' === embed.link) {
							embed.linkUrl = '';
						} else if ('file' === embed.link) {
							embed.linkUrl = embed.url;
						}
						
						
						this.insert(wp.media.string.image(embed));
					}
				}, this);
				
				
				workflow.state('featured-image').on('select', wp.media.featuredImage.select);
				
				
				workflow.setState(workflow.options.state);
				
				
				return workflow;
			}, 
			id : function (id) { 
				if (id) {
					return id;
				}
				
				
				id = wpActiveEditor;
				
				
				if ( 
					!id && 
					typeof tinymce !== 'undefined' && 
					tinymce.activeEditor 
				) {
					id = tinymce.activeEditor.id;
				}
				
				
				id = id || '';
				
				
				return id;
			}, 
			get : function (id) { 
				id = this.id(id);
				
				
				return workflows[id];
			}, 
			remove : function (id) { 
				id = this.id(id);
				
				
				delete workflows[id];
			}, 
			send : { 
				attachment : function (props, attachment) { 
					var caption = attachment.caption, 
						options, 
						html;
					
					
					if (!wp.media.view.settings.captions) {
						delete attachment.caption;
					}
					
					
					props = wp.media.string.props(props, attachment);
					
					
					options = { 
						id : attachment.id, 
						post_content : attachment.description, 
						post_excerpt : caption 
					};
					
					
					if (props.linkUrl) {
						options.url = props.linkUrl;
					}
					
					
					if ('image' === attachment.type) {
						html = wp.media.string.image(props);
						
						
						_.each( { 
							align : 'align', 
							size : 'image-size', 
							alt : 'image_alt' 
						}, function (option, prop) { 
							if (props[prop]) {
								options[option] = props[prop];
							}
						} );
					} else {
						html = wp.media.string.link(props);
						
						options.post_title = props.title;
					}
					
					
					return wp.media.post('send-attachment-to-editor', { 
						nonce : wp.media.view.settings.nonce.sendToEditor, 
						attachment : options, 
						html : html, 
						post_id : wp.media.view.settings.post.id 
					} );
				}, 
				link : function (embed) { 
					return wp.media.post('send-link-to-editor', { 
						nonce : wp.media.view.settings.nonce.sendToEditor, 
						src : embed.linkUrl, 
						title : embed.title, 
						html : wp.media.string.link(embed), 
						post_id : wp.media.view.settings.post.id 
					} );
				} 
			}, 
			open : function (id) { 
				var workflow, 
					editor;
				
				
				id = this.id(id);
				
				
				if (typeof tinymce !== 'undefined') {
					editor = tinymce.get(id);
					
					
					if (tinymce.isIE && editor && !editor.isHidden()) {
						editor.focus();
						
						
						editor.windowManager.insertimagebookmark = editor.selection.getBookmark();
					}
				}
				
				
				workflow = this.get(id);
				
				
				if (!workflow) {
					workflow = this.add(id);
				}
				
				
				return workflow.open();
			}, 
			init : function () { 
				$(document.body).on('click', '.custom_upload_image_button', function (event) { 
					var $this = $(this), 
						editor = $this.parent().parent().find('.wp-editor-container > textarea.wp-editor-area').attr('id');
					
					
					window.wpActiveEditor = editor;
					
					
					event.preventDefault();
					
					
					$this.blur();
					
					
					wp.media.theme.open(editor);
					
					
					return false;
				} );
			} 
		};
		
		
		$(wp.media.theme.init);
	} )(jQuery);
	
	
	
	(function ($) { 
		$.fn.cmsmsMediaUploader = function (parameters) { 
			var defaults = { 
					frameId : 'cmsms-media-frame', 
					frameClass : 'media-frame cmsms-media-frame', 
					frameTitle : 'Choose images', 
					frameButton : 'Choose', 
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
						var selection = methods.vars.frame.state().get('selection'), 
							ids = methods.el.parent().find('> input[type="hidden"]').val().split(',');
						
						
						ids.forEach(function (id) { 
							var attachment = wp.media.attachment(id);
							
							
							attachment.fetch();
							
							
							selection.add(attachment ? [attachment] : []);
						} );
					} );
					
					
					methods.vars.frame.on('select', function () { 
						var media_attachments = methods.vars.frame.state().get('selection'), 
							media_attachment = media_attachments.first(), 
							numbs = '';
						
						
						if (methods.options.multiple) {
							media_attachments.toJSON().forEach(function (selection) { 
								if (selection.id !== '') {
									numbs += selection.id + ',';
								}
							} );
							
							
							numbs = numbs.slice(0, -1);
							
							
							methods.el.parent().find('> input[type="hidden"]').val(numbs);
							
							
							methods.el.parent().find('> ul').empty();
							
							
							for (var i = 0, ilength = media_attachments.length; i < ilength; i += 1) {
								if (media_attachments.toJSON()[i].id !== '' && media_attachments.toJSON()[i].sizes !== undefined) {
									methods.el.parent().find('> ul').append('<li>' + 
										'<a href="' + media_attachments.toJSON()[i].id + '">' + 
											'<img src="' + ((media_attachments.toJSON()[i].sizes.thumbnail) ? media_attachments.toJSON()[i].sizes.thumbnail.url : media_attachments.toJSON()[i].sizes.full.url) + '" alt="" />' + 
											'<span></span>' + 
										'</a>' + 
									'</li>');
								}
							}
						} else {
							methods.el.parent().find('> input[type="hidden"]').val(media_attachment.toJSON().id);
							
							
							methods.el.parent().find('> img.custom_preview_image').attr( { 
								src : ((media_attachment.toJSON().sizes.medium) ? media_attachment.toJSON().sizes.medium.url : ((media_attachment.toJSON().sizes.thumbnail) ? media_attachment.toJSON().sizes.thumbnail.url : media_attachment.toJSON().sizes.full.url)) 
							} ).show();
						}
					} );
					
					
					methods.openUploader();
				} 
			};
			
			
			methods.init();
		}
	} )(jQuery);
	
	
	
	(function ($) { 
		$(document.body).delegate('#cmsms_composer_slider_media_button', 'click', function (e) { 
			e.preventDefault();
			
			
			$(e.target).cmsmsMediaUploader( { 
				frameId : 'cmsms-composer-slider-media-frame', 
				frameClass : 'media-frame cmsms-media-frame cmsms-composer-slider-media-frame', 
				frameTitle : $('#cmsms_slider_title').val(), 
				frameButton : $('#cmsms_slider_button').val(), 
				multiple : true 
			} );
		} );
	} )(jQuery);
	
	
	
	(function ($) { 
		$(document.body).delegate('#pb_block_image_choose_button', 'click', function (e) { 
			e.preventDefault();
			
			
			$(e.target).cmsmsMediaUploader( { 
				frameId : 'cmsms-composer-person-media-frame', 
				frameClass : 'media-frame cmsms-media-frame cmsms-composer-person-media-frame', 
				frameTitle : $('#cmsms_person_title').val(), 
				frameButton : $('#cmsms_slider_button').val(), 
				multiple : false 
			} );
		} );
	} )(jQuery);
} );

