(function($){
	
	var gdlr_tmce_set = false;
	
	// create a gdl editbox to the bottom of body section
	$.fn.gdlrEditBox = function( ending ){
		
		// trigger the visual editor for the first time
		if( !gdlr_tmce_set ){
			if( $('#wp-content-wrap').hasClass('html-active') ){
				$('#content-tmce').trigger('click');
				gdlr_tmce_set = true;
			}
		}
	
		var editbox = $('<div class="edit-box-wrapper"></div>');
		var editboxoption = $(this).closest('.gdlr-draggable').children('.gdlr-item-option');
		
		editbox.gdlrCreateEditBoxContainer( editboxoption, ending  );
		editbox.gdlrCreateEditBoxOverlay( editboxoption, ending  );
		
		// add editbox at the bottom of body selector
		$('body').append(editbox.fadeIn(150)).addClass('gdlr-disable-scroll');
		
		// bind the script that execute after the item is added
		editbox.gdlrEditBoxLaterScript();
	}
	
	// create and bind events to background overlay
	$.fn.gdlrCreateEditBoxOverlay = function( editboxoption, ending ){
		var editbox = $(this);
		var editbox_overlay = $('<div class="edit-box-overlay"></div>');
		
		editbox_overlay.click(function(){
			$(this).gdlrRemoveEditBox( editbox, editboxoption, ending );
		});
		editbox.append(editbox_overlay);	
	}
	
	// create and bind events to background overlay
	$.fn.gdlrCreateEditBoxContainer = function( options, ending ){
		var editbox = $(this);
		var editbox_container = $('<div class="edit-box-container"></div>');
		
		// bind the editbox close / create the editbox title section
		var edit_box_close = $('<div class="edit-box-close"></div>');
		edit_box_close.click(function(){
			$(this).gdlrRemoveEditBox( editbox, options, ending );
		});		
		
		// edit box id 
		var edit_box_head = $('<div class="edit-box-input-head" ></div>')
								.append('<span>ELEMENT ID :</span> ')
								.append($('<input type="text" name="page-item-id" value="' + options.children('[data-name="page-item-id"]').attr('data-value') + '" />'));
							
		var edit_box_title = $('<div class="edit-box-title-wrapper"></div>')
								.append('<h3 class="edit-box-title">Item Options</div>')
								.append(edit_box_head)
								.append(edit_box_close);

		// create the editbox content section
		var edit_box_content = $('<div class="edit-box-content"></div>');
		options.children().each(function(){
			if( $(this).attr('data-name') == 'page-item-id' ) return;
		
			var edit_box_input_outer = $('<div class="edit-box-input-wrapper"></div>');
			if( $(this).attr('data-wrapper-class') ){
				edit_box_input_outer.addClass($(this).attr('data-wrapper-class'));
			}
			
			// print input title
			if( $(this).attr('data-title') ){
				edit_box_input_outer.append('<div class="input-box-title">' + $(this).attr('data-title') + '</div>' );
			}				

			// print input option
			var edit_box_input = $('<div class="edit-box-input"></div>');
			switch ($(this).attr('data-type')){
				case 'checkbox' : edit_box_input.gdlrEditBoxCheckBox($(this)); break;
				case 'colorpicker' : edit_box_input.gdlrEditBoxColor($(this)); break;
				case 'combobox' : edit_box_input.gdlrEditBoxCombobox($(this)); break;
				case 'icon-with-list' : edit_box_input.gdlrEditBoxIconWithList($(this)); break;
				case 'multi-combobox' : edit_box_input.gdlrEditBoxMultipleCombobox($(this)); break;
				case 'slider' : edit_box_input.gdlrEditBoxSlider($(this)); break;
				case 'tab' : edit_box_input.gdlrEditBoxTab($(this)); break;
				case 'price-table' : edit_box_input.gdlrEditBoxPrice($(this)); break;
				case 'authorinfo' : edit_box_input.gdlrEditBoxAuthor($(this)); break;
				case 'radioimage' : edit_box_input.gdlrEditBoxRadioImage($(this)); break;
				case 'text' : edit_box_input.gdlrEditBoxInput($(this)); break;
				case 'textarea' : edit_box_input.gdlrEditBoxTextArea($(this)); break;
				case 'tinymce' : edit_box_input.gdlrEditBoxTinyMCE($(this)); break;				
				case 'toggle-box' : edit_box_input.gdlrEditBoxToggleBox($(this)); break;	
				case 'upload' : edit_box_input.gdlrEditBoxUpload($(this)); break;
			}
			edit_box_input.append('<div class="clear"></div>');
			edit_box_input_outer.append(edit_box_input);
			
			// print input description
			if( $(this).attr('data-description') ){
				edit_box_input.addClass('with-description');
				edit_box_input_outer.append('<div class="edit-box-description">' + $(this).attr('data-description') + '</div>' );
				edit_box_input_outer.append('<div class="clear"></div>');
			}	
			
			edit_box_content.append(edit_box_input_outer);
		});
		
		// edit box save section
		var edit_box_saved = $('<div class="edit-box-saved">Save Changes</div>');
		edit_box_saved.click(function(){
			$(this).gdlrRemoveEditBox( editbox, options, ending );
		});			
		edit_box_content.append($('<div class="edit-box-save-wrapper"></div>').append(edit_box_saved));
		
		editbox_container.append(edit_box_title);
		editbox_container.append(edit_box_content);
		editbox.append(editbox_container);
	}	
	
	// save the settings and remove the editbox
	$.fn.gdlrRemoveEditBox = function( editbox, options, ending ){
	
		// save the data when the box is about to close
		editbox.find('.edit-box-input-wrapper, .edit-box-input-head').each(function(){
			
			var data_name = '';
			var data_value = '';
			
			$(this).find('[name]').each(function(){
					data_name = $(this).attr('name');
					
					// input type = text
					if( $(this).attr('type') == 'text' ){
						data_value = $(this).val();
						
						if( data_name == 'page-item-id' ){
							data_value = gdlr_css_name_check(data_value);
						}
						
					// input type = checkbox
					}else if( $(this).attr('type') == 'checkbox' ){
						if( $(this).attr('checked') ){
							data_value = 'enable';
						}else{
							data_value = 'disable';
						}
					
					// input type = tinymce
					}else if( $(this).is('textarea[id^=gdlr-editor-]') ){
					
						if( typeof(tinyMCE) != "undefined" && typeof(tinyMCE.majorVersion) != "undefined" && 
							tinyMCE.majorVersion >= 4 ){

							var temp_tmce = tinyMCE.get($(this).attr('id'))
							if( temp_tmce.isHidden() ){
								window.switchEditors.go(tinymce_id, 'tmce');
								temp_tmce.setContent( window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'} );							
							}
							data_value = temp_tmce.getContent()
							temp_tmce = temp_tmce.remove();			
						}else{
							tinyMCE.execCommand("mceRemoveControl", false, $(this).attr('id'));
							tinyMCE.triggerSave();
							data_value = $(this).val();	
						}

					// input type = textarea
					}else if( $(this).is('textarea') ){
						data_value = $(this).val();
						
					// input type = multi-combobox
					}else if( $(this).is('select[multiple]') ){
						if( $(this).val() ){
							data_value = $(this).val().join();
						}

					// input type = combobox					
					}else if( $(this).is('select') ){
						data_value = $(this).val();
					
					// input type = radioimage
					}else if( $(this).is('input[type="radio"]:checked') ){
						data_value = $(this).val();
					}
			
			});

			// assign the value back to default area
			options.children('[data-name="' + data_name + '"]').attr('data-value', data_value);
		
		});
	
		// remove the box out
		editbox.fadeOut(150, function(){
			editbox.remove();
		});
		
		$('body').removeClass('gdlr-disable-scroll');
		
		if(typeof(ending) == 'function'){ 
			ending();
		}
	}
	
	/*------------------------------------------------*/
	/*--------     ELEMENT INPUT SECTION     ---------*/
	/*------------------------------------------------*/
	
	$.fn.gdlrEditBoxInput = function( option ){	
		var value = option.attr('data-value');
		if ((typeof value == 'undefined') && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).append( '<input type="text" name="' + option.attr('data-name') + '" class="gdl-text-input" value="' + gdlr_esc_attr(value) + '" />');
	}
	
	$.fn.gdlrEditBoxTextArea = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
	
		$(this).append( '<textarea name="' + option.attr('data-name') + '">' + value + '</textarea>');
	}	
	
	$.fn.gdlrEditBoxSlider = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}

		var textarea = $('<textarea></textarea>')
							.addClass('gdlr-input-hidden gdlr-slider-selection')
							.attr('name', option.attr('data-name'))
							.attr('data-overlay', option.attr('data-overlay'))
							.attr('data-caption', option.attr('data-caption'))
							.val(value);
		
		$(this).append(textarea);
	}	
	
	$.fn.gdlrEditBoxCheckBox = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}	
		
		// create the checkbox
		var checkbox_wrapper = $('<label for="' + option.attr('data-name') + '-id" class="checkbox-wrapper">');
		var checkbox = $('<input type="checkbox" id="' + option.attr('data-name') + '-id" name="' + option.attr('data-name') + '" />');		
		if( value == 'enable' ){
			checkbox.attr('checked','checked');
		}
		
		// bind the checkbox script
		checkbox.click(function(){	
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				$(this).siblings('.checkbox-appearance').removeClass('enable');
			}else{
				$(this).siblings('.checkbox-appearance').addClass('enable');
			}
		});
		
		checkbox_wrapper.append('<div class="checkbox-appearance ' + value + '" > </div>');	
		checkbox_wrapper.append( checkbox );	
		
		$(this).append( checkbox_wrapper );
	}	
		
	$.fn.gdlrEditBoxCombobox = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var combobox = $('<select name="' + option.attr('data-name') + '"></select>');
		var options = $.parseJSON( option.html() );

		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				if( property == value ){
					combobox.append('<option value="' + property + '" selected >' + options[property] + '</option>');
				}else{
					combobox.append('<option value="' + property + '" >' + options[property] + '</option>');
				}				
			}
		}		
		
		$(this).append($('<div class="gdlr-combobox-wrapper"></div>').append(combobox));
	}	
	
	$.fn.gdlrEditBoxRadioImage = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var radio_image = '';
		var options = $.parseJSON( option.html() );
		
		var i = 0;
		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				radio_image += '<label for="' + option.attr('data-name') + '-id' + i + '" class="radio-image-wrapper ';
				radio_image += (value == property)? 'active ': '';
				radio_image += '">';
				radio_image += '<img src="' + options[property] + '" alt="" />';
				radio_image += '<div class="selected-radio"></div>';

				radio_image += '<input type="radio" name="' + option.attr('data-name') + '" ';
				radio_image += 'id="' + option.attr('data-name') + '-id' + i + '" value="' + property + '" ';
				radio_image += (value == property)? 'checked ': '';
				radio_image += ' />';

				radio_image += '</label>';	
				i++;
			}
		}		
		
		$(this).append(radio_image);
	}	
	
	$.fn.gdlrEditBoxMultipleCombobox = function( option ){	
		var value;
		if (typeof option.attr('data-value') != 'undefined') {
			value = option.attr('data-value').split(',');
		}else if( typeof option.attr('data-default') != 'undefined' ){
			value = option.attr('data-default').split(',');
		}else{
			value = [];
		}
	
		var combobox = $('<select multiple name="' + option.attr('data-name') + '"></select>');
		var options = $.parseJSON( option.html() );

		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				if( value.indexOf(property) >= 0 ){
					combobox.append('<option value="' + property + '" selected >' + options[property] + '</option>');
				}else{
					combobox.append('<option value="' + property + '" >' + options[property] + '</option>');
				}				
			}
		}		

		$(this).append($('<div class="gdlr-multi-combobox-wrapper"></div>').append(combobox));
	}		
	
	$.fn.gdlrEditBoxColor = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}
		
		var color_picker = $('<input type="text" />');
			color_picker.addClass('gdlr-colorpicker')
						.attr('name', option.attr('data-name'))
						.attr('data-default-color', option.attr('data-default'))
						.val(value);
		
		$(this).append( color_picker );
	}	
	
	$.fn.gdlrEditBoxUpload = function( option ){	
	
		// create upload html section
		var upload_wrapper = $('<div class="gdlr-upload-wrapper" ></div>');
		var sample_image = $('<img class="gdlr-upload-img-sample" />');
		var input_text = $('<input type="text" class="gdl-text-input" />');
		if( option.html() ){
			sample_image.attr('src', option.html());
			input_text.val(option.html());
		}else{
			sample_image.addClass('blank');
		}
		var input_hidden = $('<input type="text" />')
									.addClass('gdlr-upload-box-hidden')
									.attr('name', option.attr('data-name'))
									.val(option.attr('data-value'));
		var upload_button = $('<input type="button" />')
									.addClass('gdlr-upload-box-button gdl-button')
									.val(option.attr('data-button'));
		
		// upload script
		input_text.change(function(){	
			option.html($(this).val());
			input_hidden.val($(this).val());
			
			if( $(this).val() == '' ){ 
				sample_image.addClass('blank'); 
			}else{
				sample_image.attr('src', $(this).val()).removeClass('blank');
			}
		});		
		upload_button.click(function(){
			var custom_uploader = wp.media({
				title: option.attr('data-title'),
				button: { text: upload_button.val() },
				library : { type : 'image' },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				sample_image.attr('src', attachment.url).removeClass('blank');
				input_text.val(attachment.url);
				input_hidden.val(attachment.id);
				option.html(attachment.url);
			}).open();			
		});		
		
		upload_wrapper.append(sample_image).append('<div class="clear"></div>')
						.append(input_text)
						.append(input_hidden)
						.append(upload_button);
		$(this).append(upload_wrapper);
	}	
	
	$.fn.gdlrEditBoxTinyMCE = function( option ){	
		var container = $(this);
		var tinymce_id = 'gdlr-editor-' + option.attr('data-name');
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			if( option.attr('data-default') ){
				value = option.attr('data-default');
			}else{
				value = '';
			}
		}	
		 
		current_tinymce = $('<div class="gdlr-tinymce wp-core-ui wp-editor-wrap tmce-active" data-id="' + tinymce_id + '" >\
							<div class="wp-editor-tools hide-if-no-js">\
							<div class="wp-media-buttons">\
							<a href="#" class="button insert-media add_media" data-editor="' + tinymce_id + '" title="Add Media">\
							<span class="wp-media-buttons-icon"></span>Add Media\
							</a>\
							</div>\
							<div class="wp-editor-tabs">\
							<a class="wp-switch-editor switch-html" >Text</a>\
							<a class="wp-switch-editor switch-tmce" >Visual</a>\
							</div>\
							</div>\
							<div class="wp-editor-container">\
							<textarea class="wp-editor-area" rows="20" cols="40" name="' + option.attr('data-name') + '" id="' + tinymce_id + '">' + gdlr_esc_attr(value) + '</textarea>\
							</div>\
							</div>');
							
		container.append(current_tinymce);					
	}		
	
	// Bind the srcipt that execute after the edit box is added to the content
	$.fn.gdlrEditBoxLaterScript = function(){
		
		// color picker script
		$(this).find('.gdlr-colorpicker').wpColorPicker();
	
		// combobox script
		$(this).find('select').not('[multiple]').each(function(){
			$(this).change(function(){
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';
			
				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).slideDown(300);
					}else{
						$(this).slideUp(300);
					}			
				});
			});
			$(this).each(function(){
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';

				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).css('display', 'block');
					}else{
						$(this).css('display', 'none');
					}			
				});
			});			
		});
		
		// radio-image-script
		$('.radio-image-wrapper input[type="radio"]').change(function(){
			$(this).parent().siblings('label').children('input').attr('checked', false); 
			$(this).parent().addClass('active').siblings('label').removeClass('active');
		});
		
		// slider script
		$(this).find('textarea.gdlr-slider-selection').each(function(){
			$(this).gdlrCreateSliderSelection();	
		});
	
		// for tiny mce
		$(this).find('.gdlr-tinymce').each(function(){
			current_tinymce = $(this);
			tinymce_id = $(this).attr('data-id');
			
			// add the quick tag to html editor area
			quicktags({ id: tinymce_id });
			QTags._buttonsInit(); 
		
			if( typeof(tinyMCE) != "undefined" && typeof(tinyMCE.majorVersion) != "undefined" && 
				tinyMCE.majorVersion >= 4 ){
				
				var temp_settings = tinyMCEPreInit.mceInit.content; // tinyMCE.editors[0].settings;
				temp_settings.selector = "#" + tinymce_id
				temp_settings.toolbar1 = temp_settings.toolbar1.replace(',wp_fullscreen', '');
				temp_settings.force_br_newlines = true;
				temp_settings.force_p_newlines = true;
				temp_settings.forced_root_blocks = false;
				tinyMCE.init(temp_settings);
				
				// bind the html/visual editor button
				current_tinymce.find('.wp-switch-editor').each(function(){
					$(this).click(function(){					
						if( $(this).hasClass('switch-html') ){
							current_tinymce.removeClass('tmce-active').addClass('html-active');
							window.switchEditors.go(tinymce_id, 'html');
						}else if( $(this).hasClass('switch-tmce') ){
							current_tinymce.removeClass('html-active').addClass('tmce-active');
							window.switchEditors.go(tinymce_id, 'tmce');
							tinyMCE.get(tinymce_id).setContent(
								window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'}
							);
						}
					});
				});		
		
			}else{

				// bind the html/visual editor button
				current_tinymce.find('.wp-switch-editor').each(function(){
					$(this).removeAttr('onClick');
					$(this).click(function(){					
						if( $(this).hasClass('switch-html') ){
							current_tinymce.removeClass('tmce-active').addClass('html-active');
							tinyMCE.execCommand("mceRemoveControl", false, tinymce_id);					
						}else if( $(this).hasClass('switch-tmce') ){
							current_tinymce.removeClass('html-active').addClass('tmce-active');
							tinyMCE.execCommand("mceAddControl", false, tinymce_id);

							window.tinyMCE.get(tinymce_id).setContent(
								window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'}
							);
						}
					});
					
					if( $(this).hasClass('switch-tmce') ){ 
						$(this).trigger('click'); 
					}
				});				
			}
			
		});

	}

})(jQuery);
