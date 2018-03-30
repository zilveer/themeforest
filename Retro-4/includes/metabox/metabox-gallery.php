<?php $mb->the_group_open(); ?>

<?php $mb->the_field( 'images' ); ?>
<p>
	<a href="#" class="button button-secondary retro-image-select"><?php _e( 'Select Images', 'openframe' ); ?></a>
	<a href="#" class="button button-secondary retro-image-select-reset hidden"><?php _e( 'Empty', 'openframe' ); ?></a>
	<input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
</p>

<?php $mb->the_group_close(); ?>