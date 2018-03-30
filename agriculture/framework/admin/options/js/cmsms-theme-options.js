/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Post, Page, Project & Testimonial Options Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	/* Options Tabs Change */
	jQuery('h4.nav-tab-wrapper a.nav-tab').bind('click', function () { 
		if (jQuery(this).is(':not(.nav-tab-active)')) {
			jQuery(this).parent().find('a.nav-tab.nav-tab-active').removeClass('nav-tab-active');
			jQuery(this).parent().parent().find('div.nav-tab-content.nav-tab-content-active').hide();
			jQuery(this).addClass('nav-tab-active').parent().parent().find('div' + jQuery(this).attr('href')).addClass('nav-tab-content-active').show();
		}
		
		return false;
	} );
	
	
	
	/* Default Image Button Click */
	jQuery('.custom_clear_image_button').bind('click', function () {
		var stdImage = jQuery(this).parent().siblings('.custom_std_image').text(), 
			defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		
		jQuery(this).parent().siblings('.custom_upload_image').val((defaultImage !== stdImage) ? defaultImage : '');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		
		return false;
	} );
	
	
	
	/* Remove Image Button Click */
	jQuery('.custom_remove_image_button').bind('click', function () {
		var stdImage = jQuery(this).parent().siblings('.custom_std_image').text();
		
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', stdImage);
		
		return false;
	} );
	
	
	
	/* Repeatable Add Button Click */
	jQuery('.repeatable-add').bind('click', function () { 
		var field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true), 
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		
		jQuery('input', field).val('').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		if ( 
			field.attr('style') !== undefined && 
			field.attr('style') !== '' && 
			(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
		) {
			field.removeAttr('style');
			
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
			
			jQuery(this).closest('td').find('.custom_repeatable li:first').remove();
		} else {
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		}
		
		return false;
	} );
	
	
	/* Repeatable Link Add Button Click */
	jQuery('.repeatable-link-add').bind('click', function () { 
		var select_name = jQuery(this).prev().find('option:selected').text(), 
			select_link = jQuery(this).prev().val(), 
			field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true), 
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		
		jQuery('input.cmsms_name', field).val((select_link !== '') ? select_name : '').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		jQuery('input.cmsms_link', field).val((select_link !== '') ? select_link : '').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		if ( 
			field.attr('style') !== undefined && 
			field.attr('style') !== '' && 
			(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
		) {
			field.removeAttr('style');
			
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
			
			jQuery(this).closest('td').find('.custom_repeatable li:first').remove();
		} else {
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		}
		
		return false;
	} );
	
	
	/* Repeatable Multiple Add Button Click */
	jQuery('.repeatable-multiple-add').bind('click', function () { 
		var field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true), 
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		
		jQuery('input.cmsms_name', field).val('').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		jQuery('textarea.cmsms_val', field).val('').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		if ( 
			field.attr('style') !== undefined && 
			field.attr('style') !== '' && 
			(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
		) {
			field.removeAttr('style');
			
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
			
			jQuery(this).closest('td').find('.custom_repeatable li:first').remove();
		} else {
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		}
		
		return false;
	} );
	
	
	/* Repeatable Media Add Button Click */
	jQuery('.repeatable-media-add').bind('click', function () { 
		var select_format = jQuery(this).prev().val(), 
			field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true), 
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		
		if (select_format === '') {
			alert('Please select the format.');
			
			return false;
		}
		
		for (var i = 0, ilength = jQuery(this).closest('td').find('.custom_repeatable li').length; i < ilength; i += 1) {
			if (jQuery(this).closest('td').find('.custom_repeatable li:eq(' + i + ')').find('input.cmsms_format').val() === select_format) {
				alert('Link with this format already exists.');
				
				return false;
			}
		}
		
		jQuery('input.cmsms_format', field).val(select_format).attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		jQuery('input.cmsms_link', field).val('').attr('name', function (index, name) { 
			return name.replace(/(\d+)/, function (fullMatch, n) { 
				return Number(n) + 1;
			} );
		} );
		
		if ( 
			field.attr('style') !== undefined && 
			field.attr('style') !== '' && 
			(field.attr('style') === 'display:none;' || field.attr('style') === 'display: none;') 
		) {
			field.removeAttr('style');
			
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
			
			jQuery(this).closest('td').find('.custom_repeatable li:first').remove();
		} else {
			field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		}
		
		return false;
	} );
	
	
	/* Repeatable Remove Button Click */
	jQuery('.repeatable-remove').bind('click', function () {
		if (confirm('Do you realy want to remove this item?')) {
			if (jQuery(this).parent().prev().is('li') || jQuery(this).parent().next().is('li')) {
				jQuery(this).parent().remove();
			} else {
				jQuery(this).parent().css( { 
					display : 'none' 
				} );
				
				jQuery(this).prev().val('');
				
				if (jQuery(this).prev().prev().is('input')) {
					jQuery(this).prev().prev().val('');
				}
			}
		}
		
		return false;
	} );
	
	/* Repeatable Sorting Script */
	jQuery('.custom_repeatable').sortable( { 
		opacity : 0.7, 
		revert : true, 
		cursor : 'move', 
		handle : '.sort' 
	} );
	
	
	
	/* Heading Icon Choose Script */
	jQuery('.cmsms_heading_icons_list .cmsms_heading_icon a').bind('click', function () { 
		if (jQuery(this).parent().is(':not(.selected)')) {
			var heading_icon = jQuery(this).attr('href');
			
			jQuery(this).parent().parent().find('.cmsms_heading_icon.selected').removeClass('selected');
			jQuery(this).parent().parent().prev().val(heading_icon);
			jQuery(this).parent().addClass('selected');
		}
		
		return false;
	} );
	
	/* Heading Icon Cancel Script */
	jQuery('a.cmsms_heading_icons_cancel').bind('click', function () { 
		jQuery(this).closest('tr').find('input[type="hidden"]').val('');
		
		
		jQuery(this).closest('tr').find('ul.cmsms_heading_icons_list > li.cmsms_heading_icon.selected').removeClass('selected');
		
		
		return false;
	} );
	
	
	
	/* Images List Click Script */
	jQuery('.gallery_post_image_list').delegate('a', 'click', function () { 
		return false;
	} );
	
	/* Remove Images from Images List Script */
	jQuery('.gallery_post_image_list').delegate('a span', 'click', function () { 
		jQuery(this).closest('li').remove();
		
		
		cmsmsOptionsUploadIdsUpdate();
		
		
		return false;
	} );
	
	/* Images List Sorting Script */
	jQuery('.gallery_post_image_list').sortable( { 
		items : 'li', 
		placeholder : 'ui-selected-list-highlight', 
		opacity : 0.7, 
		cursor : 'move', 
		stop : function (event, ui) { 
			cmsmsOptionsUploadIdsUpdate();
		} 
	} );
	
	
	
	/* Project Size Change Script */
	jQuery('.cmsms_tr_radio_img_pj input[type="radio"]').bind('change', function () { 
		var pj_size = jQuery(this).attr('data-size');
		
		
		jQuery(this).closest('tr.cmsms_tr_radio_img_pj').find('span.description > strong.pj_size').text(pj_size);
		
		
		return false;
	} );
} );



/* Update Media Uploader Images ID's Function */
function cmsmsOptionsUploadIdsUpdate() { 
	var href_array = '';
	
	
	jQuery('ul.gallery_post_image_list > li').each(function () { 
		href_array += jQuery(this).find('> a').attr('href') + ',';
	} );
	
	
	jQuery('ul.gallery_post_image_list').next().val(href_array.slice(0, -1));
}

