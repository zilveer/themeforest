<?php $mb->the_group_open(); ?>
		
<?php $mb->the_field( 'headline' ); ?>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name(); ?>" value="<?php echo $mb->get_the_value(); ?>" placeholder="<?php esc_attr_e( __( 'Your headline here', 'openframe' ) ); ?>" />
	</label>
</p>
<p class="description"><?php _e( 'Slogan placed under the section title or the ribbon content in case you choose a Slider section.', 'openframe' ); ?></p>

<?php $mb->the_group_close(); ?>