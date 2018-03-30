<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Tab Shortcodes Popup
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
	$type = 'tab'; 
}


if (isset($_POST['content']) && $_POST['content'] != '') {
	$content = str_replace("\n", '', $_POST['content']);
} else {
	$content = ''; 
}


if ($type == 'tab' && $content != '') {
	$content = str_replace('] [', ']|, |[', str_replace('[tabs] ', '', str_replace(' [/tabs]', '', urldecode(stripslashes($_POST['content'])))));
	
	
	$shortcode_array = explode('|, |', $content);
	
	
	$tabs = array();
	
	
	$matches = array();
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$tabs[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[tab\s.+\](.+)\[\/tab\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
} else if ($type == 'toggle' && $content != '') {
	$content = str_replace('[accordion] ', '', str_replace(' [/accordion]', '', urldecode(stripslashes($_POST['content'])), $counter));
	
	$content = str_replace('[toggles] ', '', str_replace(' [/toggles]', '', $content));
	
	$content = str_replace('] [', ']|, |[', $content);
	
	
	$shortcode_array = explode('|, |', $content);
	
	
	$toggles = array();
	
	
	$matches = array();
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$toggles[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[toggle\s.+\](.+)\[\/toggle\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
} else if ($type == 'tour' && $content != '') {
	$content = str_replace('] [', ']|, |[', str_replace('[tour] ', '', str_replace(' [/tour]', '', urldecode(stripslashes($_POST['content'])))));
	
	
	$shortcode_array = explode('|, |', $content);
	
	
	$tabs = array();
	
	
	$matches = array();
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$tabs[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[tab\s.+\](.+)\[\/tab\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
}

?>
<script type="text/javascript">
	jQuery(window).load(function () {
		if (jQuery('.mceEditor.wp_themeSkin .mceToolbar.mceToolbarRow2:eq(-1)').css('display') !== 'none') {
			jQuery('.mceEditor.wp_themeSkin .mceToolbar.mceToolbarRow3:eq(-1)').show();
			
			
			jQuery('.mceEditor.wp_themeSkin a.mce_wp_adv:eq(-1)').addClass('mceButtonActive');
		}
	} );
	
	
	jQuery(document).ready(function () { 
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
		
		
		jQuery('.add_tab').delegate('#add_tab', 'click', function () { 
			var tr = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]'), 
				i = Number(tr.eq(tr.length - 1).attr('id').substr(-1, 1)) + 1, 
				html = '';
			
			
			html = '<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">' + 
				'<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>' + 
				'<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">' + 
					'<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #' + (i + 1) + '</p>' + 
					'<span class="alignright">' + 
						'<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>' + 
					'</span>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="tab_label' + i + '"><?php _e('Tab Label', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="tab_label' + i + '" id="tab_label' + i + '" aria-required="true" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="column_content' + i + '"><?php _e('Tab Content', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<div id="wp-column_content' + i + '-editor-container-wrap" class="wp-column_content' + i + '-container-wrap">' + 
						'<div class="wp-core-ui wp-editor-wrap tmce-active" id="wp-column_content' + i + '-wrap">' + 
							'<div class="wp-editor-tools hide-if-no-js" id="wp-column_content' + i + '-editor-tools">' + 
								'<a onclick="switchEditors.switchto(this);" class="wp-switch-editor switch-html" id="column_content' + i + '-html">Text</a>' + 
								'<a onclick="switchEditors.switchto(this);" class="wp-switch-editor switch-tmce" id="column_content' + i + '-tmce">Visual</a>' + 
							'</div>' + 
							'<div class="wp-editor-container" id="wp-column_content' + i + '-editor-container">' + 
								'<textarea id="column_content' + i + '" name="column_content' + i + '" cols="40" rows="10" class="wp-editor-area"></textarea>' + 
							'</div>' + 
						'</div>' + 
					'</div>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_cols' + i + '"><?php _e('Columns Count', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="4" name="table_cols' + i + '" id="table_cols' + i + '" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_rows' + i + '"><?php _e('Rows Count', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="3" name="table_rows' + i + '" id="table_rows' + i + '" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_head' + i + '"><?php _e('Table Header', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="table_head' + i + '" id="table_head' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="table_head' + i + '"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_foot' + i + '"><?php _e('Table Footer', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="table_foot' + i + '" id="table_foot' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="table_foot' + i + '"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">' + 
					'<input type="button" id="cancel_custom_table' + i + '" class="button" name="cancel_custom_table' + i + '" value="<?php _e('Cancel', 'cmsmasters'); ?>" />' + 
				'</td>' + 
				'<td class="field" style="text-align:right; padding:15px;">' + 
					'<input type="submit" id="insert_custom_table' + i + '" class="button" name="insert_custom_table' + i + '" value="<?php _e('Insert', 'cmsmasters'); ?>" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_text' + i + '"><?php _e('Text', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="button_text' + i + '" id="button_text' + i + '" aria-required="true" class="popup_tr_value_inner" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_link' + i + '"><?php _e('Link', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="button_link' + i + '" id="button_link' + i + '" aria-required="true" class="popup_tr_value_inner" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_type' + i + '"><?php _e('Type', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<select name="button_type' + i + '" id="button_type' + i + '" aria-required="true" class="popup_tr_value_inner">' + 
						'<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>' + 
						'<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>' + 
						'<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>' + 
					'</select>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_target' + i + '"><?php _e('Target', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="_blank" name="button_target' + i + '" id="button_target' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="button_target' + i + '"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_lightbox' + i + '"><?php _e('Lightbox', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="button_lightbox' + i + '" id="button_lightbox' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="button_lightbox' + i + '"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">' + 
					'<input type="button" id="cancel_custom_button' + i + '" class="button" name="cancel_custom_button' + i + '" value="<?php _e('Cancel', 'cmsmasters'); ?>" />' + 
				'</td>' + 
				'<td class="field" style="text-align:right; padding:15px;">' + 
					'<input type="submit" id="insert_custom_button' + i + '" class="button" name="insert_custom_button' + i + '" value="<?php _e('Insert', 'cmsmasters'); ?>" />' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_tab').before(html);
			
			
			editorStart(i);
		} );
		
		
		jQuery('.add_toggle').delegate('#add_toggle', 'click', function () { 
			var tr = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]'), 
				i = Number(tr.eq(tr.length - 1).attr('id').substr(-1, 1)) + 1, 
				html = '';
			
			
			html = '<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">' + 
				'<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>' + 
				'<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">' + 
					'<p style="padding:0;" class="help alignleft"><?php _e('Toggle', 'cmsmasters'); ?> #' + (i + 1) + '</p>' + 
					'<span class="alignright">' + 
						'<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>' + 
					'</span>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="toggle_label' + i + '"><?php _e('Toggle Label', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="toggle_label' + i + '" id="toggle_label' + i + '" aria-required="true" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="column_content' + i + '"><?php _e('Toggle Content', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<div id="wp-column_content' + i + '-editor-container-wrap" class="wp-column_content' + i + '-container-wrap">' + 
						'<div class="wp-core-ui wp-editor-wrap tmce-active" id="wp-column_content' + i + '-wrap">' + 
							'<div class="wp-editor-tools hide-if-no-js" id="wp-column_content' + i + '-editor-tools">' + 
								'<a onclick="switchEditors.switchto(this);" class="wp-switch-editor switch-html" id="column_content' + i + '-html">Text</a>' + 
								'<a onclick="switchEditors.switchto(this);" class="wp-switch-editor switch-tmce" id="column_content' + i + '-tmce">Visual</a>' + 
							'</div>' + 
							'<div class="wp-editor-container" id="wp-column_content' + i + '-editor-container">' + 
								'<textarea id="column_content' + i + '" name="column_content' + i + '" cols="40" rows="10" class="wp-editor-area"></textarea>' + 
							'</div>' + 
						'</div>' + 
					'</div>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_cols' + i + '"><?php _e('Columns Count', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="4" name="table_cols' + i + '" id="table_cols' + i + '" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_rows' + i + '"><?php _e('Rows Count', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="3" name="table_rows' + i + '" id="table_rows' + i + '" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_head' + i + '"><?php _e('Table Header', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="table_head' + i + '" id="table_head' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="table_head' + i + '"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="table_foot' + i + '"><?php _e('Table Footer', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="table_foot' + i + '" id="table_foot' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="table_foot' + i + '"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_table_button_field' + i + '">' + 
				'<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">' + 
					'<input type="button" id="cancel_custom_table' + i + '" class="button" name="cancel_custom_table' + i + '" value="<?php _e('Cancel', 'cmsmasters'); ?>" />' + 
				'</td>' + 
				'<td class="field" style="text-align:right; padding:15px;">' + 
					'<input type="submit" id="insert_custom_table' + i + '" class="button" name="insert_custom_table' + i + '" value="<?php _e('Insert', 'cmsmasters'); ?>" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_text' + i + '"><?php _e('Text', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="button_text' + i + '" id="button_text' + i + '" aria-required="true" class="popup_tr_value_inner" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_link' + i + '"><?php _e('Link', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="button_link' + i + '" id="button_link' + i + '" aria-required="true" class="popup_tr_value_inner" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_type' + i + '"><?php _e('Type', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<select name="button_type' + i + '" id="button_type' + i + '" aria-required="true" class="popup_tr_value_inner">' + 
						'<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>' + 
						'<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>' + 
						'<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>' + 
					'</select>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_target' + i + '"><?php _e('Target', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="_blank" name="button_target' + i + '" id="button_target' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="button_target' + i + '"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="button_lightbox' + i + '"><?php _e('Lightbox', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:15px;">' + 
					'<input type="checkbox" value="true" name="button_lightbox' + i + '" id="button_lightbox' + i + '" class="popup_tr_value_inner" />' + 
					'<label for="button_lightbox' + i + '"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>' + 
				'</td>' + 
			'</tr>' + 
			'<tr class="custom_composer_button_field custom_button_button_field' + i + '">' + 
				'<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">' + 
					'<input type="button" id="cancel_custom_button' + i + '" class="button" name="cancel_custom_button' + i + '" value="<?php _e('Cancel', 'cmsmasters'); ?>" />' + 
				'</td>' + 
				'<td class="field" style="text-align:right; padding:15px;">' + 
					'<input type="submit" id="insert_custom_button' + i + '" class="button" name="insert_custom_button' + i + '" value="<?php _e('Insert', 'cmsmasters'); ?>" />' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_toggle').before(html);
			
			
			editorStart(i);
		} );
		
		
		jQuery('.describe').delegate('.del_item_but', 'click', function () { 
			if (confirm('<?php echo ($type == 'toggle') ? __('Are you sure that you want to delete this toggle?', 'cmsmasters') : __('Are you sure that you want to delete this tab?', 'cmsmasters'); ?>')) {
				var contTextArea = jQuery(this).closest('tr').next().next().find('textarea[id^="column_content"]'), 
					contTextAreaID = contTextArea.attr('id');
				
				
				if (contTextArea.closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.execCommand('mceRemoveEditor', true, contTextAreaID);
				}
				
				
				jQuery(this).closest('tr').next().next().remove();
				jQuery(this).closest('tr').next().remove();
				jQuery(this).closest('tr').remove();
			}
			
			
			return false;
		} );
	} );
	
	
<?php if ($type == 'tab') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var contTextAreas = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]');
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.get(contTextAreaID).save();
				}
			}
			
			
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				tr = jQuery('#TB_ajaxContent table.describe > tbody > tr').not('.custom_composer_button_field');
			
			
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
			
			
			shortcode_tag += '[tabs] ';
			
			
			for (var i = 1, ilength = tr.length; i < ilength; i += 3) {
				var trTabTitle = tr.eq(i).find('.popup_tr_value').val(), 
					trTabText = tr.eq(i + 1).find('textarea.wp-editor-area');
				
				
				shortcode_tag += '[tab tab_title="' + trTabTitle + '"]' + 
					((jQuery('#wp-' + trTabText.attr('id') + '-wrap').hasClass('tmce-active')) ? tinyMCE.get(trTabText.attr('id')).getContent() : trTabText.val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>')) + 
				'[/tab] ';
			}
			
			
			shortcode_tag += '[/tabs]';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.execCommand('mceRemoveEditor', true, contTextAreaID);
				}
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } elseif ($type == 'toggle') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var contTextAreas = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]');
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.get(contTextAreaID).save();
				}
			}
			
			
			var shortcode_tag = '', 
				toggle_as_acc = jQuery('#toggle_as_acc'), 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				tr = jQuery('#TB_ajaxContent table.describe > tbody > tr').not('.custom_composer_button_field');
			
			
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
			
			
			if (toggle_as_acc.is(':checked')) {
				shortcode_tag += '[accordion] ';
			} else {
				shortcode_tag += '[toggles] ';
			}
			
			
			for (var i = 2, ilength = tr.length - 1; i < ilength; i += 3) {
				var trToggleTitle = tr.eq(i).find('.popup_tr_value').val(), 
					trToggleText = tr.eq(i + 1).find('textarea.wp-editor-area');
				
				
				shortcode_tag += '[toggle toggle_title="' + trToggleTitle + '"]' + 
					((jQuery('#wp-' + trToggleText.attr('id') + '-wrap').hasClass('tmce-active')) ? tinyMCE.get(trToggleText.attr('id')).getContent() : trToggleText.val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>')) + 
				'[/toggle] ';
			}
			
			
			if (toggle_as_acc.is(':checked')) {
				shortcode_tag += '[/accordion]';
			} else {
				shortcode_tag += '[/toggles]';
			}
			
			
			popupUpdateContent(shortcode_tag);
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.execCommand('mceRemoveEditor', true, contTextAreaID);
				}
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } elseif ($type == 'tour') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var contTextAreas = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]');
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.get(contTextAreaID).save();
				}
			}
			
			
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				tr = jQuery('#TB_ajaxContent table.describe > tbody > tr').not('.custom_composer_button_field');
			
			
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
			
			
			shortcode_tag += '[tour] ';
			
			
			for (var i = 1, ilength = tr.length; i < ilength; i += 3) {
				var trTabTitle = tr.eq(i).find('.popup_tr_value').val(), 
					trTabText = tr.eq(i + 1).find('textarea.wp-editor-area');
				
				
				shortcode_tag += '[tab tab_title="' + trTabTitle + '"]' + 
					((jQuery('#wp-' + trTabText.attr('id') + '-wrap').hasClass('tmce-active')) ? tinyMCE.get(trTabText.attr('id')).getContent() : trTabText.val().replace(/\n/g, '<br />').replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<(\/*)tr><br \/>/g, "<$1tr>").replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>')) + 
				'[/tab] ';
			}
			
			
			shortcode_tag += '[/tour]';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
				var contTextAreaID = contTextAreas.eq(i).attr('id');
				
				
				if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
					tinyMCE.execCommand('mceRemoveEditor', true, contTextAreaID);
				}
			}
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } ?>
	
	
	function editorStart(i) { 
		if (i === undefined) {
			i = '';
		}
		
		
		if (jQuery('#wp-content-wrap').hasClass('html-active')) {
			switchEditors.go('content', 'tmce');
		}
		
		
		tinyMCE.execCommand('mceAddEditor', true, 'column_content' + i);
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').removeAttr('onclick');
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().append('<a href="#" class="button custom_upload_image_button"><span class="wp-media-buttons-icon"></span> <?php _e('Add Media', 'cmsmasters'); ?></a>');
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().append('<a href="#" class="button custom_dropcap1_button" title="<?php _e('Dropcap 1', 'cmsmasters'); ?>"><?php _e('Dropcap 1', 'cmsmasters'); ?></a>');
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().append('<a href="#" class="button custom_dropcap2_button" title="<?php _e('Dropcap 2', 'cmsmasters'); ?>"><?php _e('Dropcap 2', 'cmsmasters'); ?></a>');
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().append('<a href="#" class="button custom_button_button" title="<?php _e('Button', 'cmsmasters'); ?>"><?php _e('Button', 'cmsmasters'); ?></a>');
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().append('<a href="#" class="button custom_table_button" title="<?php _e('Table', 'cmsmasters'); ?>"><?php _e('Table', 'cmsmasters'); ?></a>');
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().find('> a.custom_dropcap1_button').bind('click', function () { 
			if (tinyMCE.activeEditor.selection.getContent()) {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap">' + tinyMCE.activeEditor.selection.getContent() + '</span>');
			} else {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap">A</span>');
			}
			
			
			return false;
		} );
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().find('> a.custom_dropcap2_button').bind('click', function () { 
			if (tinyMCE.activeEditor.selection.getContent()) {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap2">' + tinyMCE.activeEditor.selection.getContent() + '</span>');
			} else {
				tinyMCE.activeEditor.selection.setContent('<span class="dropcap2">A</span>');
			}
			
			
			return false;
		} );
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().find('> a.custom_button_button').bind('click', function () { 
			jQuery('table.describe tr.custom_table_button_field' + i).hide();
			
			
			jQuery('table.describe tr.custom_button_button_field' + i).show();
			
			
			if (tinyMCE.activeEditor.selection.getContent()) {
				jQuery('#button_text' + i).val(tinyMCE.activeEditor.selection.getContent());
			}
			
			
			return false;
		} );
		
		jQuery('#insert_custom_button' + i).bind('click', function () { 
			var shortcode_tag = '';
			
			
			shortcode_tag += '<a href="' + jQuery('#button_link' + i).val() + '" class="' + jQuery('#button_type' + i).val();
			
			
			if (jQuery('#button_lightbox' + i).is(':checked')) {
				shortcode_tag += ' jackbox';
			}
			
			
			shortcode_tag += '" alt="' + jQuery('#button_text' + i).val() + '"';
			
			
			if (jQuery('#button_target' + i).is(':checked')) {
				shortcode_tag += ' target="' + jQuery('#button_target' + i).val() + '"';
			}
			
			
			if (jQuery('#button_lightbox' + i).is(':checked')) {
				var uniq = 'but_' + (new Date()).getTime();
				
				
				shortcode_tag += ' data-group="' + uniq + '"';
			}
			
			
			shortcode_tag += '>' + jQuery('#button_text' + i).val() + '</a>';
			
			
			tinyMCE.activeEditor.selection.setContent(shortcode_tag);
			
			
			jQuery('table.describe tr.custom_button_button_field' + i).hide();
			
			
			jQuery('#button_text' + i).val('');
			jQuery('#button_link' + i).val('');
			jQuery('#button_type' + i).val('button');
			jQuery('#button_target' + i).prop('checked', false);
			jQuery('#button_lightbox' + i).prop('checked', false);
			
			
			return false;
		} );
		
		jQuery('#cancel_custom_button' + i).bind('click', function () { 
			jQuery('table.describe tr.custom_button_button_field' + i).hide();
			
			
			jQuery('#button_text' + i).val('');
			jQuery('#button_link' + i).val('');
			jQuery('#button_type' + i).val('button');
			jQuery('#button_target' + i).prop('checked', false);
			jQuery('#button_lightbox' + i).prop('checked', false);
			
			
			return false;
		} );
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-switch-editor').parent().find('> a.custom_table_button').bind('click', function () { 
			jQuery('table.describe tr.custom_button_button_field' + i).hide();
			
			
			jQuery('table.describe tr.custom_table_button_field' + i).show();
			
			
			return false;
		} );
		
		jQuery('#insert_custom_table' + i).bind('click', function () { 
			var shortcode_tag = '';
			
			
			shortcode_tag += '<table class="table">' + "\n";
			
			
			if (jQuery('#table_head' + i).is(':checked')) {
				var n = 1;
				
				
				shortcode_tag += '<thead>' + 
					'<tr>' + "\n";
				
				
				for (var j = 0; j < jQuery('#table_cols' + i).val(); j += 1) {
					shortcode_tag += '<th><?php _e('Header', 'cmsmasters'); ?> ' + n + '</th>' + "\n";
					
					
					n += 1;
				}
				
				
				shortcode_tag += '</tr>' + 
				'</thead>' + "\n";
			}
			
			
			shortcode_tag += '<tbody>' + "\n";
			
			
			for (var j = 0; j < jQuery('#table_rows' + i).val(); j += 1) {
				var k = 1;
				
				
				shortcode_tag += '<tr>' + "\n";
				
				
				for (var p = 0; p < jQuery('#table_cols' + i).val(); p += 1) {
					shortcode_tag += '<td><?php _e('Division', 'cmsmasters'); ?> ' + k + '</td>' + "\n";
					
					
					k += 1;
				}
				
				
				shortcode_tag += '</tr>' + "\n";
			}
			
			
			shortcode_tag += '</tbody>' + "\n";
			
			
			if (jQuery('#table_foot' + i).is(':checked')) {
				var m = 1;
				
				
				shortcode_tag += '<tfoot>' + 
					'<tr>' + "\n";
				
				
				for (var j = 0; j < jQuery('#table_cols' + i).val(); j += 1) {
					shortcode_tag += '<th><?php _e('Footer', 'cmsmasters'); ?> ' + m + '</th>' + "\n";
					
					
					m += 1;
				}
				
				
				shortcode_tag += '</tr>' + 
				'</tfoot>' + "\n";
			}
			
			
			shortcode_tag += '</table>' + "\n\n";
			
			
			tinyMCE.activeEditor.selection.setContent(shortcode_tag);
			
			
			jQuery('table.describe tr.custom_table_button_field' + i).hide();
			
			
			jQuery('#table_cols' + i).val(4);
			jQuery('#table_rows' + i).val(3);
			jQuery('#table_head' + i).prop('checked', false);
			jQuery('#table_foot' + i).prop('checked', false);
			
			
			return false;
		} );
		
		jQuery('#cancel_custom_table' + i).bind('click', function () { 
			jQuery('table.describe tr.custom_table_button_field' + i).hide();
			
			
			jQuery('#table_cols' + i).val(4);
			jQuery('#table_rows' + i).val(3);
			jQuery('#table_head' + i).prop('checked', false);
			jQuery('#table_foot' + i).prop('checked', false);
			
			
			return false;
		} );
		
		
		if (jQuery('#wp-column_content' + i + '-wrap').hasClass('html-active')) {
			jQuery('#wp-column_content' + i + '-wrap').removeClass('html-active').addClass('tmce-active');
		}
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.switch-tmce').bind('click', function () { 
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
			
			
			var valContent = jQuery(this).closest('.wp-column_content' + i + '-container-wrap').find('textarea#column_content' + i).val(), 
				val = switchEditors.wpautop(valContent);
			
			
			jQuery('textarea#column_content' + i).val(val);
			
			
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_upload_image_button').show();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_dropcap1_button').show();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_dropcap2_button').show();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_button_button').show();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_table_button').show();
			
			
			tinyMCE.execCommand('mceAddEditor', true, 'column_content' + i);
		} );
		
		
		jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.switch-html').bind('click', function () { 
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
			
			
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_upload_image_button').hide();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_dropcap1_button').hide();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_dropcap2_button').hide();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_button_button').hide();
			jQuery('#column_content' + i).closest('.wp-column_content' + i + '-container-wrap').find('a.custom_table_button').hide();
			
			
			tinyMCE.execCommand('mceRemoveEditor', true, 'column_content' + i);
		} );
		
		
		if (jQuery('#column_content' + i + '_toolbar2').css('display') !== 'none') {
			jQuery('#column_content' + i + '_toolbar3').show();
			
			
			jQuery('#column_content' + i + '_wp_adv').addClass('mceButtonActive');
		}
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
		var contTextAreas = jQuery('#TB_ajaxContent table.describe > tbody > tr textarea[id^="column_content"]');
		
		
		for (var i = 0, ilength = contTextAreas.length; i < ilength; i += 1) {
			var contTextAreaID = contTextAreas.eq(i).attr('id');
			
			
			if (contTextAreas.eq(i).closest('div#wp-' + contTextAreaID + '-wrap').hasClass('tmce-active')) {
				tinyMCE.execCommand('mceRemoveEditor', true, contTextAreaID);
			}
		}
		
		
		tb_remove();
		
		
		return false;
	}
</script>
<div class="popup_content">
<?php 
echo '<h3 class="media-title">' . __('Set', 'cmsmasters') . ' ';


if ($type == 'tab') {
	_e('Tabs', 'cmsmasters');
} elseif ($type == 'toggle') {
	_e('Toggles', 'cmsmasters');
} elseif ($type == 'tour') {
	_e('Tour', 'cmsmasters');
}


echo ' ' . __('Shortcode Options', 'cmsmasters') . '</h3>';
?>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
				<?php if ($type == 'tab') { ?>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #1</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label1"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[0]['tab_title']) ? $tabs[0]['tab_title'] : ''; ?>" name="tab_label1" id="tab_label1" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[0][1]) ? $matches[0][1] : ''), 'column_content', array( 
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
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #2</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label2"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[1]['tab_title']) ? $tabs[1]['tab_title'] : ''; ?>" name="tab_label2" id="tab_label2" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content1"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content1-editor-container-wrap" class="wp-column_content1-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[1][1]) ? $matches[1][1] : ''), 'column_content1', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols1"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols1" id="table_cols1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows1"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows1" id="table_rows1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head1"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head1" id="table_head1" class="popup_tr_value_inner" />
							<label for="table_head1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot1"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot1" id="table_foot1" class="popup_tr_value_inner" />
							<label for="table_foot1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table1" class="button" name="cancel_custom_table1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table1" class="button" name="insert_custom_table1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text1"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text1" id="button_text1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link1"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link1" id="button_link1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type1"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type1" id="button_type1" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target1"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target1" id="button_target1" class="popup_tr_value_inner" />
							<label for="button_target1"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox1"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox1" id="button_lightbox1" class="popup_tr_value_inner" />
							<label for="button_lightbox1"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button1" class="button" name="cancel_custom_button1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button1" class="button" name="insert_custom_button1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
				<?php for ($i = 2; $i < count($tabs); $i++) { ?>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #<?php echo $i + 1; ?></p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label<?php echo $i; ?>"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[$i]['tab_title']) ? $tabs[$i]['tab_title'] : ''; ?>" name="tab_label<?php echo $i; ?>" id="tab_label<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content<?php echo $i; ?>"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content<?php echo $i; ?>-editor-container-wrap" class="wp-column_content<?php echo $i; ?>-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[$i][1]) ? $matches[$i][1] : ''), 'column_content' . $i, array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols<?php echo $i; ?>"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols<?php echo $i; ?>" id="table_cols<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows<?php echo $i; ?>"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows<?php echo $i; ?>" id="table_rows<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head<?php echo $i; ?>"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head<?php echo $i; ?>" id="table_head<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_head<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot<?php echo $i; ?>"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot<?php echo $i; ?>" id="table_foot<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_foot<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table<?php echo $i; ?>" class="button" name="cancel_custom_table<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table<?php echo $i; ?>" class="button" name="insert_custom_table<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text<?php echo $i; ?>"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text<?php echo $i; ?>" id="button_text<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link<?php echo $i; ?>"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link<?php echo $i; ?>" id="button_link<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type<?php echo $i; ?>"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type<?php echo $i; ?>" id="button_type<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target<?php echo $i; ?>"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target<?php echo $i; ?>" id="button_target<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_target<?php echo $i; ?>"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox<?php echo $i; ?>"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox<?php echo $i; ?>" id="button_lightbox<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_lightbox<?php echo $i; ?>"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button<?php echo $i; ?>" class="button" name="cancel_custom_button<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button<?php echo $i; ?>" class="button" name="insert_custom_button<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<script type="text/javascript">
						jQuery(document).ready(function () { 
							editorStart(<?php echo $i; ?>);
						} );
					</script>
				<?php } ?>
					<tr class="add_tab" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add New Tab', 'cmsmasters'); ?>" name="add_tab" id="add_tab" class="button" />
						</td>
					</tr>
				<?php } elseif ($type == 'toggle') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="toggle_as_acc"><?php _e('Accordion', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="toggle_as_acc" id="toggle_as_acc"<?php echo ($content != '' && $counter > 0) ? ' checked="checked"' : ''; ?> class="popup_tr_value" />
							<label for="toggle_as_acc"><?php _e('Show toggles as accordion', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Toggle', 'cmsmasters'); ?> #1</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="toggle_label1"><?php _e('Toggle Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $toggles[0]['toggle_title']) ? $toggles[0]['toggle_title'] : ''; ?>" name="toggle_label1" id="toggle_label1" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Toggle Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[0][1]) ? $matches[0][1] : ''), 'column_content', array( 
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
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Toggle', 'cmsmasters'); ?> #2</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="toggle_label2"><?php _e('Toggle Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $toggles[1]['toggle_title']) ? $toggles[1]['toggle_title'] : ''; ?>" name="toggle_label2" id="toggle_label2" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content1"><?php _e('Toggle Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content1-editor-container-wrap" class="wp-column_content1-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[1][1]) ? $matches[1][1] : ''), 'column_content1', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols1"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols1" id="table_cols1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows1"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows1" id="table_rows1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head1"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head1" id="table_head1" class="popup_tr_value_inner" />
							<label for="table_head1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot1"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot1" id="table_foot1" class="popup_tr_value_inner" />
							<label for="table_foot1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table1" class="button" name="cancel_custom_table1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table1" class="button" name="insert_custom_table1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text1"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text1" id="button_text1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link1"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link1" id="button_link1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type1"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type1" id="button_type1" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target1"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target1" id="button_target1" class="popup_tr_value_inner" />
							<label for="button_target1"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox1"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox1" id="button_lightbox1" class="popup_tr_value_inner" />
							<label for="button_lightbox1"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button1" class="button" name="cancel_custom_button1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button1" class="button" name="insert_custom_button1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
				<?php for ($i = 2; $i < count($toggles); $i++) { ?>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Toggle', 'cmsmasters'); ?> #<?php echo $i + 1; ?></p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="toggle_label<?php echo $i; ?>"><?php _e('Toggle Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $toggles[$i]['toggle_title']) ? $toggles[$i]['toggle_title'] : ''; ?>" name="toggle_label<?php echo $i; ?>" id="toggle_label<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content<?php echo $i; ?>"><?php _e('Toggle Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content<?php echo $i; ?>-editor-container-wrap" class="wp-column_content<?php echo $i; ?>-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[$i][1]) ? $matches[$i][1] : ''), 'column_content' . $i, array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols<?php echo $i; ?>"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols<?php echo $i; ?>" id="table_cols<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows<?php echo $i; ?>"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows<?php echo $i; ?>" id="table_rows<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head<?php echo $i; ?>"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head<?php echo $i; ?>" id="table_head<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_head<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot<?php echo $i; ?>"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot<?php echo $i; ?>" id="table_foot<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_foot<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table<?php echo $i; ?>" class="button" name="cancel_custom_table<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table<?php echo $i; ?>" class="button" name="insert_custom_table<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text<?php echo $i; ?>"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text<?php echo $i; ?>" id="button_text<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link<?php echo $i; ?>"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link<?php echo $i; ?>" id="button_link<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type<?php echo $i; ?>"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type<?php echo $i; ?>" id="button_type<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target<?php echo $i; ?>"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target<?php echo $i; ?>" id="button_target<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_target<?php echo $i; ?>"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox<?php echo $i; ?>"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox<?php echo $i; ?>" id="button_lightbox<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_lightbox<?php echo $i; ?>"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button<?php echo $i; ?>" class="button" name="cancel_custom_button<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button<?php echo $i; ?>" class="button" name="insert_custom_button<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<script type="text/javascript">
						jQuery(document).ready(function () { 
							editorStart(<?php echo $i; ?>);
						} );
					</script>
				<?php } ?>
					<tr class="add_toggle" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add New Toggle', 'cmsmasters'); ?>" name="add_toggle" id="add_toggle" class="button" />
						</td>
					</tr>
				<?php } elseif ($type == 'tour') { ?>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #1</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label1"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[0]['tab_title']) ? $tabs[0]['tab_title'] : ''; ?>" name="tab_label1" id="tab_label1" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[0][1]) ? $matches[0][1] : ''), 'column_content', array( 
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
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #2</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label2"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[1]['tab_title']) ? $tabs[1]['tab_title'] : ''; ?>" name="tab_label2" id="tab_label2" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content1"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content1-editor-container-wrap" class="wp-column_content1-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[1][1]) ? $matches[1][1] : ''), 'column_content1', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols1"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols1" id="table_cols1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows1"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows1" id="table_rows1" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head1"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head1" id="table_head1" class="popup_tr_value_inner" />
							<label for="table_head1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot1"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot1" id="table_foot1" class="popup_tr_value_inner" />
							<label for="table_foot1"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table1" class="button" name="cancel_custom_table1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table1" class="button" name="insert_custom_table1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text1"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text1" id="button_text1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link1"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link1" id="button_link1" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type1"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type1" id="button_type1" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target1"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target1" id="button_target1" class="popup_tr_value_inner" />
							<label for="button_target1"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox1"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox1" id="button_lightbox1" class="popup_tr_value_inner" />
							<label for="button_lightbox1"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field1">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button1" class="button" name="cancel_custom_button1" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button1" class="button" name="insert_custom_button1" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
				<?php 
				if ($content != '') { 
					for ($i = 2; $i < count($tabs); $i++) { 
				?>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Tab', 'cmsmasters'); ?> #<?php echo $i + 1; ?></p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="tab_label<?php echo $i; ?>"><?php _e('Tab Label', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $tabs[$i]['tab_title']) ? $tabs[$i]['tab_title'] : ''; ?>" name="tab_label<?php echo $i; ?>" id="tab_label<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content<?php echo $i; ?>"><?php _e('Tab Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content<?php echo $i; ?>-editor-container-wrap" class="wp-column_content<?php echo $i; ?>-container-wrap">
							<?php 
								wp_editor((($content != '' && $matches[$i][1]) ? $matches[$i][1] : ''), 'column_content' . $i, array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 10 
								));
							?>
							</div>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_cols<?php echo $i; ?>"><?php _e('Columns Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="4" name="table_cols<?php echo $i; ?>" id="table_cols<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_rows<?php echo $i; ?>"><?php _e('Rows Count', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="3" name="table_rows<?php echo $i; ?>" id="table_rows<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" style="width:45px;" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_head<?php echo $i; ?>"><?php _e('Table Header', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_head<?php echo $i; ?>" id="table_head<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_head<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Header', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="table_foot<?php echo $i; ?>"><?php _e('Table Footer', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="table_foot<?php echo $i; ?>" id="table_foot<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="table_foot<?php echo $i; ?>"><?php echo __('Show', 'cmsmasters') . ' ' . __('Table Footer', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_table_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_table<?php echo $i; ?>" class="button" name="cancel_custom_table<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_table<?php echo $i; ?>" class="button" name="insert_custom_table<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_text<?php echo $i; ?>"><?php _e('Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_text<?php echo $i; ?>" id="button_text<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_link<?php echo $i; ?>"><?php _e('Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="" name="button_link<?php echo $i; ?>" id="button_link<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner" />
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_type<?php echo $i; ?>"><?php _e('Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="button_type<?php echo $i; ?>" id="button_type<?php echo $i; ?>" aria-required="true" class="popup_tr_value_inner">
								<option value="button"><?php _e('Small button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_medium"><?php _e('Medium button', 'cmsmasters'); ?>&nbsp;</option>
								<option value="button_large"><?php _e('Large button', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_target<?php echo $i; ?>"><?php _e('Target', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="_blank" name="button_target<?php echo $i; ?>" id="button_target<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_target<?php echo $i; ?>"><?php _e('Open link in a new tab/window', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="button_lightbox<?php echo $i; ?>"><?php _e('Lightbox', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="button_lightbox<?php echo $i; ?>" id="button_lightbox<?php echo $i; ?>" class="popup_tr_value_inner" />
							<label for="button_lightbox<?php echo $i; ?>"><?php _e('Open link in a lightbox', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr class="custom_composer_button_field custom_button_button_field<?php echo $i; ?>">
						<td class="label" valign="top" style="width:130px; padding:15px;" scope="row">
							<input type="button" id="cancel_custom_button<?php echo $i; ?>" class="button" name="cancel_custom_button<?php echo $i; ?>" value="<?php _e('Cancel', 'cmsmasters'); ?>" />
						</td>
						<td class="field" style="text-align:right; padding:15px;">
							<input type="submit" id="insert_custom_button<?php echo $i; ?>" class="button" name="insert_custom_button<?php echo $i; ?>" value="<?php _e('Insert', 'cmsmasters'); ?>" />
						</td>
					</tr>
					<script type="text/javascript">
						jQuery(document).ready(function () { 
							editorStart(<?php echo $i; ?>);
						} );
					</script>
				<?php 
					} 
				} 
				?>
					<tr class="add_tab" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add New Tab', 'cmsmasters'); ?>" name="add_tab" id="add_tab" class="button" />
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
		editorStart();
		
		
		editorStart(1);
	} );
</script>

