<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Pricing Table Shortcodes Script
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
	
	
	$pricing_table = array();
	
	
	foreach($pairs as $pair) {
		$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
		
		
		$pricing_table[$atr[0]] = $atr[1];
	}
	
	
	$pattern = "/^\[pricing_table\s.+\](.+)\[\/pricing_table\]$/";
	
	
	preg_match($pattern, $content, $matches);
	
	
	$new_content = str_replace('</ul>', '', str_replace('<ul class="price_table_list">', '', $matches[1]));
	
	
	if ($new_content != '') {
		$new_matches_array = explode('</li><li class="price_table_list_item">', $new_content);
		
		
		$new_matches_array[0] = str_replace('<li class="price_table_list_item">', '', $new_matches_array[0]);
		
		
		$new_matches_array[count($new_matches_array) - 1] = str_replace('</li>', '', $new_matches_array[count($new_matches_array) - 1]);
	}
} else {
	$content = ''; 
}

?>
<script type="text/javascript">
	jQuery(document).ready(function () { 
		jQuery('#pt_glow').wpColorPicker();
		
	
		jQuery(window).resize(function () { 
			if (jQuery('#TB_window').height() - 44 > jQuery('.popup_content').height() + 20) {
				jQuery('#TB_ajaxContent').height(jQuery('#TB_window').height() - 44);
			} else {
				jQuery('#TB_ajaxContent').height(jQuery('.popup_content').height() + 20);
			}
		} );
		
		
		jQuery('.add_list_item').delegate('#add_list_item', 'click', function () { 
			var tr = jQuery('#TB_ajaxContent table.describe > tbody > tr input[id^="price_list_text"]'), 
				i = (tr.length > 0) ? Number(tr.eq(tr.length - 1).attr('id').substr(-1, 1)) + 1 : 0, 
				html = '';
			
			
			html = '<tr>' + 
				'<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">' + 
					'<span class="alignleft">' + 
						'<label for="price_list_text' + i +'"><?php _e('List Item', 'cmsmasters'); ?> #' + (i + 1) + '</label>' + 
						'<span class="remove_list_item" style="color:#ff0000; padding-left:10px; cursor:pointer;">[x]</span>' + 
					'</span>' + 
				'</th>' + 
				'<td class="field" style="padding-top:10px;">' + 
					'<input type="text" value="" name="price_list_text' + i + '" id="price_list_text' + i + '" class="popup_tr_value cmsms_list_item" />' + 
				'</td>' + 
			'</tr>';
			
			
			jQuery('tr.add_list_item').before(html);
		} );
		
		
		jQuery('.describe').delegate('.remove_list_item', 'click', function () { 
			if (confirm('<?php _e('Are you sure that you want to delete this list item?', 'cmsmasters'); ?>')) {
				jQuery(this).closest('tr').remove();
			}
			
			
			return false;
		} );
	} );
	
	
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				cmsms_list_item = jQuery('#TB_ajaxContent .cmsms_list_item'), 
				price_title = jQuery('#price_title').val(), 
				price_text_price = jQuery('#price_text_price').val(), 
				price_currency = jQuery('#price_currency').val(), 
				price_coins = jQuery('#price_coins').val(), 
				price_period = jQuery('#price_period').val(), 
				price_but_text = jQuery('#price_but_text').val(), 
				price_but_link = jQuery('#price_but_link').val(), 
				pt_glow = jQuery('#pt_glow').val();
			
			
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
			
			
			shortcode_tag += '[pricing_table bgcolor=\"' + pt_glow + '\" title="' + price_title + '" price="' + price_text_price + '" buttontext="' + price_but_text + '" buttonlink="' + price_but_link + '"';
			
			
			if (price_currency !== '') {
				shortcode_tag += ' currency="' + price_currency + '"';
			}
			
			
			if (price_coins !== '') {
				shortcode_tag += ' coins="' + price_coins + '"';
			}
			
			
			if (price_period !== '') {
				shortcode_tag += ' period="' + price_period + '"';
			}
			
			
			shortcode_tag += ']';
			
			
			if (cmsms_list_item.length > 0) {
				shortcode_tag += '<ul class="price_table_list">';
			}
			
			
			for (var i = 0, ilength = cmsms_list_item.length; i < ilength; i += 1) {
				shortcode_tag += '<li class="price_table_list_item">' + cmsms_list_item.eq(i).val() + '</li>';
			}
			
			
			if (cmsms_list_item.length > 0) {
				shortcode_tag += '</ul>';
			}
			
			
			shortcode_tag += '[/pricing_table]';
			
			
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
	<h3 class="media-title"><?php echo __('Set', 'cmsmasters') . ' ' . __('Pricing Table', 'cmsmasters') . ' ' . __('Shortcode Options', 'cmsmasters'); ?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_title"><?php _e('Title', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['title']) ? $pricing_table['title'] : ''; ?>" name="price_title" id="price_title" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_text_price"><?php _e('Price', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['price']) ? $pricing_table['price'] : ''; ?>" name="price_text_price" id="price_text_price" class="popup_tr_value" aria-required="true" style="width:45px;" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_coins"><?php _e('Coins', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['coins']) ? $pricing_table['coins'] : ''; ?>" name="price_coins" id="price_coins" class="popup_tr_value" style="width:45px;" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_currency"><?php _e('Currency', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['currency']) ? $pricing_table['currency'] : ''; ?>" name="price_currency" id="price_currency" class="popup_tr_value" style="width:45px;" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_period"><?php _e('Period', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['period']) ? $pricing_table['period'] : ''; ?>" name="price_period" id="price_period" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_but_text"><?php _e('Button Text', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['buttontext']) ? $pricing_table['buttontext'] : ''; ?>" name="price_but_text" id="price_but_text" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="price_but_link"><?php _e('Button Link', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['buttonlink']) ? $pricing_table['buttonlink'] : ''; ?>" name="price_but_link" id="price_but_link" class="popup_tr_value" aria-required="true" />
						</td>
					</tr>
					<?php 
						$i = 0;
						
						if (isset($new_matches_array)) {
							foreach ($new_matches_array as $new_matches_item) { 
					?>
							<tr>
								<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
									<span class="alignleft">
										<label for="price_list_text<?php echo $i; ?>"><?php _e('List Item', 'cmsmasters'); ?> #<?php echo ($i + 1); ?></label>
										<span class="remove_list_item" style="color:#ff0000; padding-left:10px; cursor:pointer;">[x]</span>
									</span>
								</th>
								<td class="field" style="padding-top:10px;">
									<input type="text" value="<?php echo ($new_matches_item) ? $new_matches_item : ''; ?>" name="price_list_text<?php echo $i; ?>" id="price_list_text<?php echo $i; ?>" class="popup_tr_value cmsms_list_item" />
								</td>
							</tr>
					<?php 
								$i++;
							}
						}
					?>
					<tr class="add_list_item" style="border-top:1px dotted #dfdfdf;">
						<th class="label" style="width:130px; padding-top:15px;" scope="row"></th>
						<td class="field" style="padding-top:10px; padding-bottom:10px;">
							<input type="button" value="<?php _e('Add Feature', 'cmsmasters'); ?>" name="add_list_item" id="add_list_item" class="button" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="pt_glow"><?php _e('Pricing Color', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $pricing_table['bgcolor']) ? $pricing_table['bgcolor'] : '#58aa30'; ?>" name="pt_glow" id="pt_glow" class="popup_tr_value my-color-field" aria-required="true" data-default-color="#58aa30" />
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

