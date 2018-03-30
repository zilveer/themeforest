jQuery(function($){
	// Overall Functionality
	jQuery('.group').hide();
	jQuery('.group:first').fadeIn();
	jQuery('#om-options-sections li:first').addClass('current');
	jQuery('#om-options-sections li a').click(function(evt){
	
		jQuery('#om-options-sections li').removeClass('current');
		jQuery(this).parent().addClass('current');
		
		var clicked_group = jQuery(this).attr('href');

		jQuery('.group').hide();
		
		jQuery(clicked_group).fadeIn();

		evt.preventDefault();
	});
	
	// Image Radio
	jQuery('.om-radio-img-img').click(function(){
		jQuery(this).parent().parent().find('.om-radio-img-img').removeClass('om-radio-img-selected');
		jQuery(this).addClass('om-radio-img-selected');
	});
	
	jQuery('.om-radio-img-label').hide();
	jQuery('.om-radio-img-img').show();
	jQuery('.om-radio-img-radio').hide();
	
	//Color Picker
	function initPickers(context)
	{
		jQuery('.wp-color-picker-field', context).wpColorPicker({
			clear: function(){
				jQuery(this).parents('.wp-picker-container').find('.wp-color-result').addClass('wp-picked-cleared');
			},
			change: function(){
				jQuery(this).parents('.wp-picker-container').find('.wp-color-result').removeClass('wp-picked-cleared');
			}
		});
	}
	initPickers();
	


	//Save everything else
	jQuery('#om-options-form').submit(function(){
	
		jQuery('.ajax-loading-img').fadeIn();
		var serializedReturn = jQuery("#om-options-form").serialize();
		 
		var data = {
			type: 'options',
			action: 'om_theme_options_ajax',
			data: serializedReturn
		};
		
		jQuery.post(ajaxurl, data, function(response) {
			jQuery('.ajax-loading-img').fadeOut();
			var success = jQuery('#om-popup-save').fadeIn();
			window.setTimeout(function(){
			   success.fadeOut(); 
			}, 2000);
		});
		
		return false; 
		
	});
	
	// Slider with sections
	jQuery('.om_add_slider_section_button').click(function(){
		var option_id=jQuery(this).attr('rel');
		var section_index=++om_slider_max_section_index[option_id];
		om_slider_max_section_slide_index[option_id]=[];
		om_slider_max_section_slide_index[option_id][section_index]=0;
		
		var tpl=jQuery('#om-slider-'+option_id+'-section-template').html();
		tpl=tpl.replace(/SECTION_INDEX/g,section_index);
		var section=jQuery('<div class="om-slider-section">'+tpl+'</div>');
		section.hide().insertBefore(this).slideDown(200);
		
		initPickers(section);
		om_init_browse_button(section);
		section.find('.om_add_slider_slide_button').click(function(){
			var slide_index=++om_slider_max_section_slide_index[option_id][section_index];
								
			var tpl=jQuery('#om-slider-'+option_id+'-slide-template').html();
			tpl=tpl.replace(/SECTION_INDEX/g,section_index);
			tpl=tpl.replace(/SLIDE_INDEX/g,slide_index);
			var slide=jQuery('<div class="om-slider-section-slide">'+tpl+'</div>');
			slide.hide().insertBefore(this).slideDown(200);	
			
			initPickers(slide);
			om_init_browse_button(slide);

			slide.find('.om_remove_slider_slide').click(function(){
				slide.slideUp(200,function(){
					jQuery(this).remove();
				});
				return false;
			});
			
			return false;
		});
		
		section.find('.om_remove_slider_section').click(function(){
			section.slideUp(200,function(){
				jQuery(this).remove();
			});
			return false;
		});
		
		return false;
	});
	
	jQuery('.om-slider .om-slider-section .om_add_slider_slide_button').click(function(){

		var option_id=jQuery(this).parents('.om-slider').attr('rel');				
		var section_index=jQuery(this).parents('.om-slider-section').attr('rel');
		var slide_index=++om_slider_max_section_slide_index[option_id][section_index];
							
		var tpl=jQuery('#om-slider-'+option_id+'-slide-template').html();
		tpl=tpl.replace(/SECTION_INDEX/g,section_index);
		tpl=tpl.replace(/SLIDE_INDEX/g,slide_index);
		var slide=jQuery('<div class="om-slider-section-slide">'+tpl+'</div>');
		slide.hide().insertBefore(this).slideDown(200);	
		
		initPickers(slide);
		om_init_browse_button(slide);

		slide.find('.om_remove_slider_slide').click(function(){
			slide.slideUp(200,function(){
				jQuery(this).remove();
			});
			return false;
		});
		
		return false;
	});
	
	jQuery('.om-slider').find('.om_remove_slider_section').click(function(){
		jQuery(this).parents('.om-slider-section').slideUp(200,function(){
			jQuery(this).remove();
		});
		return false;
	});
	
	jQuery('.om-slider').find('.om_remove_slider_slide').click(function(){
		jQuery(this).parents('.om-slider-section-slide').slideUp(200,function(){
			jQuery(this).remove();
		});
		return false;
	});
	
	
	// Slider
	jQuery('.om_add_simple_slider_section_button').click(function(){
		
		var option_id=jQuery(this).attr('rel');
		var slide_index=++om_simple_slider_max_slide_index;
		
		var tpl=jQuery('#om-slider-'+option_id+'-slide-template').html();
		tpl=tpl.replace(/SLIDE_INDEX/g,slide_index);
		var section=jQuery('<div class="om-slider-section">'+tpl+'</div>');
		section.hide().insertBefore(this).slideDown(200);
		
		
		
		initPickers(section);
		om_init_browse_button(section);
		
		section.find('.om_remove_simple_slider_section').click(function(){
			section.slideUp(200,function(){
				jQuery(this).remove();
			});
			return false;
		});
		
		return false;
	});
	
	jQuery('.om-slider').find('.om_remove_simple_slider_section').click(function(){
		jQuery(this).parents('.om-slider-section').slideUp(200,function(){
			jQuery(this).remove();
		});
		return false;
	});

	//
	initPickers();
	om_init_browse_button(jQuery('.om-slider'));
	
});