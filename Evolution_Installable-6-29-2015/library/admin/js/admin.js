jQuery.noConflict();
	
jQuery(document).ready(function () {
	jQuery(".toggle-container").hide();
	jQuery("#alc_body_font, #alc_headings_font, #alc_menu_font").after('<div class="font-preview"></div>');
    if (jQuery('.color-picker').size() > 0) {
        jQuery('.color-picker').ColorPicker({
            onSubmit: function (hsb, hex, rgb, el) {
                jQuery(el).val('#' + hex);
                jQuery(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value);
            }
        }).bind('keyup', function () {
            jQuery(this).ColorPickerSetColor(this.value);
        });
    }
	
	
	
	// Drag & Drop sorting 
	
	jQuery(function($) {
		$('#sortable-table tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');
	
				var data = {
					action: 'sneek_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};
	
				$.post(ajaxurl, data);
			}
		}).disableSelection();
	
	});
	
	jQuery(function($) {
		$('#sortable-table-portfolio tbody').sortable({
			axis: 'y',
			handle: '.column-order img',
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			update: function(event, ui) {
				var theOrder = $(this).sortable('toArray');
	
				var data = {
					action: 'portfolio_update_post_order',
					postType: $(this).attr('data-post-type'),
					order: theOrder
				};
	
				$.post(ajaxurl, data);
			}
		}).disableSelection();
	
	});
    
	// image Uploader Functions ##############################################
	function alcatron_set_uploader(field) {
		var button = "#upload_"+field+"_button";
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			touchm_set_send_img(field);
			return false;
		});
		jQuery('#'+field).change(function(){
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
		});
	}
	function touchm_set_send_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined') // Bug fix By Fouad Badawy
				imgurl = jQuery(html).attr('src');
				
			jQuery('#'+field).val(imgurl);
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",imgurl);
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
	//Alcatron_set_uploader("slide");
	alcatron_set_uploader("favicon");
	alcatron_set_uploader("gravatar");
	alcatron_set_uploader("banner_top_img");
	alcatron_set_uploader("banner_bottom_img");
	alcatron_set_uploader("banner_above_img");
	alcatron_set_uploader("banner_below_img");
	alcatron_set_uploader("dashboard_logo");

	
// image Uploader Functions ##############################################
	function alcatron_styling_uploader(field) {
		var button = "#upload_"+field+"_button";
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			styling_send_img(field);
			return false;
		});
		jQuery('#'+field).change(function(){
			jQuery('#'+field+'-preview img').attr("src",jQuery('#'+field).val());
		});
	}
	function styling_send_img(field) {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			
			if(typeof imgurl == 'undefined') // Bug fix By Fouad Badawy
				imgurl = jQuery(html).attr('src');
				
			jQuery('#'+field+'-img').val(imgurl);
			jQuery('#'+field+'-preview').show();
			jQuery('#'+field+'-preview img').attr("src",imgurl);
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};	
	alcatron_styling_uploader("background");
	alcatron_styling_uploader("topbar_background");
	alcatron_styling_uploader("header_background");
	alcatron_styling_uploader("footer_background");
	alcatron_styling_uploader("main_content_bg");

	
	// Del Preview Image ##############################################
	jQuery(".del-img").live("click" , function() {
		jQuery(this).parent().fadeOut(function() {
			jQuery(this).hide();
			jQuery(this).parent().find('input[class="img-path"]').attr('value', '' );
		});
	});	
	
}) 