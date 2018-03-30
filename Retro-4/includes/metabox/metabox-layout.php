<?php $mb->the_group_open(); ?>

<p><strong><?php _e( 'Background Color', 'openframe' ); ?></strong></p>

<?php $mb->the_field( 'background-color' ); ?>
<p>
	<label>
		<input type="text" class="retro-iris-picker large-text code" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="<?php esc_attr_e( retro_get_background_color( isset( $_GET['post'] ) && intval( $_GET['post'] ) ? $_GET['post'] : null ) ); ?>" />
	</label>
</p>

<?php $mb->the_field( 'light-text' ); ?>
<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?> />
		<?php _e( 'Use a light color for text inside this section.', 'openframe' ); ?>
	</label>
</p>

<?php $mb->the_group_close(); ?>