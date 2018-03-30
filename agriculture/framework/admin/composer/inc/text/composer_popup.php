<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0.1
 * 
 * Content Block Shortcode Popup
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
} else {
	$content = ''; 
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
	} );
	
	
	function insertShortcode() { 
		if (window.tinyMCE) {
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.get('column_content').save();
			}
			
			
			var shortcode_tag = '', 
				column_content = jQuery('#column_content').val().replace(/\n/g, '<br />');
			
			
			column_content = column_content.replace(/<table class="table"><br \/>/g, '<table class="table">').replace(/<(\/*)thead><br \/>/g, "<$1thead>").replace(/<(\/*)tbody><br \/>/g, "<$1tbody>").replace(/<(\/*)tfoot><br \/>/g, "<$1tfoot>").replace(/<\/tr><br \/>/g, '</tr>').replace(/<\/th><br \/>/g, '</th>').replace(/<\/td><br \/>/g, '</td>');
			
			
			shortcode_tag += (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) ? tinyMCE.get('column_content').getContent() : column_content;
			
			
			popupUpdateContent(shortcode_tag);
			
			
			if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
				tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
			}
			
			
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
		if (jQuery('#wp-column_content-wrap').hasClass('tmce-active')) {
			tinyMCE.execCommand('mceRemoveEditor', true, 'column_content');
		}
		
		
		tb_remove();
		
		
		return false;
	}
</script>
<div class="popup_content">
	<h3 class="media-title"><?php echo __('Set', 'cmsmasters') . ' ' . __('Content Block', 'cmsmasters') . ' ' . __('Shortcode Options', 'cmsmasters'); ?></h3>
	<div id="media-items" class="media-upload-form">
		<div class="media-item">
			<table class="describe">
				<tbody>
					<tr>
						<th class="label" valign="top" style="width:130px; padding-top:15px;" scope="row">
							<span class="alignleft">
								<label for="column_content"><?php _e('Content', 'cmsmasters'); ?></label>
							</span>
						</th>
						<td class="field" style="padding-top:10px;">
							<div id="wp-column_content-editor-container-wrap" class="wp-column_content-container-wrap">
							<?php 
								wp_editor($content, 'column_content', array( 
									'wpautop' => true, 
									'media_buttons' => false, 
									'textarea_rows' => 15 
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

