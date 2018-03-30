<div id="of_container" class="wrap">
	<div id="of-popup-save" class="of-save-popup"><?php _e('Options Updated', 'royalgold'); ?></div>
	<div id="of-popup-reset" class="of-save-popup"><?php _e('Options Reset', 'royalgold'); ?></div>
	<div id="of-popup-fail" class="of-save-popup"><div class="of-save-fail"><?php _e('Error!', 'royalgold'); ?></div></div>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />
	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
		<div id="header"><div id="js-warning"><?php _e('Warning - This panel will not work properly without JavaScript enabled!', 'royalgold'); ?></div></div>
		<div id="info_bar">
			<h3><?php _e('Theme Options', 'royalgold'); ?></h3>
			<button type="button" class="save-options button-primary"><?php _e('Save All Changes', 'royalgold'); ?></button>
			<img src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="" />
			<div class="clear"></div>
		</div>
		<div id="main">
			<div id="of-nav">
				<ul><?php echo $options_machine->Menu; ?></ul>
			</div>
			<div id="content">
				<div class="inner">
					<?php echo $options_machine->Inputs; ?>

				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="save_bar">
			<button type="button" class="save-options button-primary"><?php _e('Save All Changes', 'royalgold'); ?></button>
			<img src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="" />
			<button type="button" class="reset-options button submit-button" ><?php _e('Reset Options', 'royalgold'); ?></button>
			<div class="clear"></div>
		</div>
	</form>
	<div class="clear"></div>
	<div class="temphide">
		<span id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
		<em id="message-delete-slide"><?php _e( 'Confirm if you wish to delete this slide?', 'royalgold' ); ?></em>
		<em id="message-backup-options"><?php _e( 'Confirm to backup your current saved options.', 'royalgold' ); ?></em>
		<em id="message-backup-restore"><?php _e( 'Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'royalgold' ); ?></em>
		<em id="message-backup-import"><?php _e( 'Confirm to import options.', 'royalgold' ); ?></em>
		<em id="message-reset-warning"><?php _e( 'Confirm to reset the options. All settings will be lost and replaced with default settings!', 'royalgold' ); ?></em>
		<ul id="sorter-newitem-list">
			<li><div class="slide_header"><strong><?php _e( 'Slide', 'royalgold' ); ?> %1</strong><input type="hidden" class="slide of-input order" name="%2[%1][order]" id="%2_slide_order-%1" value="%1"><a class="slide_edit_button" href="#"><?php _e( 'Edit', 'royalgold' ); ?></a></div><div class="slide_body" style="display:none;"><label><?php _e( 'Title', 'royalgold' ); ?></label><input type="text" class="slide of-input of-slider-title" name="%2[%1][title]" id="%2_%1_slide_title" value=""><label><?php _e( 'Image URL', 'royalgold' ); ?></label><input type="text" class="upload slide of-input" name="%2[%1][url]" id="%2_%1_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="%2_%1"><?php _e( 'Upload', 'royalgold' ); ?></span><span class="button remove-image hide" id="reset_%2_%1"><?php _e( 'Remove', 'royalgold' ); ?></span></div><div class="screenshot"></div><label><?php _e( 'Link URL (optional)', 'royalgold' ); ?></label><input type="text" class="slide of-input" name="%2[%1][link]" id="%2_%1_slide_link" value=""><label><?php _e( 'Description (optional)', 'royalgold' ); ?></label><textarea class="slide of-input" name="%2[%1][description]" id="%2_%1_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#"><?php _e( 'Delete', 'royalgold' ); ?></a><div class="clear"></div></div></li>
		</ul>
	</div>
</div>