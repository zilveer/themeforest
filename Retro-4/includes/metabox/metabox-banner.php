<?php $mb->the_group_open(); ?>

<?php $mb->the_field( 'imgbanner' ); ?>
<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?> />
		<?php _e( 'Use an image for banner', 'openframe' ); ?>
	</label>
</p>

<?php $mb->the_field( 'banner' ); ?>
<p>
	<a href="#" class="button button-secondary retro-single-image-select"><?php _e( 'Select Image', 'openframe' ); ?></a>
	<a href="#" class="button button-secondary retro-single-image-select-reset hidden"><?php _e( 'Empty', 'openframe' ); ?></a>	
	<input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
</p>

<p class="description"><?php _e( 'Recommended image size: 400x110px', 'openframe' ); ?></p>

<?php $mb->the_field( 'banner-retina' ); ?>
<p>
	<a href="#" class="button button-secondary retro-single-image-select"><?php _e( 'Select Image for Retina', 'openframe' ); ?></a>
	<a href="#" class="button button-secondary retro-single-image-select-reset hidden"><?php _e( 'Empty', 'openframe' ); ?></a>	
	<input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
</p>

<p class="description"><?php _e( 'Recommended image size: 800x220px', 'openframe' ); ?></p>

<?php $mb->the_group_close(); ?>