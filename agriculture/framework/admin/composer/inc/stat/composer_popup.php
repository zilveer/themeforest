<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Stats Shortcode Popup
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
	$content = str_replace('] [', ']|, |[', str_replace('[stats] ', '', str_replace(' [/stats]', '', urldecode(stripslashes($_POST['content'])))));
	
	
	$shortcode_array = explode('|, |', $content);
	
	
	$stats = array();
	
	
	function trim_quotes($data) {
		$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
		
		
		return $data;
	}
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
			
			
			$stats[$i][$atr[0]] = $atr[1];
		}
	}
	
	
	if (sizeof($stats > 2)) {
		$stats_array = $stats;
		
		
		unset($stats_array[0]);
	}
} else {
	$content = ''; 
}

?>
<script type="text/javascript">
	jQuery(document).ready(function () { 
		jQuery('#percent_color0').wpColorPicker();
		
		
		jQuery(window).resize(function () { 
			if (jQuery('#TB_window').height() - 44 > jQuery('.popup_content').height() + 20) {
				jQuery('#TB_ajaxContent').height(jQuery('#TB_window').height() - 44);
			} else {
				jQuery('#TB_ajaxContent').height(jQuery('.popup_content').height() + 20);
			}
		} );
		
		
		jQuery('.add_stats_bar').delegate('#add_stats_bar', 'click', function () { 
			var tr = jQuery('#TB_ajaxContent table.describe > tbody > tr input[id^="percent_value"]'), 
				i = Number(tr.eq(tr.length - 1).attr('id').substr(-1, 1)) + 1, 
				html = '';
			
			
			html = '<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">' + 
				'<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>' + 
				'<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">' + 
					'<p style="padding:0;" class="help alignleft"><?php _e('Stats Bar', 'cmsmasters'); ?> #' + (i + 1) + '</p>' + 
					'<span class="alignright">' + 
						'<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>' + 
					'</span>' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="percent_title' + i + '"><?php _e('Title', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="percent_title' + i + '" id="percent_title' + i + '" aria-required="true" class="popup_tr_value" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="percent_value' + i + '"><?php _e('Percent Value', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="percent_value' + i + '" id="percent_value' + i + '" aria-required="true" class="popup_tr_value" style="width:45px;" />' + 
				'</td>' + 
			'</tr>' + 
			'<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="percent_color' + i + '"><?php _e('Color', 'cmsmasters'); ?></label>' + 
					'</span>' + 
					'<span class="alignright">' + 
						'<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>' + 
					'</span>' + 
				'</th>' +
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="#3a454b" name="percent_color' + i + '" id="percent_color' + i + '" aria-required="true" class="popup_tr_value my-color-field" data-default-color="#3a454b" />' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_stats_bar').before(html);
			
			
			jQuery('#percent_color' + i).wpColorPicker();
		} );
		
		
		jQuery('.describe').delegate('.del_item_but', 'click', function () { 
			if (confirm('<?php _e('Are you sure that you want to delete this stats bar?', 'cmsmasters'); ?>')) {
				jQuery(this).closest('tr').next().next().next().remove();
				jQuery(this).closest('tr').next().next().remove();
				jQuery(this).closest('tr').next().remove();
				jQuery(this).closest('tr').remove();
			}
			
			
			return false;
		} );
	} );
	
	
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				cmsms_stats_bar = jQuery('#TB_ajaxContent tr input[type="text"]');
			
			
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
			
			
			shortcode_tag += '[stats] ';
			
			
			for (var i = 0, ilength = cmsms_stats_bar.length; i < ilength; i += 3) {
				shortcode_tag += '[stats_bar title="' + cmsms_stats_bar.eq(i).val() + '" value="' + cmsms_stats_bar.eq(i + 1).val() + '" color="' + cmsms_stats_bar.eq(i + 2).val() + '"] ';
			}
			
			
			shortcode_tag += '[/stats]';
			
			
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
	<h3 class="media-title"><?php echo __('Set', 'cmsmasters') . ' ' . __('Stats', 'cmsmasters') . ' ' . __('Shortcode Options', 'cmsmasters'); ?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
						<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
						<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
							<p style="padding:0;" class="help alignleft"><?php _e('Stats Bar', 'cmsmasters'); ?> #1</p>
							<span class="alignright">
								<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
							</span>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="percent_title0"><?php _e('Title', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $stats[0]['title']) ? $stats[0]['title'] : ''; ?>" name="percent_title0" id="percent_title0" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="percent_value0"><?php _e('Percent Value', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $stats[0]['value']) ? $stats[0]['value'] : ''; ?>" name="percent_value0" id="percent_value0" class="popup_tr_value" aria-required="true" style="width:45px;" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="percent_color0"><?php _e('Color', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $stats[0]['color']) ? $stats[0]['color'] : '#3a454b'; ?>" name="percent_color0" id="percent_color0" class="popup_tr_value my-color-field" aria-required="true" data-default-color="#3a454b" />
						</td>
					</tr>
					<?php 
						$i = 2;
						
						if (isset($stats_array)) {
							foreach ($stats_array as $stats_array_item) { 
					?>
							<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf; background-color:#eeeeee;">
								<th valign="top" scope="row" style="width:130px; padding-top:10px;" class="label"></th>
								<td style="font-weight:bold; padding:8px 12px 7px 0;" class="field">
									<p style="padding:0;" class="help alignleft"><?php _e('Stats Bar', 'cmsmasters'); ?> #<?php echo $i; ?></p>
									<span class="alignright">
										<a class="del_item_but" title="<?php _e('Delete', 'cmsmasters'); ?>" href="#">[x]</a>
									</span>
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="percent_title<?php echo $i; ?>"><?php _e('Title', 'cmsmasters'); ?></label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($stats_array_item['title']) ? $stats_array_item['title'] : ''; ?>" name="percent_title<?php echo $i; ?>" id="percent_title<?php echo $i; ?>" class="popup_tr_value" aria-required="true" />
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="percent_value<?php echo $i; ?>"><?php _e('Percent Value', 'cmsmasters'); ?></label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($stats_array_item['value']) ? $stats_array_item['value'] : ''; ?>" name="percent_value<?php echo $i; ?>" id="percent_value<?php echo $i; ?>" class="popup_tr_value" aria-required="true" style="width:45px;" />
								</td>
							</tr>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="percent_color<?php echo $i; ?>"><?php _e('Color', 'cmsmasters'); ?></label>
									</span>
									<span class="alignright">
										<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($stats_array_item['color']) ? $stats_array_item['color'] : '#3a454b'; ?>" name="percent_color<?php echo $i; ?>" id="percent_color<?php echo $i; ?>" class="popup_tr_value my-color-field" aria-required="true" data-default-color="#3a454b" />
								</td>
							</tr>
							<script type="text/javascript">
								jQuery(document).ready(function () { 
									jQuery('#percent_color<?php echo $i; ?>').wpColorPicker();
								} );
							</script>
					<?php 
								$i++;
							}
						}
					?>
					<tr class="add_stats_bar" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add Stats Bar', 'cmsmasters'); ?>" name="add_stats_bar" id="add_stats_bar" class="button" />
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

