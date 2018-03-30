<?php $mb->the_group_open(); ?>
		
<?php $mb->the_field( 'url' ); ?>
<p>
	<label>
		<input type="text" class="large-text code" name="<?php $mb->the_name(); ?>" value="<?php echo esc_url( $mb->get_the_value() ); ?>" placeholder="https://www.youtube.com/watch?v=Lt7opm-AeCk" />
	</label>
</p>

<?php $mb->the_group_close(); ?>