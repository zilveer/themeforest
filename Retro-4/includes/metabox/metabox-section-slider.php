<?php $mb->the_group_open(); ?>
		
<ul id="retro-slides-mirror"></ul>

<div id="retro-slides-create">

	<h2><?php _e( 'Create New Slide', 'openframe' ); ?></h2>
	
	<p><a href="#select" class="button button-secondary button-large"><?php _e( 'Select Image', 'openframe' ); ?></a></p>
	
	<input type="hidden" name="image" />

	<p class="description"><?php _e( 'Recommended image size: 940x400px', 'openframe' ); ?></p>
		
	<p><input class="caption" type="text" name="caption" placeholder="<?php esc_attr_e( __( 'Caption', 'openframe' ) ); ?>" /></p>
	
	<p><input class="url" type="text" name="link-url" placeholder="<?php esc_attr_e( __( 'http://', 'openframe' ) ); ?>" /></p>
	
	<p><a href="#add" class="button button-primary button-large"><?php _e( 'Create Slide', 'openframe' ); ?></a></p>
	
</div>

<?php $mb->the_field( 'list' ); ?>

<input type="hidden" id="retro-slides" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />

<?php $mb->the_group_close(); ?>