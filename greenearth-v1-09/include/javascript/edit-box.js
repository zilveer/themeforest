/**
 *	Goodlayers Edit Box File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		Goodlayers
 * 	@link		http://goodlayers.com
 * 	@copyright	Copyright (c) Goodlayers
 * 	---------------------------------------------------------------------
 * 	This file contains the script of the editbox that create overlay over
 *	any elements and copy desired element to be showed in that overlay.
 *	---------------------------------------------------------------------
 */

jQuery(document).ready(function(){
	
	// initialize necessary variables
	var gdl_div_wrapper = jQuery('#gdl-overlay-wrapper');
	var gdl_edit_box_elements = {
		editbox: '<div id="gdl-edit-box">\
					<div id="gdl-overlay"></div>\
					<div id="gdl-overlay2"></div>\
					<div id="gdl-inline-wrapper">\
						<div class="gdl-inline-header">\
							<div class="gdl-inline-header-wrapper">\
								<div class="gdl-inline-header-inner-wrapper" >\
									<div class="gdl-inline-header-text"> EDITOR </div>\
									<div id="gdl-head-edit-img" class="gdl-head-edit-img"></div>\
								</div>\
							</div>\
							<div id="close-gdl-edit-box"></div>\
						</div>\
						<div id="gdl-inline"></div>\
						<div class="gdl-inline-footer">\
							<input type="button" value="Done" id="gdl-inline-edit-done" class="gdl-button">\
							<br class="clear">\
						</div>\
					</div>\
				</div>',
		opacity: 0.42
	};
	gdl_div_wrapper.append(gdl_edit_box_elements.editbox);
	
	var gdl_editbox = gdl_div_wrapper.find('#gdl-edit-box');
	var gdl_content = gdl_editbox.siblings('#gdl-overlay-content');
	var gdl_overlay = gdl_editbox.find('#gdl-overlay');
	var gdl_inline = gdl_editbox.find('#gdl-inline');
	var gdl_clicked_item = '';
	var gdl_item_size = '';
	var gdl_edit_item = '';
	var gdl_clone_item = '';
	
	// bind the initialize elements
	gdl_editbox.children().css('display','none');
	gdl_overlay.css('opacity',gdl_edit_box_elements.opacity);
	jQuery('#close-gdl-edit-box').click(function(){
		gdl_close_editbox();
	});
	jQuery('#gdl-inline-edit-done').click(function(){
		gdl_close_editbox(); 
	});	
	jQuery('div[rel="gdl-edit-box"]').click(function(){
		gdl_clicked_item = jQuery(this);
		gdl_item_size = gdl_clicked_item.parents('#page-element-item').find('#element-size-text').html();
		gdl_item_size = parseInt(gdl_item_size.substr(0,1))  /  parseInt(gdl_item_size.substr(2,1));
		gdl_open_editbox();
	});
	jQuery('input#publish[name="save"]').click(function(){
		gdl_close_editbox();
	});
	
	// copy the content and open the edit box to use
	function gdl_open_editbox(){
		clicked_id = gdl_clicked_item.attr('id');
		gdl_edit_item = gdl_clicked_item.parents('#page-element-item').siblings('#' + clicked_id);
		gdl_clone_item = gdl_edit_item.children().clone(true);
		
		var li_cloned = gdl_clone_item.find('div.selected-image ul').children().clone(true);
		li_cloned = jQuery('<ul></ul>').append(li_cloned);
		gdl_clone_item.find('div.selected-image ul').replaceWith(li_cloned)
		gdl_clone_item.find('div.selected-image ul').sortable({ tolerance: 'pointer', forcePlaceholderSize: true, placeholder: 'slider-placeholder', cancel: '.slider-detail-wrapper' });

		//gdl_clone_item.css('display','block');
		
		// Remove unnecessary size
		gdl_clone_item.find("#page-option-item-testimonial-size, #page-option-item-portfolio-size, \
			#page-option-item-blog-size, #page-option-item-page-size").children("option").each(function(){
			var item_size = jQuery(this).html();
			
			if(item_size == "Widget Style"){
				item_size = 1/8;
			}else{
				item_size = parseInt(item_size.substr(0,1))  /  parseInt(item_size.substr(2,1));
			}
			
			if(gdl_item_size >= item_size){
				jQuery(this).css('display','block');
			}else{
				jQuery(this).css('display','none');
			}
		});
		
		gdl_inline.append(gdl_clone_item);
		
		// Open Process
		gdl_editbox.children().fadeIn(600);
		gdl_content.hide(function(){
			jQuery(this).css('position','absolute');
			jQuery(this).show();
		});
		
	}
	
	// manipulate the edited content and close editbox 
	function gdl_close_editbox(){
		var gdl_edited_item = gdl_inline.children().clone(true);
		if(gdl_edit_item){
			gdl_edit_item.html(gdl_edited_item);
		}
		gdl_clear_editbox();
	}
	
	// clear the editbox variables and internal content
	function gdl_clear_editbox(){
		gdl_content.hide(0, function(){
			gdl_content.css('position','relative');
			gdl_content.slideDown(600);
			gdl_editbox.children().fadeOut( function(){
				gdl_inline.children().remove();
				gdl_edit_item = '';
				gdl_clone_item = '';
				gdl_clicked_item = '';
			});
		});
	}

	jQuery.fn.bindEditBox = function(){
		gdl_clicked_item = jQuery(this);
		gdl_open_editbox();
	}
});

// Fix the clone problem of <textarea> and <select> elements
(function (original) {
  jQuery.fn.clone = function () {
    var       result = original.apply (this, arguments),
        my_textareas = this.find('textarea, select'),
    result_textareas = result.find('textarea, select');

    for (var i = 0, l = my_textareas.length; i < l; ++i)
      jQuery(result_textareas[i]).val (jQuery(my_textareas[i]).val());

    return result;
  };
}) (jQuery.fn.clone);

