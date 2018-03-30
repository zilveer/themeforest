<?php $mb->the_group_open(); ?>

<p><strong><?php _e( 'Page address', 'openframe' ); ?></strong></p>
		
<?php $mb->the_field( 'url' ); ?>
<p>
	<label>
		<input type="text" class="large-text code" name="<?php $mb->the_name(); ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>" placeholder="<?php esc_attr_e( isset( $_GET['post'] ) && intval( $_GET['post'] ) ? get_permalink( $_GET['post'] ) : 'http://' ); ?>" />
	</label>
</p>
<?php $mb->the_field( 'target' ); ?>
<p>
	<label>
	<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?> />
		<?php _e( 'Open link in a new page', 'openframe' ); ?>
	</label>
</p>

<?php $mb->the_group_close(); ?>