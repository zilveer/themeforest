<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Information Box Shortcodes Script
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


if (isset($_POST['type']) && $_POST['type'] != '') {
	$type = $_POST['type'];
} else {
	$type = ''; 
}


if (isset($_POST['content']) && $_POST['content'] != '') {
	$content = urldecode(stripslashes($_POST['content']));
	
	
	preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
	
	
	$pairs = $pairs[0];
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	if ($type == 'block') {
		$block = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$block[$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[featured_block(?:\s*.*)\](.+)\[\/featured_block\]$/";
	} else if ($type == 'color') {
		$color = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$color[$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[colored_block\s.+\](.+)\[\/colored_block\]$/";
	} else {
		$box = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$box[$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[info_box\s.+\](.+)\[\/info_box\]$/";
	}
	
	
	preg_match($pattern, $content, $matches);
} else {
	$content = ''; 
}

?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#cb_glow').wpColorPicker();
		
		
		jQuery(window).resize(function () {
			if (jQuery('#TB_window').height() - 44 > jQuery('.popup_content').height() + 20) {
				jQuery('#TB_ajaxContent').height(jQuery('#TB_window').height() - 44);
			} else {
				jQuery('#TB_ajaxContent').height(jQuery('.popup_content').height() + 20);
			}
		} );
		
		
		jQuery('#TB_closeWindowButton, #TB_overlay').bind('click', function () { 
			closePopup();
		} );
		
		
<?php if ($type == 'block') { ?>
		if (jQuery('#fb_add_button').is(':checked')) {
			jQuery('#fb_button_text').parent().parent().show();
			
			jQuery('#fb_button_link').parent().parent().show();
			
			jQuery('#fb_icon').parent().parent().show();
			
			jQuery('#fb_button_target').parent().parent().show();
		}
		
		
		jQuery('#fb_add_button').bind('change', function () {
			if (jQuery(this).is(':checked')) {
				jQuery('#fb_button_text').parent().parent().show();
				
				jQuery('#fb_button_link').parent().parent().show();
				
				jQuery('#fb_icon').parent().parent().show();
				
				jQuery('#fb_button_target').parent().parent().show();
			} else {
				jQuery('#fb_button_text').parent().parent().hide();
				
				jQuery('#fb_button_link').parent().parent().hide();
				
				jQuery('#fb_icon').parent().parent().hide();
				
				jQuery('#fb_button_target').parent().parent().hide();
			}
		} );
<?php } ?>
} );

<?php if ($type == 'block') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.get('column_content').save();
			}
			
			
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				column_content = jQuery('#column_content').val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>'), 
				fb_icon = jQuery('#fb_icon').val(), 
				fb_add_button = jQuery('#fb_add_button'), 
				fb_button_text = jQuery('#fb_button_text').val(), 
				fb_button_link = jQuery('#fb_button_link').val(), 
				fb_button_target = jQuery('#fb_button_target');
			
			
			for (var i = 0, ilength = popup_tr_value.length; i < ilength; i += 1) {
				popup_tr_value[i].style.removeProperty('border');
				
				
				if (popup_tr_value.eq(i).attr('aria-required') === 'true' && fb_add_button.is(':checked')) {
					if (popup_tr_value.eq(i).val() === '' || popup_tr_value.eq(i).val() === ' ') {
						alert('<?php _e('Enter required fields!', 'cmsmasters'); ?>');
						
						
						popup_tr_value.eq(i).css('border', '1px solid #ff0000').focus();
						
						
						return false;
					}
				}
			}
			
			
			shortcode_tag += "[featured_block";
			
			
			if (fb_add_button.is(':checked')) {
				shortcode_tag += " button=\"true\" buttonicon=\"" + fb_icon + "\" buttontext=\"" + fb_button_text + "\" buttonlink=\"" + fb_button_link + "\"";
				
				if (fb_button_target.is(':checked')) {
					shortcode_tag += " target=\"" + fb_button_target.val() + "\"";
				}
			}
			
			
			shortcode_tag += "]" + ((jQuery('#wp-column_content-wrap').hasClass('tmce-active')) ? tinyMCE.get('column_content').getContent() : column_content) + "[/featured_block]";
			
			
			popupUpdateContent(shortcode_tag);
			
			
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } else if ($type == 'color') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.get('column_content').save();
			}
			
			
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				column_content = jQuery('#column_content').val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>'), 
				cb_glow = jQuery('#cb_glow').val();
			
			
			for (var i = 0, ilength = popup_tr_value.length; i < ilength; i += 1) {
				popup_tr_value[i].style.removeProperty('border');
				
				
				if (popup_tr_value.eq(i).attr('aria-required') === 'true') {
					if (popup_tr_value.eq(i).val() === '' || popup_tr_value.eq(i).val() === ' ') {
						alert('<?php _e('Enter required fields!', 'cmsmasters'); ?>');
						
						
						popup_tr_value.eq(i).css('border', '1px solid #ff0000').focus();
						
						
						return false;
					}
				}
			}
			
			
			shortcode_tag += "[colored_block bgcolor=\"" + cb_glow + "\"]" + ((jQuery('#wp-column_content-wrap').hasClass('tmce-active')) ? tinyMCE.get('column_content').getContent() : column_content) + "[/colored_block]";
			
			
			popupUpdateContent(shortcode_tag);
			
			
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } else { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.get('column_content').save();
			}
			
			
			var shortcode_tag = '', 
				box_type = jQuery('#box_type').val(), 
				column_content = jQuery('#column_content').val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>');
			
			
			shortcode_tag += "[info_box box_type=\"" + box_type + "\"]" + ((jQuery('#wp-column_content-wrap').hasClass('tmce-active')) ? tinyMCE.get('column_content').getContent() : column_content) + "[/info_box]";
			
			
			popupUpdateContent(shortcode_tag);
			
			
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } ?>
	
	
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
		if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
			tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
		}
		
		
		tb_remove();
		
		
		return false;
	}
</script>
<div class="popup_content">
	<h3 class="media-title"><?php 
		echo __('Set', 'cmsmasters') . ' ';
		
		if ($type == 'block') {
			_e('Featured Block', 'cmsmasters');
		} else if ($type == 'color') {
			_e('Colored Block', 'cmsmasters');
		} else {
			_e('Box', 'cmsmasters');
		}
		
		echo ' ' . __('Shortcode Options', 'cmsmasters'); 
	?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
			<?php if ($type == 'block') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Block Text', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor($matches[1], 'column_content', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols" id="table_cols" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows" id="table_rows" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head" id="table_head" class="popup_tr_value_inner" />
							<label for="table_head"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot" id="table_foot" class="popup_tr_value_inner" />
							<label for="table_foot"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table" class="button" name="cancel_custom_table" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table" class="button" name="insert_custom_table" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text" id="button_text" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link" id="button_link" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type" id="button_type" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target" id="button_target" class="popup_tr_value_inner" />
							<label for="button_target"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox" id="button_lightbox" class="popup_tr_value_inner" />
							<label for="button_lightbox"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button" class="button" name="cancel_custom_button" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button" class="button" name="insert_custom_button" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="fb_add_button"><?php _e('Button', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="fb_add_button" id="fb_add_button"<?php echo ($content != '') ? (($block['button'] && $block['button'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="fb_add_button"><?php _e('Show button', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="fb_button_text"><?php _e('Button Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $block['buttontext']) ? $block['buttontext'] : ''; ?>" name="fb_button_text" id="fb_button_text" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="fb_button_link"><?php _e('Button Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $block['buttonlink']) ? $block['buttonlink'] : ''; ?>" name="fb_button_link" id="fb_button_link" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="fb_icon"><?php _e('Button Icon', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="fb_icon" id="fb_icon">
								<option value="up"<?php echo ($content != '' && $block['buttonicon'] && $block['buttonicon'] == 'up') ? ' selected="selected"' : ''; ?>><?php _e('Up', 'cmsmasters'); ?></option>
								<option value="right"<?php echo ($content != '' && $block['buttonicon'] && $block['buttonicon'] == 'right') ? ' selected="selected"' : ''; ?>><?php _e('Right', 'cmsmasters'); ?></option>
								<option value="down"<?php echo ($content != '' && $block['buttonicon'] && $block['buttonicon'] == 'down') ? ' selected="selected"' : ''; ?>><?php _e('Down', 'cmsmasters'); ?></option>
								<option value="left"<?php echo ($content != '' && $block['buttonicon'] && $block['buttonicon'] == 'left') ? ' selected="selected"' : ''; ?>><?php _e('Left', 'cmsmasters'); ?></option>
							</select>
						</td>
					</tr>
					<tr style="display:none;">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="fb_button_target"><?php _e('Button Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="fb_button_target" id="fb_button_target"<?php echo ($content != '') ? (($block['target'] && $block['target'] == '_blank') ? ' checked="checked"' : '') : ''; ?> />
							<label for="fb_button_target"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
			<?php } else if ($type == 'color') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Block Text', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor($matches[1], 'column_content', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols" id="table_cols" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows" id="table_rows" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head" id="table_head" class="popup_tr_value_inner" />
							<label for="table_head"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot" id="table_foot" class="popup_tr_value_inner" />
							<label for="table_foot"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table" class="button" name="cancel_custom_table" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table" class="button" name="insert_custom_table" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text" id="button_text" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link" id="button_link" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type" id="button_type" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target" id="button_target" class="popup_tr_value_inner" />
							<label for="button_target"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox" id="button_lightbox" class="popup_tr_value_inner" />
							<label for="button_lightbox"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button" class="button" name="cancel_custom_button" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button" class="button" name="insert_custom_button" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="cb_glow"><?php _e('Block Color', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $color['bgcolor']) ? $color['bgcolor'] : '#313131'; ?>" name="cb_glow" id="cb_glow" class="popup_tr_value my-color-field" aria-required="true" data-default-color="#313131" />
						</td>
					</tr>
			<?php } else { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="box_type"><?php _e('Box Type', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="box_type" id="box_type">
								<option value="success"<?php echo ($content != '' && $box['box_type'] && $box['box_type'] == 'success') ? ' selected="selected"' : ''; ?>><?php _e('Success', 'cmsmasters'); ?></option>
								<option value="error"<?php echo ($content != '' && $box['box_type'] && $box['box_type'] == 'error') ? ' selected="selected"' : ''; ?>><?php _e('Error', 'cmsmasters'); ?></option>
								<option value="notice"<?php echo ($content != '' && $box['box_type'] && $box['box_type'] == 'notice') ? ' selected="selected"' : ''; ?>><?php _e('Notice', 'cmsmasters'); ?></option>
								<option value="warning"<?php echo ($content != '' && $box['box_type'] && $box['box_type'] == 'warning') ? ' selected="selected"' : ''; ?>><?php _e('Warning', 'cmsmasters'); ?></option>
								<option value="download"<?php echo ($content != '' && $box['box_type'] && $box['box_type'] == 'download') ? ' selected="selected"' : ''; ?>><?php _e('Download', 'cmsmasters'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Box Text', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor($matches[1], 'column_content', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols" id="table_cols" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows" id="table_rows" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head" id="table_head" class="popup_tr_value_inner" />
							<label for="table_head"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot" id="table_foot" class="popup_tr_value_inner" />
							<label for="table_foot"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table" class="button" name="cancel_custom_table" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table" class="button" name="insert_custom_table" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text" id="button_text" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link" id="button_link" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type" id="button_type" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target" id="button_target" class="popup_tr_value_inner" />
							<label for="button_target"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox" id="button_lightbox" class="popup_tr_value_inner" />
							<label for="button_lightbox"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button" class="button" name="cancel_custom_button" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button" class="button" name="insert_custom_button" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
			<?php } ?>
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
<script type="text/javascript">
	jQuery(document).ready(function () { 
		if (jQuery('#wp-content-wrap').hasClass('html-active')) {
			switchEditors.go('content', 'tmce');
		}
		
		
		tinyMCE.execCommand('mceAddEditor', true, 'column_content');
		
		
		jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.wp-switch-editor').removeAttr('onclick');
		
		
		var addButCont = jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.wp-switch-editor').parent();
		
		
		addButCont.append('<a href="#" class="button custom_upload_image_button">' + 
			'<span class="wp-media-buttons-icon"></span> <?php _e('Add Media', 'cmsmasters'); ?>' + 
		'</a>');
		addButCont.append('<a href="#" class="button custom_dropcap1_button" title="<?php _e('Dropcap 1', 'cmsmasters'); ?>"><?php _e('Dropcap 1', 'cmsmasters'); ?></a>');
		addButCont.append('<a href="#" class="button custom_dropcap2_button" title="<?php _e('Dropcap 2', 'cmsmasters'); ?>"><?php _e('Dropcap 2', 'cmsmasters'); ?></a>');
		addButCont.append('<a href="#" class="button custom_button_button" title="<?php _e('Button', 'cmsmasters'); ?>"><?php _e('Button', 'cmsmasters'); ?></a>');
		addButCont.append('<a href="#" class="button custom_table_button" title="<?php _e('Table', 'cmsmasters'); ?>"><?php _e('Table', 'cmsmasters'); ?></a>');
		
		
		addButCont.find('> a.custom_dropcap1_button').bind('click', function () { 
			if (tinyMCE.activeEditor.selection.getContent()) {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap">' + tinyMCE.activeEditor.selection.getContent() + '</span>');
			} else {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap">A</span>');
			}
			
			
			return false;
		} );
		
		
		addButCont.find('> a.custom_dropcap2_button').bind('click', function () { 
			if (tinyMCE.activeEditor.selection.getContent()) {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap2">' + tinyMCE.activeEditor.selection.getContent() + '</span>');
			} else {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap2">A</span>');
			}
			
			
			return false;
		} );
		
		
		addButCont.find('> a.custom_button_button').bind('click', function () { 
			jQuery('table.describe tr.custom_table_button_field').hide();
			
			
			jQuery('table.describe tr.custom_button_button_field').show();
			
			
			if (tinyMCE.activeEditor.selection.getContent()) {
				jQuery('#button_text').val(tinyMCE.activeEditor.selection.getContent());
			}
			
			
			return false;
		} );
		
		jQuery('#insert_custom_button').bind('click', function () { 
			var shortcode_tag = '', 
				but_text = jQuery('#button_text').val(), 
				but_link = jQuery('#button_link').val(), 
				but_type = jQuery('#button_type').val(), 
				but_target = jQuery('#button_target'), 
				but_lightbox = jQuery('#button_lightbox');
			
			
			shortcode_tag += '<a href="' + but_link + '" class="' + but_type;
			
			
			if (but_lightbox.is(':checked')) {
				shortcode_tag += ' jackbox';
			}
			
			
			shortcode_tag += '" alt="' + but_text + '"';
			
			
			if (but_target.is(':checked')) {
				shortcode_tag += ' target="' + but_target.val() + '"';
			}
			
			
			if (but_lightbox.is(':checked')) {
				var uniq = 'but_' + (new Date()).getTime();
				
				
				shortcode_tag += ' data-group="' + uniq + '"';
			}
			
			
			shortcode_tag += '>' + but_text + '</a>';
			
			
			tinyMCE.activeEditor.selection.setContent(shortcode_tag);
			
			
			jQuery('table.describe tr.custom_button_button_field').hide();
			
			
			jQuery('#button_text').val('');
			jQuery('#button_link').val('');
			jQuery('#button_type').val('button');
			jQuery('#button_target').prop('checked', false);
			jQuery('#button_lightbox').prop('checked', false);
			
			
			return false;
		} );
		
		jQuery('#cancel_custom_button').bind('click', function () { 
			jQuery('table.describe tr.custom_button_button_field').hide();
			
			
			jQuery('#button_text').val('');
			jQuery('#button_link').val('');
			jQuery('#button_type').val('button');
			jQuery('#button_target').prop('checked', false);
			jQuery('#button_lightbox').prop('checked', false);
			
			
			return false;
		} );
		
		
		addButCont.find('> a.custom_table_button').bind('click', function () { 
			jQuery('table.describe tr.custom_button_button_field').hide();
			
			
			jQuery('table.describe tr.custom_table_button_field').show();
			
			
			return false;
		} );
		
		jQuery('#insert_custom_table').bind('click', function () { 
			var shortcode_tag = '', 
				table_cols = jQuery('#table_cols').val(), 
				table_rows = jQuery('#table_rows').val(), 
				table_head = jQuery('#table_head'), 
				table_foot = jQuery('#table_foot');
			
			
			shortcode_tag += '<table class="table">' + "\n";
			
			
			if (table_head.is(':checked')) {
				var n = 1;
				
				
				shortcode_tag += '<thead>' + 
					'<tr>' + "\n";
				
				
				for (var i = 0; i < table_cols; i += 1) {
					shortcode_tag += '<th><?php _e('Header', 'cmsmasters'); ?> ' + n + '</th>' + "\n";
					
					
					n += 1;
				}
				
				
				shortcode_tag += '</tr>' + 
				'</thead>' + "\n";
			}
			
			
			shortcode_tag += '<tbody>' + "\n";
			
			
			for (var i = 0; i < table_rows; i += 1) {
				var k = 1;
				
				
				shortcode_tag += '<tr>' + "\n";
				
				
				for (var j = 0; j < table_cols; j += 1) {
					shortcode_tag += '<td><?php _e('Division', 'cmsmasters'); ?> ' + k + '</td>' + "\n";
					
					
					k += 1;
				}
				
				
				shortcode_tag += '</tr>' + "\n";
			}
			
			
			shortcode_tag += '</tbody>' + "\n";
			
			
			if (table_foot.is(':checked')) {
				var m = 1;
				
				
				shortcode_tag += '<tfoot>' + 
					'<tr>' + "\n";
				
				
				for (var i = 0; i < table_cols; i += 1) {
					shortcode_tag += '<th><?php _e('Footer', 'cmsmasters'); ?> ' + m + '</th>' + "\n";
					
					
					m += 1;
				}
				
				
				shortcode_tag += '</tr>' + 
				'</tfoot>' + "\n";
			}
			
			
			shortcode_tag += '</table>' + "\n\n";
			
			
			tinyMCE.activeEditor.selection.setContent(shortcode_tag);
			
			
			jQuery('table.describe tr.custom_table_button_field').hide();
			
			
			jQuery('#table_cols').val(4);
			jQuery('#table_rows').val(3);
			jQuery('#table_head').prop('checked', false);
			jQuery('#table_foot').prop('checked', false);
			
			
			return false;
		} );
		
		jQuery('#cancel_custom_table').bind('click', function () { 
			jQuery('table.describe tr.custom_table_button_field').hide();
			
			
			jQuery('#table_cols').val(4);
			jQuery('#table_rows').val(3);
			jQuery('#table_head').prop('checked', false);
			jQuery('#table_foot').prop('checked', false);
			
			
			return false;
		} );
		
		
		if (jQuery('#wp-column_content-wrap').hasClass('html-active')) {
			jQuery('#wp-column_content-wrap').removeClass('html-active').addClass('tmce-active');
		}
		
		
		jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.switch-tmce').bind('click', function () { 
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
			
			
			var valContent = jQuery(this).closest('.wp-column_content-container-wrap').find('textarea#column_content').val(), 
				val = switchEditors.wpautop(valContent);
			
			
			jQuery('textarea#column_content').val(val);
			
			
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_upload_image_button').show();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_dropcap1_button').show();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_dropcap2_button').show();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_button_button').show();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_table_button').show();
			
			
			tinyMCE.execCommand('mceAddEditor', true, 'column_content');
		} );
		
		
		jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.switch-html').bind('click', function () { 
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
			
			
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_upload_image_button').hide();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_dropcap1_button').hide();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_dropcap2_button').hide();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_button_button').hide();
			jQuery('#column_content').closest('.wp-column_content-container-wrap').find('a.custom_table_button').hide();
			
			
			tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
		} );
		
		
		if (jQuery('#column_content_toolbar2').css('display') !== 'none') {
			jQuery('#column_content_toolbar3').show();
			
			
			jQuery('#column_content_wp_adv').addClass('mceButtonActive');
		}
	} );
</script>

