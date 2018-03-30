(function($){

	// bind an event to upload 	
	$.fn.gdlrUploadFont = function(){
		var font_wrapper = $(this);
		var font_input = $(this).children('.gdlr-upload-font-input');
		var font_container = $(this).children('.gdlr-upload-font-container');
		
		// bind the existing font
		font_container.find('.gdlr-font-item-wrapper').each(function(){
			$(this).gdlrbindFontItemOptions( font_wrapper );
		});
		
		// bind adding font option
		$(this).find('.gdlr-add-more-font').click(function(){
			var font_item = $(this).siblings('.gdlr-font-item-wrapper').clone();
			
			font_item.gdlrbindFontItemOptions( font_wrapper );
			font_item.hide().appendTo(font_container).slideDown();
			
			font_wrapper.gdlrUpdateUploadedFont();
		});
	}
	
	// update the font when the changes is made
	$.fn.gdlrUpdateUploadedFont = function( font_wrapper ){
		var font_input = [];
		var font_container = $(this).children('.gdlr-upload-font-container');
		font_container.find('.gdlr-font-item-wrapper').each(function(){
			var subfont = new Object();
			$(this).find('input[type="text"]').each(function(){
				if( $(this).attr('data-id') ){
					subfont[$(this).attr('data-type')] = $(this).attr('data-id');
				}else{
					subfont[$(this).attr('data-type')] = $(this).val();
				}
			});
			font_input.push(subfont);
		});
		
		$(this).children('.gdlr-upload-font-input').val(JSON.stringify(font_input));
	}
	
	// bind the font option
	$.fn.gdlrbindFontItemOptions = function( font_wrapper ){
		var font_item = $(this);
		
		// delete font button
		$(this).children('.gdlr-delete-font-item').click(function(){
			$('body').gdlr_confirm({
				success: function(){
					font_item.slideUp(function(){
						$(this).remove();
						font_wrapper.gdlrUpdateUploadedFont();
					});
				}
			});
		});
		
		// change the font input
		$(this).find('input[type="text"]').change(function(){
			$(this).removeAttr('data-id');
			font_wrapper.gdlrUpdateUploadedFont();
		});
		
		// select font function
		$(this).find('.gdlr-upload-font-button').click(function(){
			var upload_button = $(this);
		
			var custom_uploader = wp.media({
				title: upload_button.attr('data-title'),
				button: { text: upload_button.attr('data-button') },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				upload_button.siblings('.gdlr-font-input')
					.val(attachment.url)
					.attr('data-id', attachment.id);
				font_wrapper.gdlrUpdateUploadedFont();
			}).open();			
		});		
	}
	
	// skin option
	$.fn.gdlrSkinGenerator = function(){
		var container = $(this).children('.gdlr-skin-container');
		var textarea = $(this).children('textarea');
		
		// generate default option
		var default_options = $.parseJSON($(this).find('.gdlr-default-skin').html());
		var default_item = '<div class="gdlr-skin-item-wrapper" >';
		default_item += '<div class="skin-option-item">';
		default_item += '<div class="skin-option-item-title">Default Title</div>';
		default_item += '<div class="skin-option-item-edit"></div>';
		default_item += '<div class="skin-option-item-delete"></div>';
		default_item += '</div>'; // skin-option-item
		default_item += '<div class="gdlr-skin-option-wrapper" >';
		for(var slug in default_options){
			default_item += '<div class="skin-option">';
			default_item += '<div class="skin-color-title">' + default_options[slug] + '</div>';
			default_item += '<input type="text" data-name="' + slug + '" class="wp-color-picker" value="#ffffff" data-default-color="#ffffff" />';
			default_item += '</div>';
		}
		default_item += '</div>';
		default_item += '</div>'; // gdlr-skin-item-wrapper
		
		// init item
		var old_options = $.parseJSON(textarea.val());
		old_options = (old_options)? old_options: [];
		for(var i=0; i<old_options.length; i++){
			var new_item = $(default_item);
			container.append(new_item);
			
			new_item.find('.wp-color-picker').each(function(){
				$(this).val(old_options[i][$(this).attr('data-name')]);
				$(this).wpColorPicker({
					change: function(){ textarea.gdlrUpdateSkinOption(container); }
				});				
			});
			
			var item_title = new_item.find('.skin-option-item-title');
			item_title.html(old_options[i]['skin-title']);
			item_title.siblings('.skin-option-item-delete').click(function(){
				$(this).closest('.gdlr-skin-item-wrapper').slideUp(function(){
					$(this).remove();
					textarea.gdlrUpdateSkinOption(container);
				});
			});
			item_title.siblings('.skin-option-item-edit').click(function(){
				$(this).parent().siblings('.gdlr-skin-option-wrapper').slideToggle();
			});
			new_item.slideDown();			
			
		}
			
		// add new skin
		$(this).find('.gdlr-add-more-skin').click(function(){
			if(!$(this).siblings('.gdl-text-input').val()){
				$('body').gdlr_alert({ text: 'Please fill the skin name', duration: 2000, status: 'failed'});
				return;
			}

			var new_item = $(default_item).hide();
			container.append(new_item);
			
			// bind events
			new_item.find('.gdlr-skin-option-wrapper').css('display', 'block');
			new_item.find('.wp-color-picker').each(function(){
				$(this).wpColorPicker({
					change: function(){ textarea.gdlrUpdateSkinOption(container); }
				});
			});
			
			var item_title = new_item.find('.skin-option-item-title');
			item_title.html($(this).siblings('.gdl-text-input').val());
			item_title.siblings('.skin-option-item-delete').click(function(){
				$(this).closest('.gdlr-skin-item-wrapper').slideUp(function(){
					$(this).remove();
					textarea.gdlrUpdateSkinOption(container);
				});
			});
			item_title.siblings('.skin-option-item-edit').click(function(){
				$(this).parent().siblings('.gdlr-skin-option-wrapper').slideToggle();
			});
			new_item.slideDown();
			
			textarea.gdlrUpdateSkinOption(container);
		});
	}	
	
	$.fn.gdlrUpdateSkinOption = function(container){
		var skin_val = [];
		container.children().each(function(){
			var skin = new Object();
			$(this).find('input[data-name]').each(function(){
				eval('skin["' + $(this).attr('data-name') + '"]=$(this).val()');
			});
			$(this).find('.skin-option-item-title').each(function(){
				skin['skin-title'] = $(this).html();
			});
			skin_val.push(skin);
		});
		
		$(this).val(JSON.stringify(skin_val));
	}
	
	// execute the script when document is ready
	$(document).ready(function(){

		// set the color picker
		$('.gdlr-option-input .wp-color-picker').wpColorPicker();		
		
		// animate combobox
		$('.gdlr-option-input select').not('multiple').change(function(){
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';
			$(this).parents('.gdlr-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).slideDown(300);
				}else{
					$(this).slideUp(300);
				}
			});
		});
		$('.gdlr-option-input select').not('multiple').each(function(){
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';

			$(this).parents('.gdlr-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).css('display', 'block');
				}else{
					$(this).css('display', 'none');
				}
			});
		});		
				
		// animate radio image 
		$('.gdlr-option-input input[type="radio"]').change(function(){
			$(this).parent().siblings('label').children('input').attr('checked', false); 
			$(this).parent().addClass('active').siblings('label').removeClass('active');
			
			// animate the related section
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';
			$(this).parents('.gdlr-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).slideDown(300);
				}else{
					$(this).slideUp(300);
				}
			});
		});
		$('.gdlr-option-input input[type="radio"]:checked').each(function(){
		
			// trigger the default value
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';

			$(this).parents('.gdlr-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).css('display', 'block');
				}else{
					$(this).css('display', 'none');
				}
			});
		});		
		
		// animate checkbox
		$('.gdlr-option-input input[type="checkbox"]').click(function(){	
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				$(this).siblings('.checkbox-appearance').removeClass('enable');
			}else{
				$(this).siblings('.checkbox-appearance').addClass('enable');
			}
		});
		
		// animate date picker
		$('.gdlr-option-input input.gdlr-date-picker').datepicker({
			dateFormat : 'yy-mm-dd'
		});
		
		// animate upload button
		$('.gdlr-option-input .gdlr-upload-box-input').change(function(){		
			$(this).siblings('.gdlr-upload-box-hidden').val($(this).val());
			if( $(this).val() == '' ){ 
				$(this).siblings('.gdlr-upload-img-sample').addClass('blank'); 
			}else{
				$(this).siblings('.gdlr-upload-img-sample').attr('src', $(this).val()).removeClass('blank');
			}
		});
		$('.gdlr-option-input .gdlr-upload-box-button').click(function(){
			var upload_button = $(this);
			var data_type = upload_button.attr('data-type');
			if( data_type == 'all' ){ data_type = ''; }
			
			var custom_uploader = wp.media({
				title: upload_button.attr('data-title'),
				button: { text: upload_button.attr('data-button') },
				library : { type : data_type },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				if( data_type == 'image' ){
					upload_button.siblings('.gdlr-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				}
				upload_button.siblings('.gdlr-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				upload_button.siblings('.gdlr-upload-box-input').val(attachment.url);
				upload_button.siblings('.gdlr-upload-box-hidden').val(attachment.id);
			}).open();			
		});
		
		// animate sliderbar item
		$('.gdlr-option-input .gdlr-sliderbar').each(function(){
			$(this).slider({ min:10, max:72, value: $(this).attr('data-value'),
				slide: function(event, ui){
					$(this).siblings('.gdlr-sliderbar-text-hidden').val(ui.value);
					$(this).siblings('.gdlr-sliderbar-text').html(ui.value + ' px');
				}
			});
		});		
		
		// animate skin
		$('#skin-setting-wrapper').each(function(){ $(this).gdlrSkinGenerator(); });
		
		// animate the font section
		$('#upload-font-wrapper').gdlrUploadFont();
		
		// animate font family section
		var gdlr_custom_font_list = [];
		$('select.gdlr-font-combobox').change(function(){
			var font_family = $(this).val();
			var sample_font = $(this).parent().siblings('.gdlr-sample-font');
			var selected_option = $(this).children('option:selected');
			
			if( selected_option.attr('data-type') == 'web-safe-font' ){
				sample_font.css('font-family', font_family);
			}else if( selected_option.attr('data-type') == 'google-font' ){
				$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', selected_option.attr('data-url')) );
				sample_font.css('font-family', font_family + ', BlankSerif');
			}else if( selected_option.attr('data-type') == 'custom-font' ){
				if( gdlr_custom_font_list.indexOf(font_family) <= 0 ){
					var new_font = '@font-face {';
					new_font    += 'font-family: "' + font_family + '";'
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '");';
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '?#iefix") format("embedded-opentype"),';
					new_font    += 'url("' + selected_option.attr('data-ttf') + '") format("truetype");';
					new_font    += '}';
					
					$('head').append($('<style type="text/css"></style>').append(new_font));
					gdlr_custom_font_list.push(font_family);
				}
				sample_font.css('font-family', font_family + ', BlankSerif');
			}
		
		});
		$('select.gdlr-font-combobox').trigger('change');
		
		// initiate slider selector		
		$('textarea.gdlr-slider-selection').each(function(){
			$(this).gdlrCreateSliderSelection();	
		});
	});	
	
})(jQuery);