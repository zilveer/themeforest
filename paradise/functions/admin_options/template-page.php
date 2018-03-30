<?php settings_errors(); ?>
<div class="wrap" id="theme_options">
	<?php screen_icon($this->page_icon); ?>
	<h2><?php echo (isset($this->page_title)) ? $this->page_title : get_admin_page_title(); ?></h2>
	<form action="options.php" <?php if ($this->use_upload): ?>enctype="multipart/form-data"<?php endif; ?> method="post">
		<?php settings_fields($this->slug.'_group'); ?>
		<?php do_settings_sections($this->slug); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
	</form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var items = [];
		var form = $('#theme_options form');
		$('<div/>').html(form.html()).attr('id', 'tabs').appendTo(form.html(''));
		$('#tabs').find('h3').each(function(index) {
			items[items.length] = '<li><a href="#tab-'+index+'">'+$(this).html()+'</a></li>';
			$(this).addClass('hidden').next('.form-table')
			.attr('id', 'tab-'+index);
		});
		$('#tabs').prepend('<ul>' + items.join('') + '</ul>');
		$("#tabs").tabs({
				cookie: {expires: 1}
		});
		$('.form-table').find('tr:first').find('th, td').css('border-top', 'none');
	});
</script>
<?php if ($this->use_picker): ?>
<?php global $_theme_pickers; ?>
<script type="text/javascript">
jQuery(document).mousedown(function(){
	jQuery('div[id^="colorPickerDiv"]').each(function(){
		var display = jQuery(this).css('display');
		if ( display == 'block' )
			jQuery(this).fadeOut(2);
	});
	<?php foreach($_theme_pickers as $_key => $_val): ?>
	jQuery.farbtastic('#<?php echo $_val; ?>').linkTo('#<?php echo $_key; ?>');
	jQuery('#<?php echo $_key; ?>').focus(function() {
		jQuery('#<?php echo $_val; ?>').show();
	});
	jQuery('#<?php echo $_key; ?>').focusout(function() {
		if (jQuery(this).val() == '')
			jQuery(this).val('#');
	});
	<?php endforeach; ?>
});
</script>
<?php endif; ?>