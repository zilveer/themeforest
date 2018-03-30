<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Content Slider Shortcode Popup
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
	
	
	$slider = array();
	
	
	foreach($pairs as $pair) {
		$atr = array_map("trim_quotes", preg_split("/\s*=\"\s*/", $pair));
		
		
		$slider[$atr[0]] = $atr[1];
	}
	
	
	$pattern = "/^\[content_slider\s.+\](.+)\[\/content_slider\]$/";
	
	
	preg_match($pattern, $content, $matches);
	
	
	$matches = explode(',', $matches[1]);
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
		
		
		if (jQuery('input[name="slider_height_type"]:checked').val() === 'fixed') {
			jQuery('#slider_height').parent().parent().show();
		} else {
			jQuery('#slider_height').parent().parent().hide();
		}
		
		
		jQuery('input[name="slider_height_type"]').change(function () { 
			if (jQuery('input[name="slider_height_type"]:checked').val() === 'auto') {
				jQuery('#slider_height').parent().parent().hide();
			} else if (jQuery('input[name="slider_height_type"]:checked').val() === 'fixed') {
				jQuery('#slider_height').parent().parent().show();
			}
		} );
		
		
		jQuery('#slider_images').parent().find('ul.selected_list').delegate('a', 'click', function () { 
			return false;
		} );
		
		
		jQuery('#slider_images').parent().find('ul.selected_list').delegate('a > span', 'click', function () { 
			jQuery(this).closest('li').remove();
			
			
			sliderIdsUpdate();
			
			
			return false;
		} );
		
		
		jQuery('#slider_images').parent().find('ul.selected_list').sortable( { 
			items : '> li', 
			placeholder : 'ui-sortable-highlight', 
			update : function () { 
				sliderIdsUpdate();
			} 
		} );
	} );
	
	
	function sliderIdsUpdate() { 
		var href_array = '';
		
		
		jQuery('#slider_images').parent().find('ul.selected_list > li').each(function () { 
			href_array += jQuery(this).find('> a').attr('href') + ',';
		} );
		
		
		jQuery('#slider_images').val(href_array.slice(0, -1));
	}
	
	
	function insertShortcode() { 
		if (window.tinyMCE) {
			var shortcode_tag = '', 
				popup_tr_value = jQuery('#TB_ajaxContent .popup_tr_value'), 
				slider_images = jQuery('#slider_images').val(), 
				slider_height_type = jQuery('input[name="slider_height_type"]:checked').val(), 
				slider_height = jQuery('#slider_height').val(), 
				slider_speed = jQuery('#slider_speed').val(), 
				slider_effect = jQuery('input[name="slider_effect"]:checked').val(), 
				slider_easing = jQuery('#slider_easing').val(), 
				slider_pause = jQuery('#slider_pause').val(), 
				active_slide = jQuery('#active_slide').val(), 
				pause_on_hover = jQuery('#pause_on_hover'), 
				touch_control = jQuery('#touch_control'), 
				slides_control = jQuery('#slides_control'), 
				arrow_control = jQuery('#arrow_control');
			
			
			for (var i = 0, ilength = popup_tr_value.length; i < ilength; i += 1) {
				popup_tr_value[i].style.removeProperty('border');
				
				
				if (popup_tr_value.eq(i).attr('aria-required') === 'true' && popup_tr_value.eq(i).parent().parent().css('display') !== 'none' && popup_tr_value.eq(i).parent().parent().parent().css('display') !== 'none') {
					if (popup_tr_value.eq(i).val() === '' || popup_tr_value.eq(i).val() === ' ') {
						alert('<?php _e('Enter required fields!', 'cmsmasters'); ?>');
						
						
						popup_tr_value.eq(i).css('border', '1px solid #ff0000').focus();
						
						
						return false;
					}
				}
			}
			
			
			shortcode_tag += '[content_slider height="' + ((slider_height_type === 'auto') ? 'auto' : slider_height) + 
				'" animation_speed="' + slider_speed + 
				'" effect="' + slider_effect + 
				'" easing="' + slider_easing + 
				'" pause_time="' + slider_pause + 
				'" active_slide="' + active_slide + 
				'" pause_on_hover="' + ((pause_on_hover.is(':checked')) ? 'true' : 'false') + 
				'" touch_control="' + ((touch_control.is(':checked')) ? 'true' : 'false') + 
				'" slides_control="' + ((slides_control.is(':checked')) ? 'true' : 'false') + 
				'" arrow_control="' + ((arrow_control.is(':checked')) ? 'true' : 'false') + '"]' + 
				slider_images + 
			'[/content_slider]';
			
			
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
	<h3 class="media-title"><?php echo __('Set', 'cmsmasters') . ' ' . __('Content Slider', 'cmsmasters') . ' ' . __('Shortcode Options', 'cmsmasters'); ?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label><?php _e('Slider Images', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:17px;">
							<a href="#" id="cmsms_composer_slider_media_button" class="button open_images_list"><?php _e('Choose slider images', 'cmsmasters'); ?></a>
							<ul class="lighbox_image_list selected_list">
						<?php 
							if ($content != '' && sizeof($matches) > 0) {
								foreach ($matches as $match) {
						?>
								<li>
									<a href="<?php echo $match; ?>">
										<?php echo wp_get_attachment_image($match, 'thumbnail', false); ?>
										<span></span>
									</a>
								</li>
						<?php 
								}
							}
						?>
							</ul>
							<input type="hidden" value="<?php if ($content != '' && sizeof($matches) > 0) {
								$res = '';
								
								foreach ($matches as $match) {
									$res .= $match . ',';
								}
								
								echo substr($res, 0, -1);
							} ?>" name="slider_images" id="slider_images" aria-required="true" class="popup_tr_value" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_height_type_1"><?php _e('Height Type', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="radio" value="auto" name="slider_height_type" id="slider_height_type_1" aria-required="true" class="popup_tr_value"<?php echo ($content != '') ? (($slider['height'] && $slider['height'] && $slider['height'] == 'auto') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="slider_height_type_1"><?php _e('Use automatic height', 'cmsmasters'); ?></label>
							<br />
							<input type="radio" value="fixed" name="slider_height_type" id="slider_height_type_2" aria-required="true" class="popup_tr_value"<?php echo ($content != '') ? (($slider['height'] && $slider['height'] && $slider['height'] != 'auto') ? ' checked="checked"' : '') : ''; ?> />
							<label for="slider_height_type_2"><?php _e('Use fixed height', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_height"><?php _e('Height', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $slider['height'] && $slider['height'] != 'auto') ? $slider['height'] : '300'; ?>" name="slider_height" id="slider_height" aria-required="true" class="popup_tr_value" style="width:45px; position:relative; z-index:1;" />
							<p class="help"><?php _e('in pixels', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_speed"><?php _e('Animation Speed', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $slider['animation_speed']) ? $slider['animation_speed'] : '0.5'; ?>" name="slider_speed" id="slider_speed" aria-required="true" class="popup_tr_value" style="width:45px; position:relative; z-index:1;" />
							<p class="help"><?php _e('in seconds', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_effect_1"><?php _e('Animation Effect', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="radio" value="slide" name="slider_effect" id="slider_effect_1" aria-required="true" class="popup_tr_value"<?php echo ($content != '') ? (($slider['effect'] && $slider['effect'] == 'slide') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="slider_effect_1"><?php _e('Slide', 'cmsmasters'); ?></label>
							<br />
							<input type="radio" value="fade" name="slider_effect" id="slider_effect_2" aria-required="true" class="popup_tr_value"<?php echo ($content != '') ? (($slider['effect'] && $slider['effect'] == 'fade') ? ' checked="checked"' : '') : ''; ?> />
							<label for="slider_effect_2"><?php _e('Fade', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_easing"><?php _e('Animation Effect', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<select name="slider_easing" id="slider_easing" aria-required="true" class="popup_tr_value">
								<option value="linear"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'linear') ? ' selected="selected"' : ''; ?>><?php _e('None', 'cmsmasters'); ?>&nbsp;</option>
								<option value="easeInQuad"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInQuad') ? ' selected="selected"' : ''; ?>>Ease-In-Quad&nbsp;</option>
								<option value="easeOutQuad"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutQuad') ? ' selected="selected"' : ''; ?>>Ease-Out-Quad&nbsp;</option>
								<option value="easeInOutQuad"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutQuad') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Quad&nbsp;</option>
								<option value="easeInCubic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInCubic') ? ' selected="selected"' : ''; ?>>Ease-In-Cubic&nbsp;</option>
								<option value="easeOutCubic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutCubic') ? ' selected="selected"' : ''; ?>>Ease-Out-Cubic&nbsp;</option>
								<option value="easeInOutCubic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutCubic') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Cubic&nbsp;</option>
								<option value="easeInQuart"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInQuart') ? ' selected="selected"' : ''; ?>>Ease-In-Quart&nbsp;</option>
								<option value="easeOutQuart"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutQuart') ? ' selected="selected"' : ''; ?>>Ease-Out-Quart&nbsp;</option>
								<option value="easeInOutQuart"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutQuart') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Quart&nbsp;</option>
								<option value="easeInQuint"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInQuint') ? ' selected="selected"' : ''; ?>>Ease-In-Quint&nbsp;</option>
								<option value="easeOutQuint"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutQuint') ? ' selected="selected"' : ''; ?>>Ease-Out-Quint&nbsp;</option>
								<option value="easeInOutQuint"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutQuint') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Quint&nbsp;</option>
								<option value="easeInSine"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInSine') ? ' selected="selected"' : ''; ?>>Ease-In-Sine&nbsp;</option>
								<option value="easeOutSine"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutSine') ? ' selected="selected"' : ''; ?>>Ease-Out-Sine&nbsp;</option>
								<option value="easeInOutSine"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutSine') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Sine&nbsp;</option>
								<option value="easeInExpo"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInExpo') ? ' selected="selected"' : ''; ?>>Ease-In-Expo&nbsp;</option>
								<option value="easeOutExpo"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutExpo') ? ' selected="selected"' : ''; ?>>Ease-Out-Expo&nbsp;</option>
								<option value="easeInOutExpo"<?php echo ($content != '') ? (($slider['easing'] && $slider['easing'] == 'easeInOutExpo') ? ' selected="selected"' : '') : ' selected="selected"'; ?>>Ease-In-Out-Expo&nbsp;</option>
								<option value="easeInCirc"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInCirc') ? ' selected="selected"' : ''; ?>>Ease-In-Circ&nbsp;</option>
								<option value="easeOutCirc"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutCirc') ? ' selected="selected"' : ''; ?>>Ease-Out-Circ&nbsp;</option>
								<option value="easeInOutCirc"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutCirc') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Circ&nbsp;</option>
								<option value="easeInElastic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInElastic') ? ' selected="selected"' : ''; ?>>Ease-In-Elastic&nbsp;</option>
								<option value="easeOutElastic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutElastic') ? ' selected="selected"' : ''; ?>>Ease-Out-Elastic&nbsp;</option>
								<option value="easeInOutElastic"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutElastic') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Elastic&nbsp;</option>
								<option value="easeInBack"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInBack') ? ' selected="selected"' : ''; ?>>Ease-In-Back&nbsp;</option>
								<option value="easeOutBack"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutBack') ? ' selected="selected"' : ''; ?>>Ease-Out-Back&nbsp;</option>
								<option value="easeInOutBack"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutBack') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Back&nbsp;</option>
								<option value="easeInBounce"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInBounce') ? ' selected="selected"' : ''; ?>>Ease-In-Bounce&nbsp;</option>
								<option value="easeOutBounce"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeOutBounce') ? ' selected="selected"' : ''; ?>>Ease-Out-Bounce&nbsp;</option>
								<option value="easeInOutBounce"<?php echo ($content != '' && $slider['easing'] && $slider['easing'] == 'easeInOutBounce') ? ' selected="selected"' : ''; ?>>Ease-In-Out-Bounce&nbsp;</option>
							</select>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slider_pause"><?php _e('Pause Time', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $slider['pause_time']) ? $slider['pause_time'] : '7.0'; ?>" name="slider_pause" id="slider_pause" aria-required="true" class="popup_tr_value" style="width:45px; position:relative; z-index:1;" />
							<p class="help"><?php _e('in seconds', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="active_slide"><?php _e('Active Slide', 'cmsmasters'); ?></label>
							</span>
							<span class="alignright">
								<abbr class="required" title="<?php _e('required', 'cmsmasters'); ?>">*</abbr>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<input type="text" value="<?php echo ($content != '' && $slider['active_slide']) ? $slider['active_slide'] : '1'; ?>" name="active_slide" id="active_slide" aria-required="true" class="popup_tr_value" style="width:45px; position:relative; z-index:1;" />
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="pause_on_hover"><?php _e('Pause on Hover', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="pause_on_hover" id="pause_on_hover" class="popup_tr_value"<?php echo ($content != '') ? (($slider['pause_on_hover'] && $slider['pause_on_hover'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="pause_on_hover"><?php _e('Pause slider on mouseover', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr style="border-top:1px dotted #dfdfdf; border-bottom:1px dotted #dfdfdf;">
						<th class="label" valign="top" style="width:130px;" scope="row"></th>
						<td class="field" style="font-weight:bold; padding-top:8px; padding-bottom:7px;">
							<p class="help"><?php _e('Choose Content Slider Controls', 'cmsmasters'); ?></p>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="touch_control"><?php _e('Touch Control', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="touch_control" id="touch_control" class="popup_tr_value"<?php echo ($content != '') ? (($slider['touch_control'] && $slider['touch_control'] == 'true') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="touch_control"><?php _e('Use touch control', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="slides_control"><?php _e('Slides Control', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="slides_control" id="slides_control" class="popup_tr_value"<?php echo ($content != '') ? (($slider['slides_control'] && $slider['slides_control'] == 'true') ? ' checked="checked"' : '') : ' checked="checked"'; ?> />
							<label for="slides_control"><?php _e('Use slides control', 'cmsmasters'); ?></label>
						</td>
					</tr>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="arrow_control"><?php _e('Arrow Control', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:15px;">
							<input type="checkbox" value="true" name="arrow_control" id="arrow_control" class="popup_tr_value"<?php echo ($content != '') ? (($slider['arrow_control'] && $slider['arrow_control'] == 'true') ? ' checked="checked"' : '') : ''; ?> />
							<label for="arrow_control"><?php _e('Use arrow control', 'cmsmasters'); ?></label>
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

