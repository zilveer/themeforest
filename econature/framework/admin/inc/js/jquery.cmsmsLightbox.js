/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Icon Lightbox jQuery Plugin
 * Created by CMSMasters
 * 
 */

 
(function ($) { 
	var CmsmsLightbox = function (element, parameters) { 
		var defaults = { 
				closeButtons : 		true, 
				backdropClose : 	true, 
				closeButtonText : 	cmsms_admin_lightbox.cancel, 
				saveButtonText : 	cmsms_admin_lightbox.insert, 
				boxTitle : 			false, 
				loadURL : 			false, 
				loadData : 			false 
			}, 
			obj = this, 
			privateMethods = {};
		
		// Global Methods
		obj.methods = { 
			init : function () { 
				obj.methods.options = $.extend({}, defaults, parameters);
				
				
				obj.methods.setVars();
			}, 
			setVars : function () { 
				obj.methods.el = $(element);
				
				
				obj.methods.body = $('body');
				
				
				obj.methods.lbHTML = '<div class="cmsmsLightBoxOut">' + 
					'<div class="cmsmsLightBoxBack" />' + 
					'<div class="cmsmsLightBoxCont">' + 
						'<div class="cmsmsLightBoxContIn admin-icon-loader animate-spin">' + 
							'<div class="cmsmsLightBoxContInTop wrap" />' + 
							'<div class="cmsmsLightBoxContInMid" />' + 
							'<div class="cmsmsLightBoxContInBot" />' + 
						'</div>' + 
					'</div>' + 
				'</div>';
			}, 
			resetVars : function () { 
				obj.methods.uniqID = privateMethods.getUniqID();
				
				
				obj.methods.lbStructure = $(obj.methods.lbHTML);
				
				
				obj.methods.back = obj.methods.lbStructure.find('.cmsmsLightBoxBack');
				obj.methods.cont = obj.methods.lbStructure.find('.cmsmsLightBoxCont');
				
				obj.methods.contIn = obj.methods.cont.find('.cmsmsLightBoxContIn');
				
				obj.methods.contInTop = obj.methods.contIn.find('.cmsmsLightBoxContInTop');
				obj.methods.contInMid = obj.methods.contIn.find('.cmsmsLightBoxContInMid');
				obj.methods.contInBot = obj.methods.contIn.find('.cmsmsLightBoxContInBot');
				
				
				obj.methods.icons = cmsms_composer_icons();
				
				
				obj.methods.fields = '';
				
				
				obj.methods.buildObj();
				
				
				privateMethods.attachEvents();
			}, 
			buildObj : function () { 
				if (obj.methods.options.closeButtons) {
					obj.methods.contInTop.append('<a href="#" class="cmsmsLightBoxClose admin-icon-remove" title="' + obj.methods.options.closeButtonText + '" />');
					
					
					obj.methods.lbCloseBut = obj.methods.contInTop.find('.cmsmsLightBoxClose');
				}
				
				
				obj.methods.contInTop.append('<h2>' + cmsms_admin_lightbox.choose_icon + '</h2>');
				
				
				obj.methods.lbTitle = obj.methods.contInTop.find('h2');
				
				
				obj.methods.lbTitleText = obj.methods.lbTitle.text();
				
				
				if (obj.methods.options.closeButtons) {
					obj.methods.contInBot.append('<a href="#" class="cmsmsLightBoxCancel button button-large" title="' + obj.methods.options.closeButtonText + '">' + 
						obj.methods.options.closeButtonText + 
					'</a>');
					
					
					obj.methods.lbCancelBut = obj.methods.contInBot.find('.cmsmsLightBoxCancel');
				}
				
				
				obj.methods.contInBot.append('<a href="#" class="cmsmsLightBoxSave button button-primary button-large" title="' + obj.methods.options.saveButtonText + '">' + 
					obj.methods.options.saveButtonText + 
				'</a>');
				
				
				obj.methods.lbSaveBut = obj.methods.contInBot.find('.cmsmsLightBoxSave');
			}, 
			openLightbox : function (data) { 
				obj.methods.resetVars();
				
				
				obj.methods.lbStructure.attr( { 
					id : 				'cmsmsLightBox_' + obj.methods.uniqID, 
					'data-id' : 		obj.methods.uniqID, 
					'data-index' : 		data.index 
				} );
				
				
				if (privateMethods.getWinWidth() < 930) {
					obj.methods.cont.addClass('resp');
				}
				
				
				obj.methods.body.append(obj.methods.lbStructure);
				
				
				obj.methods.body.css( { 
					overflow : 'hidden' 
				} ).find('#cmsmsLightBox_' + obj.methods.uniqID).addClass('showBox preloadBox');
				
				
				if (obj.methods.lbSaveBut.is(':hidden')) {
					obj.methods.lbSaveBut.removeAttr('style');
				}
				
				
				obj.methods.fields += obj.methods.generateField(data.val);
				
				
				obj.methods.body.find('#cmsmsLightBox_' + obj.methods.uniqID).find('.cmsmsLightBoxContInMid').append(obj.methods.fields);
				
				
				obj.methods.body.find('#cmsmsLightBox_' + obj.methods.uniqID).removeClass('preloadBox');
				
				
				setTimeout(function () { 
					privateMethods.attachGeneratedEvents();
				}, 100);
			}, 
			generateField : function (val) { 
				var fieldContent = '';
				
				
				fieldContent += '<div class="cmsms_content_box full_width" data-id="icon_' + obj.methods.uniqID + '" data-type="icon">' + 
					'<div class="cmsms_field cmsms_field_icon">';
				
				
				fieldContent += '<div class="icons_list_parent">' + 
					'<a href="#" class="cmsms_icon_cancel admin-icon-remove"' + ((val !== '') ? '' : ' style="display:none;"') + '>' + cmsms_admin_lightbox.deselect + '</a>' + 
					'<div class="cmsms_icon_search">' + 
						'<label>' + cmsms_admin_lightbox.find_icons + ':</label>' + 
						'<input type="text" name="cmsms_icon_search" />' + 
					'</div>' + 
					'<div class="cl" />';
				
				
				for (var font in obj.methods.icons) {
					fieldContent += '<h3>' + font.slice(0, 1).toUpperCase() + font.slice(1) + '</h3>' + 
					'<ul>';
					
					
					for (var k in obj.methods.icons[font]) {
						fieldContent += '<li' + ((obj.methods.icons[font][k] === val) ? ' class="active"' : '') + '><a class="' + obj.methods.icons[font][k] + '" data-code="' + k + '" title="' + k + '" /></li>';
					}
					
					
					fieldContent += '</ul>';
				}
				
				
				fieldContent += '<input type="hidden" id="icon_' + obj.methods.uniqID + '" name="icon_' + obj.methods.uniqID + '" value="' + val + '" class="cmsms_icon_value" />'  + 
				'</div>';
				
				
				fieldContent += '</div>' + 
					'</div>' + 
				'</div>';
				
				
				return fieldContent;
			}, 
			saveContent : function (id) { 
				var icon_value = '';
				
				
				obj.methods.body.find('#cmsmsLightBox_' + id).find('.cmsmsLightBoxContInMid > div').each(function () { 
					if ($(this).is(':visible')) {
						var fieldID = $(this).data('id'), 
							fieldName = fieldID.replace('_' + id, '');
						
						
						if ($(this).find('> .cmsms_field #' + fieldID).val() !== '') {
							icon_value += $(this).find('> .cmsms_field #' + fieldID).val();
						}
					}
				} );
				
				
				setTimeout(function () { 
					privateMethods.loadContent(icon_value, id);
				}, 150);
			}, 
			closeLightbox : function (id) { 
				obj.methods.body.find('#' + id).removeClass('showBox');
				
				
				if (obj.methods.body.find('.cmsmsLightBoxOut').length < 2) {
					obj.methods.body.css( { 
						overflow : 'auto' 
					} );
				}
				
				
				if (obj.methods.body.find('.cmsmsLightBoxOut').length > 1) {
					obj.methods.uniqID = obj.methods.body.find('.cmsmsLightBoxOut').eq(-2).data('id');
				}
				
				
				setTimeout(function () { 
					privateMethods.destroyLightbox(id);
				}, 150);
			} 
		};
		
		// Private Methods
		privateMethods = { 
			attachEvents : function () { 
				obj.methods.lbCloseBut.bind('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				obj.methods.lbCancelBut.bind('click', function () { 
					var id = privateMethods.getLbID(this);
					
					
					obj.methods.body.find('#' + id).addClass('preloadBox');
					
					
					obj.methods.closeLightbox(id);
					
					
					return false;
				} );
				
				
				if (obj.methods.options.backdropClose) {
					obj.methods.back.bind('click', function () { 
						var id = privateMethods.getLbID(this);
						
						
						obj.methods.body.find('#' + id).addClass('preloadBox');
						
						
						obj.methods.closeLightbox(id);
						
						
						return false;
					} );
				}
				
				
				obj.methods.lbSaveBut.bind('click', function () { 
					obj.methods.saveContent($(this).parents('.cmsmsLightBoxOut').data('id'));
					
					
					return false;
				} );
				
				
				$(window).bind('resize', function () { 
					if (privateMethods.getWinWidth() < 930) {
						obj.methods.cont.addClass('resp');
					} else if (obj.methods.cont.hasClass('resp')) {
						obj.methods.cont.removeClass('resp');
					}
				} );
			}, 
			loadContent : function (data, id) { 
				var idx = obj.methods.body.find('#cmsmsLightBox_' + id).data('index').toString(),  
					social_container = $('#' + idx).parents('div').eq(0).find('.icon_upload_link');
				
				
				if (typeof idx === 'string') {
					$('#' + idx).val(data).trigger('change');
					
					
					if (data !== '') {
						$('#' + idx + '_icon').attr('class', data).show();
						
						
						$('#' + idx).parent().find('.cmsms_remove_icon').show();
						
						
						social_container.show();
						
						
						if (social_container.nextAll('input.button').eq(1).is(':not(:visible)')) {
							social_container.nextAll('input.button').eq(0).show();
						}
					} else {
						$('#' + idx + '_icon').removeAttr('class').hide();
						
						
						$('#' + idx).parent().find('.cmsms_remove_icon').trigger('click');
					}
				} else {
					alert(cmsms_admin_lightbox.error_on_page);
					
					
					return false;
				}
				
				
				obj.methods.body.find('#' + id).addClass('preloadBox');
				
				
				obj.methods.closeLightbox('cmsmsLightBox_' + id);
			}, 
			destroyLightbox : function (id) { 
				obj.methods.body.find('#' + id).find('.cmsmsLightBoxContInMid > div').remove();
				
				
				obj.methods.body.find('#' + id).remove();
			}, 
			attachGeneratedEvents : function () { 
				// Icons Filter
				$('#cmsmsLightBox_' + obj.methods.uniqID + ' .cmsms_icon_search > input[type="text"]').bind('input', function () { 
					var val = $(this).val();
					
					
					if (val !== '') {
						$(this).parents('.icons_list_parent').find('> ul > li > a').each(function () { 
							var code = $(this).data('code');
							
							
							if (code.replace(val, '') !== code) {
								$(this).parent().removeAttr('style');
							} else {
								$(this).parent().css('display', 'none');
							}
						} );
					} else {
						$(this).parents('.icons_list_parent').find('> ul > li').removeAttr('style');
					}
				} );
				
				// Icon Choose
				$('#cmsmsLightBox_' + obj.methods.uniqID + ' .icons_list_parent > ul > li > a').bind('click', function () { 
					var parentLi = $(this).parent(), 
						li = $(this).parents('.icons_list_parent').find('> ul > li'), 
						cancel = $(this).parents('.icons_list_parent').find('> a.cmsms_icon_cancel'), 
						hidden = $(this).parents('.icons_list_parent').find('> input.cmsms_icon_value');
					
					
					if (parentLi.hasClass('active')) {
						parentLi.removeClass('active');
						
						
						hidden.val('');
						
						
						cancel.css('display', 'none');
					} else {
						li.removeClass('active');
						
						
						parentLi.addClass('active');
						
						
						hidden.val($(this).attr('class'));
						
						
						cancel.removeAttr('style');
					}
					
					
					return false;
				} );
				
				// Icon Cancel
				$('#cmsmsLightBox_' + obj.methods.uniqID + ' .icons_list_parent > a.cmsms_icon_cancel').bind('click', function () { 
					var li = $(this).parents('.icons_list_parent').find('> ul > li'), 
						hidden = $(this).parents('.icons_list_parent').find('> input.cmsms_icon_value');
					
					
					li.removeClass('active');
					
					
					hidden.val('');
					
					
					$(this).css('display', 'none');
					
					
					return false;
				} );
			}, 
			getLbID : function (el) { 
				return $(el).parents('.cmsmsLightBoxOut').attr('id');
			}, 
			getUniqID : function () { 
				return (new Date().getTime()).toString(16);
			}, 
			getWinWidth : function () { 
				return $(window).width();
			} 
		};
		
		
		obj.methods.init();
	};
	
	// Plugin Start
	$.fn.cmsmsLightbox = function (parameters) { 
		return this.each(function () { 
			if ($(this).data('cmsmsLightbox')) { 
				return;
			}
			
			
			var cmsmsLightbox = new CmsmsLightbox(this, parameters);
			
			
			$(this).data('cmsmsLightbox', cmsmsLightbox);
		} );
	};
} )(jQuery);

