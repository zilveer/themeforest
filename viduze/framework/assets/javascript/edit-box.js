/**
 *	CrunchPress Edit Box File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the script of the editbox that create overlay over
 *	any elements and copy desired element to be showed in that overlay.
 *	---------------------------------------------------------------------
 */

jQuery(document).ready(function(){
	
	// initialize necessary variables
	var cp_div_wrapper = jQuery('#cp-overlay-wrapper');
	var cp_edit_box_elements = {
		editbox: '<div id="cp-edit-box">\
					<div id="cp-overlay"></div>\
					<div id="cp-overlay2"></div>\
					<div id="cp-inline-wrapper">\
						<div class="cp-inline-header">\
							<div class="cp-inline-header-wrapper">\
								<div class="cp-inline-header-inner-wrapper" >\
									<div class="cp-inline-header-text"> EDITOR </div>\
									<div id="cp-head-edit-img" class="cp-head-edit-img"></div>\
								</div>\
							</div>\
							<div id="close-cp-edit-box"></div>\
						</div>\
						<div id="cp-inline"></div>\
						<div class="cp-inline-footer">\
							<input type="button" value="Done" id="cp-inline-edit-done" class="cp-button">\
							<br class="clear">\
						</div>\
					</div>\
				</div>',
		opacity: 0.42
	};
	cp_div_wrapper.append(cp_edit_box_elements.editbox);
	
	var cp_editbox = cp_div_wrapper.find('#cp-edit-box');
	var cp_content = cp_editbox.siblings('#cp-overlay-content');
	var cp_overlay = cp_editbox.find('#cp-overlay');
	var cp_inline = cp_editbox.find('#cp-inline');
	var cp_clicked_item = '';
	var cp_item_size = '';
	var cp_edit_item = '';
	var cp_clone_item = '';
	
	// bind the initialize elements
	cp_editbox.children().css('display','none');
	cp_overlay.css('opacity',cp_edit_box_elements.opacity);
	jQuery('#close-cp-edit-box').click(function(){
		cp_close_editbox();
	});
	jQuery('#cp-inline-edit-done').click(function(){
		cp_close_editbox(); 
	});	
	jQuery('div[rel="cp-edit-box"]').click(function(){
		cp_clicked_item = jQuery(this);
		cp_item_size = cp_clicked_item.parents('#page-element-item').find('#element-size-text').html();
		cp_item_size = parseInt(cp_item_size.substr(0,1))  /  parseInt(cp_item_size.substr(2,1));
		cp_open_editbox();
	});
	jQuery('input#publish[name="save"]').click(function(){
		cp_close_editbox();
	});
	
	// copy the content and open the edit box to use
	function cp_open_editbox(){
		clicked_id = cp_clicked_item.attr('id');
		cp_edit_item = cp_clicked_item.parents('#page-element-item').siblings('#' + clicked_id);
		cp_clone_item = cp_edit_item.children().clone(true);
		
		var li_cloned = cp_clone_item.find('div.selected-image ul').children().clone(true);
		li_cloned = jQuery('<ul></ul>').append(li_cloned);
		cp_clone_item.find('div.selected-image ul').replaceWith(li_cloned)
		cp_clone_item.find('div.selected-image ul').sortable({ tolerance: 'pointer', forcePlaceholderSize: true, placeholder: 'slider-placeholder', cancel: '.slider-detail-wrapper' });

		//cp_clone_item.css('display','block');
		
		// Remove unnecessary size
		cp_clone_item.find("#page-option-item-testimonial-size, #page-option-item-portfolio-size, \
			#page-option-item-blog-size, #page-option-item-page-size").children("option").each(function(){
			var item_size = jQuery(this).html();
			
			if(item_size == "Widget Style"){
				item_size = 1/8;
			}else{
				item_size = parseInt(item_size.substr(0,1))  /  parseInt(item_size.substr(2,1));
			}
			
			if(cp_item_size >= item_size){
				jQuery(this).css('display','block');
			}else{
				jQuery(this).css('display','none');
			}
		});
		
		cp_inline.append(cp_clone_item);
		
		// Open Process
		cp_editbox.children().fadeIn(600);
		cp_content.hide(function(){
			jQuery(this).css('position','absolute');
			jQuery(this).show();
		});
		
	}
	
	// manipulate the edited content and close editbox 
	function cp_close_editbox(){
		var cp_edited_item = cp_inline.children().clone(true);
		if(cp_edit_item){
			cp_edit_item.html(cp_edited_item);
		}
		cp_clear_editbox();
	}
	
	// clear the editbox variables and internal content
	function cp_clear_editbox(){
		cp_content.hide(0, function(){
			cp_content.css('position','relative');
			cp_content.slideDown(600);
			cp_editbox.children().fadeOut( function(){
				cp_inline.children().remove();
				cp_edit_item = '';
				cp_clone_item = '';
				cp_clicked_item = '';
			});
		});
	}

	jQuery.fn.bindEditBox = function(){
		cp_clicked_item = jQuery(this);
		cp_open_editbox();
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

