<?php

$column_width = '';
if(isset($view_params['phone'])) {
	$column_width = ($view_params['phone'] == 'true') ? 'one-third' : 'half';
}

?>

<div class="mk-form-row <?php echo $column_width; ?>">
	<?php if(isset($view_params['show_icon'])) : ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-li-mail', 16); ?>
	<?php endif; ?>	
	<input placeholder="<?php _e( 'Your Email', 'mk_framework' ); ?>" class="text-input s_txt-input" type="email" data-type="email" required="required" name="email" value="" tabindex="<?php echo $view_params['tab_index']; ?>" />
</div>