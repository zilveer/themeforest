<?php

// If captcha plugin is not active do not show captcha form
if(!Mk_Theme_Captcha::is_plugin_active()) return false;

?>
<div class="mk-form-row">
	<?php if(isset($view_params['show_icon'])) : ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-li-lock', 16); ?>
	<?php endif; ?>	
	<input placeholder="<?php _e( 'Enter Captcha', 'mk_framework' ); ?>" data-placeholder="<?php _e( 'Enter Captcha', 'mk_framework' ); ?>" class="captcha-form text-input s_txt-input full" type="text" data-type="captcha" name="captcha" required="required" autocomplete="off" tabindex="<?php echo $view_params['tab_index']; ?>" />
	<div class="captcha-block">
	<span class="captcha-image-holder"></span> 
	</div>
	<?php 
		if(isset($view_params['add_br'])) {
			echo '<br>';
		} 
	?>
	<a href="#" class="captcha-change-image"><?php _e( 'Not readable?', 'mk_framework' ); ?> <?php _e( 'Change text.', 'mk_framework' ); ?></a>
	
</div>

