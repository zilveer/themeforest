/**
 *	Goodlayers Page Dragging File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		Goodlayers
 * 	@link		http://goodlayers.com
 * 	@copyright	Copyright (c) Goodlayers
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script for Page Dragging
 *	---------------------------------------------------------------------
 */
 
jQuery(document).ready(function(){ 

	// All of size that div can be (text, class, value)
	var DIV_SIZE = [
		['1/4','element1-4',1/4,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Price-Item']],
		['1/3','element1-3',1/3,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Price-Item']],
		['1/2','element1-2',1/2,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Price-Item']],
		['2/3','element2-3',2/3,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Price-Item']],
		['3/4','element3-4',3/4,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Price-Item']],
		['1/1','element1-1',1,['Column','Content','Blog','Page','Post-Slider','Portfolio','Testimonial','Slider','Accordion','Tab','Divider','Message-Box','Toggle-Box','Column-Service','Stunning-Text','Contact-Form','Price-Item']]
	];
	
	var page_item_list = jQuery("#page-element-lists");
	var page_methodology = jQuery('#page-methodology');
	var page_alignment_val = '';
	
	//bind select radio-image
	jQuery('.radio-image-wrapper input').change(function(){
		jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
		jQuery(this).siblings("label").children("#check-list").addClass("check-list");
	})
	jQuery('.radio-image-wrapper input:checked').each(function(){
		jQuery(this).triggerHandler("change");
	});	
	
	//Bind sidebar template option
	jQuery('input[name="page-option-sidebar-template"]').change(function(){
		//jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
		//jQuery(this).siblings("label").children("#check-list").addClass("check-list");
		if(jQuery(this).val() == "left-sidebar"){
			jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
			jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideUp();
		}else if(jQuery(this).val() == "right-sidebar"){ 
			jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideUp();
			jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();		
		}else if(jQuery(this).val() == "both-sidebar"){
			jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideDown();
			jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideDown();		
		}else{
			jQuery("#page-option-choose-left-sidebar").parents(".meta-body").slideUp();
			jQuery("#page-option-choose-right-sidebar").parents(".meta-body").slideUp();		
		}
	});
	jQuery('input[name="page-option-sidebar-template"]:checked').triggerHandler("change");
	
	// Change the style of <select>
	if (!jQuery.browser.opera) {
        jQuery('.meta-input .combobox select').each(function(){
            var title = jQuery(this).attr('title');
            if( jQuery('option:selected', this).val() != ''  ) title = jQuery('option:selected',this).text();
            jQuery(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span rel="combobox">' + title + '</span>')
                .change(function(){
                    val = jQuery('option:selected',this).text();
                    jQuery(this).next().text(val);
                    })
        });
    };
	
	//Bind the delete element button
	var init_object = jQuery("div#gdl-overlay-wrapper");
	init_object.find(".delete-element").click(function(){
	
		var deleted_element = jQuery(this).parents('#page-element');
	
		jQuery.confirm({
			'message'	: 'Are you sure to do this?',
			'buttons'	: {
				'Delete'	: {
					'class'	: 'confirm-yes',
					'action': function(){
						deleted_element.fadeOut( function(){jQuery(this).remove();} );
					}
				},
				'Cancel'	: {
					'class'	: 'confirm-no',
					'action': function(){ return false; }
				}
			}
		});
	});
	
	//Add Element Size
	init_object.find(".add-element-size").click(function(){
		jQuery(this).gdlPageAddElementSize();
	});
	jQuery.fn.gdlPageAddElementSize = function(){
		var click_object = jQuery(this).parents('#page-element');
		var object_type = click_object.attr('rel');
		var is_upper_style = false;
		var current_style = '';
		for(var i=0; i<DIV_SIZE.length-1; i++){
			if(click_object.hasClass(DIV_SIZE[i][1])){ 
				is_upper_style = true; 
				current_style = DIV_SIZE[i][1];
			}
			if( is_upper_style && jQuery.inArray(object_type,DIV_SIZE[i+1][3]) > -1){
				if( i < DIV_SIZE.length-2 ){
					click_object.removeClass(current_style).addClass(DIV_SIZE[i+1][1]);
					click_object.find("#element-size-text").html(DIV_SIZE[i+1][0]);
					click_object.find("#page-option-item-size").val(DIV_SIZE[i+1][1])
				}else if( i == DIV_SIZE.length-2){
					click_object.removeClass(current_style).addClass(DIV_SIZE[i+1][1]);
					click_object.find("#element-size-text").html(DIV_SIZE[i+1][0]);
					click_object.find("#page-option-item-size").val(DIV_SIZE[i+1][1])
				}
				break;
			}
		}
	}
	
	//Subtract Element size
	init_object.find(".sub-element-size").click(function(){
		jQuery(this).gdlPageSubElementSize();
	});
	jQuery.fn.gdlPageSubElementSize = function(){
		var click_object = jQuery(this).parents('#page-element');
		var object_type = click_object.attr('rel');
		var is_lower_style = false;
		var current_style = '';
		for(var i=DIV_SIZE.length-1; i > 0; i--){
			if( click_object.hasClass(DIV_SIZE[i][1]) ){ 
				is_lower_style = true; 
				current_style = DIV_SIZE[i][1];
			}
			if( is_lower_style && jQuery.inArray(object_type, DIV_SIZE[i-1][3]) > -1){
				if( i > 1 ){
					click_object.removeClass(current_style).addClass(DIV_SIZE[i-1][1]);
					click_object.find("#element-size-text").html(DIV_SIZE[i-1][0]);
					click_object.find("#page-option-item-size").val(DIV_SIZE[i-1][1])
				}else if( i == 1){
					click_object.removeClass(current_style).addClass(DIV_SIZE[i-1][1]);
					click_object.find("#element-size-text").html(DIV_SIZE[i-1][0]);
					click_object.find("#page-option-item-size").val(DIV_SIZE[i-1][1])
				}
				break;
			}
		}
	}
	
	//Bind Add Items
	jQuery("input#page-add-item-button").click(function(){
		var selectd_list = jQuery(this).siblings(".page-select-element-list-wrapper").children("select");
		var clone_item = page_item_list.find('div[rel="' + selectd_list.val() + '"]').clone(true);
		if( clone_item ){
			clone_item.find("#page-option-item-size").attr('name',function(){
				return jQuery(this).attr('id')+ '[]';
			});
			clone_item.find("#page-option-item-type").attr('name',function(){
				return jQuery(this).attr('id')+ '[]';
			});
			clone_item.css("display","none");
			page_methodology.find("#page-selected-elements").append(clone_item);
			page_methodology.find(".page-element").fadeIn();
		}
	});
	page_methodology.find("#page-selected-elements").sortable({ forcePlaceholderSize: true, placeholder: 'placeholder' });
	
	// Button effects;
	jQuery(".add-element-size").hover(function(){
		jQuery(this).addClass("add-element-size-hover");
	},function(){
		jQuery(this).removeClass("add-element-size-hover");
	});
	jQuery(".sub-element-size").hover(function(){
		jQuery(this).addClass("sub-element-size-hover");
	},function(){
		jQuery(this).removeClass("sub-element-size-hover");
	});
	
	// Tab chooser
	jQuery('.page-item-tab').css('display','block');
	jQuery(".page-tab-add-more").click(function(){
		var added_tab = jQuery(this).siblings(".meta-input").children("#added-tab");
		var clone_tab = added_tab.find(".default").clone(true);
		clone_tab.attr('class','page-item-tab');
		clone_tab.find('input, textarea, select').attr('name', function(){
			return jQuery(this).attr('id') + '[]';
		});
		added_tab.siblings("#tab-num").val(function(){
			return parseInt(jQuery(this).val()) + 1;
		});
		added_tab.children("ul").append(clone_tab);
		added_tab.find('.page-item-tab').slideDown();
		
	});
	jQuery(".unpick-tab").click(function(){
		var deleted_tab = jQuery(this);
		
		jQuery.confirm({
			'message'	: 'Are you sure to do this?',
			'buttons'	: {
				'Delete'	: {
					'class'	: 'confirm-yes',
					'action': function(){
						deleted_tab.parents('#page-item-tab').slideUp(function(){
							jQuery(this).remove();
						});
						deleted_tab.parents("#added-tab").siblings("#tab-num").val(function(){
							return parseInt(jQuery(this).val()) - 1;
						});
					}
				},
				'Cancel'	: {
					'class'	: 'confirm-no',
					'action': function(){ return false; }
				}
			}
		});
	});

	// Blog slideshow
	jQuery('select#page-option-item-blog-size').change(function(){
		var selected_val = jQuery(this).val();
		if( selected_val == '1/1 Blog Slide Show' ){
			jQuery(this).parents('.meta-body').siblings('.meta-body').find('#page-option-item-blog-slideshow-title,\
			#page-option-item-blog-slideshow-image-type').each(function(){
				jQuery(this).parents('.meta-body').slideDown();
			});
		}else{
			jQuery(this).parents('.meta-body').siblings('.meta-body').find('#page-option-item-blog-slideshow-title,\
			#page-option-item-blog-slideshow-image-type').each(function(){
				jQuery(this).parents('.meta-body').slideUp();
			});
		}
	});
	jQuery('select#page-option-item-blog-size').each(function(){
		var selected_val = jQuery(this).val();
		if( selected_val == '1/1 Blog Slide Show' ){
			jQuery(this).parents('.meta-body').siblings('.meta-body').find('#page-option-item-blog-slideshow-title,\
			#page-option-item-blog-slideshow-image-type').each(function(){
				jQuery(this).parents('.meta-body').css('display', 'block');
			});
		}else{
			jQuery(this).parents('.meta-body').siblings('.meta-body').find('#page-option-item-blog-slideshow-title,\
			#page-option-item-blog-slideshow-image-type').each(function(){
				jQuery(this).parents('.meta-body').css('display','none');
			});
		}
	});	
	
	// Link type of slider
	jQuery("select#page-option-item-slider-linktype, select#page-option-top-slider-linktype").change(function(){
		var selected_val = jQuery(this).val();
		if(selected_val == 'No Link' ||  selected_val == 'Lightbox'){
			jQuery(this).parent().siblings('div').slideUp();
		}else{
			if(selected_val == 'Link to URL'){
				jQuery(this).parent().siblings('div').not('[rel="video"]').slideDown();
				jQuery(this).parent().siblings('div[rel="video"]').slideUp();
			}else{
				jQuery(this).parent().siblings('div').not('[rel="url"]').slideDown();
				jQuery(this).parent().siblings('div[rel="url"]').slideUp();
			}
		}
	});
	jQuery('select#page-option-item-slider-linktype, select#page-option-top-slider-linktype').each(function(){
		var selected_val = jQuery(this).val();
		if(selected_val == 'No Link' ||  selected_val == 'Lightbox'){
			jQuery(this).parent().siblings('div').css('display','none');
		}else{
			if(selected_val == 'Link to URL'){
				jQuery(this).parent().siblings('div').not('[rel="video"]').css('display','block');
				jQuery(this).parent().siblings('div[rel="video"]').css('display','none');
			}else{
				jQuery(this).parent().siblings('div').not('[rel="url"]').css('display','block');
				jQuery(this).parent().siblings('div[rel="url"]').css('display','none');
			}
		}
	});
	
	// Upload Image
	jQuery("input#upload_image_text_meta").change(function(){
		jQuery(this).siblings("input[type='hidden']").val(jQuery(this).val());
	});
	jQuery('input:button.upload_image_button_meta').click(function() {
		example_image =  jQuery(this).siblings("#meta-input-example-image");
		upload_text = jQuery(this).siblings("#upload_image_text_meta");
		attachment_id = jQuery(this).siblings("#upload_image_attachment_id");
		tb_show('Upload Media', 'media-upload.php?post_id=&type=image&amp;TB_iframe=true');
		window.send_to_editor = function(html){
			image_url = jQuery(html).attr('href');
			thumb_url = jQuery('img',html).attr('src');
			attid = jQuery(html).attr('attid');
			
			upload_text.val(image_url);
			attachment_id.val(attid);
			example_image.html('<img src=' + thumb_url + ' />');
			tb_remove();
		}
		return false;
	});
	
	// Testimonial Option
	jQuery("div.combobox #page-option-item-testimonial-display-type").change(function(){
		var gdl_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
		var gdl_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
		if(jQuery(this).val() == 'Testimonial Category'){
			gdl_specific.parents(".meta-body").slideUp();
			gdl_category.parents(".meta-body").slideDown();	
		}else{
			gdl_category.parents(".meta-body").slideUp();
			gdl_specific.parents(".meta-body").slideDown();
		}
	});
	jQuery("div.combobox #page-option-item-testimonial-display-type").each(function(){
		var gdl_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
		var gdl_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
		if(jQuery(this).val() == 'Testimonial Category'){
			gdl_specific.parents(".meta-body").css('display','none');
			gdl_category.parents(".meta-body").css('display','block');	
		}else{
			gdl_category.parents(".meta-body").css('display','none');
			gdl_specific.parents(".meta-body").css('display','block');
		}
	});
	
	// Bind No Top Slider
	jQuery('select#page-option-top-slider-types').change(function(){
		
		if(jQuery(this).val()=='No Slider'){
			jQuery(this).parents('.meta-body').next('.meta-body').slideUp();
			jQuery(this).parents('.meta-body').siblings('.meta-body.image-picker-wrapper').slideUp();
		}else{
			jQuery(this).parents('.meta-body').next('.meta-body').slideDown();
			jQuery(this).parents('.meta-body').siblings('.meta-body.image-picker-wrapper').slideDown();
		}
	});
	jQuery('select#page-option-top-slider-types').each(function(){
		if(jQuery(this).val()=='No Slider'){
			jQuery(this).parents('.meta-body').next('.meta-body').css('display','none');
			jQuery(this).parents('.meta-body').siblings('.meta-body.image-picker-wrapper').css('display','none');
		}else{
			jQuery(this).parents('.meta-body').next('.meta-body').css('display','block');
			jQuery(this).parents('.meta-body').siblings('.meta-body.image-picker-wrapper').css('display','block');
		}
	});
	
	// Page Template Choose
	jQuery("#page_template").change(function(){
		if(jQuery(this).val() == 'page-sitemap.php'){
			jQuery("#page-option").slideUp();
		}else{
			jQuery("#page-option").slideDown();
		}
	});
	
});