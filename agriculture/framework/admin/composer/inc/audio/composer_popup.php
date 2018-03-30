<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Audio Shortcodes Popup
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
	$type = 'html5'; 
}


if (isset($_POST['content']) && $_POST['content'] != '') {
	if ($type == 'html5') {
		$content = urldecode(stripslashes($_POST['content']));
		
		
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
		
		
		$pairs = $pairs[0];
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		$html5audio = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$html5audio[$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[html5audio\s.+\](.+)\[\/html5audio\]$/";
		
		
		preg_match($pattern, $content, $matches);
	} else if ($type == 'single') {
		$content = urldecode(stripslashes($_POST['content']));
		
		
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
		
		
		$pairs = $pairs[0];
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		$single_audio_player = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$single_audio_player[$atr[0]] = $atr[1];
		}
	} else if ($type == 'multiple') {
		$content = str_replace('], [', ']|, |[', str_replace('[multiple_audio_player] ', '', str_replace(' [/multiple_audio_player]', '', urldecode(stripslashes($_POST['content'])))));
		
		
		$shortcode_array = explode('|, |', $content);
		
		
		$multiple_audio_player = array();
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
			preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
			
			
			$pairs = $pairs[0];
			
			
			foreach($pairs as $pair) {
				$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
				
				
				$multiple_audio_player[$i][$atr[0]] = $atr[1];
			}
		}
		
		
		if (sizeof($multiple_audio_player > 2)) {
			$multiple_audio_player_array = $multiple_audio_player;
			
			
			unset($multiple_audio_player_array[0]);
			
			unset($multiple_audio_player_array[1]);
		}
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
		
		
		jQuery('.add_audio').delegate('#add_audio', 'click', function () { 
			var i = (jQuery('#TB_ajaxContent .popup_tr_value').length / 3) + 1, 
				html = '';
			
			
			html = '<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>' + 
				'<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">' + 
					'<p class="help alignleft" style="padding:0;"><?php _e('Audio', 'cmsmasters'); ?> #' + i + '</p>' + 
					'<span class="alignright">' + 
						'<a href="#" title="<?php _e('Delete', 'cmsmasters'); ?>" class="del_item_but">[x]</a>' + 
					'</span>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="audio_player_name' + i + '"><?php _e('Name', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="audio_player_name' + i + '" id="audio_player_name' + i + '" aria-required="true" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="audio_player_mp3' + i + '"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="audio_player_mp3' + i + '" id="audio_player_mp3' + i + '" aria-required="true" class="popup_tr_value" />' + 
					'<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="audio_player_ogg' + i + '"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="audio_player_ogg' + i + '" id="audio_player_ogg' + i + '" aria-required="true" class="popup_tr_value" />' + 
					'<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_audio').before(html);
		} );
		
		
		jQuery('.describe').delegate('.del_item_but', 'click', function () { 
			if (confirm('<?php _e('Are you sure that you want to delete this playlist item?', 'cmsmasters'); ?>')) {
				jQuery(this).closest('tr').next().next().next().remove();
				jQuery(this).closest('tr').next().next().remove();
				jQuery(this).closest('tr').next().remove();
				jQuery(this).closest('tr').remove();
			}
			
			
			return false;
		} );
	} );
	
	
<?php if ($type == 'html5') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				audio_mp3 = jQuery('#audio_mp3').val(), 
				audio_ogg = jQuery('#audio_ogg').val(), 
				audio_support = jQuery('#audio_support').val(), 
				audio_preload = jQuery('#audio_preload').val(), 
				audio_control = jQuery('#audio_control'), 
				audio_autoplay = jQuery('#audio_autoplay'), 
				audio_loop = jQuery('#audio_loop');
			
			
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
			
			
			shortcode_tag += '[html5audio mp3="' + audio_mp3 + '" ogg="' + audio_ogg + '" preload="' + audio_preload + '"';
			
			
			if (audio_control.is(':checked')) {
				shortcode_tag += ' controls="' + audio_control.val() + '"';
			}
			
			
			if (audio_autoplay.is(':checked')) {
				shortcode_tag += ' autoplay="' + audio_autoplay.val() + '"';
			}
			
			
			if (audio_loop.is(':checked')) {
				shortcode_tag += ' loop="' + audio_loop.val() + '"';
			}
			
			
			shortcode_tag += ']' + audio_support + '[/html5audio]';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } elseif ($type == 'single') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				audio_mp3 = jQuery('#audio_player_mp3').val(), 
				audio_ogg = jQuery('#audio_player_ogg').val(), 
				audio_name = jQuery('#audio_player_name').val();
			
			
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
			
			
			shortcode_tag += '[single_audio_player mp3="' + audio_mp3 + '" ogg="' + audio_ogg + '" title="' + audio_name + '"]';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } elseif ($type == 'multiple') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				tr = jQuery('#TB_ajaxContent tr');
			
			
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
			
			
			shortcode_tag += '[multiple_audio_player] ';
			
			
			for (var i = 0, ilength = tr.length - 1; i < ilength; i += 4) {
				shortcode_tag += '[audio_playlist mp3="' + tr.eq(i + 2).find('.popup_tr_value').val() + '" ogg="' + tr.eq(i + 3).find('.popup_tr_value').val() + '" title="' + tr.eq(i + 1).find('.popup_tr_value').val() + '"], ';
			}
			
			
			shortcode_tag += '[/multiple_audio_player]';
			
			
			shortcode_tag = shortcode_tag.replace("], [/multiple_audio_player]", "] [/multiple_audio_player]");
			
			
			popupUpdateContent(shortcode_tag);
			
			
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
		tb_remove();
		
		
		return false;
	}
</script>
<div class="popup_content">
<?php 
echo '<h3 class="media-title">' . __('Set', 'cmsmasters') . ' ';


if ($type == 'html5') {
	_e('HTML5 Audio', 'cmsmasters');
} elseif ($type == 'single') {
	_e('Audio Player', 'cmsmasters');
} elseif ($type == 'multiple') {
	_e('Audio Player with Playlist', 'cmsmasters');
}


echo ' ' . __('Shortcode Options', 'cmsmasters') . '</h3>';
?>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
				<?php if ($type == 'html5') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_mp3"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $html5audio['mp3']) ? $html5audio['mp3'] : ''; ?>" name="audio_mp3" id="audio_mp3" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer (9+), Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_ogg"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $html5audio['ogg']) ? $html5audio['ogg'] : ''; ?>" name="audio_ogg" id="audio_ogg" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_support"><?php _e('Not Support Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $matches[1]) ? $matches[1] : __('Your browser does not support the audio tag.', 'cmsmasters'); ?>" name="audio_support" id="audio_support" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_preload"><?php _e('Preloading', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="audio_preload" id="audio_preload" aria-required="true" class="popup_tr_value">
								<option value="none"<?php echo ($content != '' && $html5audio['preload'] && $html5audio['preload'] == 'none') ? ' selected="selected"' : ''; ?>><?php _e('Not preload', 'cmsmasters'); ?>&nbsp;</option>
								<option value="auto"<?php echo ($content != '' && $html5audio['preload'] && $html5audio['preload'] == 'auto') ? ' selected="selected"' : ''; ?>><?php _e('Preload auto', 'cmsmasters'); ?>&nbsp;</option>
								<option value="metadata"<?php echo ($content != '' && $html5audio['preload'] && $html5audio['preload'] == 'metadata') ? ' selected="selected"' : ''; ?>><?php _e('Preload as metadata', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_control"><?php _e('Controls', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="controls" name="audio_control" id="audio_control"<?php echo ($content != '') ? (($html5audio['controls'] && $html5audio['controls'] == 'controls') ? ' checked="checked"' : '') : ' checked="checked"'; ?> class="popup_tr_value" />
							<label for="audio_control"><?php _e('Show controls', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_autoplay"><?php _e('Autoplay', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="autoplay" name="audio_autoplay" id="audio_autoplay"<?php echo ($content != '') ? (($html5audio['autoplay'] && $html5audio['autoplay'] == 'autoplay') ? ' checked="checked"' : '') : ''; ?> class="popup_tr_value" />
							<label for="audio_autoplay"><?php _e('Autoplay audio', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_loop"><?php _e('Repeat', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="loop" name="audio_loop" id="audio_loop"<?php echo ($content != '') ? (($html5audio['loop'] && $html5audio['loop'] == 'loop') ? ' checked="checked"' : '') : ''; ?> class="popup_tr_value" />
							<label for="audio_loop"><?php _e('Repeat audio', 'cmsmasters'); ?></label>
						</td>
					</tr>
				<?php } elseif ($type == 'single') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_name"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_audio_player['title']) ? $single_audio_player['title'] : ''; ?>" name="audio_player_name" id="audio_player_name" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_mp3"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_audio_player['mp3']) ? $single_audio_player['mp3'] : ''; ?>" name="audio_player_mp3" id="audio_player_mp3" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_ogg"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_audio_player['ogg']) ? $single_audio_player['ogg'] : ''; ?>" name="audio_player_ogg" id="audio_player_ogg" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
				<?php } elseif ($type == 'multiple') { ?>
					<tr style="border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
						<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
							<p class="help alignleft" style="padding:0;"><?php _e('Audio', 'cmsmasters'); ?> #1</p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_name1"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[0]['title']) ? $multiple_audio_player[0]['title'] : ''; ?>" name="audio_player_name1" id="audio_player_name1" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_mp31"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[0]['mp3']) ? $multiple_audio_player[0]['mp3'] : ''; ?>" name="audio_player_mp31" id="audio_player_mp31" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_ogg1"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[0]['ogg']) ? $multiple_audio_player[0]['ogg'] : ''; ?>" name="audio_player_ogg1" id="audio_player_ogg1" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
						<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
							<p class="help alignleft" style="padding:0;"><?php _e('Audio', 'cmsmasters'); ?> #2</p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_name2"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[1]['title']) ? $multiple_audio_player[1]['title'] : ''; ?>" name="audio_player_name2" id="audio_player_name2" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_mp32"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[1]['mp3']) ? $multiple_audio_player[1]['mp3'] : ''; ?>" name="audio_player_mp32" id="audio_player_mp32" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="audio_player_ogg2"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_audio_player[1]['ogg']) ? $multiple_audio_player[1]['ogg'] : ''; ?>" name="audio_player_ogg2" id="audio_player_ogg2" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<?php 
						$i = 3;
						
						if (isset($multiple_audio_player_array)) {
							foreach ($multiple_audio_player_array as $multiple_audio_player_item) { 
					?>
							<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
								<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
								<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
									<p class="help alignleft" style="padding:0;"><?php _e('Audio', 'cmsmasters'); ?> #<?php echo $i; ?></p>
									<span class="alignright">
										<a href="#" title="<?php _e('Delete', 'cmsmasters'); ?>" class="del_item_but">[x]</a>
									</span>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="audio_player_name<?php echo $i; ?>"><?php _e('Name', 'cmsmasters'); ?></label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_audio_player_item['title']) ? $multiple_audio_player_item['title'] : ''; ?>" name="audio_player_name<?php echo $i; ?>" id="audio_player_name<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="audio_player_mp3<?php echo $i; ?>"><?php _e('URL', 'cmsmasters'); ?> (mp3/m4a)</label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_audio_player_item['mp3']) ? $multiple_audio_player_item['mp3'] : ''; ?>" name="audio_player_mp3<?php echo $i; ?>" id="audio_player_mp3<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
									<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="audio_player_ogg<?php echo $i; ?>"><?php _e('URL', 'cmsmasters'); ?> (ogg/oga)</label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_audio_player_item['ogg']) ? $multiple_audio_player_item['ogg'] : ''; ?>" name="audio_player_ogg<?php echo $i; ?>" id="audio_player_ogg<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
									<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
								</td>
							</tr>
					<?php 
								$i++;
							}
						}
					?>
					<tr class="add_audio" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add Audio to Playlist', 'cmsmasters'); ?>" name="add_audio" id="add_audio" class="button" />
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

