<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Video Shortcodes Popup
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
	$type = 'embed'; 
}


if (isset($_POST['content']) && $_POST['content'] != '') {
	if ($type == 'embed') {
		$content = urldecode(stripslashes($_POST['content']));
		
		
		$pattern = "/^\[video\s(.+)=\"(.+)\"\]$/";
		
		
		preg_match($pattern, $content, $matches);
		
		
		$att_name = $matches[1];
		
		$att_val = $matches[2];
	} else if ($type == 'html5') {
		$content = urldecode(stripslashes($_POST['content']));
		
		
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
		
		
		$pairs = $pairs[0];
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		$html5video = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$html5video[$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[html5video\s.+\](.+)\[\/html5video\]$/";
		
		
		preg_match($pattern, $content, $matches);
	} else if ($type == 'single') {
		$content = urldecode(stripslashes($_POST['content']));
		
		
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $content, $pairs);
		
		
		$pairs = $pairs[0];
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		$single_video_player = array();
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$single_video_player[$atr[0]] = $atr[1];
		}
	} else if ($type == 'multiple') {
		$content = str_replace('], [', ']|, |[', str_replace('[multiple_video_player] ', '', str_replace(' [/multiple_video_player]', '', urldecode(stripslashes($_POST['content'])))));
		
		
		$shortcode_array = explode('|, |', $content);
		
		
		$multiple_video_player = array();
		
		
		function trim_quotes($data) {
			$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
			
			
			return $data;
		}
		
		
		for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
			preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
			
			
			$pairs = $pairs[0];
			
			
			foreach($pairs as $pair) {
				$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
				
				
				$multiple_video_player[$i][$atr[0]] = $atr[1];
			}
		}
		
		
		if (sizeof($multiple_video_player > 2)) {
			$multiple_video_player_array = $multiple_video_player;
			
			
			unset($multiple_video_player_array[0]);
			
			unset($multiple_video_player_array[1]);
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
		
		
		jQuery('.add_video').delegate('#add_video', 'click', function () { 
			var i = (jQuery('#TB_ajaxContent .popup_tr_value').length / 4) + 1, 
				html = '';
			
			
			html = '<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">' + 
				'<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>' + 
				'<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">' + 
					'<p class="help alignleft" style="padding:0;"><?php _e('Video', 'cmsmasters'); ?> #' + i + '</p>' + 
					'<span class="alignright">' + 
						'<a href="#" title="<?php _e('Delete', 'cmsmasters'); ?>" class="del_item_but">[x]</a>' + 
					'</span>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="video_player_name' + i + '"><?php _e('Name', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="video_player_name' + i + '" id="video_player_name' + i + '" aria-required="true" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="video_player_mp4' + i + '"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="video_player_mp4' + i + '" id="video_player_mp4' + i + '" aria-required="true" class="popup_tr_value" />' + 
					'<p class="help"><?php _e('For Internet Explorer, Google Chrome, Apple Safari', 'cmsmasters'); ?></p>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="video_player_ogg' + i + '"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="video_player_ogg' + i + '" id="video_player_ogg' + i + '" aria-required="true" class="popup_tr_value" />' + 
					'<p class="help"><?php _e('For Firefox, Google Chrome, Opera', 'cmsmasters'); ?></p>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="video_player_poster' + i + '"><?php _e('Poster', 'cmsmasters'); ?></label>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="video_player_poster' + i + '" id="video_player_poster' + i + '" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_video').before(html);
		} );
		
		
		jQuery('.describe').delegate('.del_item_but', 'click', function () { 
			if (confirm('<?php _e('Are you sure that you want to delete this playlist item?', 'cmsmasters'); ?>')) {
				jQuery(this).closest('tr').next().next().next().next().remove();
				jQuery(this).closest('tr').next().next().next().remove();
				jQuery(this).closest('tr').next().next().remove();
				jQuery(this).closest('tr').next().remove();
				jQuery(this).closest('tr').remove();
			}
			
			
			return false;
		} );
	} );
	
	
<?php if ($type == 'embed') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				video_url = jQuery('#video_url').val();
			
			
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
			
			
			shortcode_tag += '[video url="' + video_url + '"]';
			
			
			popupUpdateContent(shortcode_tag);
			
			
			tb_remove();
		}
		
		
		return false;
	}
<?php } elseif ($type == 'html5') { ?>
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				video_mp4 = jQuery('#video_mp4').val(), 
				video_ogg = jQuery('#video_ogg').val(), 
				video_support = jQuery('#video_support').val(), 
				video_preload = jQuery('#video_preload').val(), 
				video_poster = jQuery('#video_poster').val(), 
				video_control = jQuery('#video_control'), 
				video_autoplay = jQuery('#video_autoplay'), 
				video_loop = jQuery('#video_loop');
			
			
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
			
			
			shortcode_tag += '[html5video mp4="' + video_mp4 + '" ogg="' + video_ogg + '" preload="' + video_preload + '"';
			
			
			if (video_poster !== '' && video_poster !== ' ') {
				shortcode_tag += ' poster="' + video_poster + '"';
			}
			
			
			if (video_control.is(':checked')) {
				shortcode_tag += ' controls="' + video_control.val() + '"';
			}
			
			
			if (video_autoplay.is(':checked')) {
				shortcode_tag += ' autoplay="' + video_autoplay.val() + '"';
			}
			
			
			if (video_loop.is(':checked')) {
				shortcode_tag += ' loop="' + video_loop.val() + '"';
			}
			
			
			shortcode_tag += ']' + video_support + '[/html5video]';
			
			
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
				video_player_mp4 = jQuery('#video_player_mp4').val(), 
				video_player_ogg = jQuery('#video_player_ogg').val(), 
				video_player_name = jQuery('#video_player_name').val(), 
				video_player_poster = jQuery('#video_player_poster').val();
			
			
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
			
			
			shortcode_tag += '[single_video_player mp4="' + video_player_mp4 + '" ogg="' + video_player_ogg + '" title="' + video_player_name + '"';
			
			
			if (video_player_poster !== '' && video_player_poster !== ' ') {
				shortcode_tag += ' poster="' + video_player_poster + '"';
			}
			
			
			shortcode_tag += ']';
			
			
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
			
			
			shortcode_tag += '[multiple_video_player] ';
			
			
			for (var i = 0, ilength = tr.length - 1; i < ilength; i += 5) {
				shortcode_tag += '[video_playlist mp4="' + tr.eq(i + 2).find('.popup_tr_value').val() + '" ogg="' + tr.eq(i + 3).find('.popup_tr_value').val() + '" title="' + tr.eq(i + 1).find('.popup_tr_value').val() + '" poster="' + tr.eq(i + 4).find('.popup_tr_value').val() + '"], ';
			}
			
			
			shortcode_tag += '[/multiple_video_player]';
			
			
			shortcode_tag = shortcode_tag.replace("], [/multiple_video_player]", "] [/multiple_video_player]");
			
			
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


if ($type == 'embed') {
    _e('Embedded Video', 'cmsmasters');
} elseif ($type == 'html5') {
	_e('HTML5 Video', 'cmsmasters');
} elseif ($type == 'single') {
	_e('Video Player', 'cmsmasters');
} elseif ($type == 'multiple') {
	_e('Video Player with Playlist', 'cmsmasters');
}


echo ' ' . __('Shortcode Options', 'cmsmasters') . '</h3>';
?>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
				<?php if ($type == 'embed') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_url"><?php _e('URL', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $att_name == 'url') ? $att_val : ''; ?>" name="video_url" id="video_url" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('You can use YouTube, Vimeo, DailyMotion or Screenr video here', 'cmsmasters'); ?></p>
						</td>
					</tr>
				<?php } elseif ($type == 'html5') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_mp4"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $html5video['mp4']) ? $html5video['mp4'] : ''; ?>" name="video_mp4" id="video_mp4" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer (9+), Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_ogg"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $html5video['ogg']) ? $html5video['ogg'] : ''; ?>" name="video_ogg" id="video_ogg" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_poster"><?php _e('Poster', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $html5video['poster']) ? $html5video['poster'] : ''; ?>" name="video_poster" id="video_poster" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_support"><?php _e('Not Support Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $matches[1]) ? $matches[1] : __('Your browser does not support the video tag.', 'cmsmasters'); ?>" name="video_support" id="video_support" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_preload"><?php _e('Preloading', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="video_preload" id="video_preload" aria-required="true" class="popup_tr_value">
								<option value="none"<?php echo ($content != '' && $html5video['preload'] && $html5video['preload'] == 'none') ? ' selected="selected"' : ''; ?>><?php _e('Not preload', 'cmsmasters'); ?>&nbsp;</option>
								<option value="auto"<?php echo ($content != '' && $html5video['preload'] && $html5video['preload'] == 'auto') ? ' selected="selected"' : ''; ?>><?php _e('Preload auto', 'cmsmasters'); ?>&nbsp;</option>
								<option value="metadata"<?php echo ($content != '' && $html5video['preload'] && $html5video['preload'] == 'metadata') ? ' selected="selected"' : ''; ?>><?php _e('Preload as metadata', 'cmsmasters'); ?>&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_control"><?php _e('Controls', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="controls" name="video_control" id="video_control"<?php echo ($content != '') ? (($html5video['controls'] && $html5video['controls'] == 'controls') ? ' checked="checked"' : '') : ' checked="checked"'; ?> class="popup_tr_value" />
							<label for="video_control"><?php _e('Show controls', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_autoplay"><?php _e('Autoplay', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="autoplay" name="video_autoplay" id="video_autoplay"<?php echo ($content != '') ? (($html5video['autoplay'] && $html5video['autoplay'] == 'autoplay') ? ' checked="checked"' : '') : ''; ?> class="popup_tr_value" />
							<label for="video_autoplay"><?php _e('Autoplay video', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_loop"><?php _e('Repeat', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="loop" name="video_loop" id="video_loop"<?php echo ($content != '') ? (($html5video['loop'] && $html5video['loop'] == 'loop') ? ' checked="checked"' : '') : ''; ?> class="popup_tr_value" />
							<label for="video_loop"><?php _e('Repeat video', 'cmsmasters'); ?></label>
						</td>
					</tr>
				<?php } elseif ($type == 'single') { ?>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_name"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_video_player['title']) ? $single_video_player['title'] : ''; ?>" name="video_player_name" id="video_player_name" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_mp4"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_video_player['mp4']) ? $single_video_player['mp4'] : ''; ?>" name="video_player_mp4" id="video_player_mp4" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_ogg"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_video_player['ogg']) ? $single_video_player['ogg'] : ''; ?>" name="video_player_ogg" id="video_player_ogg" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_poster"><?php _e('Poster', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $single_video_player['poster']) ? $single_video_player['poster'] : ''; ?>" name="video_player_poster" id="video_player_poster" class="popup_tr_value" />
						</td>
					</tr>
				<?php } elseif ($type == 'multiple') { ?>
					<tr style="border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
						<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
							<p class="help alignleft" style="padding:0;"><?php _e('Video', 'cmsmasters'); ?> #1</p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_name1"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[0]['title']) ? $multiple_video_player[0]['title'] : ''; ?>" name="video_player_name1" id="video_player_name1" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_mp41"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[0]['mp4']) ? $multiple_video_player[0]['mp4'] : ''; ?>" name="video_player_mp41" id="video_player_mp41" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_ogg1"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[0]['ogg']) ? $multiple_video_player[0]['ogg'] : ''; ?>" name="video_player_ogg1" id="video_player_ogg1" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_poster1"><?php _e('Poster', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[0]['poster']) ? $multiple_video_player[0]['poster'] : ''; ?>" name="video_player_poster1" id="video_player_poster1" class="popup_tr_value" />
						</td>
					</tr>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
						<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
							<p class="help alignleft" style="padding:0;"><?php _e('Video', 'cmsmasters'); ?> #2</p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_name2"><?php _e('Name', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[1]['title']) ? $multiple_video_player[1]['title'] : ''; ?>" name="video_player_name2" id="video_player_name2" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_mp42"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[1]['mp4']) ? $multiple_video_player[1]['mp4'] : ''; ?>" name="video_player_mp42" id="video_player_mp42" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_ogg2"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[1]['ogg']) ? $multiple_video_player[1]['ogg'] : ''; ?>" name="video_player_ogg2" id="video_player_ogg2" aria-required="true" class="popup_tr_value" />
							<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="video_player_poster2"><?php _e('Poster', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $multiple_video_player[1]['poster']) ? $multiple_video_player[1]['poster'] : ''; ?>" name="video_player_poster2" id="video_player_poster2" class="popup_tr_value" />
						</td>
					</tr>
					<?php 
						$i = 3;
						
						if (isset($multiple_video_player_array)) {
							foreach ($multiple_video_player_array as $multiple_video_player_item) { 
					?>
							<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
								<th class="label" valign="top" style="width:130px; padding-top:10px;" scope="row"></th>
								<td class="field" style="font-weight:bold; padding:8px 12px 7px 0;">
									<p class="help alignleft" style="padding:0;"><?php _e('Video', 'cmsmasters'); ?> #<?php echo $i; ?></p>
									<span class="alignright">
										<a href="#" title="<?php _e('Delete', 'cmsmasters'); ?>" class="del_item_but">[x]</a>
									</span>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="video_player_name<?php echo $i; ?>"><?php _e('Name', 'cmsmasters'); ?></label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_video_player_item['title']) ? $multiple_video_player_item['title'] : ''; ?>" name="video_player_name<?php echo $i; ?>" id="video_player_name<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="video_player_mp4<?php echo $i; ?>"><?php _e('URL', 'cmsmasters'); ?> (mp4/m4v)</label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_video_player_item['mp4']) ? $multiple_video_player_item['mp4'] : ''; ?>" name="video_player_mp4<?php echo $i; ?>" id="video_player_mp4<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
									<p class="help"><?php _e('For Internet Explorer, Google Chrome and Apple Safari', 'cmsmasters'); ?></p>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="video_player_ogg<?php echo $i; ?>"><?php _e('URL', 'cmsmasters'); ?> (ogg/ogv)</label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_video_player_item['ogg']) ? $multiple_video_player_item['ogg'] : ''; ?>" name="video_player_ogg<?php echo $i; ?>" id="video_player_ogg<?php echo $i; ?>" aria-required="true" class="popup_tr_value" />
									<p class="help"><?php _e('For Firefox, Google Chrome and Opera', 'cmsmasters'); ?></p>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="video_player_poster<?php echo $i; ?>"><?php _e('Poster', 'cmsmasters'); ?></label>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($multiple_video_player_item['poster']) ? $multiple_video_player_item['poster'] : ''; ?>" name="video_player_poster<?php echo $i; ?>" id="video_player_poster<?php echo $i; ?>" class="popup_tr_value" />
								</td>
							</tr>
					<?php 
								$i++;
							}
						} 
					?>
					<tr class="add_video" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add Video to Playlist', 'cmsmasters'); ?>" name="add_video" id="add_video" class="button" />
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

