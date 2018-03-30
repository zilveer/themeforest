<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Post Type Shortcode Popup
 * Created by CMSMasters
 * 
 */
 
header('Content-type:text/html; charset=utf-8');


define('DOING_AJAX', true);
define('WP_ADMIN', true);


require_once('../../../../../../../../wp-load.php');
require_once('../../../../../../../../wp-admin/includes/admin.php');


do_action('admin_init');


if (!is_user_logged_in()) {
	die(__('You must be logged in to access this page.', 'cmsmasters'));
}


if (isset($_POST['index']) && $_POST['index'] != '') {
	$index = explode('|', $_POST['index']);
} else {
	$index = ''; 
}


if (isset($_POST['content']) && $_POST['content'] != '') {
	$content = urldecode(stripslashes($_POST['content']));
	
	
	preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
	
	
	$pairs = $pairs[0];
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	$post = array();
	
	
	foreach($pairs as $pair) {
		$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
		
		
		$post[$atr[0]] = $atr[1];
	}
} else {
	$content = ''; 
}

?>
<script type="text/javascript">
	jQuery(document).ready(function () { 
		jQuery(window).resize(function () { 
			if (jQuery('#TB_window').height() - 44 > jQuery('.popup_content').height() + 20) {
				jQuery('#TB_ajaxContent').height(jQuery('#TB_window').height() - 44);
			} else {
				jQuery('#TB_ajaxContent').height(jQuery('.popup_content').height() + 20);
			}
		} );
		
		
		if (jQuery('#post_type_val').val() !== 'testimonial') {
			jQuery('#post_content_check').closest('tr').show();
		}
		
		if (jQuery('#post_type_val').val() !== 'post') {
			jQuery('#post_info_check').closest('tr').show();
			jQuery('#post_slide_check').closest('tr').show();
		}
		
		if (jQuery('#post_type_val').val() == 'post') {
			jQuery('#post_link_check').closest('tr').show();
		}
		
		
		
		if (jQuery('#post_link_check').is(':checked')) {
			jQuery('#post_link_text').closest('tr').show();
			jQuery('#post_link_address').closest('tr').show();
		} else {
			jQuery('#post_link_text').closest('tr').hide();
			jQuery('#post_link_address').closest('tr').hide();
		}
		
		
		jQuery('#post_link_check').change(function () { 
			if (jQuery('#post_link_check').is(':checked')) {
				jQuery('#post_link_text').closest('tr').show();
				jQuery('#post_link_address').closest('tr').show();
			} else {
				jQuery('#post_link_text').closest('tr').hide();
				jQuery('#post_link_address').closest('tr').hide();
			}
		} );
		
		
		
		if (jQuery('#post_sort').val() === 'category') {
			if (jQuery('#post_type_val').val() === 'post') {
				jQuery('#post_cat').closest('tr').show();
			} else if (jQuery('#post_type_val').val() === 'project') {
				jQuery('#project_cat').closest('tr').show();
			} else if (jQuery('#post_type_val').val() === 'testimonial') {
				jQuery('#testimonial_cat').closest('tr').show();
			}
		}
		
		
		jQuery('#post_type_val').change(function () { 
			if (jQuery(this).val() === 'post') {
				jQuery('#post_content_check').closest('tr').show();
				jQuery('#post_info_check').closest('tr').hide();
				jQuery('#post_slide_check').closest('tr').hide();
				jQuery('#post_link_check').closest('tr').show();
				
				
				if (jQuery('#post_sort').val() === 'category') {
					jQuery('#project_cat').closest('tr').hide();
					
					jQuery('#testimonial_cat').closest('tr').hide();
					
					
					jQuery('#post_cat').closest('tr').show();
				}
				
				
				if (jQuery('#post_link_check').is(':checked')) {
					jQuery('#post_link_text').closest('tr').show();
					jQuery('#post_link_address').closest('tr').show();
				} else {
					jQuery('#post_link_text').closest('tr').hide();
					jQuery('#post_link_address').closest('tr').hide();
				}
			} else if (jQuery(this).val() === 'project') {
				jQuery('#post_content_check').closest('tr').show();
				jQuery('#post_info_check').closest('tr').show();
				jQuery('#post_slide_check').closest('tr').show();
				jQuery('#post_link_check').closest('tr').hide();
				jQuery('#post_link_text').closest('tr').hide();
				jQuery('#post_link_address').closest('tr').hide();
				
				
				if (jQuery('#post_sort').val() === 'category') {
					jQuery('#post_cat').closest('tr').hide();
					
					jQuery('#testimonial_cat').closest('tr').hide();
					
					
					jQuery('#project_cat').closest('tr').show();
				}
			} else if (jQuery(this).val() === 'testimonial') {
				jQuery('#post_content_check').closest('tr').hide();
				jQuery('#post_info_check').closest('tr').show();
				jQuery('#post_slide_check').closest('tr').show();
				jQuery('#post_link_check').closest('tr').hide();
				jQuery('#post_link_text').closest('tr').hide();
				jQuery('#post_link_address').closest('tr').hide();
				
				
				if (jQuery('#post_sort').val() === 'category') {
					jQuery('#post_cat').closest('tr').hide();
					
					jQuery('#project_cat').closest('tr').hide();
					
					
					jQuery('#testimonial_cat').closest('tr').show();
				}
			}
		} );
		
		
		jQuery('#post_sort').change(function () { 
			if (jQuery(this).val() === 'category') {
				if (jQuery('#post_type_val').val() === 'post') {
					jQuery('#project_cat').closest('tr').hide();
					
					jQuery('#testimonial_cat').closest('tr').hide();
					
					
					jQuery('#post_cat').closest('tr').show();
				} else if (jQuery('#post_type_val').val() === 'project') {
					jQuery('#post_cat').closest('tr').hide();
					
					jQuery('#testimonial_cat').closest('tr').hide();
					
					
					jQuery('#project_cat').closest('tr').show();
				} else if (jQuery('#post_type_val').val() === 'testimonial') {
					jQuery('#post_cat').closest('tr').hide();
					
					jQuery('#project_cat').closest('tr').hide();
					
					
					jQuery('#testimonial_cat').closest('tr').show();
				}
			} else {
				jQuery('#post_cat').closest('tr').hide();
				
				jQuery('#project_cat').closest('tr').hide();
				
				jQuery('#testimonial_cat').closest('tr').hide();
			}
		} );
	} );
	
	
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				post_type_title = jQuery('#post_type_title').val(), 
				post_type_val = jQuery('#post_type_val').val(), 
				post_sort = jQuery('#post_sort').val(), 
				post_cat = jQuery('#post_cat').val(), 
				project_cat = jQuery('#project_cat').val(), 
				testimonial_cat = jQuery('#testimonial_cat').val(), 
				post_number = jQuery('#post_number').val(), 
				post_slide_check = jQuery('#post_slide_check'), 
				post_image_check = jQuery('#post_image_check'), 
				post_content_check = jQuery('#post_content_check'), 
				post_info_check = jQuery('#post_info_check'), 
				post_link_check = jQuery('#post_link_check'), 
				post_link_text = jQuery('#post_link_text').val(), 
				post_link_address = jQuery('#post_link_address').val();
			
			
			for (var i = 0, ilength = popup_tr_value.length; i < ilength; i += 1) {
				popup_tr_value[i].style.removeProperty('border');
				
				
				if (popup_tr_value.eq(i).attr('aria-required') === 'true' && popup_tr_value.eq(i).parent().parent().css('display') !== 'none') {
					if (popup_tr_value.eq(i).val() === '' || popup_tr_value.eq(i).val() === ' ') {
						alert('<?php _e('Enter required fields!', 'cmsmasters'); ?>');
						
						
						popup_tr_value.eq(i).css('border', '1px solid #ff0000').focus();
						
						
						return false;
					}
				}
			}
			
			
			shortcode_tag += '[posttype post_type="' + post_type_val + '" post_sort="' + post_sort + '"';
			
			if (post_type_title != '') {
				shortcode_tag += ' post_title="' + post_type_title + '"';
			}
			
			if (post_sort === 'category') {
				if (post_type_val === 'post' && post_cat !== '') {
					shortcode_tag += ' post_category="' + post_cat + '"';
				} else if (post_type_val === 'project' && project_cat !== '') {
					shortcode_tag += ' post_category="' + project_cat + '"';
				} else if (post_type_val === 'testimonial' && testimonial_cat !== '') {
					shortcode_tag += ' post_category="' + testimonial_cat + '"';
				} else if ( 
					(post_type_val === 'post' && post_cat === '') || 
					(post_type_val === 'project' && project_cat === '') || 
					(post_type_val === 'testimonial' && testimonial_cat === '') 
				) {
					alert('<?php _e('Error! Choose another posts sorting.', 'cmsmasters'); ?>');
					
					
					jQuery('#post_sort').css('border', '1px solid #ff0000').focus();
					
					
					return false;
				}
			}
			
			
			shortcode_tag += ' post_number="' + post_number + '"';
			
			
			if (post_slide_check.is(':checked')) {
				shortcode_tag += ' post_slide="' + post_slide_check.val() + '"';
			} else {
				shortcode_tag += ' post_slide="false"';
			}
			
			
			if (post_image_check.is(':checked')) {
				shortcode_tag += ' show_images="' + post_image_check.val() + '"';
			} else {
				shortcode_tag += ' show_images="false"';
			}
			
			
			if (post_info_check.is(':checked')) {
				shortcode_tag += ' show_info="' + post_info_check.val() + '"';
			} else {
				shortcode_tag += ' show_info="false"';
			}
			
			
			if (post_type_val !== 'testimonial') {
				if (post_content_check.is(':checked')) {
					shortcode_tag += ' show_content="' + post_content_check.val() + '"';
				} else {
					shortcode_tag += ' show_content="false"';
				}
			} else {
				shortcode_tag += ' show_content="true"';
			}
			
			
			if (post_type_val == 'post') {
				if (post_link_check.is(':checked')) {
					shortcode_tag += ' show_post_link="' + post_link_check.val() + '"';
				} else {
					shortcode_tag += ' show_post_link="false"';
				}
				
				if (post_link_text != '' && post_link_address !='') {
					shortcode_tag += ' post_link_text="' + post_link_text + '" post_link_address="' + post_link_address + '"';
				}
			}
			
			
			shortcode_tag += ']';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			tb_remove();
		}
		
		
		return false;
	}
	
	
	function popupUpdateContent(shortcode_tag) { 
		var newValDivs = jQuery('#cmsms_composer_content > div'), 
			newPostContent = '';
		
		
		newValDivs.eq(<?php echo $index[0]; ?>).find('.cmsms_composer_column_elements > div:eq(<?php echo $index[1]; ?>) > .cmsms_composer_column_content').html(shortcode_tag);
		
		
		for (var i = 0, ilength = newValDivs.length; i < ilength; i += 1) {
			var cClass = newValDivs.eq(i).attr('class'), 
				cFolder = (newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-folder')) ? newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-folder') : 'column', 
				cType = (newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-type')) ? newValDivs.eq(i).find('> .cmsms_composer_column_elements').attr('data-type') : '', 
				cElements = newValDivs.eq(i).find('> .cmsms_composer_column_elements > div'), 
				newPostElementContent = '';
			
			
			if (cFolder !== 'divider' && cElements.length > 0) {
				for (var j = 0, jlength = cElements.length; j < jlength; j += 1) {
					var ceFolder = (cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-folder')) ? cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-folder') : 'column', 
						ceType = (cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-type')) ? cElements.eq(j).find('> .cmsms_composer_column_content').attr('data-type') : '', 
						ceContent = cElements.eq(j).find('> .cmsms_composer_column_content').html();
					
					
					newPostElementContent += '<div data-folder="' + ceFolder + '" data-type="' + ceType + '">' + ceContent + '</div>';
				}
			}
			
			
			if (cFolder !== 'divider') {
				newPostContent += '<div class="' + cClass + '" data-folder="' + cFolder + '" data-type="' + cType + '">' + newPostElementContent + '</div>';
			} else {
				newPostContent += '<div class="' + cClass + '" data-folder="' + cFolder + '" data-type="' + cType + '">' + '<div class="' + ((cType === 'divider') ? 'divider' : 'cl') + '"></div>' + '</div>';
			}
		}
		
		
		jQuery('#cmsms_content_composer_text').text(encodeURIComponent(newPostContent));
	}
	
	
	function closePopup() { 
		tb_remove();
		
		
		return false;
	}
</script>
<div class="popup_content">
	<h3 class="media-title"><?php echo __('Set', 'cmsmasters') . ' ' . __('Post Types', 'cmsmasters') . ' ' . __('Shortcode Options', 'cmsmasters'); ?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_type_title"><?php _e('Title', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $post['post_title']) ? $post['post_title'] : ''; ?>" name="post_type_title" id="post_type_title" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_type_val"><?php _e('Posts Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="post_type_val" id="post_type_val" aria-required="true" class="popup_tr_value">
								<option value="post"<?php echo ($content != '' && $post['post_type'] && $post['post_type'] == 'post') ? ' selected="selected"' : ''; ?>><?php _e('Blog Posts', 'cmsmasters'); ?>&nbsp;</option>
								<option value="project"<?php echo ($content != '' && $post['post_type'] && $post['post_type'] == 'project') ? ' selected="selected"' : ''; ?>><?php _e('Portfolio Projects', 'cmsmasters'); ?>&nbsp;</option>
								<option value="testimonial"<?php echo ($content != '' && $post['post_type'] && $post['post_type'] == 'testimonial') ? ' selected="selected"' : ''; ?>><?php _e('Testimonials', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_sort"><?php _e('Posts Sorting', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="post_sort" id="post_sort" aria-required="true" class="popup_tr_value">
								<option value="latest"<?php echo ($content != '' && $post['post_sort'] && $post['post_sort'] == 'latest') ? ' selected="selected"' : ''; ?>><?php _e('Latest', 'cmsmasters'); ?>&nbsp;</option>
								<option value="popular"<?php echo ($content != '' && $post['post_sort'] && $post['post_sort'] == 'popular') ? ' selected="selected"' : ''; ?>><?php _e('Popular', 'cmsmasters'); ?>&nbsp;</option>
								<option value="category"<?php echo ($content != '' && $post['post_sort'] && $post['post_sort'] == 'category') ? ' selected="selected"' : ''; ?>><?php _e('Category', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_cat"><?php _e('Posts Category', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
					<?php 
						$categs = get_categories('orderby=name&hide_empty=0');
						
						if (sizeof($categs) > 0) {
							echo '<select name="post_cat" id="post_cat" aria-required="true" class="popup_tr_value">';
							
							foreach ($categs as $categ) {
								if ($content != '' && $post['post_sort'] == 'category' && $post['post_category'] && $post['post_category'] == $categ->slug) {
									echo '<option value="' . $categ->slug . '" selected="selected">' . $categ->name . '&nbsp;</option>';
								} else {
									echo '<option value="' . $categ->slug . '">' . $categ->name . '&nbsp;</option>';
								}
							}
							
							echo '</select>';
						} else {
							echo '<p id="post_cat" class="help" style="padding-top:7px;">' . __('You need to create posts category before using this sorting type', 'cmsmasters') . '</p>';
						}
					?>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="project_cat"><?php _e('Projects Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
					<?php 
						$pj_categs = get_terms('pj-categs', 'orderby=name&hide_empty=0');
						
						if (sizeof($pj_categs) > 0) {
							echo '<select name="project_cat" id="project_cat" aria-required="true" class="popup_tr_value">';
							
							foreach($pj_categs as $pj_categ) {
								if ($content != '' && $post['post_sort'] == 'category' && $post['post_category'] && $post['post_category'] == $pj_categ->slug) {
									echo '<option value="' . $pj_categ->slug . '" selected="selected">' . $pj_categ->name . '&nbsp;</option>';
								} else {
									echo '<option value="' . $pj_categ->slug . '">' . $pj_categ->name . '&nbsp;</option>';
								}
							}
							
							echo '</select>';
						} else {
							echo '<p id="project_cat" class="help" style="padding-top:7px;">' . __('You need to create project type before using this sorting type', 'cmsmasters') . '</p>';
						}
					?>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="testimonial_cat"><?php _e('Testimonials Cat.', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
					<?php 
						$tl_categs = get_terms('tl-categs', 'orderby=name&hide_empty=0');
						
						if (sizeof($tl_categs) > 0) {
							echo '<select name="testimonial_cat" id="testimonial_cat" aria-required="true" class="popup_tr_value">';
							
							foreach($tl_categs as $tl_categ) {
								if ($content != '' && $post['post_sort'] == 'category' && $post['post_category'] && $post['post_category'] == $tl_categ->slug) {
									echo '<option value="' . $tl_categ->slug . '" selected="selected">' . $tl_categ->name . '&nbsp;</option>';
								} else {
									echo '<option value="' . $tl_categ->slug . '">' . $tl_categ->name . '&nbsp;</option>';
								}
							}
							
							echo '</select>';
						} else {
							echo '<p id="testimonial_cat" class="help" style="padding-top:7px;">' . __('You need to create testimonials category before using this sorting type', 'cmsmasters') . '</p>';
						}
					?>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_number"><?php _e('Posts Number', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $post['post_number']) ? $post['post_number'] : '4'; ?>" name="post_number" id="post_number" aria-required="true" class="popup_tr_value" style="width:45px;" />
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_slide_check"><?php _e('Sliding', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="post_slide_check" id="post_slide_check" class="popup_tr_value"<?php echo ($content != '') ? (($post['post_slide'] && $post['post_slide'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="post_slide_check"><?php _e('Show posts as slider', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_image_check"><?php _e('Posts Images', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="post_image_check" id="post_image_check" class="popup_tr_value"<?php echo ($content != '') ? (($post['show_images'] && $post['show_images'] == 'true') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="post_image_check"><?php _e('Show posts featured images', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_info_check"><?php _e('Posts Additionals', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="post_info_check" id="post_info_check" class="popup_tr_value"<?php echo ($content != '') ? (($post['show_info'] && $post['show_info'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="post_info_check"><?php _e('Show posts additional information', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_content_check"><?php _e('Posts Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="post_content_check" id="post_content_check" class="popup_tr_value"<?php echo ($content != '') ? (($post['show_content'] && $post['show_content'] == 'true') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="post_content_check"><?php _e('Show posts content', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_link_check"><?php _e('Posts Link', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="post_link_check" id="post_link_check" class="popup_tr_value"<?php echo ($content != '') ? (($post['show_post_link'] && $post['show_post_link'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="post_link_check"><?php _e('Show posts link', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_link_text"><?php _e('Posts link text', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $post['post_link_text']) ? $post['post_link_text'] : ''; ?>" name="post_link_text" id="post_link_text" class="popup_tr_value" />
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="post_link_address"><?php _e('Posts link address', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $post['post_link_address']) ? $post['post_link_address'] : ''; ?>" name="post_link_address" id="post_link_address" class="popup_tr_value" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="cmsms_shcs_buttons">
		<div class="fl">
			<input type="button" id="cancel" class="button" name="cancel" value="<?php _e('Cancel', 'cmsmasters'); ?>" onclick="closePopup();" />
		</div>
		<div class="fr">
			<input type="submit" id="insert" class="button-primary" name="insert" value="<?php _e('Update Shortcode', 'cmsmasters'); ?>" onclick="insertShortcode();" />
		</div>
	</div>
</div>

