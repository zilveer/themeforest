<div class="mk-form-row">
	<?php if(isset($view_params['show_icon'])) : ?>
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-li-pencil', 16); ?>
	<?php endif; ?>	
	<textarea required="required" placeholder="<?php _e( 'Your Message', 'mk_framework' ); ?>" class="mk-textarea s_txt-input" name="content" tabindex="<?php echo $view_params['tab_index']; ?>"></textarea>
</div>